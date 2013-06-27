<?php /* Smarty version 2.6.16, created on 2008-03-31 23:45:43
         compiled from admin/recycled/divisionPlayerLinkList.tpl.php */ ?>
<h3><?php echo $this->_config[0]['vars']['LIST_WITH_PLAYER_TEAM_IDS']; ?>
</h3>

<table class='mainTable'>
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<tr>
	<td width='60'><a href="#" onclick="popup('popupRegPlayers.php?iYear=<?php echo $this->_tpl_vars['g_iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['division_name_short']; ?>
','800', '800', '100', '400'); return false"><?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</a></td>
	<td> (<?php echo $this->_config[0]['vars']['OPENS_IN_A_NEW_WINDOW']; ?>
}</td>
	</tr>
<?php endfor; endif; ?>
</table>