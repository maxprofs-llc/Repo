<?php

  abstract class base implements JsonSerializable {
    
    public static $_db;
    public static $_login;
    public static $parentDepth = 0;

    public static $instances;
    public static $arrClass;
    public static $select;
    public static $parents = array();
    public static $children = array();
    public static $prefixes = array();
    public static $cols = array();
    public static $selfParent = FALSE;
    public static $validators = array();
    public static $mandatory = array();
    public static $infoProps = array();

    public function __construct($data = NULL, $search = config::NOSEARCH, $depth = NULL) {
      $depth = (preg_match('/^[0-9]+$/', $depth)) ? $depth : config::$parentDepth;
      if (!self::$_db) {
        self::$_db = new db();
      }
      $this->db = self::$_db;
      if (!static::$instances)  {
        static::$instances = (property_exists($this, 'arrClass')) ? new static::$arrClass : array();
      }
      if ($data === FALSE) {
        $this->failed = TRUE;
      } else {
        if ($search === config::NOSEARCH) {
          if (is($data)) {
            if (isId($data)) {
              if (is_object(static::$instances['ID'.$data])) {
                $obj = static::$instances['ID'.$data];
              } else {
                $obj = $this->db->getObjectById(get_class($this), $data);
              }
              if ($obj) {
                $this->_set($obj);
              } else {
                $this->failed = TRUE;
              }
            } else if (is_string($data) && is_object(json_decode($data))) {
              $this->_set(json_decode($data));
            } else if (isObj($data) && get_class($data) == get_class($this)) {
              $this->_set($data);
            } else if (isObj($data) && isId($data->id)) {
              $dataClass = get_class($data);
              $dataTable = (property_exists($data, 'table')) ? $dataClass::$table : $dataClass;
              $objSearch[$dataTable.'_id'] = $data->id;
              $obj = $this->db->getObjectByProps(get_class($this), $objSearch);
              if ($obj) {
                $this->_set($obj);
              } else {
                $this->failed = TRUE;
              }
            } else if (isAssoc($data) || is_object($data)) {
              $this->_set($data);
            } else if (is_string($data)) {
              if ($data != 'empty' && $data != 'new') {
                $search = 'name';
                $obj = $this->db->getObjectByProp(get_class($this), $search, $data);
                if (!$obj) {
                  $this->failed = TRUE;
                }
              }
            }
          }
        } else {
          if (isAssoc($data)) {
            $obj = $this->db->getObjectByProps(get_class($this), $data);
          } else if (isObj($data) && isId($data->id)) {
            $dataClass = get_class($data);
            $dataTable = (property_exists($data, 'table')) ? $dataClass::$table : $dataClass;
            $objSearch[$dataTable.'_id'] = $data->id;
            if (isObj($search) && isId($search->id)) {
              $searchClass = get_class($search);
              $searchTable = (property_exists($search, 'table')) ? $searchClass::$table : $searchClass;
              $objSearch[$searchTable.'_id'] = $search->id;
            }
            if (isObj($depth) && isId($depth->id)) {
              $depthClass = get_class($depth);
              $depthTable = (property_exists($depth, 'table')) ? $depthClass::$table : $depthClass;
              $objSearch[$depthTable.'_id'] = $depth->id;
            }
            $obj = $this->db->getObjectByProps(get_class($this), $objSearch);
          } else if (is($data)) {
            $obj = $this->db->getObjectByProp(get_class($this), $search, $data);
          }
          if ($obj) {
            $this->_set($obj);
          } else {
            $this->failed = TRUE;
          }
        }
        if ($this->id) {
          static::$instances['ID'.$this->id] = $this;
          $this->populate($depth);
        }
      }
    }

    protected function _set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
      return TRUE;
    }
    
    public function __get($prop) {
      if (property_exists($this, $prop)) {
       return $this->$prop;
      } else if (property_exists($this, $prop.'_id')) {
        if ($this->{$prop.'_id'} && !$this->$prop) {
          self::$parentDepth = 0;
          $this->populate();
          return $this->$prop;
        }
      } else {
        return NULL;
      }
    }
    
    function getObj($type = NULL, $arg = NULL) {
      if (method_exists($this, $type)) {
        return $this->$type($arg);
      } else {
        return NULL;
      }
    }
    
    public function unsetProp($prop) {
      return $this->setProp($prop, NULL);
    }
    
    public function setProp($prop, $value = NULL) {
      if (isObj($prop, TRUE) && static::$parents[$prop]) {
        if (!is_null($value)) {
          if (!isObj($value)) {
            $class = static::$parents[$prop];
            $value = $class($value);
          }
          if (!isObj($value)) {
            warning('Trying to set '.$prop.' to invalid object');
            return FALSE;
          }
        }
        $prop = $prop.'_id';
      }
      if (isObj($value)) {
        $valueObj = $value;
        $value = $value->id;
      }
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      $cols = $this->getColNames();
      if (!in_array($prop, $cols)) {
        $prop = (static::$cols[$prop]) ? static::$cols[$prop] : $prop;
      }
      if (!in_array($prop, $cols)) {
        $props = array_flip(static::$cols);
        $prop = ($props[$prop]) ? $props[$prop] : $prop;
      }
      if ($this->id && in_array($prop, $cols)) {
        $query = 'update '.$table.' set '.$prop.' = '.db::getAlias($prop);
        $values[db::getAlias($prop)] = $value;
        if (substr($prop, -3) == '_id' && isObj($valueObj) && in_array(substr($prop, 0, -3), $cols)) {
          $query .= ', '.substr($prop, 0, -3).' = '.db::getAlias(substr($prop, 0, -3));
          $values[db::getAlias(substr($prop, 0, -3))] = $valueObj->name;
        }
        $query .= ' where id = '.$this->id;
        $update = $this->db->update($query, $values);
        if ($update) {
          $this->$prop = $value;
          if (substr($prop, -3) == '_id') {
            $this->populate(1);
          }
        }
        return $update;
      }
      return FALSE;
    }
    
    public function getColNames() {
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      return $this->db->getColNames($table);
    }

    protected function update() {
      if ($this->id) {
        $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
        $cols = $this->getColNames();
        $query = 'update '.$table.' set ';
        $array = $this->getQueryArray($cols, ', ');
        $query .= $array['update'].' where id = '.$this->id;;
        return $this->db->update($query, $array['values']);
      }
      return false;
    }
    
    protected function add() {
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      $cols = $this->db->getColNames($table);
      $query = 'insert into '.$table.' set ';
      $array = $this->getQueryArray($cols, ', ', FALSE);
      $query .= $array['update'];
      return $this->db->insert($query, $array['values']);
    }
    
    public function save($propagate = FALSE) {
      if ($this->id) {
        $return = $this->update();
      } else {
        $return = $this->add();
      }
      if ($propagate) {
        // Propagate
      }
      return $return;
    }

    public function merge($removeObj, $delete = TRUE) {
      foreach (static::$children as $idColumn => $targets) {
        foreach ($targets['classes'] as $childClass) {
          $table = (property_exists($childClass, 'table')) ? $childClass::$table : $childClass;
          $fieldLines = array();
          foreach($targets['fields'] as $prop => $column) {
            $fieldLines[] = $column.' = "'.$this->$prop.'"';
          }
          $fieldLines = implode(",\n", $fieldLines);
          $query = '
            update '.$table.'
              set '.$idColumn.' = '.$this->id.',
              '.$fieldLines.'
            where '.$idColumn.' = '.$removeObj->id.'
          ';
          $update = $this->db->update($query);
          if (!$update) {
            $failure = TRUE;
            return FALSE;
          }
        }
      }
      if ($delete) {
        $remove = $removeObj->delete(FALSE);
        return ($remove) ? TRUE : FALSE;
      }
      return TRUE;
    }
    
    protected function getQueryArray($cols = NULL, $cond = 'or', $nulls = FALSE) {
      $obj = get_object_vars($this);
      $cols = ($cols) ? $cols : array_keys($obj);
      foreach ($cols as $col) {
        $prop = (property_exists($this, 'table') && static::$cols[$col]) ? static::$cols[$col] : $col;
        $updates[] = '`'.$col.'`'.(($nulls && $obj[$prop] === NULL) ? ' is ' : ' = ').db::getAlias($col);
        $values[db::getAlias($col)] = (isObj($obj[$prop])) ? $obj[$prop]->name : $obj[$prop];
      }
      return array('update' => implode($updates, $cond), 'values' => $values);
    }
    
    public function getPhotoIcon($icon = NULL) {
      $photo = $this->getPhoto(FALSE, TRUE, FALSE);
      $icon = ($icon) ? $icon : config::$baseHref.'/images/objects/'.get_class($this).'.png';
      return ($photo) ? '
        <img src="'.$icon.'" data-photoDiv="'.$this->id.get_class($this).'PhotoDiv" class="photoIcon icon" title="Click to view photo">
        <div id="'.$this->id.get_class($this).'PhotoDiv" class="photoPopup" title="'.$this->name.'">
          <img src="'.$photo.'" class="popupPhoto">
        </div>
      ' : '';
    }
    
    public function getIcon($anchor = TRUE, $defaults = FALSE) {
      $photo = $this->getPhoto($defaults, TRUE, FALSE);
      $icon = '<img src="'.$photo.'" class="icon" title="Click to view '.$this->name.'">';
      $link = ($anchor) ? $this->getLink('object', TRUE, FALSE, FALSE, $defaults, $icon) : $icon;
      return ($link) ? $link : FALSE;
    }

    public function getInfo() {
      $info = new div($this->id.'_'.get_class($this).'_InfoDiv');
      $left = $info->addDiv($this->id.'_'.get_class($this).'_InfoDivLeft', 'left');
      if (static::$infoProps) {
        foreach (static::$infoProps as $label => $prop) {
          $html = FALSE;
          if (isObj($this->$prop)) {
            $link = $this->$prop->getLink('object', FALSE);
            if ($link) {
              $html = new link($link, $this->$prop->name);
            } else {
              $html = $this->${$prop.'Name'};
            }
          } else if (method_exists($this, $prop)) {
            $html = $this->$prop();
          } else if ($prop == 'name' || $label === 'name') {
            $context = (get_class($this) == 'player' || get_class($this) == 'team' || get_class($this) == 'qualGroup') ? division($this->tournamentDivision) : getTournament();
            if (isTournament($context) || isDivision($context)) {
              $arrClass = static::$arrClass;
              $objs = $arrClass($context);
              $selectDiv = $left->addDiv($this->id.'_'.get_class($this).'_NameDiv');
              $select = $objs->getSelectObj(get_class($this).'_Select', $this, 'Name');
              $select->addCombobox();
              $select->addChange('location.assign("'.config::$baseHref.'//object/?obj='.get_class($this).'&id=" + $(this).val());');
              $select->addFocus('#'.$select->id.'_combobox');
              $selectDiv->addContent($select);
            } else {
              $nameDiv = $left->addDiv();
              $nameDiv->addLabel('Name');
              $nameDiv->addSpan($this->name);
            }
          } else if(is($this->$prop)){
            $html = (string) $this->$prop;
          }
          if (isHtml($html) && get_class($html) == 'div') {
            $left->addContent($html);
          } else if ($html) {
            $nameDiv = $left->addDiv($this->id.'_'.get_class($this).'_'.ucfirst($prop).'Div');
            $nameDiv->addLabel(((isId($label)) ? ucfirst($prop) : $label));
            $nameDiv->addSpan($html, NULL, 'info')->escape = FALSE;
          }
        }
      } else {
        $context = (get_class($this) == 'player' || get_class($this) == 'team') ? division($this->tournamentDivision) : getTournament();
        if (isTournament($context) || isDivision($context)) {
          $arrClass = static::$arrClass;
          $objs = $arrClass($context);
          $selectDiv = $left->addDiv($this->id.'_'.get_class($this).'_NameDiv');
          $select = $objs->getSelectObj(get_class($this).'_Select', $this, 'Name');
          $select->addCombobox();
          $select->addChange('location.assign("'.config::$baseHref.'//object/?obj='.get_class($this).'&id=" + $(this).val());');
          $select->addFocus('#'.$select->id.'_combobox');
          $selectDiv->addContent($select);
        } else {
          $nameDiv = $left->addDiv();
          $nameDiv->addLabel('Name');
          $nameDiv->addSpan($this->name, NULL, 'info');
        }
      }
      $right = $info->addDiv($this->id.'_'.get_class($this).'_InfoDivRight', 'right');
      $person = person('login');
      if ($person && $person->receptionist) {
        $props = array(
          'ID' => 'id',
          'Person ID' => 'person_id',
          'Team ID' => 'team_id',
          'Game ID' => 'game_id'
        );
        foreach ($props as $key => $prop) {
          if ($this->$prop) {
            $div = $left->addDiv();
            $div->addLabel($key);
            $div->addSpan($this->$prop, NULL, 'info');
          }
        }
      }
      if ($this->getPhoto()) {
        $right->addImg($this->getPhoto(), $this->name, array('class' => 'infoImg'));
      }
      return $info;
    }
    
    public function getChildrenTabs() {
      return NULL;
    }
    
    public function getPhoto($defaults = TRUE, $thumbnail = FALSE, $anchor = FALSE) {
      return $this->getLink('photo', $anchor, $thumbnail, FALSE, $defaults);
    }

    public function getLink($type = 'object', $anchor = TRUE, $thumbnail = FALSE, $preview = FALSE, $defaults = TRUE, $text = NULL) {
      switch ($type) {
        case 'photo':
          if ($defaults) {
            foreach (config::$photoExts as $ext) {
              if (file_exists(config::$baseDir.'/images/objects/0.'.$ext)) {
                $url = config::$baseHref.'/images/objects/0.'.$ext;
              }
            }
            foreach (config::$photoExts as $ext) {
              if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/0.'.$ext)) {
                $url = config::$baseHref.'/images/objects/'.get_class($this).'/0.'.$ext;
              }
            }
            if ($thumbnail) {
              foreach (config::$photoExts as $ext) {
                if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/0.thumb.'.$ext)) {
                  $url = config::$baseHref.'/images/objects/'.get_class($this).'/0.thumb.'.$ext;
                } 
              }
            }
          }
          if (get_class($this) == 'player' || get_class($this) == 'person') {
            foreach (config::$photoExts as $ext) {
              if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/ifpa/'.$this->ifpa_id.'.'.$ext)) {
                $url = config::$baseHref.'/images/objects/'.get_class($this).'/ifpa/'.$this->ifpa_id.'.'.$ext;
              }
            }
          }
          foreach (config::$photoExts as $ext) {
            if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/'.$this->id.'.'.$ext)) {
              $url = config::$baseHref.'/images/objects/'.get_class($this).'/'.$this->id.'.'.$ext;
            }
          }
          if ($thumbnail) {
            foreach (config::$photoExts as $ext) {
              if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/'.$this->id.'.thumb.'.$ext)) {
                $url = config::$baseHref.'/images/objects/'.get_class($this).'/'.$this->id.'.thumb.'.$ext;
              }
            }
          } 
          if (!$url) {
            $url = NULL;
          }
        break;
        case 'shortName':
          if ($this->shortName) {
            $text = ($text) ? $text : $this->shortName;
          } else {
            return NULL;
          }
        case 'object':
          $url = ($this->id) ? config::$baseHref.'/object/?obj='.get_class($this).'&id='.$this->id : NULL;
        break;
        case 'qr':
          QRcode::png(((get_class($this) == 'machine') ? 'g' : substr(get_class($this),0,1)).'id='.$this->id.'&'.((get_class($this) == 'person') ? 'tag' : ((get_class($this) == 'machine') ? 'game' : get_class($this))).'='.$this->shortName, config::$baseDir.'/images/objects/'.get_class($this).'/qr/'.$this->id.'.png', 0, 6, 0);
          return config::$baseHref.'/images/objects/'.get_class($this).'/qr/'.$this->id.'.png';
        break;
        default:
          return NULL;
        break;
      }
      return ($url && $anchor) ? '<a href="'.$url.'">'.(($text) ? $text : $this->name).'</a>' : $url;
    }

    protected function populate($depth = NULL) {
      $depth = ($depth || $depth === 0) ? $depth : config::$parentDepth;
      if (self::$parentDepth < $depth) {
        self::$parentDepth++;
        foreach (static::$parents as $field => $class) {
          if ($this->{$field.'_id'}) {
            $this->{$field.'ParentDepth'} = self::$parentDepth;
            if (is_object($class::$instances['ID'.$this->{$field.'_id'}])) {
              $this->$field = $class::$instances['ID'.$this->{$field.'_id'}]->getFlat();
            } else {
              $this->$field = $class($this->{$field.'_id'}, config::NOSEARCH, $depth);
            }
            $this->{$field.'Name'} = $this->$field->name;
          }
        }
        self::$parentDepth--;
      }
    }
    
    public function delete($propagate = TRUE) {
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      if ($this->id) {
        $delete = (property_exists($this, 'delete')) ? static::$delete : 'delete from '.$table.' where id = :id';
        if ($this->db->delete($delete, array('id' => $this->id))) {
          unset(static::$instances['ID'.$this->id]);
          if ($propagate) {
            // @todo: deletion propagation
/*
            foreach (static::$children as $class => $target) {
              if (isAssoc($target)) {
                $field = ($target['field']) ? $target['field'] : $field;
                $delete = ($target['delete']) ? $target['delete'] : NULL;
              } else {
                $field = (is_string($target)) ? $target : get_class($parent);
              }
              if (class_exists($class)) {
                if ($delete) {
                  $objs = new $class::$arrClass(array($field = $this->id));
                  $objs->delete();
                } else {
                  $objs = new $class::$arrClass;
                  $objs->nullify(array($field.'_id' => $this->id));
                }
              }
            }
            */
          }
          return TRUE;
        } else {
          return FALSE;
        }
      } else {
        return FALSE;
      }
    }

    public function nullify($field, $value = NULL, $cond = 'or') {
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      if ($field) {
        $update = 'update '.$table.' set '.$field.' = null where id = :id';
        $values[':id'] = $this->id;
        if (isAssoc($value)) {
          $update .= ' and (';
          foreach ($value as $col => $val) {
            $updates[] = $col .' = '.db::getAlias($col);
            $values[db::getAlias($col)] = $val;
          }
          $update .= implode($updates, ' '.$cond.' ').')';
        } else if (is_array($value)) {
          foreach ($value as $val) {
            $i++;
            $updates[] = $field .' = '.db::getAlias($field).$i;
            $values[db::getAlias($field).$i] = $val;
          }
          $update .= implode($updates, ' '.$cond.' ').')';
        } else if ($value) {
          $update .= ' and '.$field.' = :value';
          $values[':value'] = $value;
        }
        if ($this->db->update($update, $values)) {
          return TRUE;
        }
      }
      return FALSE;
    }

