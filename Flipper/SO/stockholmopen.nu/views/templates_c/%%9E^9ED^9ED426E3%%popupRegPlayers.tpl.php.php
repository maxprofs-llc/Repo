<?php /* Smarty version 2.6.16, created on 2008-06-06 10:45:44
         compiled from popupRegPlayers.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'popupRegPlayers.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.languages.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.javascript.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.inputs.php"), $this);?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo $this->_config[0]['vars']['PAGE_TITLE']; ?>
</title>
<meta name="description" content="desc" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<meta name="ROBOTS" content="NOODP" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
<link rel="stylesheet" href="css/stylePopup.css" type="text/css" />
</head>
<body>

<h2>
<?php if ($this->_tpl_vars['sDivision'] == 'S'): ?>
	<?php echo $this->_config[0]['vars']['REG_TEAMS_HL']; ?>

<?php else: ?>
	<?php echo $this->_config[0]['vars']['REG_PLAYERS_HL']; ?>

<?php endif; ?>
</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/playersAndStandings.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>