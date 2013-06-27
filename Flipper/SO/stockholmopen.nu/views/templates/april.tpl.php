{include file="elements/header.tpl.php" title=header}

<div class='leftContentLeft'>
	<h2>{#INDEX_HL_APR#}</h2>
	{eval var=#INDEX_MAIN_APR#}
	{* <img src='images/misc/so1.jpg' alt='' /> *}
</div>
	
<div class='leftContentRight'>
	<h2>{#NEWS#}</h2>
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}	
	
	{include file="recycled/news.tpl.php" title=footer}
	
	<br />
	<br />
	<h2>{#NEWS#}</h2>
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}
</div>
<div class='clear'></div>
{include file="elements/footer.tpl.php" title=footer}
