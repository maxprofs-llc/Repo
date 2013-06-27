<?php /* Smarty version 2.6.16, created on 2008-03-31 23:54:48
         compiled from oldie.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'oldie.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browser Version Not Supported | Dao By Design</title>
</head>
<body style="text-align:center; font-family: Trebuchet MS, arial, verdana;">
<div style="margin:30px auto;border:1px solid #333;padding:10px;text-align:left;width:550px;background:#FFFFCC;">
	<h2 style="font-variant:small-caps;"><?php echo $this->_config[0]['vars']['OLIDE_HL']; ?>
</h2>
	<?php echo $this->_config[0]['vars']['OLDIE_MAIN']; ?>

</div>
</div>
</body>
</html>