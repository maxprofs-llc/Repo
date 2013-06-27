<?php /* Smarty version 2.6.16, created on 2008-06-07 14:22:26
         compiled from recycled/news.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'recycled/news.tpl.php', 2, false),array('modifier', 'nl2br', 'recycled/news.tpl.php', 4, false),)), $this); ?>
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aNews']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<h3 class='news'><?php echo $this->_config[0]['vars']['POSTED']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aNews'][$this->_sections['section']['index']]['news_date'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
 <?php echo $this->_config[0]['vars']['BY']; ?>
  <?php echo $this->_tpl_vars['aNews'][$this->_sections['section']['index']]['user_firstname']; ?>
</h3>
<br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['aNews'][$this->_sections['section']['index']]['news_text'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

<?php endfor; endif; ?>