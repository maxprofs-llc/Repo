<?php /* Smarty version 2.6.16, created on 2008-03-30 13:07:26
         compiled from errorPages/errorGameSearch.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['GAME_SEARCH_HL']; ?>
 - <?php echo $this->_config[0]['vars']['ERROR']; ?>
</h2>

<?php if ($this->_tpl_vars['bNotFound'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['GAME_SEARCH_NOT_FOUND']; ?>
: <i><?php echo $this->_tpl_vars['sGameSearch']; ?>
</i>
<?php endif; ?>

<?php if ($this->_tpl_vars['bEmptyString'] == true): ?>
	<?php echo $this->_config[0]['vars']['ERROR_PLEASE_ENTER_STRING_TO_SEARCH']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bMultipleGames'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['GAME_SEARCH_MULTIPLE_GAMES']; ?>
: 
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aSearchGames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<a href='searchGame.php?sGameSearch=<?php echo $this->_tpl_vars['aSearchGames'][$this->_sections['section']['index']]['game_name']; ?>
&amp;bFromLink=true'><?php echo $this->_tpl_vars['aSearchGames'][$this->_sections['section']['index']]['game_name']; ?>
</a>
	<?php endfor; endif;  endif; ?>

<?php if ($this->_tpl_vars['bGameNull'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['GAME_SEARCH_NULL']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>