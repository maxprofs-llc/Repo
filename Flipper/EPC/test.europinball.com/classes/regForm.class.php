<?php
  require_once('element.class.php'); // Why is this needed? Shouldn't autload take care of that?
  
  class regForm extends element {
    
    public $jsPopulator;
    public $table = true;
    public $div = true;
    public $fields = array();
    public $submitButton = true;
    public $nosubmit = true;
    public $contentStart;
    public $contentMid;
    public $contentEnd;
    public $class = 'form';
    
    public function addField($fields) {
      if (is_array($fields)) {
        foreach($fields as $field) {
          $this->addField($field);
        }
      } else {
        $this->fields[] = $fields;        
      }
    }
    
    public function update(){
      foreach($this->fields as $field) {
        $field->update();
      }
      $this->updateContent();
    }
    
    function updateContent() {
      $this->contentStart = "\n";
      if ($this->div) { 
        $this->contentStart .= '<div id="'.$this->id.'Div">'."\n"; 
      }
      $this->contentStart .= '<form name="'.$this->id.'" id="'.$this->id.'" action="'.$this->action.'"';
      if ($this->nosubmit) {
        $this->contentStart .= ' onsubmit="return false;"';
      }
      $this->contentStart .= ">\n";
      if ($this->table) { 
        $this->contentStart .= '<table id="'.$this->id.'Table">'."\n"; 
      }
      $this->contentMid = '';
      foreach($this->fields as $field) { 
        if ($this->table) { 
          $this->contentMid .= '<tr><td>'; 
        } else if ($this->div){
          $this->contentMid .= '<div id="'.$field->id.'Div">';
        }
        $this->contentMid .= $field->content;
        if ($this->table) { 
          $this->contentMid .= "</td></tr>\n";
        } else if ($this->div){
          $this->contentMid .= "</div>\n";
        } else {
          $this->contentMid .= "\n";          
        }
      }
      $this->contentEnd = "</table></form></div>\n";
      $this->content = $this->contentStart.$this->contentMid.$this->contentEnd;
    }
    
    public function removeField($id) {
      $cmp = cmpField($id, true);
      $this->options = array_filter($this->options, $cmp);
    }
            
  }
?>