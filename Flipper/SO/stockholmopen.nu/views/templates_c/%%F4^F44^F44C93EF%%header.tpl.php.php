<?php /* Smarty version 2.6.16, created on 2013-06-18 00:32:53
         compiled from elements/header.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'elements/header.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.languages.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.javascript.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.inputs.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.main.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.menu.php"), $this);?>


<?php if ($this->_tpl_vars['bInclude'] == null): ?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="verify-v1" content="+5Tuc9/ody1QWHEFnccwMrtI+TLN9l+Rz3pJOYpLAzw=" />
	<meta name="author" content="Stockholm Pinball Open" />
    <meta name="description" content="The Stockholm Open international pinball tournament is one of the six majors in the world, and it is open to anyone regardless of skill or citizenship. It is held on June 14-17 at O'Learys in Heron City close to Stockholm, and there are divisions for A players, classics and split flipper teams." />
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
  
	  <html itemscope itemtype="http://schema.org/LocalBusiness">
  <meta itemprop="name" content="Stockholm Open">
  <meta itemprop="description" content="Stockholm Open is an annual international pinball tournament held in Stockholm, Sweden.">
  <meta itemprop="image" content="https://lh4.googleusercontent.com/-K57YmevORt8/AAAAAAAAAAI/AAAAAAAAABY/Z05s30sspqs/s120-c/photo.jpg">
  
  <link rel="image_src" href="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/s160x160/527760_10151338206392611_1848577458_a.png" / >
  <link rel="image_src" href="https://lh4.googleusercontent.com/-K57YmevORt8/AAAAAAAAAAI/AAAAAAAAABY/Z05s30sspqs/s120-c/photo.jpg" / >
	
		<?php if ($this->_tpl_vars['g_sPage'] == "/finalResults.php"): ?>
	<meta http-equiv="refresh" content="30"/>
	<?php endif; ?>
		
	<title><?php echo $this->_config[0]['vars']['PAGE_TITLE']; ?>
 <?php echo $this->_tpl_vars['g_sTitle']; ?>
</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
	<link rel="stylesheet" href="css/styleMenu.css" type="text/css" />
	<link rel="stylesheet" href="css/styleAutoComplete.css" type="text/css" />
	<?php if ($this->_tpl_vars['g_sPage'] == "/finalResults.php"): ?>
	<link rel="stylesheet" href="css/finalResults.css" type="text/css" />
	<?php endif; ?>
	<script type="text/javascript" src="javascript/wom.js"></script>
	<script type="text/javascript" src="javascript/prototype.js"></script>
	<script type="text/javascript" src="javascript/genericFunctions.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/effects.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/controls.js"></script>
	
<?php if ($this->_tpl_vars['bOldIETest'] == true): ?>	
	<?php echo '
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
	'; ?>

<?php endif; ?>
</head>
<body>

	<?php if ($this->_tpl_vars['bJSTest'] == true): ?>
				<noscript>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/noScript.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</noscript>
	<?php endif; ?>

	<div class="content">
		<div class="header">
			<div class="header_left">
				  <a href="index.php" id="header_link"><em>Stockholm Open</em></a>
			</div>
			<div class="top_info">
				<div class="top_info_right">
					<?php if ($this->_tpl_vars['g_bMultLang'] == 'true'): ?>
						<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aLanguages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['section']['show'] = true;
$this->_sections['section']['max'] = $this->_sections['section']['loop'];
$this->_sections['section']['step'] = 1;
$this->_sections['section']['start'] = $this->_sections['section']['step'] > 0 ? 0 : $this->_sections['section']['loop']-1;
if ($this->_sections['section']['show']) {
    $this->_sections['section']['total'] = $this->_sections['section']['loop'];
    if ($this->_sections['section']['total'] == 0)
        $this->_sections['section']['show'] = false;
} else
    $this->_sections['section']['total'] = 0;
if ($this->_sections['section']['show']):

            for ($this->_sections['section']['index'] = $this->_sections['section']['start'], $this->_sections['section']['iteration'] = 1;
                 $this->_sections['section']['iteration'] <= $this->_sections['section']['total'];
                 $this->_sections['section']['index'] += $this->_sections['section']['step'], $this->_sections['section']['iteration']++):
$this->_sections['section']['rownum'] = $this->_sections['section']['iteration'];
$this->_sections['section']['index_prev'] = $this->_sections['section']['index'] - $this->_sections['section']['step'];
$this->_sections['section']['index_next'] = $this->_sections['section']['index'] + $this->_sections['section']['step'];
$this->_sections['section']['first']      = ($this->_sections['section']['iteration'] == 1);
$this->_sections['section']['last']       = ($this->_sections['section']['iteration'] == $this->_sections['section']['total']);
?>
							<a href='<?php echo $this->_tpl_vars['g_sPageLangChange']; ?>
sLang=<?php echo $this->_tpl_vars['g_aLanguages'][$this->_sections['section']['index']]['lang']; ?>
'><img src='<?php echo $this->_tpl_vars['g_aLanguages'][$this->_sections['section']['index']]['img']; ?>
' alt='' class='iconLink' /></a> 
						<?php endfor; endif; ?>
						<br /><br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ajax/login.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
						<br /><br />
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ajax/login.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
				</div>		
			</div>
			<div class="logo">
			</div>
		</div>
		
		<div class="bar">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menus/mainMenu.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	
		<div class="left">
			<div class="left_dialog">
 				<div class="hd"><div class="c"></div></div>
 					<div class="bd">
  						<div class="c">
   							<div class="s">
<?php endif; ?>					