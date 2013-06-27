<?php /* Smarty version 2.6.16, created on 2013-04-22 05:42:42
         compiled from ajax/entranceFeePay.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/entranceFeePay.tpl.php', 1, false),array('function', 'eval', 'ajax/entranceFeePay.tpl.php', 6, false),array('function', 'math', 'ajax/entranceFeePay.tpl.php', 33, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.main.php"), $this);?>

<?php if ($this->_tpl_vars['bError'] == true): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['ERROR_PAYMENT_FEE']), $this);?>

	</div>
<?php else: ?>
	<b><?php echo $this->_config[0]['vars']['YOU_HAVE_SELECTED_TO_PAY']; ?>
:</b>
	<br />
	<table width='100%'>
	
	<?php if ($this->_tpl_vars['iMain'] != null): ?>
		<tr>
			<td align='right'><b><?php echo $this->_tpl_vars['iMain']; ?>
</b> <?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT']; ?>
 <?php echo $this->_config[0]['vars']['PLAYERS']; ?>

			<?php if ($this->_tpl_vars['sCurrency'] == 'SEK'): ?>
				(<?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'EUR'): ?>
				(<?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'USD'): ?>
				(<?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'GBP'): ?>
				(<?php echo $this->_config[0]['vars']['MAIN_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
			</td>
		
			<td>= <?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['iMain'])." * ".($this->_tpl_vars['dMainPrice'])), $this);?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
		</tr>	
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['iClassics'] != null): ?>
		<tr>
			<td align='right'><b><?php echo $this->_tpl_vars['iClassics']; ?>
</b> <?php echo $this->_config[0]['vars']['CLASSICS']; ?>
 <?php echo $this->_config[0]['vars']['PLAYERS']; ?>

			<?php if ($this->_tpl_vars['sCurrency'] == 'SEK'): ?>
				(<?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'EUR'): ?>
				(<?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'USD'): ?>
				(<?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'GBP'): ?>
				(<?php echo $this->_config[0]['vars']['CLASSICS_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
			</td>
			<td>= <?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['iClassics'])." * ".($this->_tpl_vars['dClassicsPrice'])), $this);?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
		</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['iTeamMember'] != null): ?>
		<tr>
			<td align='right'><b><?php echo $this->_tpl_vars['iTeamMember']; ?>
</b> <?php echo $this->_config[0]['vars']['TEAM_MEMBERS']; ?>

			<?php if ($this->_tpl_vars['sCurrency'] == 'SEK'): ?>
				(<?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_SEK']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'EUR'): ?>
				(<?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_EUR']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'USD'): ?>
				(<?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_USD']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'GBP'): ?>
				(<?php echo $this->_config[0]['vars']['SPLIT_TOURNAMENT_ENTRANCE_PRICE_GBP']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
) 
			<?php endif; ?>
			</td>
			<td>= <?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['iTeamMember'])." * ".($this->_tpl_vars['dTeamMemberPrice'])), $this);?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
		</tr>
	<?php endif; ?>

        <?php if ($this->_tpl_vars['iTShirt'] != null): ?>
                <tr>
                        <td align='right'><b><?php echo $this->_tpl_vars['iTShirt']; ?>
</b> <?php echo $this->_config[0]['vars']['TSHIRT']; ?>

                        <?php if ($this->_tpl_vars['sCurrency'] == 'SEK'): ?>
                                (<?php echo $this->_config[0]['vars']['TSHIRT_PRICE_SEK']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
)
                        <?php endif; ?>

                        <?php if ($this->_tpl_vars['sCurrency'] == 'EUR'): ?>
                                (<?php echo $this->_config[0]['vars']['TSHIRT_PRICE_EUR']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
)
                        <?php endif; ?>

                        <?php if ($this->_tpl_vars['sCurrency'] == 'USD'): ?>
                                (<?php echo $this->_config[0]['vars']['TSHIRT_PRICE_USD']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
)
                        <?php endif; ?>

                        <?php if ($this->_tpl_vars['sCurrency'] == 'GBP'): ?>
                                (<?php echo $this->_config[0]['vars']['TSHIRT_PRICE_GBP']; ?>
 <?php echo $this->_config[0]['vars']['EACH']; ?>
)
                        <?php endif; ?>
                        </td>
                        <td>= <?php echo smarty_function_math(array('equation' => ($this->_tpl_vars['iTShirt'])." * ".($this->_tpl_vars['dTShirtPrice'])), $this);?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
                </tr>
        <?php endif; ?>
	
	<?php if ($this->_tpl_vars['iType'] == 2): ?>
		<tr>
			<td align='right'><?php echo $this->_config[0]['vars']['ADDITIONAL_PAYPAL_FEES']; ?>
</td>
			<td>= <?php echo $this->_tpl_vars['dPayPalFees']; ?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
		</tr>
	<?php endif; ?>
		
	<tr>
		<td width='35%' align='right'><b><?php echo $this->_config[0]['vars']['TOTAL_TO_PAY']; ?>
</b></td>
		<td>= <?php echo $this->_tpl_vars['dSum']; ?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
</td>
	</tr>

	<?php if ($this->_tpl_vars['iType'] == 0): ?>
		<tr>
			<td colspan='2'><i><?php echo $this->_config[0]['vars']['PAYMENT_DOMESTIC_INFO_BEFORE']; ?>
 <?php echo $this->_tpl_vars['dSum']; ?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
 <?php echo $this->_config[0]['vars']['PAYMENT_DOMESTIC_INFO_AFTER']; ?>
</i></td>
		</tr>

		<tr>
			<td align='right'><b><?php echo $this->_config[0]['vars']['BANKGIRO']; ?>
</b></td>
			<td><?php echo $this->_config[0]['vars']['BANKGIRO_NO']; ?>
</td>
		</tr>
		<tr>
			<td align='right'><b><?php echo $this->_config[0]['vars']['BANKKONTO_FSB']; ?>
</b></td>
			<td><?php echo $this->_config[0]['vars']['BANKKONTO_FSB_NO']; ?>
</td>
		</tr>
		<tr>
			<td align='right'><b><?php echo $this->_config[0]['vars']['BANKKONTO_SEB']; ?>
</b></td>
			<td><?php echo $this->_config[0]['vars']['BANKKONTO_SEB_NO']; ?>
</td>
		</tr>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['iType'] == 1): ?>
		<tr>
			<td colspan='2'><i><?php echo $this->_config[0]['vars']['PAYMENT_INTERNATIONAL_INFO_BEFORE']; ?>
 <?php echo $this->_tpl_vars['dSum']; ?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
 <?php echo $this->_config[0]['vars']['PAYMENT_INTERNATIONAL_INFO_AFTER']; ?>
</i></td>
		</tr>
		<tr>
			<td align='right'><b><?php echo $this->_config[0]['vars']['BIC_SWIFT']; ?>
</b></td>
			<td><?php echo $this->_config[0]['vars']['BIC_SWIFT_ADDRESS']; ?>
</td>
		</tr>
		<tr>
			<td align='right'><b><?php echo $this->_config[0]['vars']['IBAN']; ?>
</b></td>
			<td><?php echo $this->_config[0]['vars']['IBAN_NUMBER']; ?>
</td>
		</tr>
		<tr>
			<td colspan='2'><?php echo $this->_config[0]['vars']['PAYMENT_INFO_DOMESTIC']; ?>
</td>
		</tr>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['iType'] == 2): ?>
		<tr>
			<td colspan='2'><i><?php echo $this->_config[0]['vars']['PAYMENT_ELECTRONIC_INFO']; ?>
</i></td>
		</tr>
	
		<tr>
			<td align='right' valign='top'><b><?php echo $this->_config[0]['vars']['PAYPAL']; ?>
</td>
			<td>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="the@pal.pp.se" />
			<input type="hidden" name="undefined_quantity" value="1" />
			<input type="hidden" name="item_name" value="Stockholm Open Entrance Fee" />
			<input type="hidden" name="item_number" value="1" />
			<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['dSum']; ?>
 <?php echo $this->_tpl_vars['sCurrency']; ?>
" />
			<input type="hidden" name="page_style" value="StockholmOpen" />
			
			<input type="hidden" name="no_shipping" value="1" />
			<input type="hidden" name="return" value="http://www.stockholmopen.nu/paySuccess.php" />
			<input type="hidden" name="cancel_return" value="http://www.stockholmopen.nu/payCancel.php" />
			<input type="hidden" name="cn" value="Players you are paying for" />
<input type="hidden" name="on0" value="message" />
<input type="hidden" name="os0" value="A: <?php echo $this->_tpl_vars['iMain']; ?>
 C: <?php echo $this->_tpl_vars['iClassics']; ?>
 S: <?php echo $this->_tpl_vars['iTeamMember']; ?>
 T: <?php echo $this->_tpl_vars['iTShirt']; ?>
 TS: <?php echo $this->_tpl_vars['sTShirtSize']; ?>
 TC: <?php echo $this->_tpl_vars['sTShirtColor']; ?>
"/>
			<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['sCurrency']; ?>
" />
			
			<?php if ($this->_tpl_vars['sCurrency'] == 'SEK'): ?>
				<input type="image"src="images/misc/x-click-butcc_sek.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'EUR'): ?>
				<input type="image"src="images/misc/x-click-butcc_euro.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'USD'): ?>
				<input type="image"src="images/misc/x-click-butcc_dollar.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['sCurrency'] == 'GBP'): ?>
				<input type="image"src="images/misc/x-click-butcc_pound.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			<?php endif; ?>
			</form>
			</td>	
		</tr>
		
		<tr>
			<td valign='top' align='right'><b><?php echo $this->_config[0]['vars']['MONEYBOOKERS_OR_NETELLER']; ?>
</b></td>
			<td valign='top'><?php echo $this->_config[0]['vars']['MONEYBOOKERS_OR_NETELLER_INFO']; ?>
</td>
		</tr>		
	<?php endif; ?>
	
	<tr>
		<td colspan='2'><i><?php echo $this->_config[0]['vars']['PAYMENT_INFO2']; ?>
</i></td>
	</tr>
	
	</table>
<?php endif; ?>