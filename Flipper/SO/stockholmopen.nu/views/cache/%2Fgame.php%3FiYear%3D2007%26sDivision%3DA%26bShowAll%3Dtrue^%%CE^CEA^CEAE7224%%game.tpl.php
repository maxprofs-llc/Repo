925
a:5:{s:8:"template";a:16:{s:12:"game.tpl.php";b:1;s:28:"forms/form.loginAjax.tpl.php";b:1;s:18:"ajax/login.tpl.php";b:1;s:22:"menus/mainMenu.tpl.php";b:1;s:23:"elements/header.tpl.php";b:1;s:26:"recycled/gameStats.tpl.php";b:1;s:30:"recycled/gameHeadLines.tpl.php";b:1;s:32:"recycled/gameEntryRounds.tpl.php";b:1;s:25:"forms/form.logout.tpl.php";b:1;s:29:"forms/form.searchGame.tpl.php";b:1;s:31:"forms/form.searchPlayer.tpl.php";b:1;s:33:"forms/form.searchIDPlayer.tpl.php";b:1;s:32:"forms/form.searchIDEntry.tpl.php";b:1;s:22:"elements/right.tpl.php";b:1;s:31:"elements/activeUserInfo.tpl.php";b:1;s:23:"elements/footer.tpl.php";b:1;}s:6:"config";a:6:{s:26:"lang/en/config.en.lang.php";b:1;s:20:"config.languages.php";b:1;s:21:"config.javascript.php";b:1;s:17:"config.inputs.php";b:1;s:15:"config.main.php";b:1;s:15:"config.menu.php";b:1;}s:9:"timestamp";i:1206309896;s:7:"expires";i:1206309906;s:13:"cache_serials";a:0:{}}






 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="author" content="Stockholm Pinball Open" />
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
	<title>Stockholm Open - International Pinball Tournament</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
	<link rel="stylesheet" href="css/styleMenu.css" type="text/css" />
	<link rel="stylesheet" href="css/styleAutoComplete.css" type="text/css" />
	<script type="text/javascript" src="javascript/wom.js"></script>
	<script type="text/javascript" src="javascript/prototype.js"></script>
	<script type="text/javascript" src="javascript/genericFunctions.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/effects.js"></script>
	<script type="text/javascript" src="javascript/scriptaculous/controls.js"></script>

</head>
<body>

	
	<div class="content">
		<div class="header">
			<div class="top_info">
				<div class="top_info_right">
											<!-- <form action='login.php' method='post'> -->
<form action="https://nya.stockholmopen.nu/login.php" method='post'>
<br />
<div id='login' style='display:none;'>
<input id='sUsername' name="sUsername" size='11' maxlength='64' type='text' class='default' value='Username' onfocus="clearInput('sUsername')"/> 
<input id='sPassword' name="sPassword" size='11' maxlength='64' type='password' class='default' value='Password' onfocus="clearInput('sPassword')"/>
<input name='sRedirect' type='hidden' value='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true' />
<input type='submit' value='Submit' class='submitDefault' /></div>
</form>									</div>		
			</div>
			<div class="logo">
			<h1>Stockholm Open 2008 - Dev.</h1>
			</div>
		</div>
		
		<div class="bar">
			<span class="preload1"></span>
<span class="preload2"></span>

