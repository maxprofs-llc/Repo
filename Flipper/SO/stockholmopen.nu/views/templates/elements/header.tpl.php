{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.languages.php}
{config_load file=config.javascript.php}
{config_load file=config.inputs.php}
{config_load file=config.main.php}
{config_load file=config.menu.php}

{if $bInclude == null} {* IN SOME ODD CASES THE MAIN FILES ARE INCLUDED, AND THEN WE DON'T WANT TO INCLUDE ALL OF THIS *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="verify-v1" content="+5Tuc9/ody1QWHEFnccwMrtI+TLN9l+Rz3pJOYpLAzw=" />
	<meta name="author" content="Stockholm Pinball Open" />
    <meta name="description" content="The Stockholm Open international pinball tournament is one of the six majors in the world, and it is open to anyone regardless of skill or citizenship. It is held on June 14-17 at O'Learys in Heron City close to Stockholm, and there are divisions for A players, classics and split flipper teams." />
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
  
	{* CONTROL INFO IN SOCIAL MEDIA URL POSTINGS *}
  <html itemscope itemtype="http://schema.org/LocalBusiness">
  <meta itemprop="name" content="Stockholm Open">
  <meta itemprop="description" content="Stockholm Open is an annual international pinball tournament held in Stockholm, Sweden.">
  <meta itemprop="image" content="https://lh4.googleusercontent.com/-K57YmevORt8/AAAAAAAAAAI/AAAAAAAAABY/Z05s30sspqs/s120-c/photo.jpg">
  
  <link rel="image_src" href="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/s160x160/527760_10151338206392611_1848577458_a.png" / >
  <link rel="image_src" href="https://lh4.googleusercontent.com/-K57YmevORt8/AAAAAAAAAAI/AAAAAAAAABY/Z05s30sspqs/s120-c/photo.jpg" / >
	{* END OF SOCIAL MEDIA *}

	{* LET'S REFRESH THE FINAL RESULTS, ANNOYING, BUT STILL *}
	{if $g_sPage == "/finalResults.php"}
	<meta http-equiv="refresh" content="30"/>
	{/if}
		
	<title>{#PAGE_TITLE#} {$g_sTitle}</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
	<link rel="stylesheet" href="css/styleMenu.css" type="text/css" />
	<link rel="stylesheet" href="css/styleAutoComplete.css" type="text/css" />
	{if $g_sPage == "/finalResults.php"}
	<link rel="stylesheet" href="css/finalResults.css" type="text/css" />
	{/if}
	<script type="text/javascript" src="javascript/wom.js"></script>
	<script type="text/javascript" src="javascript/prototype.js"></script>
	<script type="text/javascript" src="javascript/genericFunctions.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/effects.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/controls.js"></script>
	
{if $bOldIETest == true}	
	{literal}
	<script type="text/javascript">
	// <![CDATA[ 
		var browser		= navigator.appName
		var ver			= navigator.appVersion
		var thestart	= parseFloat(ver.indexOf("MSIE"))+1 //This finds the start of the MS version string.
		var brow_ver	= parseFloat(ver.substring(thestart+4,thestart+7)) //This cuts out the bit of string we need.

		if ((browser=="Microsoft Internet Explorer") && (brow_ver < 5.5)) 
		{
			window.location="oldie.php"; //URL to redirect to.
		}
	// ]]> 
	</script>
	{/literal}
{/if}
</head>
<body>

	{if $bJSTest == true}
		{* TEST IF JAVASCRIPT IS ENABLED, WE ONLY WANT TO DO THIS ONCE *}
		<noscript>
			{include file="elements/noScript.tpl.php"}
		</noscript>
	{/if}

	<div class="content">
		<div class="header">
			<div class="header_left">
				  <a href="index.php" id="header_link"><em>Stockholm Open</em></a>
			</div>
			<div class="top_info">
				<div class="top_info_right">
					{if $g_bMultLang == "true"}
						{section name=section loop=$g_aLanguages}
							<a href='{$g_sPageLangChange}sLang={$g_aLanguages[section].lang}'><img src='{$g_aLanguages[section].img}' alt='' class='iconLink' /></a> 
						{/section}
						<br /><br />
						{include file="ajax/login.tpl.php"}
					{else}
						<br /><br />
						{include file="ajax/login.tpl.php"}
					{/if}
				</div>		
			</div>
			<div class="logo">
			</div>
		</div>
		
		<div class="bar">
			{include file="menus/mainMenu.tpl.php"}
		</div>
	
		<div class="left">
			<div class="left_dialog">
 				<div class="hd"><div class="c"></div></div>
 					<div class="bd">
  						<div class="c">
   							<div class="s">
{/if}					
