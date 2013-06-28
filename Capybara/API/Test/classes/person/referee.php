<?php
	class person_referee extends person_person {
		
		public $roleId;
		public $personId;
		
		function getPersonId() {
			return $this->personId;
		}
	}