<ul id="nav">
	
			<li class="top"><a href="index.php" class="top_link"><span>HOME</span></a></li>
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">GENERAL</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="news.php">NEWS</a></li>
										<li><a href="overview.php">OVERVIEW</a></li>
										<li><a href="games.php">MACHINES</a></li>
										<li><a href="classics.php">CLASSICS</a></li>
						</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">RULES</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="rules.php">GENERAL RULES</a></li>
										<li><a href="rulesSplit.php">GENERAL RULES (SPLIT)</a></li>
				
							<li><a href="qualDetails.php">QUALIFICATIONS</a></li>
										<li><a href="finalsDetails.php">FINALS</a></li>
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">LOGISTICS</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="location.php">LOCATION</a></li>
										<li><a href="travel.php">TRAVEL</a></li>
										<li><a href="accommodations.php">ACCOMMODATIONS</a></li>
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">REGISTER</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="register.php">REGISTER - MAIN</a></li>
										<li><a href="registerSplit.php">REGISTER - SPLIT</a></li>
																
											<li><a href="registeredPlayers.php?iYear=2008&amp;sDivision=A">REG. PLAYERS (A)</a></li>
															
															
											<li><a href="registeredPlayers.php?iYear=2008&amp;sDivision=C">REG. PLAYERS (C)</a></li>
															
											<li><a href="registeredPlayers.php?iYear=2008&amp;sDivision=J">REG. PLAYERS (J)</a></li>
										
									<li><a href="registeredPlayers.php?iYear=2008&amp;sDivision=S">REG. TEAMS</a></li>
								

							<li><a href="entranceFee.php">ENTRANCE FEE</a></li>
							
			
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">STANDINGS</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
												<li><a href="#"><b>2008</b></a></li>
										<li><a href="standings.php?iYear=2008&amp;sDivision=A">STANDINGS (A)</a></li>
										<li><a href="standings.php?iYear=2008&amp;sDivision=S">STANDINGS (S)</a></li>
										<li><a href="standings.php?iYear=2008&amp;sDivision=C">STANDINGS (C)</a></li>
										<li><a href="standings.php?iYear=2008&amp;sDivision=J">STANDINGS (J)</a></li>
							
								
						<li><a href="game.php?iYear=2008&amp;sDivision=A&amp;bShowAll=true">MACHINE STANDINGS (A)</a></li>
								
						<li><a href="game.php?iYear=2008&amp;sDivision=S&amp;bShowAll=true">MACHINE STANDINGS (S)</a></li>
								
						<li><a href="game.php?iYear=2008&amp;sDivision=C&amp;bShowAll=true">MACHINE STANDINGS (C)</a></li>
								
						<li><a href="game.php?iYear=2008&amp;sDivision=J&amp;bShowAll=true">MACHINE STANDINGS (J)</a></li>
																					<li><a href="#"><b>2007</b></a></li>
										<li><a href="standings.php?iYear=2007&amp;sDivision=A">STANDINGS (A)</a></li>
										<li><a href="standings.php?iYear=2007&amp;sDivision=S">STANDINGS (S)</a></li>
							
								
						<li><a href="game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true">MACHINE STANDINGS (A)</a></li>
								
						<li><a href="game.php?iYear=2007&amp;sDivision=S&amp;bShowAll=true">MACHINE STANDINGS (S)</a></li>
																					<li><a href="#"><b>2006</b></a></li>
										<li><a href="standings.php?iYear=2006&amp;sDivision=A">STANDINGS (A)</a></li>
										<li><a href="standings.php?iYear=2006&amp;sDivision=S">STANDINGS (S)</a></li>
							
								
						<li><a href="game.php?iYear=2006&amp;sDivision=A&amp;bShowAll=true">MACHINE STANDINGS (A)</a></li>
								
						<li><a href="game.php?iYear=2006&amp;sDivision=S&amp;bShowAll=true">MACHINE STANDINGS (S)</a></li>
																					<li><a href="#"><b>2005</b></a></li>
										<li><a href="standings.php?iYear=2005&amp;sDivision=A">STANDINGS (A)</a></li>
							
								
						<li><a href="game.php?iYear=2005&amp;sDivision=A&amp;bShowAll=true">MACHINE STANDINGS (A)</a></li>
															</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		
			<li class="top"><a href="#"  class="top_link"><span class="down">FINALS</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->			
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="finalResults.php?iYear=2008&sDivision=A">FINALS A Div - 2008</a></li>
							<li><a href="finalResults.php?iYear=2004&sDivision=C">FINALS C Div - 2004</a></li>
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>	
		

		
		<li class="top"><a href="#"  class="top_link"><span class="down">RESULTS</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="results.php?iYear=2006">RESULTS 2006</a></li>
							<li><a href="results.php?iYear=2005">RESULTS 2005</a></li>
							<li><a href="results.php?iYear=2004">RESULTS 2004</a></li>
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
			<li class="top"><a href="#"  class="top_link"><span class="down">STATS</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
																							<li><a href="statsYearly.php?iYear=2008">STATS - 2008</a></li>
																									<li><a href="statsYearly.php?iYear=2007">STATS - 2007</a></li>
																									<li><a href="statsYearly.php?iYear=2006">STATS - 2006</a></li>
																									<li><a href="statsYearly.php?iYear=2005">STATS - 2005</a></li>
																			<li><a href="statsTopScores.php">TOP SCORES</a></li>
										<li><a href="statsBestEntries.php">BEST ENTRIES</a></li>
					
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		
	
		
		<li class="top"><a href="#"  class="top_link"><span class="down">MISC</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
							<li><a href="promotion.php">PROMOTION</a></li>
										<li><a href="press.php">PRESS</a></li>
					
							<li><a href="stpb.php">STOCKHOLM PINBALL</a></li>
					
												<li><a href="gallery.php?iYear=2007">GALLERY 2007</a></li>
									<li><a href="gallery.php?iYear=2005">GALLERY 2005</a></li>
									<li><a href="gallery.php?iYear=2004">GALLERY 2004</a></li>
							
												<li><a href="slide.php?bStart=true&amp;iYear=2008&amp;bTotalAndGames=true">SLIDE (TOTAL + MACHINES)</a></li>
					<li><a href="slideTotal.php?iYear=2008&amp;bStart=true">SLIDE (TOTAL ONLY)</a></li>
											
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	
			<li class="top"><a href="contact.php" class="top_link"><span>CONTACT US</span></a></li>
	
						<li class="top"><a href="javascript:Effect.toggle('login','appear');" class="top_link"><span>LOGIN</span></a></li>
			
			
</ul>		</div>
	
		<div class="left">
			<div class="left_dialog">
 				<div class="hd"><div class="c"></div></div>
 					<div class="bd">
  						<div class="c">
   							<div class="s">
					
	<h2>Machine Standings - A Division - 2007</h2>
	



	<b>Machines/Pages:</b><br />
			Aaron. - Docto. | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=5'>F-14 . - India.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=10'>India. - Medie.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=15'>No Go. - Tales.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=20'>Termi. - Theat.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=25'>Twili.</a>
		
	<br />
	<br />
	Display <select name="iLimit" id='iLimit' onchange="document.location.href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iLimit=' + this[this.selectedIndex].value;" class='default'><option value = '1'>1</option><option value = '2'>2</option><option value = '3'>3</option><option value = '4'>4</option><option value = '5'>5</option><option value = '6'>6</option><option value = '7'>7</option><option value = '8'>8</option><option value = '9'>9</option><option selected='selected' value='10'>10</option><option value = '11'>11</option><option value = '12'>12</option><option value = '13'>13</option><option value = '14'>14</option><option value = '15'>15</option><option value = '16'>16</option><option value = '17'>17</option><option value = '18'>18</option><option value = '19'>19</option><option value = '20'>20</option></select> Scores



				<h3><a href='game.php?iYear=2007&amp;iIDGame=56&amp;sDivision=A'>Aaron Spelling (Data East) - A Division - 2007</a></h3>
		<b>Total no of rounds</b>: 0 /	<b>Max</b>:  / <b>Min:</b>  / <b>Average:</b> 0 / <b>Median</b>: 	
	<br />
		
