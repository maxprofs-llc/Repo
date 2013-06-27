<?php /* Smarty version 2.6.16, created on 2008-03-30 04:50:42
         compiled from forms/form.entranceFee.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'forms/form.entranceFee.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.main.php"), $this);?>


<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['aCustomErrors']['nonInteger']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_NON_INTEGERS']; ?>
<br />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['aCustomErrors']['noDivisionSelected']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_SELECT_PLAYERS_TEAMS']; ?>
<br />
		<?php endif; ?>		
	</div>		
<?php endif; ?>

<?php echo $this->_tpl_vars['sFormStart']; ?>

<table class='formTable'>
	<tr>
		<td colspan='2'><?php echo $this->_config[0]['vars']['NUMBER_OF']; ?>
...</td>
	</tr>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_FEES']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['iMain']['input']; ?>
 <?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 / <?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 / <?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 / <?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
</td>
	</tr>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['CLASSICS_DIVISION_ENTRANCE_FEES']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['iClassics']['input']; ?>
 <?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 / <?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 / <?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 / <?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
</td>
	</tr>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['SPLIT_TEAM_MEMBER_ENTRANCE_FEES']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['iTeamMember']['input']; ?>
 <?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 / <?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 / <?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 / <?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
</td>
	</tr>
	<tr>
		<td></td>
		<td><i><?php echo $this->_config[0]['vars']['SPLIT_FLIPPER_NOTE']; ?>
</i></td>
	</tr>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['CURRENCY']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['sCurrency']['input']; ?>
</td>
	</tr>
	<tr>
		<td></td>
		<td><i><?php echo $this->_config[0]['vars']['PAYPAL_FEE_NOTE']; ?>
</i></td>
	</tr>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['PAYMENT_TYPE']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['iType']['input']; ?>
</td>
	</tr>
	</table>
<?php echo $this->_tpl_vars['sFormEnd']; ?>
