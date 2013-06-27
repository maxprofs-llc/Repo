<?php /* Smarty version 2.6.16, created on 2008-04-12 19:17:44
         compiled from registeredPlayers.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'registeredPlayers.tpl.php', 38, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['sDivision'] == 'S'): ?>
	<h2><?php echo $this->_config[0]['vars']['REG_TEAMS_HL']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</h2>
	<?php echo $this->_config[0]['vars']['REG_TEAMS_MAIN']; ?>

<?php else: ?>
	<h2><?php echo $this->_config[0]['vars']['REG_PLAYERS_HL']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 
	
		
	<?php echo $this->_config[0]['vars']['DIVISION']; ?>
</h2>
	<p>
	<?php echo $this->_config[0]['vars']['REG_PLAYERS_MAIN']; ?>

	<br />
	<br />
	<?php if ($this->_tpl_vars['bDivisionIsFree'] != 1): ?>
		<?php echo $this->_config[0]['vars']['REG_PLAYERS_PAYMENT_INFO']; ?>

	<?php else: ?>
		<?php echo $this->_config[0]['vars']['REG_PLAYERS_FREE_INFO']; ?>

	<?php endif; ?>		
	</p>
<?php endif; ?>
	
<p>
<?php if ($this->_tpl_vars['sDivision'] == 'S'): ?>
	<?php echo $this->_config[0]['vars']['NUMBER_OF_REGISTERED_TEAMS']; ?>
: 
<?php else: ?>
	<?php echo $this->_config[0]['vars']['NUMBER_OF_REGISTERED_PLAYERS']; ?>
: 
<?php endif; ?>
<b><?php echo $this->_tpl_vars['iNoOfPlayers']; ?>
</b> 


<?php if ($this->_tpl_vars['sDivision'] != 'S' && $this->_tpl_vars['iNumberOfCountries'] > 1): ?>
	(<?php echo ((is_array($_tmp=$this->_config[0]['vars']['FROM'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 <?php echo $this->_tpl_vars['iNumberOfCountries']; ?>
 <?php echo ((is_array($_tmp=$this->_config[0]['vars']['COUNTRIES'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
)
<?php endif; ?>
.

<?php if ($this->_tpl_vars['bDivisionIsFree'] != 1): ?>
	<?php echo $this->_config[0]['vars']['NUMBER_OF_PAID_ENTRANCE_FEES']; ?>
: <b><?php echo $this->_tpl_vars['iPlayersWithEntranceFee']; ?>
</b>.
<?php endif; ?>

</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/playersAndStandings.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>