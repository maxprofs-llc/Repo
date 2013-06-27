<?php
function getImageNamesForGallery($a_sFolder)
{
	$aImgNames = array();
	$handle = @opendir($a_sFolder);
	if($handle) 
	{
   		while(false !== ($file = readdir($handle))) 
   		{
   			if(@!is_dir($a_sFolder . $file))
				array_push($aImgNames, $a_sFolder . $file);
   		}
	}
	
	sort($aImgNames);
	return $aImgNames;
}
?>