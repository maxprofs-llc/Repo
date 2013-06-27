{include file="elements/header.tpl.php"}

<h2>{#VOLUNTEERS_HL#}</h2>
{if $bDisplayForm}
	<p>
	{#VOLUNTEERS_MAIN#}
	</p>
{/if}

<table class='mainTable'>
{section name=section loop=$aSchedule}
	<tr>
		<td colspan='2'><h3>{$aSchedule[section].vol_time_start} - {$aSchedule[section].vol_time_end}</h3></td>
	</tr>
	
	{section name=vols loop=$aSchedule[section].volunteers}
	<tr class='underLine' {#MOUSE_OVER_DEFAULT#}>
		<td>
			{$aSchedule[section].volunteers[vols].vol_firstname} {$aSchedule[section].volunteers[vols].vol_lastname}
		</td>
		
		<td>
			{section name=duts loop=$aSchedule[section].volunteers[vols].duties}
			-{$aSchedule[section].volunteers[vols].duties[duts].vol_duty_name}
			{/section}
		</td>
		
		<td>
			{$aSchedule[section].volunteers[vols].vol_email}
		</td>

		<td>
			{$aSchedule[section].volunteers[vols].vol_phone_mobile}
		</td>		
		
	</tr>
	{/section}
{/section}
</table>

{include file="elements/footer.tpl.php"}