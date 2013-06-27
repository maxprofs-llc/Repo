<?php /* Smarty version 2.6.16, created on 2013-06-12 08:28:08
         compiled from admin/adminEntryCreate.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<?php echo '
	<script type="text/javascript">

	function focus()
	{
		document.getElementById(\'another\').focus();
	}

	womAdd(\'focus()\');
	womOn();
	</script>
	'; ?>


<?php elseif ($this->_tpl_vars['bIsVerOption']): ?>
	<?php echo '
	<script type="text/javascript">

	function focus()
	{
		document.getElementById(\'buttonVerBack\').focus();
	}

	womAdd(\'focus()\');
	womOn();
	</script>
	'; ?>

<?php else: ?>
	<?php echo '
	<script type="text/javascript">

	function focus()
	{
		document.getElementById(\'iIDGame_0\').focus();
	}

	womAdd(\'focus()\');
	womOn();
	</script>
	'; ?>

<?php endif; ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_ENTRY_CREATE_HL']; ?>


(
<?php if ($this->_tpl_vars['bIsStart'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['STEP_THREE_OF_FIVE']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsVerOption'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['STEP_FOUR_OF_FIVE']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['DONE']; ?>

<?php endif; ?>
)

</h2>

<?php if ($this->_tpl_vars['bIsVerOption'] == 'true'): ?>
	<p><?php echo $this->_config[0]['vars']['ADMIN_ENTRY_CREATE_VER']; ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayStartText'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_CREATE_MAIN']; ?>

<?php endif; ?>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.entryCreate.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<h3><?php echo $this->_config[0]['vars']['ENTRY_INFO']; ?>
</h3>
	
	<hr width='300' align='left' />
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aEntry']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['section']['show'] = true;
$this->_sections['section']['max'] = $this->_sections['section']['loop'];
$this->_sections['section']['step'] = 1;
$this->_sections['section']['start'] = $this->_sections['section']['step'] > 0 ? 0 : $this->_sections['section']['loop']-1;
if ($this->_sections['section']['show']) {
    $this->_sections['section']['total'] = $this->_sections['section']['loop'];
    if ($this->_sections['section']['total'] == 0)
        $this->_sections['section']['show'] = false;
} else
    $this->_sections['section']['total'] = 0;
if ($this->_sections['section']['show']):

            for ($this->_sections['section']['index'] = $this->_sections['section']['start'], $this->_sections['section']['iteration'] = 1;
                 $this->_sections['section']['iteration'] <= $this->_sections['section']['total'];
                 $this->_sections['section']['index'] += $this->_sections['section']['step'], $this->_sections['section']['iteration']++):
$this->_sections['section']['rownum'] = $this->_sections['section']['iteration'];
$this->_sections['section']['index_prev'] = $this->_sections['section']['index'] - $this->_sections['section']['step'];
$this->_sections['section']['index_next'] = $this->_sections['section']['index'] + $this->_sections['section']['step'];
$this->_sections['section']['first']      = ($this->_sections['section']['iteration'] == 1);
$this->_sections['section']['last']       = ($this->_sections['section']['iteration'] == $this->_sections['section']['total']);
?>
		<table class='mainTable'>
			<tr>
				<td width='90' class='tableLabel'><?php echo $this->_config[0]['vars']['PLAYER_TEAM']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aEntry']['0']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aEntry']['0']['player_lastname']; ?>
</td>
			</tr>
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['PLAYER_TEAM_ID']; ?>
</td>
				<td valign='top'><?php echo $this->_tpl_vars['aEntry']['0']['id_player']; ?>
 <a href='wap/playerPrinter.php?playerId=<?php echo $this->_tpl_vars['aEntry']['0']['id_player']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' /></a></td>
			</tr>
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['INITIALS']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aEntry']['0']['player_initials']; ?>
</td>
			</tr>
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</td>
				<td><?php echo $this->_tpl_vars['iNoOfEntries']; ?>
</td>
			</tr>
			<tr>
				<td colspan='2'><i class='small'><?php echo $this->_config[0]['vars']['INCLUDING_THE_ONE_JUST_CREATED']; ?>
</td>
			</tr>
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aEntry']['0']['id_entry']; ?>
</td>
			</tr>			
			<?php unset($this->_sections['entryRounds']);
$this->_sections['entryRounds']['name'] = 'entryRounds';
$this->_sections['entryRounds']['loop'] = is_array($_loop=$this->_tpl_vars['aEntry'][$this->_sections['section']['index']]['entry_rounds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['entryRounds']['show'] = true;
$this->_sections['entryRounds']['max'] = $this->_sections['entryRounds']['loop'];
$this->_sections['entryRounds']['step'] = 1;
$this->_sections['entryRounds']['start'] = $this->_sections['entryRounds']['step'] > 0 ? 0 : $this->_sections['entryRounds']['loop']-1;
if ($this->_sections['entryRounds']['show']) {
    $this->_sections['entryRounds']['total'] = $this->_sections['entryRounds']['loop'];
    if ($this->_sections['entryRounds']['total'] == 0)
        $this->_sections['entryRounds']['show'] = false;
} else
    $this->_sections['entryRounds']['total'] = 0;
if ($this->_sections['entryRounds']['show']):

            for ($this->_sections['entryRounds']['index'] = $this->_sections['entryRounds']['start'], $this->_sections['entryRounds']['iteration'] = 1;
                 $this->_sections['entryRounds']['iteration'] <= $this->_sections['entryRounds']['total'];
                 $this->_sections['entryRounds']['index'] += $this->_sections['entryRounds']['step'], $this->_sections['entryRounds']['iteration']++):
$this->_sections['entryRounds']['rownum'] = $this->_sections['entryRounds']['iteration'];
$this->_sections['entryRounds']['index_prev'] = $this->_sections['entryRounds']['index'] - $this->_sections['entryRounds']['step'];
$this->_sections['entryRounds']['index_next'] = $this->_sections['entryRounds']['index'] + $this->_sections['entryRounds']['step'];
$this->_sections['entryRounds']['first']      = ($this->_sections['entryRounds']['iteration'] == 1);
$this->_sections['entryRounds']['last']       = ($this->_sections['entryRounds']['iteration'] == $this->_sections['entryRounds']['total']);
?>
				<tr>
					<td class='tableLabel'><?php echo $this->_config[0]['vars']['GAME']; ?>
 <?php echo $this->_sections['entryRounds']['iteration']; ?>
</td>
					<td><?php echo $this->_tpl_vars['aEntry'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['game_name']; ?>
</td>
				</tr>
			<?php endfor; endif; ?>	
		</table>
	<?php endfor; endif; ?>
	<hr width='300' align='left' />

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<br />
	<a href='wap/entryPrinter.php?entryId=<?php echo $this->_tpl_vars['aEntry']['0']['id_entry']; ?>
&autoPrint=true' id='printEntry' target='_new'><?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
</a><br />
	<a href='adminEntryCreateStart.php' id='another'><?php echo $this->_config[0]['vars']['ADMIN_ENTRY_CREATE_ANOTHER']; ?>
</a>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>