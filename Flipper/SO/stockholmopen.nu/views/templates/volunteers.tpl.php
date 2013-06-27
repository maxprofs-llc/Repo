{include file="elements/header.tpl.php"}

<h2>{#VOLUNTEERS_HL#}</h2>
<p>
{#VOLUNTEERS_MAIN#}
</p>

{if $aTopVolunteers != null}
	<h3>{#TOP_VOLUNTEERS#}</h3>
	<table class='minor'>
		<tr>
			<td></td>
			<td><b>{#NUMBER_OF_HOURS#}</b></td>
		</tr>
	{section name=section loop=$aTopVolunteers}
		<tr class='underLine'>
			<td>{$aTopVolunteers[section].vol_firstname} {$aTopVolunteers[section].vol_lastname}</td>
			<td>{$aTopVolunteers[section].vol_hours}</td>
		</tr>
	{/section}
	</table>
{/if}
	
<table class='mainTable'>
{section name=section loop=$aSchedule}
	<tr class='underLine'>
		<td colspan='5' valign='top'><h3>{$aSchedule[section].vol_time_start} - {$aSchedule[section].vol_time_end}</h3></td>
	</tr>
	
	{assign var="bOutput" value=false}
			
	{section name=vols loop=$aSchedule[section].volunteers}
		{assign var="bOutput" value=true}
		<tr class='underLine' {#MOUSE_OVER_DEFAULT#}>
			<td valign='top' width='120'>
				{$aSchedule[section].volunteers[vols].vol_firstname} {$aSchedule[section].volunteers[vols].vol_lastname}
			</td>
			
			<td valign='top'>
				{section name=duts loop=$aSchedule[section].volunteers[vols].duties}
				-{$aSchedule[section].volunteers[vols].duties[duts].vol_duty_name}
				{/section}
			</td>
			
			<td valign='top'>
				
				{if $g_bIsLoggedIn == "true"}
					{$aSchedule[section].volunteers[vols].vol_email}
				{/if}
					
			</td valign='top'>
	
			<td valign='top'>
				{if $g_bIsLoggedIn == "true"}
					{$aSchedule[section].volunteers[vols].vol_phone_mobile}
				{/if}
			</td>		
			
		</tr>
	{/section}
	
	{if $bOutput == false}
		<tr>
			<td colspan='5'><i>{#NONE#}</i></td>
		</tr>
	{/if}
	
{/section}
</table>

{include file="elements/footer.tpl.php"}