<?php
  require_once('formInput.class.php'); // Why is this needed? Shouldn't autload take care of that?
    
  class selectOption extends formInput {
    
    public $value = 0;
    public $text = "Loading...";
    public $selected = false;
    public $class = 'selectOption';
    
    public function update() {
      $this->updateContent();
    }
    
    function updateContent() {
      $this->content = '<option id="'.$this->id.'" value="'.$this->value.'"';
      if ($this->selected) {
        $this->content .= ' selected="selected"';
      }
      $this->content .= '>'.$this->text."</option>\n";
    }
    
  }
?>