<?php

  class spinner extends jqueryui {
    
    public function __construct($props = NULL, $selector = NULL, $indents = 0) {
      $props['stop'] = ($props['stop']) ? $props['stop'] : '
        function(event, ui) {
          $("'.$selector.'").change();
        }
      ';
      $props['min'] = ($props['min']) ? $props['min'] : 0;
      parent::__construct($selector, 'spinner', 'object', NULL, $props, $indents);
    }
//    jqueryui public function __construct($selector = NULL, $tool = NULL, $jqtype = NULL, $contents = NULL, array $props = NULL, $indents = 0) {
//    jquery public function __construct($selector = NULL, $tool = NULL, $jqtype = NULL, $contents = NULL, array $props = NULL, $indents = 0) {
//    scriptCode public function __construct($source = NULL, array $params = NULL, $indents = 0) {
//    html public function __construct($element = 'span', $contents = NULL, array $params = NULL, $id = NULL, $class = NULL, array $css = NULL, $indents = 0) {

  }
  
?>
