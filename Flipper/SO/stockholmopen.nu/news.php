<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.News.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oNews = new News();
$aNews = $oNews->getNews();
$oTemplate->assign("aNews", $aNews);
$oTemplate->display("news.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>