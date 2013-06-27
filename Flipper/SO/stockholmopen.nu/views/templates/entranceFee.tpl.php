{include file="elements/header.tpl.php" title=header}

<script src="javascript/displayPayEntranceFee.js" language="javascript" type="text/javascript"></script>
<script src="javascript/calcEntranceFee.js" language="javascript" type="text/javascript"></script>

<h2>{#ENTRANCE_FEE_HL#}</h2>

<p>
{eval var=#ENTRANCE_FEE_MAIN#}
</p>


<h3>{#PAYMENT_METHODS_HL#}</h3>
<p>
{#PAYMENT_METHODS_MAIN#}
</p>

<h3>{#PAYMENT#}</h3>
<p>
{eval var=#PAYMENT_INFO#}
</p>

{* 
WONT' DISPLAY IT HERE 
{include file="forms/form.entranceFee.tpl.php"}
*}

{* USED TO DISPLAY THE PAY-ENTRANCE-FEE-FORM *}
<div id='payEntranceFee'></div>

<script type="text/javascript">
	womAdd('displayPayEntranceFee()');
	womOn();
</script>

{eval var=#ENTRANCE_FEE_MAIN_2#}

{include file="elements/footer.tpl.php" title=footer}
