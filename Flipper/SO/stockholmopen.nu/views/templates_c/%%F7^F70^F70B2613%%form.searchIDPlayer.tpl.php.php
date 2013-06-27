<?php /* Smarty version 2.6.16, created on 2008-03-30 17:57:58
         compiled from forms/form.searchIDPlayer.tpl.php */ ?>
<?php if ($this->_tpl_vars['iIDPlayerSearch'] == null): ?>
	<?php $this->assign('sPreSearch', $this->_config[0]['vars']['PLAYER_ID']); ?>
<?php else: ?>
	<?php $this->assign('sPreSearch', $this->_tpl_vars['iIDPlayerSearch']); ?>
<?php endif; ?>

<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDPlayerSearch' id='iIDPlayerSearch' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onfocus="clearInput(\'iIDPlayerSearch\')"'; ?>
 />
<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
</form>