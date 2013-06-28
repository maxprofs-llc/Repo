<?php
	class article extends baseClass {
		
		public $languageId = NULL;
		public $organizationId = NULL; //Publisher
		public $articleCategoryId = NULL;
		public $articleTags = NULL; //Array!
		public $date = NULL; //Date object
		public $writerId = NULL; //Array! There can be several writers.
		public $isHidden = false; //Boolean. Publicly visible?
		public $isCached = false; //Boolean. Directly stored data or not yet cached URL = false. Cached URL = true.

		public $url = NULL; //If article is located elsewhere, URL goes here and cached data goes below. If local article, URL is null and content goes below.
		
		//Directly stored or cached data:
		public $header = NULL;
		public $ingress = NULL;
		public $text = NULL;
		public $egress = NULL;
		public $comment = NULL;
				
		function getName() {
			return "";
		}
		
	}