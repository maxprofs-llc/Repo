<?php

  require_once(config::$baseDir.'/contrib/jsbeautifier.php');
  
  class scriptCode extends script {
    
    public function __construct($code = NULL, array $params = NULL, $indents = 0) {
      $params['type'] = ($params['type']) ? $params['type'] : 'text/javascript';
      $this->settings['type'] = 'code';
      $this->settings['escape'] = FALSE;
      $this->contentParam = FALSE;
      static::$indents = ($indents) ? $indents : static::$indents;
      parent::__construct($code, $params);
    }
//    script public function __construct($code = NULL, array $params = NULL) {
//    html public function __construct($element = 'span', $contents = NULL, array $params = NULL, $id = NULL, $class = NULL, array $css = NULL, $indents = 0) {
    
    protected function getContent($index = NULL, $string = TRUE) {
      if (is($index)) {
        return parent::getContent($index, $string);
      } else {
        $options = new BeautifierOptions();
        $options->indent_size = strlen(static::$indenter);
        $options->indent_char = substr(static::$indenter, 0, 1);
        $options->indent_level = static::$indents + 1;
        $options->max_preserve_newlines = 1;
        $jsbeautifier = new JSBeautifier();
        $content = parent::getContent($index, $string);
        return ltrim($jsbeautifier->beautify($content, $options));
      }
    }

  }

?>