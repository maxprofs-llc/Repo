<?php
	class html_imageList extends html_htmlEntity {
		
		private $images;
		public $columns=4;
		public $thumbnailSize=50;
		public $table;
		public $tableRowId=0;
		public $extraContent=false;
		public $multiSelect=true;
		
		function __construct() {
			parent::__construct();
			$this->images=array();
			$this->showRemoveLink=lang_lang::getSingleton()->get('Remove link to this picture');
		}
		
		function addImage($url) {
			$this->images[]=$url;
		}
		
		function printHTML() {
			print "<div";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			print "<input type='hidden' name='columns' value='$this->columns' />";
			print "<table class='imageList'><tr>";
			if(count($this->images)) { 
				$count=0;	
				$no=1;
				foreach($this->images as $image) {
					if(isset($image->fileId))
						$id=$image->fileId;
					else
						$id=$image->id;
					$conf=config_conf::getSingleton();
					$width=$conf->get('thumbnail_width',50);
					$height=$conf->get('thumbnail_height',50);
					print "<td><img id='".$this->id."_image".$no."' src='common/getFile.php?id=$id&thumbnail&maxwidth=$width&maxheight=$height&width=$width&height=$height' alt='' class='thumbnail' /><input type='hidden' id='".$this->id."_image".$no."_id' value='$image->id' /></td>";
					$count++;
					$no++;
					if($count==$this->columns) {
						print "</tr><tr>";
						$count=0;
					}
				}
			} else {
				print "<td>".lang_lang::getSingleton()->get('No_images')."<td>";
			}
			print "</tr>";
			print "</table></div>";
			print "<div id='".$this->id."_script'>";
			$cont=implode('',file(__DIR__."/scripts/imageList.js"));
			print "<script>";
			print $cont;
			print "initImageList('$this->id','$this->table',".(is_null($this->tableRowId)?'null':$this->tableRowId).",".($this->multiSelect?-1:0).");";
			print "$('".$this->id."_script').dispose();";
			print "</script>";
			print "</div>";
		}
	}
?>