<table class='mainTable'>

<tr>
	<td class='HL' width='20'>Pos</td>
	<td class='HL' width='30'>Points</td>
	<td class='HL' width='100' style='text-align: right;'>Score</td>
	<td class='HL' width='30'></td>
	<td class='HL' width='170'>Player Name</td>
	<td class='HL' width='70'>Initials</td>
	<td class='HL' width='90'>Country</td>
	<td class='HL' width='70'>Entry ID</td>
	<td class='HL' width='40'>Points</td>
	<td class='HL'>Last Update</td>
</tr>
<tr>
	<td colspan='10'></td>
</tr>	<tr>
		<td colspan='10' align='center'>No Entry Rounds found</td>
	</tr>

		
		</table>

	<div id="game56">
</div>


	<br />


				<h3><a href='game.php?iYear=2007&amp;iIDGame=19&amp;sDivision=A'>Creature from the Black Lagoon (WMS/Bally) - A Division - 2007</a></h3>
		<b>Total no of rounds</b>: 59 /	<b>Max</b>: 802.4M / <b>Min:</b> 12.2M / <b>Average:</b> 120.0M / <b>Median</b>: 94.4M	
	<br />
		
<table class='mainTable'>

<tr>
	<td class='HL' width='20'>Pos</td>
	<td class='HL' width='30'>Points</td>
	<td class='HL' width='100' style='text-align: right;'>Score</td>
	<td class='HL' width='30'></td>
	<td class='HL' width='170'>Player Name</td>
	<td class='HL' width='70'>Initials</td>
	<td class='HL' width='90'>Country</td>
	<td class='HL' width='70'>Entry ID</td>
	<td class='HL' width='40'>Points</td>
	<td class='HL'>Last Update</td>
</tr>
<tr>
	<td colspan='10'></td>
</tr>
		
			
						
							
											
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>1</b></td>	
		<td><b>100</b></td>	
		<td align='right' style='padding-right:10px;'>
			802.435.690
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>100%</span></td>
			
		<td><a href='player.php?iIDPlayer=3059'>Fredrik Lindberg</a></td>	
	<td>F L</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4225', 'ajax/displayEntry.php?iIDEntry=30054'); return false;">30054</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4225', 'ajax/displayEntry.php?iIDEntry=30054'); return false;">106</a></td>
		<td>
			2007-04-06 15:38
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4225">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>2</b></td>	
		<td><b>90</b></td>	
		<td align='right' style='padding-right:10px;'>
			454.382.270
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -19px 6px; margin-left: 10px;'><span class='small'>56%</span></td>
			
		<td><a href='player.php?iIDPlayer=3021'>Jorian Engelbrektsson</a></td>	
	<td>JOE</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5463', 'ajax/displayEntry.php?iIDEntry=30466'); return false;">30466</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5463', 'ajax/displayEntry.php?iIDEntry=30466'); return false;">208</a></td>
		<td>
			2007-04-07 22:02
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5463">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>3</b></td>	
		<td><b>82</b></td>	
		<td align='right' style='padding-right:10px;'>
			359.655.480
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -22px 6px; margin-left: 10px;'><span class='small'>44%</span></td>
			
		<td><a href='player.php?iIDPlayer=3014'>Karl Broström</a></td>	
	<td>KGB</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5973', 'ajax/displayEntry.php?iIDEntry=30634'); return false;">30634</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5973', 'ajax/displayEntry.php?iIDEntry=30634'); return false;">123</a></td>
		<td>
			2007-04-08 12:34
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5973">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>4</b></td>	
		<td><b>74</b></td>	
		<td align='right' style='padding-right:10px;'>
			344.773.950
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -22px 6px; margin-left: 10px;'><span class='small'>42%</span></td>
			
		<td><a href='player.php?iIDPlayer=3062'>Henrik Lagercrantz</a></td>	
	<td>HEN</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5784', 'ajax/displayEntry.php?iIDEntry=30572'); return false;">30572</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5784', 'ajax/displayEntry.php?iIDEntry=30572'); return false;">115</a></td>
		<td>
			2007-04-08 11:28
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5784">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>5</b></td>	
		<td><b>68</b></td>	
		<td align='right' style='padding-right:10px;'>
			236.983.300
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -26px 6px; margin-left: 10px;'><span class='small'>29%</span></td>
			
		<td><a href='player.php?iIDPlayer=3098'>Per-Olof Romell</a></td>	
	<td>PRO</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5935', 'ajax/displayEntry.php?iIDEntry=30622'); return false;">30622</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5935', 'ajax/displayEntry.php?iIDEntry=30622'); return false;">99</a></td>
		<td>
			2007-04-08 11:40
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5935">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>6</b></td>	
		<td><b>62</b></td>	
		<td align='right' style='padding-right:10px;'>
			225.265.690
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -26px 6px; margin-left: 10px;'><span class='small'>28%</span></td>
			
		<td><a href='player.php?iIDPlayer=3040'>Reidar Spets</a></td>	
	<td>LEL</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4751', 'ajax/displayEntry.php?iIDEntry=30228'); return false;">30228</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4751', 'ajax/displayEntry.php?iIDEntry=30228'); return false;">94</a></td>
		<td>
			2007-04-07 13:44
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4751">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>7</b></td>	
		<td><b>58</b></td>	
		<td align='right' style='padding-right:10px;'>
			196.286.620
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -27px 6px; margin-left: 10px;'><span class='small'>24%</span></td>
			
		<td><a href='player.php?iIDPlayer=3043'>P-J Snygg</a></td>	
	<td>PJS</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4728', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">30220</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4728', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">156</a></td>
		<td>
			2007-04-07 12:36
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4728">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>8</b></td>	
		<td><b>54</b></td>	
		<td align='right' style='padding-right:10px;'>
			194.157.130
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -27px 6px; margin-left: 10px;'><span class='small'>24%</span></td>
			
		<td><a href='player.php?iIDPlayer=3056'>Antti Peltonen</a></td>	
	<td>AEP</td>	
					<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4416', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">30087</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4416', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">104</a></td>
		<td>
			2007-04-06 19:11
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4416">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>9</b></td>	
		<td><b>50</b></td>	
		<td align='right' style='padding-right:10px;'>
			147.626.250
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -29px 6px; margin-left: 10px;'><span class='small'>18%</span></td>
			
		<td><a href='player.php?iIDPlayer=3071'>Olli-Mikko Ojamies</a></td>	
	<td>OMO</td>	
					<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5514', 'ajax/displayEntry.php?iIDEntry=30484'); return false;">30484</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5514', 'ajax/displayEntry.php?iIDEntry=30484'); return false;">56</a></td>
		<td>
			2007-04-07 22:39
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5514">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>10</b></td>	
		<td><b>47</b></td>	
		<td align='right' style='padding-right:10px;'>
			146.635.640
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -29px 6px; margin-left: 10px;'><span class='small'>18%</span></td>
			
		<td><a href='player.php?iIDPlayer=3071'>Olli-Mikko Ojamies</a></td>	
	<td>OMO</td>	
					<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5966', 'ajax/displayEntry.php?iIDEntry=30632'); return false;">30632</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5966', 'ajax/displayEntry.php?iIDEntry=30632'); return false;">97</a></td>
		<td>
			2007-04-08 13:31
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5966">
	</div>
	</td>
