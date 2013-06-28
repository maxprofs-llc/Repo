<?php
	include_once('_define.php');
	
	print "Cache roles...<br>";
	$dr->getRoleList();
	die('');
	print "Cache continents...<br>";
	$dr->getContinentList();
	print "Cache countries...<br>";
	$dr->getCountryList();
	print "Cache states...<br>";
	$dr->getStateList();
	print "Cache cities...<br>";
	$dr->getCityList();
?>