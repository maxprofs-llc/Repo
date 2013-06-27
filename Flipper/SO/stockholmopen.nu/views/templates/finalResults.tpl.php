{include file="elements/header.tpl.php" title=header}

<script language="javascript" type="text/javascript" src="javascript/wysiwyg/wysiwyg.js"></script> 

<a name="cup">
<h2>{#FINALS#} - {$sDivision} {#DIVISION#} - {$iYear}</h2>

{* INCLUDE THE SELECTED FINAL-FILE *}
{include file="finals/$iYear/$sDivision.html}

<!--
<form action="finalResults.php"" method="post">
<br />
<br />
<br />
<hr />
<h2>{#EDIT_TEXT#}</h2>
<i>{#LOGGED_IN_AS_UBER_ADMIN_AND_ALLOWED_TO_EDIT#}</i>
<p>
{#EDIT_WICKED_WIKI_INFO#}
</p>
<input type='submit' value="Update Page" />
{if $g_aUserAdminTasks.admin_uber == "true"}
	<br />
	<br />
	<textarea  name='sText' id='sText'>
		{$sFileContent}
	</textarea>
	<input type='hidden' name='iYear' value='{$iYear}' /> <input type='hidden' name='sDivision' value='{$sDivision}' />
{/if}
</form>

<script language="javascript1.2">
	generate_wysiwyg('sText');
</script> 
-->
{include file="elements/footer.tpl.php" title=footer}
