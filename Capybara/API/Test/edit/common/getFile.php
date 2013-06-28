<?
	include "../_define.php";
		
	if(is_numeric($_GET['id']))
		$id=$_GET['id'];
	else { 
		header("HTTP/1.0 404 Not Found");
		exit;
	}		
	$class='file';
	if(isset($_GET['scale']) || isset($_GET['width']) || isset($_GET['height']) || isset($_GET['maxwidth']) || isset($_GET['maxheight'])) {
		$class='file_image';
	}
	if(isset($_GET['scale']))
		$scale=$_GET['scale'];
	
	$file=$dr->getFileById($id,$class);
	if($scale)
		$file->scale($scale);
		
	if(isset($_GET['width']))
		$file->setWidth($_GET['width']);
	if(isset($_GET['height']))
		$file->setHeight($_GET['height']);
	if(isset($_GET['maxwidth']))
		$file->setMaxWidth($_GET['maxwidth']);
	if(isset($_GET['maxheight']))
		$file->setMaxHeight($_GET['maxheight']);
		
	$file->printFile();
	
?>