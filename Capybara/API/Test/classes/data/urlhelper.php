<?php

	class data_urlhelper {
		
		public function createurl($relativeUrl) {
			return str_replace("~/","/beta/",$relativeUrl);
		}
		
	}

?>