<?php

  class combobox extends jqueryui {
    
    public function __construct($selector = NULL, $indents = 0) {
      if (substr($selector, 0, 1) == '#') {
        $this->addAfter(new change($selector, '
          $("'.$selector.'_combobox").val($(this).children(":selected").text());
        ', $indents));
      }
      parent::__construct($selector, 'combobox', 'command', NULL, NULL, $indents);
    }
//    jqueryui public function __construct($selector = NULL, $tool = NULL, $jqtype = NULL, $contents = NULL, array $props = NULL, $indents = 0) {
//    jquery public function __construct($selector = NULL, $tool = NULL, $jqtype = NULL, $contents = NULL, array $props = NULL, $indents = 0) {
//    scriptCode public function __construct($source = NULL, array $params = NULL, $indents = 0) {
//    html public function __construct($element = 'span', $contents = NULL, array $params = NULL, $id = NULL, $class = NULL, array $css = NULL, $indents = 0) {

  }
  
?>
