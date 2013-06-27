{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.main.php}
{if $bError == true}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		{eval var=#ERROR_PAYMENT_FEE#}
	</div>
{else}
	<b>{#YOU_HAVE_SELECTED_TO_PAY#}:</b>
	<br />
	<table width='100%'>
	
	{if $iMain != null}
		<tr>
			<td align='right'><b>{$iMain}</b> {#MAIN_TOURNAMENT#} {#PLAYERS#}
			{if $sCurrency == "SEK"}
				({#MAIN_TOURNAMENT_ENTRANCE_PRICE_SEK#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "EUR"}
				({#MAIN_TOURNAMENT_ENTRANCE_PRICE_EUR#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "USD"}
				({#MAIN_TOURNAMENT_ENTRANCE_PRICE_USD#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "GBP"}
				({#MAIN_TOURNAMENT_ENTRANCE_PRICE_GBP#} {#EACH#}) 
			{/if}
			</td>
		
			<td>= {math equation="$iMain * $dMainPrice"} {$sCurrency}</td>
		</tr>	
	{/if}
	
	{if $iClassics != null}
		<tr>
			<td align='right'><b>{$iClassics}</b> {#CLASSICS#} {#PLAYERS#}
			{if $sCurrency == "SEK"}
				({#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_SEK#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "EUR"}
				({#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_EUR#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "USD"}
				({#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_USD#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "GBP"}
				({#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_GBP#} {#EACH#}) 
			{/if}
			</td>
			<td>= {math equation="$iClassics * $dClassicsPrice"} {$sCurrency}</td>
		</tr>
	{/if}
	
	{if $iTeamMember != null}
		<tr>
			<td align='right'><b>{$iTeamMember}</b> {#TEAM_MEMBERS#}
			{if $sCurrency == "SEK"}
				({#SPLIT_TOURNAMENT_ENTRANCE_PRICE_SEK#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "EUR"}
				({#SPLIT_TOURNAMENT_ENTRANCE_PRICE_EUR#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "USD"}
				({#SPLIT_TOURNAMENT_ENTRANCE_PRICE_USD#} {#EACH#}) 
			{/if}
		
			{if $sCurrency == "GBP"}
				({#SPLIT_TOURNAMENT_ENTRANCE_PRICE_GBP#} {#EACH#}) 
			{/if}
			</td>
			<td>= {math equation="$iTeamMember * $dTeamMemberPrice"} {$sCurrency}</td>
		</tr>
	{/if}

        {if $iTShirt != null}
                <tr>
                        <td align='right'><b>{$iTShirt}</b> {#TSHIRT#}
                        {if $sCurrency == "SEK"}
                                ({#TSHIRT_PRICE_SEK#} {#EACH#})
                        {/if}

                        {if $sCurrency == "EUR"}
                                ({#TSHIRT_PRICE_EUR#} {#EACH#})
                        {/if}

                        {if $sCurrency == "USD"}
                                ({#TSHIRT_PRICE_USD#} {#EACH#})
                        {/if}

                        {if $sCurrency == "GBP"}
                                ({#TSHIRT_PRICE_GBP#} {#EACH#})
                        {/if}
                        </td>
                        <td>= {math equation="$iTShirt * $dTShirtPrice"} {$sCurrency}</td>
                </tr>
        {/if}
	
	{if $iType == 2}
		<tr>
			<td align='right'>{#ADDITIONAL_PAYPAL_FEES#}</td>
			<td>= {$dPayPalFees} {$sCurrency}</td>
		</tr>
	{/if}
		
	<tr>
		<td width='35%' align='right'><b>{#TOTAL_TO_PAY#}</b></td>
		<td>= {$dSum} {$sCurrency}</td>
	</tr>

	{if $iType == 0}
		<tr>
			<td colspan='2'><i>{#PAYMENT_DOMESTIC_INFO_BEFORE#} {$dSum} {$sCurrency} {#PAYMENT_DOMESTIC_INFO_AFTER#}</i></td>
		</tr>

		<tr>
			<td align='right'><b>{#BANKGIRO#}</b></td>
			<td>{#BANKGIRO_NO#}</td>
		</tr>
		<tr>
			<td align='right'><b>{#BANKKONTO_FSB#}</b></td>
			<td>{#BANKKONTO_FSB_NO#}</td>
		</tr>
		<tr>
			<td align='right'><b>{#BANKKONTO_SEB#}</b></td>
			<td>{#BANKKONTO_SEB_NO#}</td>
		</tr>
	{/if}
	
	{if $iType == 1}
		<tr>
			<td colspan='2'><i>{#PAYMENT_INTERNATIONAL_INFO_BEFORE#} {$dSum} {$sCurrency} {#PAYMENT_INTERNATIONAL_INFO_AFTER#}</i></td>
		</tr>
		<tr>
			<td align='right'><b>{#BIC_SWIFT#}</b></td>
			<td>{#BIC_SWIFT_ADDRESS#}</td>
		</tr>
		<tr>
			<td align='right'><b>{#IBAN#}</b></td>
			<td>{#IBAN_NUMBER#}</td>
		</tr>
		<tr>
			<td colspan='2'>{#PAYMENT_INFO_DOMESTIC#}</td>
		</tr>
	{/if}

	{if $iType == 2}
		<tr>
			<td colspan='2'><i>{#PAYMENT_ELECTRONIC_INFO#}</i></td>
		</tr>
	
		<tr>
			<td align='right' valign='top'><b>{#PAYPAL#}</td>
			<td>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="the@pal.pp.se" />
			<input type="hidden" name="undefined_quantity" value="1" />
			<input type="hidden" name="item_name" value="Stockholm Open Entrance Fee" />
			<input type="hidden" name="item_number" value="1" />
			<input type="hidden" name="amount" value="{$dSum} {$sCurrency}" />
			<input type="hidden" name="page_style" value="StockholmOpen" />
			
			<input type="hidden" name="no_shipping" value="1" />
			<input type="hidden" name="return" value="http://www.stockholmopen.nu/paySuccess.php" />
			<input type="hidden" name="cancel_return" value="http://www.stockholmopen.nu/payCancel.php" />
			<input type="hidden" name="cn" value="Players you are paying for" />
<input type="hidden" name="on0" value="message" />
<input type="hidden" name="os0" value="A: {$iMain} C: {$iClassics} S: {$iTeamMember} T: {$iTShirt} TS: {$sTShirtSize} TC: {$sTShirtColor}"/>
			<input type="hidden" name="currency_code" value="{$sCurrency}" />
			
			{if $sCurrency == "SEK"}
				<input type="image"src="images/misc/x-click-butcc_sek.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			{/if}
		
			{if $sCurrency == "EUR"}
				<input type="image"src="images/misc/x-click-butcc_euro.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			{/if}
		
			{if $sCurrency == "USD"}
				<input type="image"src="images/misc/x-click-butcc_dollar.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			{/if}
		
			{if $sCurrency == "GBP"}
				<input type="image"src="images/misc/x-click-butcc_pound.GIF" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
			{/if}
			</form>
			</td>	
		</tr>
		
		<tr>
			<td valign='top' align='right'><b>{#MONEYBOOKERS_OR_NETELLER#}</b></td>
			<td valign='top'>{#MONEYBOOKERS_OR_NETELLER_INFO#}</td>
		</tr>		
	{/if}
	
	<tr>
		<td colspan='2'><i>{#PAYMENT_INFO2#}</i></td>
	</tr>
	
	</table>
{/if}
