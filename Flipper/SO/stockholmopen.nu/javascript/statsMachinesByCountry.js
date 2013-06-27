function statsMachinesByCountry()
{
	var iYear = $F('iYear');
	var sDivision = $F('sDivision');
	window.location.href = "statsPopularGamesByCountry.php?iYear=" + iYear + "&sDivision=" + sDivision;
}