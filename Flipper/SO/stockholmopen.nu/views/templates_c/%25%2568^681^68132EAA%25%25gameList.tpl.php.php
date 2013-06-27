<?php /* Smarty version 2.6.16, created on 2008-04-02 16:35:17
         compiled from recycled/gameList.tpl.php */ ?>
<table class='mainTable'>
	<tr>
		<?php if ($this->_tpl_vars['sSort'] == null || $this->_tpl_vars['sSort'] == 'nameAsc'): ?> 
			<td class='HLsortUp'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>
		<a href='games.php?sSort=nameAsc'><?php echo $this->_config[0]['vars']['NAME']; ?>
</a>
		</td>

		<?php if ($this->_tpl_vars['sSort'] == 'yearDesc'): ?> 
			<td class='HLsortUp'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>
		<a href='games.php?sSort=yearDesc'><?php echo $this->_config[0]['vars']['YEAR']; ?>
</a>
		</td>		

		<?php if ($this->_tpl_vars['sSort'] == 'manufacturerAsc'): ?> 
			<td class='HLsortUp'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>
		<a href='games.php?sSort=manufacturerAsc'><?php echo $this->_config[0]['vars']['MANUFACTURER']; ?>
</a>
		</td>		
		
		<td class='HL'><?php echo $this->_config[0]['vars']['RULESHEET']; ?>
</td>
		
		<?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
			<td class='HL'><?php echo $this->_config[0]['vars']['EDIT']; ?>
</td>
		<?php endif; ?>		
	</tr>
	
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aGames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

	<?php if ((1 & $this->_sections['section']['iteration'])): ?>
		<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
	<?php else: ?>
		<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
	<?php endif; ?>
	
		<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_ipdb_id'] != null && $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_ipdb_id'] != 0): ?>
			<td><a href='http://ipdb.org/machine.cgi?id=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_ipdb_id']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_name']; ?>
</a></td>
		<?php else: ?>
			<td><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_name']; ?>
</td>
		<?php endif; ?>	

		<td><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_released']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_manufacturer_name']; ?>
</td>
		
		<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_link_rulesheet'] != null): ?>
			<td><a href='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_link_rulesheet']; ?>
'><img src='images/icons/ruleSheet.gif' alt='<?php echo $this->_config[0]['vars']['RULESHEET']; ?>
' title='<?php echo $this->_config[0]['vars']['RULESHEET']; ?>
' class='iconLink' /></a></td>
		<?php else: ?>
			<td></td>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
			<td><a href='<?php echo $this->_tpl_vars['g_sPage']; ?>
?iIDEdit=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
'><img src='images/icons/edit.gif' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' class='iconLink' /></a></td>
		<?php endif; ?>
		
	</tr>
	<?php endfor; endif; ?>
	
</table>