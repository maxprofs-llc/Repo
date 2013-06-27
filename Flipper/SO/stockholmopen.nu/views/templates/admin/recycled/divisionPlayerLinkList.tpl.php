<h3>{#LIST_WITH_PLAYER_TEAM_IDS#}</h3>

<table class='mainTable'>
{* loop through all divisions *}
{section name=section loop=$aDivisions}
	<tr>
	<td width='60'><a href="#" onclick="popup('popupRegPlayers.php?iYear={$g_iYear}&amp;sDivision={$aDivisions[section].division_name_short}','800', '800', '100', '400'); return false">{$aDivisions[section].division_name_short} {#DIVISION#}</a></td>
	<td> ({#OPENS_IN_A_NEW_WINDOW#}}</td>
	</tr>
{/section}
</table>