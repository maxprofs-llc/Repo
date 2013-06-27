<p>
{assign var="iUsers" value=$g_aActiveUsers|@count}
{assign var="iGuests" value=$g_aActiveGuests|@count}
{if  $iUsers > 0 && $iGuests > 0}
	{#THERE_ARE_CURRENTLY#} {$iUsers} {#LOGGED_IN_USER_S#} {#AND#} {$iGuests} {#GUEST_S#} {#ON_THE_SITE#}
{elseif $iUsers > 0}
	{#THERE_ARE_CURRENTLY#} {$iUsers} {#LOGGED_IN_USER_S#} {#ON_THE_SITE#}
{elseif $iGuests > 0}
	{#THERE_ARE_CURRENTLY#} {$iGuests} {#GUEST_S#} {#ON_THE_SITE#}
{/if}
</p>
