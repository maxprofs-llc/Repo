<?php
session_start();
$anvnamn = trim($_POST['namn']);
$losenord = trim($_POST['losen']);

if ($losenord == 'slamtilt' && $anvnamn == 'flippersm')
{
	if (!isset($_SESSION['ok_user']))
		{
		$_SESSION['ok_user'] = $anvnamn;
		}
header("Location: nyheter2.php");
}
else
{
header("Location: loginmissheader.php");
}
?>
</body>
</html>