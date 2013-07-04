<?php

require_once('../functions/general.php');
require_once('../functions/header.php');

$path = '../images/objects/'.$_REQUEST['obj'].'/';

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_FILES['imageUpload']['name'];
  $size = $_FILES['imageUpload']['size'];
			
  if(strlen($name)) {
    list($txt, $ext) = explode('.', $name);
    if(in_array($ext,getPhotoExts())) {
      if($size<(1024*1024)) {
        $tmp = $_FILES['imageUpload']['tmp_name'];
        $previewFile = $path.'/preview/'.$_REQUEST['id'].'.'.$ext;
        if (move_uploaded_file($tmp, $previewFile)) {
          chmod($previewFile, 0664);
//          usleep(100000);
          echo '<img src="'.$baseHref.'/images/objects/'.$_REQUEST['obj'].'/preview/'.$_REQUEST['id'].'.'.$ext.'?nocache='.rand(10000,20000).'" class="preview"><script type="text/javascript">document.getElementById(\'newPhoto\').value = \''.$_REQUEST['obj'].'/preview/'.$_REQUEST['id'].'.'.$ext.'\'</script>';
        } else {
          echo 'failed';
        }
      } else {
        echo 'Image file size max 1 MB';
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