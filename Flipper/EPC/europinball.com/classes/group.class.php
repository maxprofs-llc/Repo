<?php

  abstract class group extends ArrayObject {
    
    public static $objClass = 'group';
    public static $order = array();
    public static $all = array();
    public $select;
/*
    public static $order = array(
      'prop' => 'name',
      'type' => 'string',
      'dir' => 'asc'
    );
*/
    
    public function __construct($data = NULL, $prop = NULL, $cond = 'and') {
      parent::__construct();
      if (!base::$_db) {
        base::$_db = new db();
      } 
      $this->db = base::$_db;
      if (isAssoc($data)) {
        $objs = $this->db->getObjectsByProps(static::$objClass, $data, $cond);
      } else if (is_array($data) || isGroup($data)) {
        $class = get_class($this);
        $objs = new $class();
        foreach ($data as $obj) {
          if ($obj->id) {
            if (get_class($obj) == static::$objClass) {
              $objs[] = $obj;
            } else {
              if (!is_string($prop)) {
                $prop = (property_exists($data, 'table')) ? get_class_vars(get_class($data))['table'].'_id' : get_class($data).'_id';
              }
              $objs = $objs->array_merge($this->db->getObjectsByProp(static::$objClass, $prop, $obj->id));
            }
          } else if (is_int($obj)) {
            $objs[] = $this->db->getObjectById(static::$objClass, $obj);
          }
        }
      } else if (isObj($data) && $data->id && is_string($prop)) {
        $objs = $this->db->getObjectsByProp(static::$objClass, $prop, $data->id);
      } else if (isObj($data) && $data->id) {
        if (get_class($data) == static::$objClass) { 
          $class = get_class($this);
          $objs = new $class();
          $objs[] = $data;
        } else {
          if (isObj($prop) && $prop->id) {
            $props = array(
              ((property_exists($data, 'table')) ? get_class_vars(get_class($data))['table'] : get_class($data)).'_id' => $data->id,
              ((property_exists($prop, 'table')) ? get_class_vars(get_class($prop))['table'] : get_class($prop)).'_id' => $prop->id
            );
            if (isObj($cond) && $cond->id) {
              $props[((property_exists($cond, 'table')) ? get_class_vars(get_class($cond))['table'] : get_class($cond)).'_id'] = $cond->id;
              $cond = NULL;
            }
            $objs = $this->db->getObjectsByProps(static::$objClass, $props, $cond);
          } else {
            $prop = (property_exists($data, 'table')) ? get_class_vars(get_class($data))['table'] : get_class($data);
            $objs = $this->db->getObjectsByProp(static::$objClass, $prop.'_id', $data->id);
          }
        }
      } else if ($data && is_string($prop)) {
        $objs = $this->db->getObjectsByProp(static::$objClass, $prop, $data);
      } else if (is_string($data) && (preg_match('/^where /', trim($data)) || preg_match('/^left join/', trim($data)))) {
        $objs = $this->db->getObjectsByWhere(static::$objClass, $data);
      } else if ($data == 'all') {
        $class = static::$objClass;
        $query = $class::$select;
        $objs = $this->db->getObjects($query, $class);
      } else if (in_array($data, array('login', 'auth'))) {
        $person = person($data);
        if ($person) {
          $objs = $this->db->getObjectsByProp(static::$objClass, 'person_id', $person->id);
        }
      } else if (in_array($data, array('active', 'current'))) {
        $tournament = tournament($data);
        if ($tournament) {
          $objs = $this->db->getObjectsByProp(static::$objClass, 'tournamentEdition_id', $tournament->id);
        }
      } else if (in_array($data, config::$divisions)) {
        $division = division($data);
        if ($division) {
          $objs = $this->db->getObjectsByProp(static::$objClass, 'tournamentDivision_id', $division->id);
        }
      }
      if ($objs) {
        $objs = $objs->array_unique(SORT_REGULAR);
        foreach ($objs as $obj) {
          $this[] = $obj;
        }
      }
      $this->order();
    }
    
    public function __call($func, $argv) {
      if (!is_callable($func) || substr($func, 0, 6) !== 'array_') {
        throw new BadMethodCallException(__CLASS__.'->'.$func);
      } else if (in_array($func, array('array_map'))) {
        return call_user_func_array($func, array_merge($argv, array($this->getArrayCopy())));
      } else {
        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
      }
    }
    
    public function clear() {
      $array = array();
      $this->exchangeArray($array);
    }

    public function nullify($field, $value = NULL, $cond = 'or') {
      if (count($this) > 0) {
        foreach($this as $obj) {
          $return = $obj->nullify($field, $value);
          if (!$return) {
            return FALSE;
          }
        }
        return TRUE;
      } else if ($field) {
        $table = (property_exists(static::$objClass, 'table')) ? get_class_vars(static::$objClass)['table'] : static::$objClass;
        $update = 'update '.$table.' set '.$field.' = null where 1 = :one';
        $values[':one'] = 1;
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
    
    public static function _getSelect($id = NULL, $class = NULL, $label = TRUE, $selected = NULL, $add = FALSE, $objs = NULL) {
      $group = new group();
      if ($objs && count($objs) > 0) {
        foreach ($objs as $key => $obj) {
          if (is_int($obj->id)) {
            if ($group[$obj->id]) {
              if ($group[$obj->id]->id == $obj->id) { 
                $group[$obj->id] = $obj;
              } else if ($group[$obj->id]->id) {
                $group[$group[$obj->id]->id] = $group[$obj->id];
                $group[$obj->id] = $obj;
              } else {
                $group[$obj->id]->id = end($group->array_keys()) + 1;
                $group[$group[$obj->id]->id] = $group[$obj->id];
                $group[$obj->id] = $obj;
              }
            } else {
              $group[$obj->id] = $obj;
            }
          } else {
            $obj->id = end($group->array_keys()) + 1;
            $group[$obj->id] = $obj;
          }
        }
      }
      return $group->getSelect($id, $class, $label, $selected, $add);
    }

    public function getSelect($id = NULL, $class = NULL, $label = TRUE, $selected = NULL, $add = FALSE) {
      $id = ($id) ? $id : static::$objClass;
      $label = ($label === TRUE) ? $id : $label;
      $selectedId = (is_object($select) && $selected->id) ? $selected->id : (($selected) ? $selected : 0);
      $select = ($label) ? '<label'.(($id) ? ' for="'.$id.'" id="'.$id.'Label"' : '').' class="'.(($class) ? $class.'Label ' : '').'label">'.$label.'</label>' : '';
      $select .= '
        <select'.(($id) ? ' id="'.$id.'" name="'.$id.'"' : '').(($class) ? ' class="'.$class.'"' : '').' data-previous="'.$selectedId.'">
          <option value="0"></option>
      ';
      if (count($this) > 0) {
        foreach ($this as $obj) {
          $select .= '<option value="'.$obj->id.'"'.(($obj->id == $selectedId) ? ' selected' : '').'>'.$obj->name.'</option>';
        }
      }
      $select .= '</select>';
      if ($add) {
        $select .= page::getIcon('images/add_icon.gif', 'add_'.static::$objClass, 'addIcon editIcon', 'Click to add new '.static::$objClass);
      }
      return $select;
    }
    
    public function getSelectObj($name = NULL, $selected = NULL, $label = NULL, $params = NULL) {
      if (isObj($selected)) {
        $selected = $selected->id;
      } else if (is_array($selected)) {
        $selected = array_keys($selected)[0];
      }
      if (!$this->select) {
        $name = ($name) ? $name : get_class($this);
        $label = ($label || $label === FALSE) ? $label : ucfirst($name);
        $params['id'] = ($params['id']) ? $params['id'] : $name;
        $options[] = new option('Choose...', 0, !$selected);
        foreach ($this as $obj) {
          $selected = (isId($selected)) ? $selected : (($obj->name === $selected) ? $obj->id : NULL);
          $option = new option($obj->name, $obj->id);
          $options[] = $option;
        }
        $this->select = new select(NULL, $options, NULL, NULL, $params);
      }
      $select = $this->select->getClone($label, $name, NULL, $params);
      $select->selectOption($selected);
      return $select;
    }
    
    public function getTable($id = NULL, $class = NULL, array $headers = NULL) {
      if (!$headers && $headers !== FALSE) {
        $class = static::$objClass;
        $thead = new tr();
        foreach ($class::$infoProps as $label => $prop) {
          $headers[$label] = $prop;
          $thead->addTh(((isId($label)) ? ucfirst($prop) : $label));
        }
      } else {
        foreach ($headers as $label => $prop) {
          $thead->addTh(((isId($label)) ? ucfirst($prop) : $label));
        }
      }
      foreach ($this as $obj) {
        $row = new tr();
        foreach ($headers as $prop) {
          if (isObj($obj->$prop)) {
            $link = $obj->$prop->getLink('object', FALSE);
            if ($link) {
              $row->addTd(new link($link, $obj->$prop->name));
            } else {
              $row->addTd($obj->${$prop.'Name'});
            }
          } else if (method_exists($obj, $prop)) {
            $row->addTd($obj->$prop());
          } else if(is($obj->$prop)){
            $row->addTd((string) $obj->$prop);
          } else {
            $row->addTd();
          }
        }
        $tbody[] = $row;
      }
      $table = new table($tbody, $thead, $id, $class);
      $table->addDatatables();
      return $table;
    }
      
    public function order($prop = NULL, $type = NULL, $direction = NULL, $case = FALSE, $keepkeys = FALSE) {
      $return = FALSE;
      $prop = ($prop) ? $prop : ((property_exists($this, 'order') && static::$order['prop']) ? static::$order['prop'] : (($this[0]->sortName) ? 'sortName' : 'name')) ;
      $type = ($type) ? $type : ((property_exists($this, 'order') && static::$order['type']) ? static::$order['type'] : 'string') ;
      $direction = ($direction == 'desc') ? 'desc' : ((property_exists($this, 'order') && static::$order['dir'] == 'desc') ? 'desc' : 'asc') ;
      $case = ($case) ? TRUE : ((property_exists($this, 'order') && static::$order['case']) ? TRUE : FALSE) ;
      if (count($this) > 0) {
        switch ($type) {
          case 'int':
          case 'integer':
          case 'numeric':
          case 'number':
          case 'num':
            if ($direction == 'asc') {
              $return = $this->uasort(function($a, $b) use ($prop) {
                return ($a == $b) ? 0 : (($a->$prop > $b->$prop) ? 1 : -1);
              });
            } else if ($direction == 'desc') {
               $return = $this->uasort(function($a, $b) use ($prop) {
                return ($a == $b) ? 0 : (($a->$prop < $b->$prop) ? 1 : -1);
              });
            }
          break;
          default:
            if ($direction == 'asc') {
              $return = $this->uasort(function($a, $b) use ($prop, $case) {
                return ($case) ? strcasecmp($a->$prop, $b->$prop) : strcmp($a->$prop, $b->$prop);
              });
            } else if ($direction == 'desc') {
               $return = $this->uasort(function($a, $b) use ($prop, $case) {
                return ($case) ? strcasecmp($b->$prop, $a->$prop) : strcmp($b->$prop, $a->$prop);
              });
            }
          break;
        }
      }
      if (!$keepkeys) {
        $objs = array_values($this->getArrayCopy());
        $this->exchangeArray($objs);
      }
      return $return;
    }
    
    public function flatten() {
      foreach ($this as $obj) {
        $this->flatten();
      }
      return TRUE;
    }
    
    public function getFlat() {
      $class = get_class($this);
      $objs = new $class();
      foreach ($this as $obj) {
        $objs[] = $obj->getFlat();
      }
      return $objs;
    }

    public function getFiltered($prop, $value = TRUE, $operator = '==', $out = FALSE, $array = FALSE) {
      $return = clone $this;
      $return->filter($prop, $value, $operator, $out);
      return ($array) ? $return->toArray() : $return;
    }
    
    public function filter($prop, $value = TRUE, $operator = '==', $out = FALSE) {
      foreach ($this as $index => $obj) {
        if (isAssoc($prop)) {
          foreach ($prop as $key => $val) {
            if (compare($obj->$prop, $val) == $out) {
              unset($this[$index]);
              $unset = TRUE;
            }
          }
        } else if ($operator === 'isset') {
          if (isset($obj->$prop) == $out) {
            unset($this[$index]);
            $unset = TRUE;
          }
        } else if (compare($obj->$prop, $value, $operator) == $out) {
          unset($this[$index]);
          $unset = TRUE;
        }
      }
      return $unset;
    }
    
    function getListOf($prop = 'name', $value = TRUE, $operator = '==', $unique = TRUE) {
      $return = array_filter($this->array_map(function($obj) use ($prop, $value, $operator) {
        if ($operator === 'isset') {
          if (isset($obj->$prop)) {
            return $obj->$prop;
          }
        } else if (compare($obj->$prop, $value, $operator)) {
          return $obj->$prop;
        }
      }));
      return ($unique) ? array_unique($return) : $return;
    }
    
    function getNumOf($prop = 'name', $value = TRUE, $operator = '==') {
      return count($this->getListOf($prop, $value, $operator, FALSE));
    }

    function getSumOf($prop = 'name', $value = TRUE, $operator = '==') {
      return array_sum($this->getListOf($prop, $value, $operator, FALSE));
    }

    function delete() {
      foreach ($this as $obj) {
        if (!$obj->delete()) {
          $fail = TRUE;
        }
      }
      return ($fail) ? FALSE : TRUE;
    }

    public function toArray($allArrays = FALSE, $recursive = FALSE) {
      $array = array();
      foreach ($this as $obj) {
        $array[] = ($allArrays) ? $obj->toArray($recursive) : $obj;
      }
      return $array;
    }
    
  }
?>