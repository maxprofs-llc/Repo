<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oDiv = new DivisionsToYears();
$aDivisions = $oDiv->getDivisionsFromYear(YEAR);

printArray($aDivisions);
?>