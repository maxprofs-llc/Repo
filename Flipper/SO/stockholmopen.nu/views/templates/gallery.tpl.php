{include file="elements/header.tpl.php" title=header}

<div style="text-align:center">

<h2>{#GALLERY_HL#} {$iYear}</h2>
{#GALLERY_MAIN#}

{section name=section loop=$aImages}
	<img src='{$aImages[section]}' alt='' /><br /><br /> 
{/section}

</div>

{include file="elements/footer.tpl.php" title=footer}
