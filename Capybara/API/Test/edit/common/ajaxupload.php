<?php
	$skipRelations=true;
	include_once('../_define.php');
	
	if(!isset($_SESSION['upload_file']))
	{	
		$columns=array(	'fileType'=>addslashes('picture'),
						'mimeType'=>$_FILES['filename']['type'],
						'date'=>date('Y-m-d'),
						'time'=>date('H:i:s'),
						'showOnWeb'=>'false',
						'size'=>$_FILES['filename']['size'],
						'title'=>$_FILES['filename']['name'],
						'data'=>'');
		
		
		list($columns['width'], $columns['height']) = getimagesize($_FILES['filename']['tmp_name']);
	
		# INSERT INTO FILE
		$fileId = $db->performInsert('file', $columns);
		
		$dir=dirname($_FILES['filename']['tmp_name']);
		move_uploaded_file($_FILES['filename']['tmp_name'],$dir."/".$_FILES['filename']['name']);
		
		$_SESSION['upload_file']=$dir."/".$_FILES['filename']['name'];
		$_SESSION['upload_file_fileId']=$fileId;
		$_SESSION['upload_file_filePos']=0;
		$_SESSION['upload_file_fileHex']='0x';
	}
	$fileId=$_SESSION['upload_file_fileId'];
	$filePos=$_SESSION['upload_file_filePos'];
	$fileHex=$_SESSION['upload_file_fileHex'];
	$fileName=$_SESSION['upload_file'];
		
	$chunkSize=$conf->get('file_chunk_size',100000);	
	$file=$fileName;
	$instr = fopen($file,"rb");
	$fs=filesize($file);
	fseek($instr,$filePos);
	if($filePos==$fs)
	{
		//print "<img src='common/getFile.php?id=" . $fileId . "' />";
		print "<input type='hidden' id='imageId' value='$fileId' />";
		print "<script>";
		print "window.parent.fireEvent('imageuploadcomplete',$fileId);";
		print "</script>";
		cleanup();
	} else {
		$bigpic = bin2hex((fread($instr,$chunkSize))); 
		$fileHex.=$bigpic;
		$_SESSION['upload_file_fileHex']=$fileHex;
		$_SESSION['upload_file_filePos']=ftell($instr);
		if(ftell($instr)==0) {
			cleanup();
			die('Error while uploading file.');
		}
		if($filePos==0) 
			$query="UPDATE file SET data=0x$bigpic WHERE id=$fileId";
		else
			$query="UPDATE file SET data=concat(data,unhex('$bigpic')) WHERE id=$fileId";
		$db->query($query);
		if($db->getAffectedRows()==0) {
			cleanup();
			$query="DELETE FROM file WHERE id=$fileId";
			mysql_query($query);
			die('Error while uploading picture.');
		}
		print "<div class='progressBarContainer'>";
		print "<div class='progressBarText'>".number_format(($filePos/$fs)*100,0)."%</div>";
		print "<div class='progressBar' style='width:".(($filePos/$fs)*100)."%;'>";
		print "</div>";
		print "</div>";	
		print '<meta http-equiv="refresh" content="0;url='.$_SERVER['SCRIPT_NAME'].'" />';
	}
	
	function cleanup() {
		$fileName=$_SESSION['upload_file'];
		unlink($fileName);
		unset($_SESSION['upload_file']);
	}
	/*
	 **** WORKS ****
	$chunkSize=$conf->get('file_chunk_size',13421772);	
	$file=$_FILES['filename']['tmp_name'];
	$instr = fopen($file,"rb");
	$fs=filesize($file);

	while(!feof($instr))
	{
		$bigpic = bin2hex((fread($instr,$chunkSize))); 
		$query="UPDATE file SET data=0x$bigpic WHERE id=$fileId";
		$db->query($query);
	}
	unlink($_FILES['filename']['tmp_name']);
	
	print "<img src='common/getFile.php?id=" . $fileId . "' /><input type='hidden' id='imageId' value='$fileId' />";
	
	**** WORKS ****
	*/
?>
