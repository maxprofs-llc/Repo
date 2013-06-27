<?php /* Smarty version 2.6.16, created on 2008-03-30 04:47:55
         compiled from admin/recycled/userList.tpl.php */ ?>
<h3><?php echo $this->_config[0]['vars']['CURRENT_USERS']; ?>
</h3>

<table class='mainTable'>

<tr>
	<td class='HL'><?php echo $this->_config[0]['vars']['USERNAME']; ?>
</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['FIRSTNAME']; ?>
</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['LASTNAME']; ?>
</td>
	<td class='HL' align='center'><?php echo $this->_config[0]['vars']['EDIT']; ?>
</td>
	<!-- <td class='HL' align='center'><?php echo $this->_config[0]['vars']['DELETE']; ?>
</td> -->
	<td class='HL' align='center'><?php echo $this->_config[0]['vars']['PASSWORD']; ?>
</td>
	
</tr>
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aUsers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

		<td><?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['user_username']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['user_firstname']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['user_lastname']; ?>
</td>
		<td align='center'><a href='adminUser.php?iIDEdit=<?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['id_user']; ?>
'><img src='images/icons/edit.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' /></a></td>
		<!-- <td align='center'><a href='adminUser.php?iIDDelete=<?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['id_user']; ?>
'><img src='images/icons/editdelete.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' title='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' /></a></td> -->
		<td align='center'><a href='adminUserPassword.php?iIDEdit=<?php echo $this->_tpl_vars['aUsers'][$this->_sections['section']['index']]['id_user']; ?>
'><img src='images/icons/edit.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' /></a></td>
	</tr>
<?php endfor; endif; ?>
</table>