</tr>				
				<tr>
							<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game19', 'ajax/gameHistogram.php?iYear=2007&amp;iIDGame=19&amp;sDivision=A'); return false;">View/Hide Entry Round Histogram</a></td>
					</tr>
	</table>

	<div id="game19">
</div>


	<br />


				<h3><a href='game.php?iYear=2007&amp;iIDGame=20&amp;sDivision=A'>Demolition Man (WMS/Bally) - A Division - 2007</a></h3>
		<b>Total no of rounds</b>: 62 /	<b>Max</b>: 5.0B / <b>Min:</b> 15.2M / <b>Average:</b> 1.1B / <b>Median</b>: 795.1M	
	<br />
		
<table class='mainTable'>

<tr>
	<td class='HL' width='20'>Pos</td>
	<td class='HL' width='30'>Points</td>
	<td class='HL' width='100' style='text-align: right;'>Score</td>
	<td class='HL' width='30'></td>
	<td class='HL' width='170'>Player Name</td>
	<td class='HL' width='70'>Initials</td>
	<td class='HL' width='90'>Country</td>
	<td class='HL' width='70'>Entry ID</td>
	<td class='HL' width='40'>Points</td>
	<td class='HL'>Last Update</td>
</tr>
<tr>
	<td colspan='10'></td>
