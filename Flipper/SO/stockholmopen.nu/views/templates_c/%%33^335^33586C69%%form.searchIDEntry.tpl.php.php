<?php /* Smarty version 2.6.16, created on 2008-03-30 17:57:58
         compiled from forms/form.searchIDEntry.tpl.php */ ?>
<?php if ($this->_tpl_vars['iIDEntrySearch'] == null): ?>
	<?php $this->assign('sPreSearch', $this->_config[0]['vars']['ENTRY_ID']); ?>
<?php else: ?>
	<?php $this->assign('sPreSearch', $this->_tpl_vars['iIDEntrySearch']); ?>
<?php endif; ?>

<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDEntrySearch' id='iIDEntrySearch' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onfocus="clearInput(\'iIDEntrySearch\')"'; ?>
 />
<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
</form>