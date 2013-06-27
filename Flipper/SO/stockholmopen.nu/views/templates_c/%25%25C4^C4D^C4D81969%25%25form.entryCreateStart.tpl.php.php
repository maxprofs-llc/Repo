<?php /* Smarty version 2.6.16, created on 2008-03-31 23:45:43
         compiled from formsAdmin/form.entryCreateStart.tpl.php */ ?>
<?php echo '
<script type="text/javascript">
	function displayPlayers()
	{
		var iIDPlayer = document.getElementById(\'iIDPlayer\').value;
		new Ajax.Updater(\'player\', \'ajax/player.php?iIDPlayer=\'+iIDPlayer);
		new Element.show(\'label\');
		return false;
	}

	function focus()
	{
		document.getElementById(\'iIDPlayer\').focus();
	}

	womAdd(\'focus()\');
	womOn();
</script>
'; ?>


<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing'] == true): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidPlayerID'] == true): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_PLAYER_TEAM_ID']; ?>
<br />
		<?php endif; ?>	
	</div>
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td width='80' class='inputLabel'><?php echo $this->_config[0]['vars']['PLAYER_TEAM_ID']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iIDPlayer']['input']; ?>
</td>
		</tr>

		<tr>
			<td class='inputLabel'>
				<div id="label" style='display:none'>
				<?php echo $this->_config[0]['vars']['PLAYER_TEAM']; ?>

				</div>
			</td>
			<td>
				<div id="player">
								</div>
			</td>
		</tr>

		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>	