</tr>
		
			
						
							
											
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>1</b></td>	
		<td><b>100</b></td>	
		<td align='right' style='padding-right:10px;'>
			5.078.399.410
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>100%</span></td>
			
		<td><a href='player.php?iIDPlayer=3021'>Jorian Engelbrektsson</a></td>	
	<td>JOE</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4534', 'ajax/displayEntry.php?iIDEntry=30157'); return false;">30157</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4534', 'ajax/displayEntry.php?iIDEntry=30157'); return false;">212</a></td>
		<td>
			2007-04-06 20:34
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4534">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>2</b></td>	
		<td><b>90</b></td>	
		<td align='right' style='padding-right:10px;'>
			3.836.052.230
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -14px 6px; margin-left: 10px;'><span class='small'>75%</span></td>
			
		<td><a href='player.php?iIDPlayer=3008'>Henrik Hultman</a></td>	
	<td>HNK</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4673', 'ajax/displayEntry.php?iIDEntry=30202'); return false;">30202</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4673', 'ajax/displayEntry.php?iIDEntry=30202'); return false;">103</a></td>
		<td>
			2007-04-07 00:37
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4673">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>3</b></td>	
		<td><b>82</b></td>	
		<td align='right' style='padding-right:10px;'>
			3.324.429.870
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -16px 6px; margin-left: 10px;'><span class='small'>65%</span></td>
			
		<td><a href='player.php?iIDPlayer=3062'>Henrik Lagercrantz</a></td>	
	<td>HEN</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4780', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">30238</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4780', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">145</a></td>
		<td>
			2007-04-07 12:12
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4780">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>4</b></td>	
		<td><b>74</b></td>	
		<td align='right' style='padding-right:10px;'>
			2.559.969.120
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -20px 6px; margin-left: 10px;'><span class='small'>50%</span></td>
			
		<td><a href='player.php?iIDPlayer=3031'>Mats Runsten</a></td>	
	<td>MCR</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5865', 'ajax/displayEntry.php?iIDEntry=30599'); return false;">30599</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5865', 'ajax/displayEntry.php?iIDEntry=30599'); return false;">178</a></td>
		<td>
			2007-04-08 12:41
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5865">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>5</b></td>	
		<td><b>68</b></td>	
		<td align='right' style='padding-right:10px;'>
			2.521.566.050
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -21px 6px; margin-left: 10px;'><span class='small'>49%</span></td>
			
		<td><a href='player.php?iIDPlayer=3091'>Linus Jorenbo</a></td>	
	<td>S P</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4403', 'ajax/displayEntry.php?iIDEntry=30092'); return false;">30092</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4403', 'ajax/displayEntry.php?iIDEntry=30092'); return false;">131</a></td>
		<td>
			2007-04-06 20:18
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4403">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>6</b></td>	
		<td><b>62</b></td>	
		<td align='right' style='padding-right:10px;'>
			2.498.978.440
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -21px 6px; margin-left: 10px;'><span class='small'>49%</span></td>
			
		<td><a href='player.php?iIDPlayer=3040'>Reidar Spets</a></td>	
	<td>LEL</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4713', 'ajax/displayEntry.php?iIDEntry=30215'); return false;">30215</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4713', 'ajax/displayEntry.php?iIDEntry=30215'); return false;">136</a></td>
		<td>
			2007-04-07 11:38
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4713">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>7</b></td>	
		<td><b>58</b></td>	
		<td align='right' style='padding-right:10px;'>
			2.381.451.030
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -21px 6px; margin-left: 10px;'><span class='small'>46%</span></td>
			
		<td><a href='player.php?iIDPlayer=3019'>Alvar Palm</a></td>	
	<td>C P</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5558', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">30499</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5558', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">111</a></td>
		<td>
			2007-04-07 21:41
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5558">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>8</b></td>	
		<td><b>54</b></td>	
		<td align='right' style='padding-right:10px;'>
			1.905.910.480
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -24px 6px; margin-left: 10px;'><span class='small'>37%</span></td>
			
		<td><a href='player.php?iIDPlayer=3083'>Victor Håkansson</a></td>	
	<td>TFF</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5433', 'ajax/displayEntry.php?iIDEntry=30456'); return false;">30456</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5433', 'ajax/displayEntry.php?iIDEntry=30456'); return false;">140</a></td>
		<td>
			2007-04-07 20:40
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5433">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>9</b></td>	
		<td><b>50</b></td>	
		<td align='right' style='padding-right:10px;'>
			1.859.754.600
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -24px 6px; margin-left: 10px;'><span class='small'>36%</span></td>
			
		<td><a href='player.php?iIDPlayer=3083'>Victor Håkansson</a></td>	
	<td>TFF</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5381', 'ajax/displayEntry.php?iIDEntry=30439'); return false;">30439</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5381', 'ajax/displayEntry.php?iIDEntry=30439'); return false;">77</a></td>
		<td>
			2007-04-07 19:05
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5381">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>10</b></td>	
		<td><b>47</b></td>	
		<td align='right' style='padding-right:10px;'>
			1.776.994.500
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -24px 6px; margin-left: 10px;'><span class='small'>34%</span></td>
			
		<td><a href='player.php?iIDPlayer=3013'>David Kjellberg</a></td>	
	<td>LDK</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5395', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">30443</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5395', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">219</a></td>
		<td>
			2007-04-07 20:40
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5395">
	</div>
	</td>
</tr>				
				<tr>
							<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game20', 'ajax/gameHistogram.php?iYear=2007&amp;iIDGame=20&amp;sDivision=A'); return false;">View/Hide Entry Round Histogram</a></td>
					</tr>
	</table>

	<div id="game20">
</div>


	<br />


				<h3><a href='game.php?iYear=2007&amp;iIDGame=24&amp;sDivision=A'>Dirty Harry (WMS/Bally) - A Division - 2007</a></h3>
		<b>Total no of rounds</b>: 57 /	<b>Max</b>: 2.8B / <b>Min:</b> 44.4M / <b>Average:</b> 394.4M / <b>Median</b>: 314.7M	
	<br />
		
<table class='mainTable'>

<tr>
	<td class='HL' width='20'>Pos</td>
	<td class='HL' width='30'>Points</td>
	<td class='HL' width='100' style='text-align: right;'>Score</td>
	<td class='HL' width='30'></td>
	<td class='HL' width='170'>Player Name</td>
	<td class='HL' width='70'>Initials</td>
	<td class='HL' width='90'>Country</td>
	<td class='HL' width='70'>Entry ID</td>
	<td class='HL' width='40'>Points</td>
	<td class='HL'>Last Update</td>
</tr>
<tr>
	<td colspan='10'></td>
