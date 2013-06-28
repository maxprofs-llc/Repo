<?php
	class file extends baseClass {
		
		public $title;
		public $fileType;
		public $mimeType;
		public $data;
		public $date;
		public $time;
		public $width;
		public $height;
		public $size;
		public $showOnWeb;
		public $originalFileName;
		
		function getName() {
			return $title;
		}
		
		function printFile() {
			$lastModified = 'Fri, 6 Feb 2032 05:00:00 GMT';
			$lastModifiedInSecs = '1959656400';
			if(!is_null($this->data)) {
				header("Expires: ".$lastModified."\n");
				header("Last-Modified: Fri, 5 Feb 2010 05:00:00 GMT\n");
				header('Cache-Control: max-age=2592000');
				header("Content-type: " . $this->mimeType . "\n");
				header("Content-Length: ".$this->size."\n");
				#header("Content-Disposition: filename=\"$outname\"\n");
				echo $this->data;
				ob_flush();
				flush();
			} else {
				header("HTTP/1.0 404 Not Found");
				exit;
			}
		}
	} 
?>