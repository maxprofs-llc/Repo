<?php

	include_once('_define.php');

	$cities=$dr->getCityList(true,$cid,$sid);

	print $cities->getJSON(false);

?>