</tr>
		
			
						
							
											
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>1</b></td>	
		<td><b>100</b></td>	
		<td align='right' style='padding-right:10px;'>
			2.801.894.240
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>100%</span></td>
			
		<td><a href='player.php?iIDPlayer=3059'>Fredrik Lindberg</a></td>	
	<td>F L</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5477', 'ajax/displayEntry.php?iIDEntry=30471'); return false;">30471</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5477', 'ajax/displayEntry.php?iIDEntry=30471'); return false;">170</a></td>
		<td>
			2007-04-07 20:21
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5477">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>2</b></td>	
		<td><b>90</b></td>	
		<td align='right' style='padding-right:10px;'>
			1.382.425.860
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -21px 6px; margin-left: 10px;'><span class='small'>49%</span></td>
			
		<td><a href='player.php?iIDPlayer=3020'>Henrik Tomson</a></td>	
	<td>HOT</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4902', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">30278</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4902', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">140</a></td>
		<td>
			2007-04-07 14:20
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4902">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>3</b></td>	
		<td><b>82</b></td>	
		<td align='right' style='padding-right:10px;'>
			835.190.790
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -26px 6px; margin-left: 10px;'><span class='small'>29%</span></td>
			
		<td><a href='player.php?iIDPlayer=3014'>Karl Broström</a></td>	
	<td>KGB</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4940', 'ajax/displayEntry.php?iIDEntry=30291'); return false;">30291</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4940', 'ajax/displayEntry.php?iIDEntry=30291'); return false;">182</a></td>
		<td>
			2007-04-07 16:13
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4940">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>4</b></td>	
		<td><b>74</b></td>	
		<td align='right' style='padding-right:10px;'>
			730.212.700
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -27px 6px; margin-left: 10px;'><span class='small'>26%</span></td>
			
		<td><a href='player.php?iIDPlayer=3043'>P-J Snygg</a></td>	
	<td>PJS</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4727', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">30220</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4727', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">156</a></td>
		<td>
			2007-04-07 13:20
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4727">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>5</b></td>	
		<td><b>68</b></td>	
		<td align='right' style='padding-right:10px;'>
			699.808.210
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -27px 6px; margin-left: 10px;'><span class='small'>24%</span></td>
			
		<td><a href='player.php?iIDPlayer=3020'>Henrik Tomson</a></td>	
	<td>HOT</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4746', 'ajax/displayEntry.php?iIDEntry=30226'); return false;">30226</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4746', 'ajax/displayEntry.php?iIDEntry=30226'); return false;">128</a></td>
		<td>
			2007-04-07 12:11
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4746">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>6</b></td>	
		<td><b>62</b></td>	
		<td align='right' style='padding-right:10px;'>
			697.330.510
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -27px 6px; margin-left: 10px;'><span class='small'>24%</span></td>
			
		<td><a href='player.php?iIDPlayer=3007'>Michael Lindström</a></td>	
	<td>MIC</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4374', 'ajax/displayEntry.php?iIDEntry=30117'); return false;">30117</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4374', 'ajax/displayEntry.php?iIDEntry=30117'); return false;">95</a></td>
		<td>
			2007-04-06 18:39
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4374">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>7</b></td>	
		<td><b>58</b></td>	
		<td align='right' style='padding-right:10px;'>
			607.144.420
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -28px 6px; margin-left: 10px;'><span class='small'>21%</span></td>
			
		<td><a href='player.php?iIDPlayer=3059'>Fredrik Lindberg</a></td>	
	<td>F L</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5960', 'ajax/displayEntry.php?iIDEntry=30630'); return false;">30630</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5960', 'ajax/displayEntry.php?iIDEntry=30630'); return false;">140</a></td>
		<td>
			2007-04-08 12:57
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5960">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>8</b></td>	
		<td><b>54</b></td>	
		<td align='right' style='padding-right:10px;'>
			531.464.710
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -29px 6px; margin-left: 10px;'><span class='small'>18%</span></td>
			
		<td><a href='player.php?iIDPlayer=3076'>Lars Blomgren</a></td>	
	<td>BLO</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4317', 'ajax/displayEntry.php?iIDEntry=30095'); return false;">30095</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4317', 'ajax/displayEntry.php?iIDEntry=30095'); return false;">70</a></td>
		<td>
			2007-04-06 17:37
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4317">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>9</b></td>	
		<td><b>50</b></td>	
		<td align='right' style='padding-right:10px;'>
			520.090.620
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -29px 6px; margin-left: 10px;'><span class='small'>18%</span></td>
			
		<td><a href='player.php?iIDPlayer=3022'>Magnus Rostö</a></td>	
	<td>LIX</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5429', 'ajax/displayEntry.php?iIDEntry=30455'); return false;">30455</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5429', 'ajax/displayEntry.php?iIDEntry=30455'); return false;">57</a></td>
		<td>
			2007-04-07 19:42
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5429">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>10</b></td>	
		<td><b>47</b></td>	
		<td align='right' style='padding-right:10px;'>
			516.075.050
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -29px 6px; margin-left: 10px;'><span class='small'>18%</span></td>
			
		<td><a href='player.php?iIDPlayer=3020'>Henrik Tomson</a></td>	
	<td>HOT</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5642', 'ajax/displayEntry.php?iIDEntry=30526'); return false;">30526</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5642', 'ajax/displayEntry.php?iIDEntry=30526'); return false;">79</a></td>
		<td>
			2007-04-07 22:56
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5642">
	</div>
	</td>
</tr>				
				<tr>
							<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game24', 'ajax/gameHistogram.php?iYear=2007&amp;iIDGame=24&amp;sDivision=A'); return false;">View/Hide Entry Round Histogram</a></td>
					</tr>
	</table>

	<div id="game24">
</div>


	<br />


				<h3><a href='game.php?iYear=2007&amp;iIDGame=25&amp;sDivision=A'>Doctor Who (WMS/Bally) - A Division - 2007</a></h3>
		<b>Total no of rounds</b>: 53 /	<b>Max</b>: 807.6M / <b>Min:</b> 6.0M / <b>Average:</b> 198.9M / <b>Median</b>: 126.0M	
	<br />
		
