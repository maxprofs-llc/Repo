<?php /* Smarty version 2.6.16, created on 2008-04-20 13:10:54
         compiled from ajax/gameHistogram.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/gameHistogram.tpl.php', 1, false),array('function', 'math', 'ajax/gameHistogram.tpl.php', 9, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.javascript.php"), $this);?>


<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aHistogramData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr class='underLine'>
			<td width='100'></td>
			<td width='120'><?php echo $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['score_interval_name']; ?>
</td>
			<td width='320'><img src='images/icons/green.gif' width='<?php echo smarty_function_math(array('equation' => "x / y * 320",'x' => $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['number_of_scores'],'y' => $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['max_number_of_scores'],'format' => "%d"), $this);?>
' height='10' alt='<?php echo $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['number_of_scores']; ?>
' /></td>
			<td width='30'><?php echo $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['number_of_scores']; ?>
</td>
			<td align='left'> (<?php echo smarty_function_math(array('equation' => "x / y * 100",'x' => $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['number_of_scores'],'y' => $this->_tpl_vars['aHistogramData'][$this->_sections['section']['index']]['total_no_of_rounds'],'format' => "%.1f"), $this);?>
%)</td>
		</tr>
	</table> 
<?php endfor; endif; ?>