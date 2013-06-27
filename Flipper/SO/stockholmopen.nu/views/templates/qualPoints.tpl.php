{include file="elements/header.tpl.php" title=header}

<h2>{#QUAL_POINTS_HL#}</h2>
{#QUAL_POINTS_MAIN#}

<table>
{section name=section loop=$aScores}
	<tr>
		<td>{$smarty.section.section.iteration}</td>
		<td>{$aScores[section]}</td>
	</tr>
{/section}
</table>
{include file="elements/footer.tpl.php" title=footer}