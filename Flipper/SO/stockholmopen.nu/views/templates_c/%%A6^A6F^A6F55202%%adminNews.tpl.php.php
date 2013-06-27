<?php /* Smarty version 2.6.16, created on 2008-03-30 05:13:58
         compiled from admin/adminNews.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'admin/adminNews.tpl.php', 35, false),array('modifier', 'strip_tags', 'admin/adminNews.tpl.php', 36, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
:

<?php if ($this->_tpl_vars['sFormState'] == 'defaultStart' || $this->_tpl_vars['bIsDefaultCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ADD_NEWS_HL']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['sFormState'] == 'editStart' || $this->_tpl_vars['bIsEditCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_EDIT_NEWS_HL']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsDeleteFailed'] == 'true' || $this->_tpl_vars['bIsDeleteCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_DELETE_NEWS_HL']; ?>

<?php endif; ?>

</h2>

<?php if ($this->_tpl_vars['sFormState'] == 'defaultStart'):  echo $this->_config[0]['vars']['ADMIN_ADD_NEWS_MAIN']; ?>

<br />
<br />
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.news.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h3><?php echo $this->_config[0]['vars']['POSTED_NEWS']; ?>
</h3>

<table class='mainTable'>
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
	<?php if (!(1 & $this->_sections['section']['iteration'])): ?>
		<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
	<?php else: ?>
		<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
	<?php endif; ?>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aNews'][$this->_sections['section']['index']]['news_date'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 11, "", true) : smarty_modifier_truncate($_tmp, 11, "", true)); ?>
 | <?php echo $this->_tpl_vars['aNews'][$this->_sections['section']['index']]['user_username']; ?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['aNews'][$this->_sections['section']['index']]['news_text'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, "...", false) : smarty_modifier_truncate($_tmp, 60, "...", false)); ?>
</td>
		<td align='center'><a href='adminNews.php?iIDEdit=<?php echo $this->_tpl_vars['aNews'][$this->_sections['section']['index']]['id_news']; ?>
'><img src='images/icons/edit.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' /></a></td>
		<td align='center'><a href='adminNews.php?iIDDelete=<?php echo $this->_tpl_vars['aNews'][$this->_sections['section']['index']]['id_news']; ?>
'><img src='images/icons/editdelete.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' title='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' /></a></td>
	</tr>
<?php endfor; endif; ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>