<table class='mainTable'>

<tr>
	<td class='HL' width='20'>Pos</td>
	<td class='HL' width='30'>Points</td>
	<td class='HL' width='100' style='text-align: right;'>Score</td>
	<td class='HL' width='30'></td>
	<td class='HL' width='170'>Player Name</td>
	<td class='HL' width='70'>Initials</td>
	<td class='HL' width='90'>Country</td>
	<td class='HL' width='70'>Entry ID</td>
	<td class='HL' width='40'>Points</td>
	<td class='HL'>Last Update</td>
</tr>
<tr>
	<td colspan='10'></td>
</tr>
		
			
						
							
											
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>1</b></td>	
		<td><b>100</b></td>	
		<td align='right' style='padding-right:10px;'>
			646.624.880
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>100%</span></td>
			
		<td><a href='player.php?iIDPlayer=3083'>Victor Håkansson</a></td>	
	<td>TFF</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5953', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">30628</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5953', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">217</a></td>
		<td>
			2007-04-08 11:51
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5953">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>2</b></td>	
		<td><b>90</b></td>	
		<td align='right' style='padding-right:10px;'>
			644.814.200
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>99%</span></td>
			
		<td><a href='player.php?iIDPlayer=3103'>daniel håkansson</a></td>	
	<td>VPK</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5166', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">30367</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5166', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">108</a></td>
		<td>
			2007-04-07 16:40
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5166">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>3</b></td>	
		<td><b>82</b></td>	
		<td align='right' style='padding-right:10px;'>
			630.580.390
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -8px 6px; margin-left: 10px;'><span class='small'>97%</span></td>
			
		<td><a href='player.php?iIDPlayer=3017'>Christian Balac</a></td>	
	<td>BLA</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5637', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">30524</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5637', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">172</a></td>
		<td>
			2007-04-08 00:31
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5637">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>4</b></td>	
		<td><b>74</b></td>	
		<td align='right' style='padding-right:10px;'>
			621.112.660
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -9px 6px; margin-left: 10px;'><span class='small'>96%</span></td>
			
		<td><a href='player.php?iIDPlayer=3087'>Carl Gustaf Forssbeck</a></td>	
	<td>CGF</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5678', 'ajax/displayEntry.php?iIDEntry=30537'); return false;">30537</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5678', 'ajax/displayEntry.php?iIDEntry=30537'); return false;">98</a></td>
		<td>
			2007-04-07 23:32
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5678">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>5</b></td>	
		<td><b>68</b></td>	
		<td align='right' style='padding-right:10px;'>
			591.038.280
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -10px 6px; margin-left: 10px;'><span class='small'>91%</span></td>
			
		<td><a href='player.php?iIDPlayer=3102'>Hanna Allergren</a></td>	
	<td>HEA</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4692', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">30208</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4692', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">96</a></td>
		<td>
			2007-04-07 00:51
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4692">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>6</b></td>	
		<td><b>62</b></td>	
		<td align='right' style='padding-right:10px;'>
			467.951.530
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -15px 6px; margin-left: 10px;'><span class='small'>72%</span></td>
			
		<td><a href='player.php?iIDPlayer=3083'>Victor Håkansson</a></td>	
	<td>TFF</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5208', 'ajax/displayEntry.php?iIDEntry=30382'); return false;">30382</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5208', 'ajax/displayEntry.php?iIDEntry=30382'); return false;">100</a></td>
		<td>
			2007-04-07 18:21
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5208">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>7</b></td>	
		<td><b>58</b></td>	
		<td align='right' style='padding-right:10px;'>
			454.387.190
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -15px 6px; margin-left: 10px;'><span class='small'>70%</span></td>
			
		<td><a href='player.php?iIDPlayer=3072'>Nicklas Karlbom</a></td>	
	<td>DEM</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4638', 'ajax/displayEntry.php?iIDEntry=30190'); return false;">30190</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4638', 'ajax/displayEntry.php?iIDEntry=30190'); return false;">97</a></td>
		<td>
			2007-04-06 22:50
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4638">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>8</b></td>	
		<td><b>54</b></td>	
		<td align='right' style='padding-right:10px;'>
			377.089.160
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -18px 6px; margin-left: 10px;'><span class='small'>58%</span></td>
			
		<td><a href='player.php?iIDPlayer=3016'>Per Ahlenius</a></td>	
	<td>PER</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5325', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">30421</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5325', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">156</a></td>
		<td>
			2007-04-07 18:09
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5325">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
			<td><b>9</b></td>	
		<td><b>50</b></td>	
		<td align='right' style='padding-right:10px;'>
			350.391.860
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -19px 6px; margin-left: 10px;'><span class='small'>54%</span></td>
			
		<td><a href='player.php?iIDPlayer=3072'>Nicklas Karlbom</a></td>	
	<td>DEM</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry4677', 'ajax/displayEntry.php?iIDEntry=30203'); return false;">30203</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry4677', 'ajax/displayEntry.php?iIDEntry=30203'); return false;">108</a></td>
		<td>
			2007-04-06 23:52
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry4677">
	</div>
	</td>
