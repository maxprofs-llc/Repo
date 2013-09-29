<?php

$link = @mysqli_connect("localhost","flippersm","nf7JcYqJmYT8ymCE");

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysqli_select_db($link,"flippersm_main");

?>
