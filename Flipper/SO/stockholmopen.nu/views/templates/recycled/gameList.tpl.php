<table class='mainTable'>
	<tr>
		{if $sSort == null || $sSort == "nameAsc"} 
			<td class='HLsortUp'>
		{else}
			<td class='HL'>
		{/if}
		<a href='games.php?sSort=nameAsc'>{#NAME#}</a>
		</td>

		{if $sSort == "yearDesc"} 
			<td class='HLsortUp'>
		{else}
			<td class='HL'>
		{/if}
		<a href='games.php?sSort=yearDesc'>{#YEAR#}</a>
		</td>		

		{if $sSort == "manufacturerAsc"} 
			<td class='HLsortUp'>
		{else}
			<td class='HL'>
		{/if}
		<a href='games.php?sSort=manufacturerAsc'>{#MANUFACTURER#}</a>
		</td>		
		
		<td class='HL'>{#RULESHEET#}</td>
		
		{if $bIncludedFromAdmin	== true}
      <td class='HL'>{#QR#}</td>
		  <td class='HL'>{#EDIT#}</td>
		{/if}		
	</tr>
	
	{section name=section loop=$aGames}

	{if $smarty.section.section.iteration is odd}
		<tr {#MOUSE_OVER_DEFAULT#}>
	{else}
		<tr class='lineDark' {#MOUSE_OVER_DARK#}>
	{/if}
	
		{if $aGames[section].game_ipdb_id != null && $aGames[section].game_ipdb_id != 0}
			<td><a href='http://ipdb.org/machine.cgi?id={$aGames[section].game_ipdb_id}'>{$aGames[section].game_name}</a></td>
		{else}
			<td>{$aGames[section].game_name}</td>
		{/if}	

		<td>{$aGames[section].game_year_released}</td>
		<td>{$aGames[section].game_manufacturer_name}</td>
		
		{if $aGames[section].game_link_rulesheet != null}
			<td><a href='{$aGames[section].game_link_rulesheet}'><img src='images/icons/ruleSheet.gif' alt='{#RULESHEET#}' title='{#RULESHEET#}' class='iconLink' /></a></td>
		{else}
			<td></td>
		{/if}
		
		{if $bIncludedFromAdmin	== true}
      <td><a href='wap/gamePrinter.php?gameId={$aGames[section].id_game}&autoPrint=true' target='_new'><img src='images/icons/qr.png' alt='{#ADMIN_GAME_PRINT#}' title='{#ADMIN_GAME_PRINT#}' class='iconLink'/></a></td>
		  <td><a href='{$g_sPage}?iIDEdit={$aGames[section].id_game}'><img src='images/icons/edit.gif' alt='{#EDIT#}' title='{#EDIT#}' class='iconLink' /></a></td>
		{/if}
		
	</tr>
	{/section}
	
</table>