/*
    function removeParent($parent, - $target = NULL) {
      $field = ($target) ? $target : get_class($parent).'_id';
      if ($this->$field == $parent->id) {
        return $this->setParent(NULL, $target);
      } else {
        return FALSE;
      }
    }
    
    function setParent($parent, $target = NULL)
      $parent = ($parent) ? $parent : $parent();
      $table = (property_exists($this, 'table')) ? static::$table : get_class($this);
      if (isAssoc($field)) {
        $table = ($field['table']) ? $field['table'] : $table;
        $field = ($field['field']) ? $field['field'] : $field;
      } else {
        $field = (is_string($field)) ? $field : get_class($parent).'_id';
      }
      return $this->db->update('update '.$table.' set '.$field.' = :parent where id = :id', array(':parent' => $parent->id, ':id' => $this->id));
    }
*/
    public function getPhotoEdit($prefix = NULL, $class = NULL) {
      return '
        '.page::getDivStart($prefix.'imageDiv', $class).'
          <form id="'.$prefix.'imageForm" method="post" enctype="multipart/form-data" action="'.config::$baseHref.'/ajax/imageUpload.php">
            <h2 id="regPlayerImgH2" class="entry-title">'.ucfirst(get_class($this)).' logo or picture</h2>
            <input type="hidden" name="'.$prefix.'action" id="'.$prefix.'action" value="preview">
            <input type="hidden" name="prefix" id="'.$prefix.'prefix" value="'.$prefix.'">
            <input type="hidden" name="'.$prefix.'obj" id="'.$prefix.'obj" value="'.get_class($this).'">
            <input type="hidden" name="'.$prefix.'id" id="'.$prefix.'id" value="'.$this->id.'">
      	    <div id="'.$prefix.'preview">
      		    <img src="'.$this->getPhoto().'?nocache='.rand(10000,20000).'" id="'.$prefix.'thumb" class="preview" alt="Preview of '.$this->name.'">
              <div id="'.$prefix.'imageLoader"></div>
      	    </div>
      	    <div id="'.$prefix.'uploadForm">
              <label id="'.$prefix.'imageUploadLabel" class="italic">Click picture to change preview, click button to save change</label>
              <input type="file" name="'.$prefix.'imageUpload" id="'.$prefix.'imageUpload">
            </div>
            <button id="'.$prefix.'submitImg" type="button" value="Save image" disabled>Save image</button>
            <script type="text/javascript">
              $(document).ready(function() { 
                $("#'.$prefix.'imageUpload").on("change", function() {
                  $("#'.$prefix.'preview").html("");
                  $("#'.$prefix.'imageLoader").html("<img src=\"'.config::$baseHref.'/images/loader.gif\" alt=\"Uploading....\"/>");
                  $("#'.$prefix.'submitImg").button("option", "disabled", false);
                  $("#'.$prefix.'imageForm").ajaxForm({
                    target: "#'.$prefix.'preview"
                  }).submit();
                  $("#'.$prefix.'imageLoader").html("");
                });
                $("#'.$prefix.'thumb").on("click", function() {
                  $("#'.$prefix.'imageUpload").trigger("click");
                });
                $("#'.$prefix.'submitImg").button();
              }); 
            </script>
          </form>
        '.page::getDivEnd().'
      ';
    }
    
    function setPhoto($path = NULL) {
      if ($this->id) {
        if (!$path) {
          foreach (config::$photoExts as $ext) {
            if (file_exists(config::$baseDir.'/images/objects/'.get_class($this).'/preview/'.$this->id.'.'.$ext)) {
              $path = 'images/objects/'.get_class($this).'/preview/'.$this->id.'.'.$ext;
              break;
            }
          }
        }
        if ($path) {
          if (rename(config::$baseDir.'/'.$path, config::$baseDir.'/'.preg_replace('/\/preview\//', '/', $path))) {
            return TRUE;
          } else {
            error('Could not move file');
          }
        } else {
          error('Could not find source file');
        }
      } else {
        error('Can not add photos to unsaved objects');
      }
      return FALSE;
    }

    public function jsonSerialize() {
      self::$parentDepth = 999999;
      return $this;
    }
    
    public function flatten() {
      foreach (static::$parents as $field => $class) {
        unset($this->$field);
      }
      return TRUE;
    }
    
    public function getFlat() {
      $obj = clone $this;
      foreach (static::$parents as $field => $class) {
        unset($obj->$field);
      }
      return $obj;
    }
    
    public static function  validate($prop, $value = NULL, $obj = FALSE, $mandatory = NULL) {
      if ($value === NULL || $value === '') {
        if ($mandatory || ($mandatory !== FALSE && static::$mandatory && in_array($prop, static::$mandatory))) {
          return validated(FALSE, 'The value is mandatory.', $obj);
        } else {
          return validated(TRUE, 'The value is empty and not mandatory.', $obj);
        }
      } else {
        if (static::$validators[$prop]) {
          if (is_array(static::$validators[$prop])) {
            if (static::$validators[$prop][0] == 'function') {
              if (function_exists(static::$validators[$prop][1])) {
                return call_user_func(static::$validators[$prop][1], $value, $obj);
              } else {
                warning('Non-existing function given as validator.');
              }
            } else if (static::$validators[$prop][0] == 'method') {
              if (method_exists(get_called_class(), static::$validators[$prop][1])) {
                return call_user_func(get_called_class().'::'.static::$validators[$prop][1], $value, $obj);
              } else {
                warning('Non-existing method given as validator.');
              }
            } else if (method_exists(static::$validators[$prop][0], static::$validators[$prop][1])) {
              return call_user_func(static::$validators[$prop][0]. '::'.static::$validators[$prop][1], $value, $obj);
            } else {
              warning('Unknown method given as validator.');
            }
          } else if (is_string(static::$validators[$prop])) {
            if (preg_match('/^\/.*\/$/', static::$validators[$prop])) {
              if (preg_match(static::$validators[$prop], $value)) {
                return validated(TRUE, $prop.' found to be valid.', $obj);
              } else {
                return validated(FALSE, $prop.' found to be invalid.', $obj);
              }
            } else if (method_exists(get_called_class(), static::$validators[$prop])) {
              return call_user_func(get_called_class().'::'.static::$validators[$prop], $value, $obj);
            } else if (function_exists(static::$validators[$prop])) {
              return call_user_func(static::$validators[$prop], $value, $obj);
            }
          }
        } else {
          if (method_exists(get_called_class(), 'validate'.ucfirst($prop))) {
            return call_user_func(get_called_class().'::validate'.ucfirst($prop), $value, $obj);
          } else if (function_exists('validate'.ucfirst($prop))) {
            return call_user_func('validate'.ucfirst($prop), $value, $obj);
          }
        }
      }
      return validated(TRUE, 'No validator found', $obj);
    }
    
    public function authorize($person, $prop = NULL, $value = NULL, $obj = FALSE) {
      $adminLevels = adminLevels('all');
      $adminLevelNames = $adminLevels->getListOf();
      if (property_exists(get_called_class(), 'authorized')) {
        if (is_array(static::$authorized)) {
          if (static::$authorized[$prop]) {
            if (is_array(static::$authorized[$prop])) {
              if (static::$authorized[$prop][0] == 'function') {
                if (function_exists(static::$authorized[$prop][1])) {
                  return call_user_func(static::$authorized[$prop][1], $this, $person, $value, $obj);
                } else {
                  warning('Non-existing function given as authorization.');
                }
              } else if (static::$authorized[$prop][0] == 'method') {
                if (method_exists(get_called_class(), static::$authorized[$prop][1])) {
                  return call_user_func(get_called_class().'::'.static::$authorized[$prop][1], $person, $value, $obj);
                } else {
                  warning('Non-existing method given as authorization.');
                }
              } else if (method_exists(static::$authorized[$prop][0], static::$authorized[$prop][1])) {
                return call_user_func(static::$authorized[$prop][0]. '::'.static::$authorized[$prop][1], $person, $value, $obj);
              } else {
                warning('Unknown method given as authorization.');
              }
            } else if (is_string(static::$authorized[$prop])) {
              if (in_array(ucfirst(static::$authorized[$prop]), $adminLevelNames)) {
                $level = static::$authorized[$prop];
                return ($person->$level) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
              } else if (isId(static::$authorized[$prop])) {
                return ($person->adminLevel_id >= static::$authorized[$prop]) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
              } else if (method_exists(get_called_class(), static::$authorized[$prop])) {
                return call_user_func(get_called_class().'::'.static::$authorized[$prop], $person, $value, $obj);
              } else if (function_exists(static::$authorized[$prop])) {
                return call_user_func(static::$authorized[$prop], $person, $value, $obj);
              }
            }
          } else {
            if (is_array(static::$authorized['default'])) {
              if (static::$authorized['default'][0] == 'function') {
                if (function_exists(static::$authorized['default'][1])) {
                  return call_user_func(static::$authorized['default'][1], $this, $person, $prop, $value, $obj);
                } else {
                  warning('Non-existing function given as authorization.');
                }
              } else if (static::$authorized['default'][0] == 'method') {
                if (method_exists(get_called_class(), static::$authorized['default'][1])) {
                  return call_user_func(get_called_class().'::'.static::$authorized['default'][1], $person, $prop, $value, $obj);
                } else {
                  warning('Non-existing method given as authorization.');
                }
              } else if (method_exists(static::$authorized['default'][0], static::$authorized['default'][1])) {
                return call_user_func(static::$authorized['default'][0]. '::'.static::$authorized['default'][1], $person, $prop, $value, $obj);
              } else {
                warning('Unknown method given as authorization.');
              }
            } else if (is_string(static::$authorized['default'])) {
              if (in_array(ucfirst(static::$authorized['default']), $adminLevelNames)) {
                $level = static::$authorized['default'];
                return ($person->$level) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
              } else if ($isId(static::$authorized['default'])) {
                return ($person->adminLevel_id >= static::$authorized['default']) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
              } else if (method_exists(get_called_class(), static::$authorized['default'])) {
                return call_user_func(get_called_class().'::'.static::$authorized['default'], $person, $prop, $value, $obj);
              } else if (function_exists(static::$authorized['default'])) {
                return call_user_func(static::$authorized['default'], $person, $prop, $value, $obj);
              }
            }
          }
        } else {
          if (in_array(ucfirst(static::$authorized), $adminLevelNames)) {
            $level = static::$authorized;
            return ($person->$level) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
          } else if (isId(static::$authorized)) {
            return ($person->adminLevel_id >= static::$authorized) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(FALSE, 'Authorization denied', $obj);
          } else if (method_exists(get_called_class(), static::$authorized)) {
            return call_user_func(get_called_class().'::'.static::$authorized, $person, $value, $obj);
          } else if (function_exists(static::$authorized)) {
            return call_user_func(static::$authorized, $person, $value, $obj);
          } else {
            return (static::$authorized) ? authorized(TRUE, 'Authorization granted', $obj) : authorized(TRUE, 'Authorization granted', $obj);
          }
        }
      } else {
        if (method_exists(get_called_class(), 'authorize'.ucfirst($prop))) {
          return call_user_func(get_called_class().'::authorize'.ucfirst($prop), $person, $value, $obj);
        } else if (function_exists('authorize'.ucfirst($prop))) {
          return call_user_func('authorize'.ucfirst($prop), $person, $value, $obj);
        }
      }
      return authorized(TRUE, 'No authorization found', $obj);
    }

    public function toArray($recursive = FALSE) {
      $array = array();
      foreach ($this as $prop => $value) {
        if (is_object($value)) {
          if ($recursive) {
            $array[$prop] = $value->toArray($recursive);
          } else if ($this->{$prop.'Name'}) {
            $array[$prop] = $this->{$prop.'Name'};
          } else {
            $array[$prop] = TRUE;
          }
        } else {
          $array[$prop] = $value;
        }
      }
      return $array;
    }
    
  }
?>