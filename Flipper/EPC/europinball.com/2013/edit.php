<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);

  if (checkLogin($dbh, $ulogin, true, 'Please use your login details to access the page.')) {
    printTopper("getObjects('geo');");
    $content = showEditPlayer($dbh, __baseHref__);
    
/*    $content = '
      <script src="'.$baseHref.'/js/contrib/jquery.form.min.js" type="text/javascript"></script>
      <h2 class="entry-title">Edit player profile</h2>
      <form id="imageForm" method="post" enctype="multipart/form-data" action="'.$baseHref.'/ajax/imageUpload.php?obj=player&id='.$_REQUEST['id'].'">
  	    <div id="preview">
  		    <img src="'.$baseHref.getPhoto($_REQUEST['obj'], $_REQUEST['id'], true).'" id="thumb" class="preview" alt="Preview of '.$_SESSION['username'].'">
          <div id="imageLoader"></div>
  	    </div>
  	    <div id="uploadForm">
          <label id="imageUploadLabel" class="italic">Click picture to change preview (save with submit button below)</label>
          <input type="file" name="imageUpload" id="imageUpload">
        </div>
      </div>
      <form id="newData" name="newData">
        <input type="hidden" name="newPhoto" id="newPhoto" value="false">
        <input type="hidden" name="loggedIn" id="loggedIn" value="true">
        <input type="hidden" name="baseHref" id="baseHref" value="'.$baseHref.'">
        '.(($_REQUEST['obj']) ? '<input type="hidden" name="obj" id="obj" value="'.$_REQUEST['obj'].'">' : '').'
        '.(($_REQUEST['id']) ? '<input type="hidden" name="id" id="id" value="'.$_REQUEST['id'].'">' : '').'
        <input type="hidden" name="user" id="user" value="'.$_SESSION['username'].'">
        <div id="ifpaRegResults">
          <span id="playerLoading"><img src="'.$baseHref.'/images/ajax-loader.gif" alt="Loading data..."></span>
          <div id="ifpaRegResultsTableDiv" style="display: none">
            <h3 id="ifpaRegResultsH3">People found:</h3>
            <table id="ifpaRegResultsTable" class="list">
            </table>
          </div>
        </div>
      </form>
      <script type="text/javascript">
        $(document).ready(function() { 
          $(\'#imageUpload\').on(\'change\', function() {
            $(\'#preview\').html(\'\');
            $(\'#imageLoader\').html(\'<img src="'.$baseHref.'/images/loader.gif" alt="Uploading...."/>\');
            $(\'#imageForm\').ajaxForm({
              target: \'#preview\'
            }).submit();
            $(\'#imageLoader\').html(\'\');
          });
          $(\'#preview\').on(\'click\', function() {
            $(\'#imageUpload\').trigger(\'click\');
          });
        }); 
      </script>
      <form action="edit.php" method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
      </form>
    ';
    */
    echo($content);
  }

  printFooter();
?>
