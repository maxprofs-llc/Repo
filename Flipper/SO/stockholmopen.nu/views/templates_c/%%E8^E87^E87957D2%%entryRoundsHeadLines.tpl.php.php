<?php /* Smarty version 2.6.16, created on 2008-03-30 05:40:46
         compiled from recycled/entryRoundsHeadLines.tpl.php */ ?>
<tr>
	<?php if ($this->_tpl_vars['sSort'] == 'gameAsc'): ?>
		<td class='HLsortUp' width='190'>
	<?php else: ?>
		<td width='190' class='HL'>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bNoEntryRoundSorting'] != 'true'): ?>
		<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=gameAsc'><?php echo $this->_config[0]['vars']['MACHINE']; ?>
</a>
	<?php else: ?>
		<?php echo $this->_config[0]['vars']['MACHINE']; ?>

	<?php endif; ?>
	</td>
	
	<td width='80' class='HL'><?php echo $this->_config[0]['vars']['SCORE']; ?>
</td>
	
	<?php if ($this->_tpl_vars['sSort'] == 'posDesc'): ?>
		<td class='HLsortDown'>
	<?php else: ?>
		<td class='HL'>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bNoEntryRoundSorting'] != 'true'): ?>
		<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=posDesc'><?php echo $this->_config[0]['vars']['POSITION_SHORT']; ?>
</a>
	<?php else: ?>
		<?php echo $this->_config[0]['vars']['POSITION_SHORT']; ?>

	<?php endif; ?>
	</td>
	
	<td class='HL'><?php echo $this->_config[0]['vars']['POINTS']; ?>
</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['UPDATED']; ?>
</td>
	
	<?php if ($this->_tpl_vars['sSort'] != null): ?>
		<td class='HL'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>	
	<?php endif; ?>
</tr>