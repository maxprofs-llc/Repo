<?php

  class tabs extends html {
    
    public static $debugRun;
    
    public function __construct($contents = NULL, $id = NULL, $class = NULL, array $params = NULL) {
      parent::__construct('div', $contents, $params, $id, $class, NULL);
    }
//    html public function __construct($element = 'span', $contents = NULL, array $params = NULL, $id = NULL, $class = NULL, array $css = NULL, $indents = 0) {
    
    public function addContent($content = NULL, $replace = FALSE, $index = FALSE) {
      if ($replace) {
        $this->delContent($replace);
      }
      if (is_array($content)) {
        $return = TRUE;
        foreach($content as $part) {
          $result = $this->addContent($part, FALSE, $index);
          if (!$result) {
            $return = FALSE;
          }
        }
        return $return;
      } else if (isHtml($content)) {
        if (get_class($content) == 'ajaxTab') {
          $div = $content;
          $div->params['data-title'] = ($div->data_title) ? $div->data_title : (($div->title) ? $div->title : (($div->content[0]) ? $div->content[0] : ucfirst($div->id)));
        } else if (get_class($content) == 'div') {
          $div = $content;
          $div->params['data-title'] = ($div->data_title) ? $div->data_title : (($div->title) ? $div->title : ucfirst($div->id));
        } else {
          $div = new div((($content->id) ? $content->id.'_tab' : html::newId(NULL, '_tab')));
          $div->params['data-title'] = ($content->data_title) ? $content->data_title : (($content->title) ? $content->title : ucfirst(preg_replace('/_tab$/', '', $div->id)));
          $div->addContent($content);
        }
      } else {
        $div = new div(html::newId(NULL, '_tab'));
        $div->params['data-title'] = preg_replace('/_tab$/', '', ucfirst($div->id));
        $div->addContent($content);
      }
      return parent::addContent($div, $replace, $index);
    }

    protected function getHeader($index = NULL, $string = TRUE) {
      if ($this->contents) {
        $ul = new ul();
        foreach ($this->contents as $content) {
          $li = $ul->addLi();
          $li->addLink(((get_class($content) == 'ajaxTab') ? $content->href : '#'.$content->id), $content->data_title);
        }
        return ($string) ? $ul->getHtml() : $ul;
      }
      return NULL;
    }
    
    protected function getFooter($index = NULL, $string = TRUE) {
      $script = new scriptCode('
        $(document).ready(function() {
          try {
            var tab'.$this->id.'Index = dataStore.getItem("tab'.$this->id.'Index");
          } catch(e) {
            var tab'.$this->id.'Index = 0;
          };
          tab'.$this->id.'Index = (parseInt(tab'.$this->id.'Index)) ? parseInt(tab'.$this->id.'Index) : 0;
          $("#'.$this->id.'").tabs({
            active: tab'.$this->id.'Index,
            activate: function(event, ui) {
              dataStore.setItem("tab'.$this->id.'Index", ui.newTab.parent().children().index(ui.newTab));
              var firstField = ui.newPanel.find("input[type=text],textarea,select").filter(":visible:first");
              if (firstField) {
                firstField.focus();
              }
            },
            beforeLoad: function(event, ui) {
              if ($(ui.panel).is(":empty")) {
                $(ui.panel).append("<div id=\"tab'.$this->id.'_" + tab'.$this->id.'Index + "loading\"><img title=\"Loading data...\" alt=\"Loading data...\" id=\"tab'.$this->id.'_" + tab'.$this->id.'Index + "loadingImage\" src=\"'.config::$baseHref.'/images/ajax-loader.gif\"></div>");
                return true;
              } else if ($(ui.panel).html() == "<div id=\"tab'.$this->id.'_" + tab'.$this->id.'Index + "loading\"><img title=\"Loading data...\" alt=\"Loading data...\" id=\"tab'.$this->id.'_" + tab'.$this->id.'Index + "loadingImage\" src=\"'.config::$baseHref.'/images/ajax-loader.gif\"></div>") {
                return true;
              } else {
                event.preventDefault();
                return false;
              }
            },
            load: function(event, ui) {
              var firstField = ui.panel.find("input[type=text],textarea,select").filter(":visible:first");
              if (firstField) {
                firstField.focus();
              }
              $("#'.$this->id.'").tabs("refresh");
            }
          });
        });
      ');
      return ($string) ? $script->getHtml() : $script;
    }

  }
  
?>