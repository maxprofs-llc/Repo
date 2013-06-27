{include file="elements/header.tpl.php"}
<h2>{#ADMIN#}:

{if $sFormState == "defaultStart" || $bIsDefaultCompleted == "true"}
	{#ADMIN_ADD_USER_HL#}
{/if}

{if $sFormState == "editStart" || $bIsEditCompleted == "true"}
	{#ADMIN_EDIT_USER_HL#}
{/if}

{if $bIsDeleteFailed == "true" || $bIsDeleteCompleted == "true"}
	{#ADMIN_DELETE_USER_HL#}
{/if}

</h2>

{if $sFormState == "defaultStart"}
{#ADMIN_ADD_USER_MAIN#}
<br />
<br />
{/if}

{include file="formsAdmin/form.userAdd.tpl.php"}

{include file="admin/recycled/userList.tpl.php"}

{include file="elements/footer.tpl.php"}