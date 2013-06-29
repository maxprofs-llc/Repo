<?php
  function printHeader($title = 'EPC', $scriptPath = "js/") {
    echo('
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="'.$scriptPath.'contrib/jquery.js"></script>
    <script type="text/javascript" src="'.$scriptPath.'contrib/jquery-ui.js"></script>
    <script type="text/javascript" src="'.$scriptPath.'contrib/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="'.$scriptPath.'contrib/purl.js"></script>
    <script type="text/javascript" src="'.$scriptPath.'contrib/recaptcha_ajax.js"></script>
    <script type="text/javascript" src="'.$scriptPath.'general.js"></script>
    <link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="css/epc.css" rel="stylesheet" type="text/css" />
    <title>'.$title.'</title>
  </head>
    ');
  }
  
  function printTopper($onLoad = null) {
    echo('
  <body onload="'.$onLoad.'">
    <div id="page">
    ');
  }

/*
      <div id="topper">
        <div id="topperBottom"></div>
        <div id="topperLeft"></div>
        <div id="topperRight"></div>
      </div>
  */
    
  function printFooter() {
    echo('
      <div id="debug" align="left"></div>
      <div id="debug2"></div>
    </div>
  </body>
</html>
    ');
  }
  //     <script type="text/javascript" src="'.$scriptPath.'json.js"></script>

?>