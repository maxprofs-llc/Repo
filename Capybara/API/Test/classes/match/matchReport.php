<?php
	class match_matchReport extends article {
		
		public $matchId = NULL; //TODO: Determine how to act on existing/nonexisting matchId/periodId.
		public $periodId = NULL; //TODO: Determine how to act on existing/nonexisting matchId/periodId.
		public $languageId = NULL; //TODO: Unecessary? article.languageId already exist.
		public $organizationId = NULL; //Organization that designated the article as their matchReport.
		
	}