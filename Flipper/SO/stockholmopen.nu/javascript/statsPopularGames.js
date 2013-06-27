function statsPopularGames()
{
	var iYear = $F('iYear');
	var sDivision = $F('sDivision');
	window.location.href = "statsPopularGames.php?iYear=" + iYear + "&sDivision=" + sDivision;
}