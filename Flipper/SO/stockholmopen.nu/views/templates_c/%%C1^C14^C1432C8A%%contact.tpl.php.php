<?php /* Smarty version 2.6.16, created on 2008-03-30 05:32:52
         compiled from contact.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'contact.tpl.php', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['CONTACT_HL']; ?>
</h2>

<h3><?php echo $this->_config[0]['vars']['CONTACT_MAIL_LINKS']; ?>
</h3>

<a href='mailto:<?php echo $this->_config[0]['vars']['EMAIL_SO_INFO']; ?>
'><?php echo $this->_config[0]['vars']['EMAIL_SO_INFO']; ?>
</a> - <?php echo $this->_config[0]['vars']['FOR_GENERAL_INFO']; ?>

<br />
<a href='mailto:<?php echo $this->_config[0]['vars']['EMAIL_SO_PRESS']; ?>
'><?php echo $this->_config[0]['vars']['EMAIL_SO_PRESS']; ?>
</a> - <?php echo $this->_config[0]['vars']['FOR_PRESS_MEDIA']; ?>

<br />
<a href='mailto:<?php echo $this->_config[0]['vars']['EMAIL_SO_SUPPORT']; ?>
'><?php echo $this->_config[0]['vars']['EMAIL_SO_SUPPORT']; ?>
</a> - <?php echo $this->_config[0]['vars']['IF_YOU_HAVE_PROBLEMS_WITH_THE_SITE']; ?>


<h3><?php echo $this->_config[0]['vars']['TELEPHONE']; ?>
</h3>
<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['CONTACT_TELEPHONE_INFO']), $this);?>


<h3><?php echo $this->_config[0]['vars']['SNAIL_MAIL']; ?>
</h3>
<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['CONTACT_SNAIL_INFO']), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>