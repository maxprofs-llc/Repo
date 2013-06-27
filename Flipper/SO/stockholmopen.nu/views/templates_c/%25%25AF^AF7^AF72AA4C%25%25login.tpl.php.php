<?php /* Smarty version 2.6.16, created on 2008-03-30 04:12:03
         compiled from ajax/login.tpl.php */ ?>
<!-- <form action='login.php' method='post'> -->
<form action="<?php echo @LOGIN_URL; ?>
" method='post'>
<br />
<div id='login' style='display:none;'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forms/form.loginAjax.tpl.php", 'smarty_include_vars' => array('title' => 'login')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</form>