</tr>				
			
						
							
						
						<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
			<td><b>10</b></td>	
		<td><b>47</b></td>	
		<td align='right' style='padding-right:10px;'>
			348.321.330
		</td>	
				
					<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: -19px 6px; margin-left: 10px;'><span class='small'>53%</span></td>
			
		<td><a href='player.php?iIDPlayer=3017'>Christian Balac</a></td>	
	<td>BLA</td>	
					<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
			<td><a href="#" onclick="new Ajax.Updater('entry5876', 'ajax/displayEntry.php?iIDEntry=30602'); return false;">30602</a></td>

	<td>
			<a href="#" onclick="new Ajax.Updater('entry5876', 'ajax/displayEntry.php?iIDEntry=30602'); return false;">81</a></td>
		<td>
			2007-04-08 11:18
		
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry5876">
	</div>
	</td>
</tr>				
				<tr>
							<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game25', 'ajax/gameHistogram.php?iYear=2007&amp;iIDGame=25&amp;sDivision=A'); return false;">View/Hide Entry Round Histogram</a></td>
					</tr>
	</table>

	<div id="game25">
</div>


	<br />


	<b>Machines/Pages:</b><br />
			Aaron. - Docto. | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=5'>F-14 . - India.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=10'>India. - Medie.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=15'>No Go. - Tales.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=20'>Termi. - Theat.</a> | 
			<a href='/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true&amp;iStart=25'>Twili.</a>
		


				   				</div>
			  			</div>
			 		</div>
				<div class="ft"><div class="c"></div></div>
			</div>
		</div>
		
		<div class="right">
			<div class="right_dialog">
 				<div class="hd"><div class="c"></div></div>
 					<div class="bd">
  						<div class="c">
   							<div class="s">
							
<b>Search</b><br />

	
<form action='searchGame.php' method='get'>
	<input id='sGameSearch' class='tight' name="sGameSearch" size='13' maxlength='64' type='text' value='Machine name' onclick="clearInput('sGameSearch')"/>
	<input type='submit' class='tight' value='Search' />
	<div class='autoComplete' id='gamesearch'></div>	
	
	<script type="text/javascript">
	//<![CDATA[
	var gameSearchAutoCompleter = new Ajax.Autocompleter('sGameSearch', 'gamesearch', 'ajax/autoSuggestGameName.php', {})
	//]]>
	</script>
	

</form>	
<form action='searchPlayer.php' method='get'>
<input id='sPlayerSearch' class='tight' name="sPlayerSearch" size='13' maxlength='64' type='text' value='Player/Team' onclick="clearInput('sPlayerSearch')" />
<input type='submit' class='tight' value='Search' />
<div class='autoComplete' id='playersearch'></div>


<script type="text/javascript">
//<![CDATA[
var playerSearchAutoCompleter = new Ajax.Autocompleter('sPlayerSearch', 'playersearch', 'ajax/autoSuggestPlayerName.php', {})
//]]>
</script>

</form>	
<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDPlayerSearch' id='iIDPlayerSearch' value='Player ID' onfocus="clearInput('iIDPlayerSearch')" />
<input type='submit' class='tight' value='Search' />
</form>	
<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDEntrySearch' id='iIDEntrySearch' value='Entry ID' onfocus="clearInput('iIDEntrySearch')" />
<input type='submit' class='tight' value='Search' />
</form>
<b>Partners and Sponsors</b>
<a href ='http://www.ths.kth.se/' target='blank'><img src='images/partners/kth.gif' class='partners' alt='' /></a>
<a href ='http://www.flipperdoktorn.se/' target='blank'><img src='images/partners/doktorn.gif' class='partners' alt='' /></a>
<a href ='http://www.flippergubben.se/' target='blank'><img src='images/partners/flippergubben.gif' class='partners' alt='' /></a>
<a href ='http://www.spelautomatsamlarna.se/' target='blank'><img src='images/partners/sasfSmall.gif' class='partners' alt='' /></a>
<a href ='http://www.pinballrankings.com/' target='blank'><img src='images/partners/wppr.gif' class='partners' alt='' /></a>
<a href ='http://www.oddmolly.com/' target='blank'><img src='images/partners/oddMolly.gif' class='partners' alt='' /></a>
<a href ='http://www.avis.se/' target='blank'><img src='images/partners/avis.gif' class='partners' alt='' /></a>
<a href ='http://www.stadsbud.nu/' target='blank'><img src='images/partners/ss.gif' class='partners' alt='' /></a>
<a href ='http://www.pcgamer.se/' target='blank'><img src='images/partners/pcGamer.gif' class='partners' alt='' /></a>
<a href ='http://www.dinegen.se/' target='blank'><img src='images/partners/dinegen.gif' class='partners' alt='' /></a>			   				</div>
			  			</div>
			 		</div>
				<div class="ft"><div class="c"></div></div>
			</div>
		</div>
	
		<div class="footer">
		Copyright © 2008 <a href='http://stockholmpinball.com'>Stockholm Pinball</a><br />All material on this site is free for non-commercial use, assuming it is unchanged and not out of context, unless otherwise noted.<br />Stockholm Open Pinball Tournament has no relation to other Stockholm Open tournaments, including the one in <a href='http://www.stockholmopen.se'>tennis</a>.
		<p>
	There are currently 1 Guest(s) on the site
</p>		</div>
	</div>

	
	<script type="text/javascript">
		function setActivity()
		{
			new Ajax.PeriodicalUpdater('activity', 'ajax/setActivity.php?sPage=/game.php?iYear=2007&amp;sDivision=A&amp;bShowAll=true', {asynchronous:true, frequency:10});
		}
		womAdd('setActivity()');
		womOn();
	</script>	
	
		<div id='activity'>
	</div>
</body>
</html>