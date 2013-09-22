<?php

  require_once('../functions/general.php');
  require_once('../functions/header.php');
  header('Content-Type: text/html');

  $path = '../images/objects/'.$_REQUEST['obj'].'/';

  if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_FILES['imageUpload']['name'];
    $size = $_FILES['imageUpload']['size'];
			
    if(strlen($name)) {
      list($txt, $ext) = explode('.', $name);
      if(in_array($ext,getPhotoExts())) {
        if($size < (1024*1024) && $size != 0) {
          $tmp = $_FILES['imageUpload']['tmp_name'];
          $previewFile = $path.'/preview/'.$_REQUEST['id'].'.'.$ext;
          if (move_uploaded_file($tmp, $previewFile)) {
            chmod($previewFile, 0664);
            //          usleep(100000);
            echo '
              <script src="'.__baseHref__.'/js/contrib/jquery.form.min.js" type="text/javascript"></script>
              <img src="'.$baseHref.'/images/objects/'.$_REQUEST['obj'].'/preview/'.$_REQUEST['id'].'.'.$ext.'?nocache='.rand(10000,20000).'" class="preview" id="thumb" alt="Preview of image">
              <div id="imageLoader"></div>
              <script type="text/javascript">document.getElementById(\'newPhoto\').value = \''.$_REQUEST['obj'].'/preview/'.$_REQUEST['id'].'.'.$ext.'\'</script>
              <script type="text/javascript">
                $(document).ready(function() { 
                  $(\'#imageUpload\').on(\'change\', function() {
                    $(\'#preview\').html(\'\');
                    $(\'#imageLoader\').html(\'<img src="'.__baseHref__.'/images/loader.gif" alt="Uploading...."/>\');
                    $(\'#submitImg\').prop(\'disabled\', false);
                    $(\'#imageForm\').ajaxForm({
                      target: \'#preview\'
                    }).submit();
                    $(\'#imageLoader\').html(\'\');
                  });
                  $(\'#thumb\').on(\'click\', function() {
                    $(\'#imageUpload\').trigger(\'click\');
                  });
                }); 
              </script>
            ';
          } else {
            echo 'File move failed';
          }
        } else {
          echo 'Image file is too big (size is max 1 MB) or the file was corrupt.';
        }
      } else {
        echo 'Invalid file format..';	
      }
    } else {
      echo 'Please select image..!';
    }				
    exit;
  }

?>