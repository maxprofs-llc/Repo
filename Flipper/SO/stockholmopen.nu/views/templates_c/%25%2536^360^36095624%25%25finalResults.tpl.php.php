<?php /* Smarty version 2.6.16, created on 2008-04-05 17:37:11
         compiled from finalResults.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" type="text/javascript" src="javascript/wysiwyg/wysiwyg.js"></script> 

<h2><?php echo $this->_config[0]['vars']['FINALS']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finals/".($this->_tpl_vars['iYear'])."/".($this->_tpl_vars['sDivision']).".html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br />
<br />
<br />
<hr />
<h2><?php echo $this->_config[0]['vars']['EDIT_TEXT']; ?>
</h2>
<i><?php echo $this->_config[0]['vars']['LOGGED_IN_AS_UBER_ADMIN_AND_ALLOWED_TO_EDIT']; ?>
</i>
<p>
<?php echo $this->_config[0]['vars']['EDIT_WICKED_WIKI_INFO']; ?>

</p>
<form action="finalResults.php"" method="post">
<input type='submit' value="Update Page" />
<?php if ($this->_tpl_vars['g_aUserAdminTasks']['admin_uber'] == 'true'): ?>
	<br />
	<br />
	<textarea  name='sText' id='sText'>
		<?php echo $this->_tpl_vars['sFileContent']; ?>

	</textarea>
	<input type='hidden' name='iYear' value='<?php echo $this->_tpl_vars['iYear']; ?>
' /> <input type='hidden' name='sDivision' value='<?php echo $this->_tpl_vars['sDivision']; ?>
' />
<?php endif; ?>
</form>

<script language="javascript1.2">
	generate_wysiwyg('sText');
</script> 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>