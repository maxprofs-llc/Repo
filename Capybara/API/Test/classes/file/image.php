<?php
	class file_image extends file {
		
		public $resizeWidth=NULL;
		public $resizeHeight=NULL;
		public $maxWidth=NULL;
		public $maxHeight=NULL;
		
		function scale($scale) {		
			$image=imagecreatefromstring($this->data);
			$width=imagesx($image);
			$height=imagesy($image);
			$newwidth=$width*($scale/100);
			$newheight=$height*($scale/100);
			
			$newimage=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($newimage,$image,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			ob_start();
			imagepng($newimage);
			$stringdata = ob_get_contents(); // read from buffer
			ob_end_clean(); // delete buffer
			$this->data = ($stringdata);
			$this->size=strlen($this->data);
		}
		
		function setWidth($width) {
			$this->resizeWidth=$width;
		}
		
		function setHeight($height) {
			$this->resizeHeight=$height;
		}

		function setMaxWidth($width) {
			$this->maxWidth=$width;
		}
		
		function setMaxHeight($height) {
			$this->maxHeight=$height;
		}
				
		function printFile() {
			if(is_null($this->resizeWidth) && is_null($this->resizeHeight) && is_null($this->maxWidth) && is_null($this->maxHeight))
				parent::printFile();
			else {
				$image=imagecreatefromstring($this->data);
				$width=imagesx($image);
				$height=imagesy($image);
				$newwidth=$width;
				$newheight=$height;			
				$scaleWidth=1;
				$scaleHeight=1;	
				$x=0;
				$y=0;
				if(!is_null($this->resizeWidth)) {
					$newwidth=$this->resizeWidth;
					$imagewidth=$this->resizeWidth;
				}
				if(!is_null($this->resizeHeight)) {
					$newheight=$this->resizeHeight;
					$imageheight=$this->resizeHeight;
				}
				if(!is_null($this->maxWidth))
					$scaleHeight=$this->maxWidth/$width;
				if(!is_null($this->maxHeight))
					$scaleWidth=$this->maxHeight/$height;
				if($scaleHeight>$scaleWidth) {
					$newwidth=$width*$scaleWidth;
					$newheight=$height*$scaleWidth;
					if(!is_null($this->resizeWidth)) 
						$x=($imagewidth-$newwidth)/2;
					else {
						$imagewidth=$newwidth;
					}
					$imageheight=$newheight;
				} elseif($scaleHeight<$scaleWidth) {
					$newwidth=$width*$scaleHeight;
					$newheight=$height*$scaleHeight;
					if(!is_null($this->resizeHeight)) 
						$y=($imageheight-$newheight)/2;
					else {
						$imageheight=$newheight;
					}
					$imagewidth=$newwidth;
				}
				$newimage=imagecreatetruecolor($imagewidth,$imageheight);

				// Turn off transparency blending (temporarily)
        		imagealphablending($newimage, false);
   
		        // Create a new transparent color for image
		        $color = imagecolorallocatealpha($newimage, 0, 0, 0, 127);
   
		        // Completely fill the background of the new image with allocated color.
		        imagefill($newimage, 0, 0, $color);
   
		        // Restore transparency blending
		        imagesavealpha($newimage, true);
				
			    imagecopyresampled($newimage,$image,$x,$y,0,0,$newwidth,$newheight,$width,$height);
				imagestring($newimage,3,0,0,$string,imagecolorallocate($newimage,255,0,0));
				
				ob_start();
				imagepng($newimage);
				$stringdata = ob_get_contents(); // read from buffer
				ob_end_clean(); // delete buffer
				$this->data = ($stringdata);
				$this->size=strlen($this->data);
				
				parent::printFile();
			}
		}	
	}
?>