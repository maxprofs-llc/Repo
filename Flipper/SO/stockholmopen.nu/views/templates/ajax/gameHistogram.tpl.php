{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.javascript.php}

{section name=section loop=$aHistogramData}
	<table class='mainTable'>
		<tr class='underLine'>
			<td width='100'></td>
			<td width='120'>{$aHistogramData[section].score_interval_name}</td>
			<td width='320'><img src='images/icons/green.gif' width='{math equation="x / y * 320" x=$aHistogramData[section].number_of_scores y=$aHistogramData[section].max_number_of_scores format="%d"}' height='10' alt='{$aHistogramData[section].number_of_scores}' /></td>
			<td width='30'>{$aHistogramData[section].number_of_scores}</td>
			<td align='left'> ({math equation="x / y * 100" x=$aHistogramData[section].number_of_scores y=$aHistogramData[section].total_no_of_rounds format="%.1f"}%)</td>
		</tr>
	</table> 
{/section}
