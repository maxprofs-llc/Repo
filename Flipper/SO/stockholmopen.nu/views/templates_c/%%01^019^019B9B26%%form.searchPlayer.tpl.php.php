<?php /* Smarty version 2.6.16, created on 2008-03-30 17:57:58
         compiled from forms/form.searchPlayer.tpl.php */ ?>
<?php if ($this->_tpl_vars['sPlayerSearch'] == null): ?>
	<?php $this->assign('sPreSearch', $this->_config[0]['vars']['PLAYER_TEAM']); ?>
<?php else: ?>
	<?php $this->assign('sPreSearch', $this->_tpl_vars['sPlayerSearch']); ?>
<?php endif; ?>

<form action='searchPlayer.php' method='get'>
<?php if (USE_AUTO_SUGGEST_SEARCH == true): ?>
<input id='sPlayerSearch' class='tight' name="sPlayerSearch" size='13' maxlength='64' type='text' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onclick="clearInput(\'sPlayerSearch\')"'; ?>
 />
<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
<div class='autoComplete' id='playersearch'></div>

<?php echo '
<script type="text/javascript">
//<![CDATA[
var playerSearchAutoCompleter = new Ajax.Autocompleter(\'sPlayerSearch\', \'playersearch\', \'ajax/autoSuggestPlayerName.php\', {})
//]]>
</script>
'; ?>

<?php else: ?>
<input type='text' class='tight' size='11' maxlength='64' id='sPlayerSearch' name='sPlayerSearch' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onclick="clearInput(\'sPlayerSearch\')"'; ?>
 />
<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
<?php endif; ?>
</form>