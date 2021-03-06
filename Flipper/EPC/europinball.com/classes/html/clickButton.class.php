<?php

  class clickButton extends button {
    
    public function __construct($value = 'submit', $name = NULL, $url = NULL, $form = TRUE, $script = TRUE, array $params = NULL) {
      $params['name'] = ($name) ? $name : $value;
      $params['id'] = ($params['id']) ? $params['id'] : preg_replace('/[^a-zA-Z0-9]/', '', $params['name']);
      $this->params['id'] = $params['id'];
      $this->form($form, $url);
      $this->script($script);
      $this->inline = true;
      $this->settings['insideForm'] = FALSE;
      parent::__construct($value, $name, $params);
    }
//    click public function __construct($selector = NULL, $code = NULL, $indents = 0) {
//    jquery public function __construct($selector = NULL, $tool = NULL, $type = NULL, $contents = NULL, array $props = NULL, $indents = 0) {
//    form public function __construct($id = NULL, $action = NULL, $method = 'POST', array $params = NULL) {
//    button public function __construct($value = 'submit', $name = NULL, array $params = NULL) {
//    input public function __construct($name = NULL, $value = NULL, $type = 'text', $label = TRUE, array $params = NULL) {
//    html public function __construct($element = 'span', $contents = NULL, array $params = NULL, $id = NULL, $class = NULL, array $css = NULL, $indents = 0) {

    public function __get($prop) {
      switch($prop) {
        case 'insideForm':
          return $this->settings[$prop];
        break;
        case 'previous':
          return $this->params['data-previous'];
        break;
        case 'form':
        case 'script':
          return $this->accessories[$prop];
        break;
        default:
          return parent::__get($prop);
        break;
      }
    }

    public function __set($prop, $value) {
      switch($prop) {
        case 'insideForm':
          $this->settings['insideForm'] = ($value);
          if ($value) {
            if (!$this->accessories['form']) {
              $this->accessories['form'] = $this->form(TRUE);
            }
            $this->accessories['form']->addContent($this, $this);
          } else {
            $this->accessories['form']->delContent($this);
          }
        break;
        case 'previous':
          $this->params['data-previous'] = $value;
        break;
        case 'script':
        case 'form':
          $this->$prop($value);
        break;
        default:
          parent::__set($prop, $value);
        break;
      }
    }
    
    public function __isset($prop) {
      switch($prop) {
        case 'insideForm':
          return isset($this->settings[$prop]);
        break;
        case 'previous':
          return isset($this->params['data-previous']);
        break;
        case 'script':
        case 'form':
          return isset($this->accessories[$prop]);
        break;
        default:
          return parent::__isset($prop);
        break;
      }
    }

    public function __unset($prop) {
      switch($prop) {
        case 'insideForm':
          $this->__set($prop, FALSE);
        break;
        case 'previous':
          unset($this->params['data-previous']);
        break;
        case 'script':
        case 'form':
          $this->$prop(FALSE);
        break;
        default:
          parent::__unset($prop);
        break;
      }
    }

    protected function form($form, $url = NULL) {
      if (!isset($form)) {
        return $this->accessories['form'];
      } else if (is($form)) {
        if ($form === TRUE) {
          $this->accessories['form'] = new form($this->id.'Form', $url);
        } else {
          $this->accessories['form'] = (isHtml($form)) ? $form : new form($form);
        }
        $this->accessories['form']->inline = TRUE;
        $this->accessories['form']->hide();
        return isHtml($this->accessories['form']);
      } else {
        $this->accessories['form'] = NULL;
        return TRUE;
      }
    }
    
    protected function script($script) {
      if (!isset($script)) {
        return $this->accessories['script'];
      } else if (is($script)) {
        if ($script === TRUE) {
          if (!$this->form) {
            $this->form(TRUE);
          }
          $this->accessories['script'] = new click('#'.$this->id, '$("#'.$this->form->id.'").submit();', static::$indents);
        } else {
          $this->accessories['script'] = (isHtml($script)) ? $script : new click('#'.$this->id, $script, static::$indents);
        }
        return isHtml($this->accessories['script']);
      } else {
        $this->accessories['script'] = NULL;
        return TRUE;
      }
    }
    
    public function getHtml($form = TRUE, $button = TRUE, $script = TRUE) {
      if ($button) {
        if ($form && $this->form) {
          if ($this->insideForm) {
            $this->form->addContent($this, $this);
            return ($script && $this->script) ? $this->form->getHtml().$this->script->getHtml() : $this->form->getHtml();
          } else {
            return ($script && $this->script) ? $this->form->getHtml().parent::getHtml().$this->script->getHtml() : $this->form->getHtml().parent::getHtml();
          }
        } else {
          return ($script && $this->script) ? parent::getHtml().$this->script->getHtml() : parent::getHtml();
        }
      } else {
        return parent::getHtml().(($form && $this->form) ? $this->form->getHtml().(($script && $this->script) ? $this->script->getHtml() : '') : '');
      }
    }
    
  }
  
?>