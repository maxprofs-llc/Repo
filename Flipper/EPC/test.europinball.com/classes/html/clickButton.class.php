<?php

  class clickButton extends button {
    
    public function __construct($value = 'submit', $name = NULL, $url = NULL, $form = TRUE, $script = TRUE, array $params = NULL) {
      $params['name'] = ($name) ? $name : $value;
      $params['id'] = ($params['id']) ? $params['id'] : preg_replace('/[^a-zA-Z0-9]/', '', $params['name']);
      $this->form($form, $url);
      $this->script($script);
      if ($script == TRUE) {
        $this->accessories['click'] = new click('#'.$params['id'], '$("#'.$this->accessories['form']->id.'").submit();', static::$indents);
      } else if (is($script)) {
        $this->accessories['click'] = (isHtml($script)) ? $script : new click($script);
      }
      $this->inline = true;
      $this->settings['insideForm'] = TRUE;
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
        case 'insideLabel':
        case 'beforeLabel':
          return $this->settings[$prop];
        break;
        case 'previous':
          return $this->params['data-previous'];
        break;
        case 'form':
        case 'script':
          return $this->accessories['$prop'];
        break;
        default:
          return parent::__get($prop);
        break;
      }
    }

    public function __set($prop, $value) {
      switch($prop) {
        case 'insideLabel':
          $this->settings['insideLabel'] = ($value);
          if ($value) {
            if (!$this->accessories['label']) {
              $this->accessories['label'] = new label(ucfirst($name), $name.'Label');
            }
            $this->accessories['label']->addContent($this, $this, $this->settings['beforeLabel']);
          } else {
            $this->accessories['label']->delContent($this);
          }
        break;
        case 'beforeLabel':
          $this->settings['beforeLabel'] = ($value);
          if ($this->settings['insideLabel']) {
            $this->accessories['label']->addContent($this, $this, ($value));
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
        case 'insideLabel':
        case 'beforeLabel':
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
        case 'insideLabel':
        case 'beforeLabel':
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
          $this->accessories['form'] = new form($this->params['id'].'Form', $url);
        } else {
          $this->accessories['form'] = (isHtml($form)) ? $form : new form($form);
          debug($this->accessories['form']);
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
        return $this->accessories['click'];
      } else if (is($script)) {
        if ($script === TRUE) {
          $this->accessories['click'] = new click('#'.$this->params['id'], '$("#'.$this->accessories['form']->id.'").submit();', static::$indents);
        } else {
          $this->accessories['click'] = (isHtml($script)) ? $script : new click($script);
        }
        return isHtml($this->accessories['click']);
      } else {
        $this->accessories['click'] = NULL;
        return TRUE;
      }
    }
    
    public function getHtml($form = FALSE, $button = TRUE, $script = FALSE) {
      if ($button) {
        if ($form && $this->accessories['form']) {
          if ($this->insideForm) {
            $this->accessories['form']->addContent($this, $this);
            return ($script) ? $this->accessories['form']->getHtml().$this->accessories['click']->getHtml() : $this->accessories['form']->getHtml();
          } else {
            return ($script) ? $this->accessories['form']->getHtml().parent::getHtml().$this->accessories['click']->getHtml() : $this->accessories['form']->getHtml().parent::getHtml();
          }
        } else {
          return parent::getHtml();
        }
      } else {
        return ($form && $this->accessories['form']) ? (($script && $this->accessories['click']) ? $this->accessories['form']->getHtml().$this->accessories['click']->getHtml() : $this->accessories['form']->getHtml()) : NULL;
      }
    }
    
  }
  
?>