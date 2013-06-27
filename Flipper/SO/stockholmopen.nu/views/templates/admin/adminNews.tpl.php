{include file="elements/header.tpl.php"}
<h2>{#ADMIN#}:

{if $sFormState == "defaultStart" || $bIsDefaultCompleted == "true"}
	{#ADMIN_ADD_NEWS_HL#}
{/if}

{if $sFormState == "editStart" || $bIsEditCompleted == "true"}
	{#ADMIN_EDIT_NEWS_HL#}
{/if}

{if $bIsDeleteFailed == "true" || $bIsDeleteCompleted == "true"}
	{#ADMIN_DELETE_NEWS_HL#}
{/if}

</h2>

{if $sFormState == "defaultStart"}
{#ADMIN_ADD_NEWS_MAIN#}
<br />
<br />
{/if}

{include file="formsAdmin/form.news.tpl.php"}

<h3>{#POSTED_NEWS#}</h3>

<table class='mainTable'>
{section name=section loop=$aNews}
	{if $smarty.section.section.iteration is even}
		<tr {#MOUSE_OVER_DEFAULT#}>
	{else}
		<tr class='lineDark' {#MOUSE_OVER_DARK#}>
	{/if}
		<td>{$aNews[section].news_date|truncate:11:"":true} | {$aNews[section].user_username}</td>
		<td>{$aNews[section].news_text|strip_tags|truncate:60:"...":false}</td>
		<td align='center'><a href='adminNews.php?iIDEdit={$aNews[section].id_news}'><img src='images/icons/edit.gif' class='iconLink' alt='{#EDIT#}' title='{#EDIT#}' /></a></td>
		<td align='center'><a href='adminNews.php?iIDDelete={$aNews[section].id_news}'><img src='images/icons/editdelete.gif' class='iconLink' alt='{#DELETE#}' title='{#DELETE#}' /></a></td>
	</tr>
{/section}
</table>

{include file="elements/footer.tpl.php"}