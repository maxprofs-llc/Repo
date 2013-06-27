<?php /* Smarty version 2.6.16, created on 2008-03-30 05:43:35
         compiled from elements/headerSlide.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'elements/headerSlide.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.languages.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.javascript.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.inputs.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.main.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.menu.php"), $this);?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="author" content="Stockholm Pinball Open" />
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<title><?php echo $this->_config[0]['vars']['PAGE_TITLE']; ?>
</title>
	<link rel="stylesheet" href="css/styleSlide.css" type="text/css" />
	<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
</head>
<body>