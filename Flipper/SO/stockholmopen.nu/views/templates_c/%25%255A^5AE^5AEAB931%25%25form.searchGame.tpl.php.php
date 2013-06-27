<?php /* Smarty version 2.6.16, created on 2008-03-30 04:12:03
         compiled from forms/form.searchGame.tpl.php */ ?>
<?php if ($this->_tpl_vars['sGameSearch'] == null): ?>
	<?php $this->assign('sPreSearch', $this->_config[0]['vars']['GAME_NAME']);  else: ?>
	<?php $this->assign('sPreSearch', $this->_tpl_vars['sGameSearch']);  endif; ?>

<form action='searchGame.php' method='get'>
<?php if (USE_AUTO_SUGGEST_SEARCH == true): ?>
	<input id='sGameSearch' class='tight' name="sGameSearch" size='13' maxlength='64' type='text' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onclick="clearInput(\'sGameSearch\')"'; ?>
/>
	<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
	<div class='autoComplete' id='gamesearch'></div>	
	<?php echo '
	<script type="text/javascript">
	//<![CDATA[
	var gameSearchAutoCompleter = new Ajax.Autocompleter(\'sGameSearch\', \'gamesearch\', \'ajax/autoSuggestGameName.php\', {})
	//]]>
	</script>
	'; ?>


<?php else: ?>
	<form action='searchGame.php' method='get'>
	<input type='text' class='tight' size='11' maxlength='64' id='sGameSearch' name='sGameSearch' value='<?php echo $this->_tpl_vars['sPreSearch']; ?>
' <?php echo 'onclick="clearInput(\'sGameSearch\')"'; ?>
 />
	<input type='submit' class='tight' value='<?php echo $this->_config[0]['vars']['SEARCH']; ?>
' />
<?php endif; ?>
</form>