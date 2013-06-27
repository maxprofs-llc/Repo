854
a:5:{s:8:"template";a:14:{s:17:"standings.tpl.php";b:1;s:28:"forms/form.loginAjax.tpl.php";b:1;s:18:"ajax/login.tpl.php";b:1;s:22:"menus/mainMenu.tpl.php";b:1;s:23:"elements/header.tpl.php";b:1;s:36:"recycled/playersAndStandings.tpl.php";b:1;s:25:"forms/form.logout.tpl.php";b:1;s:29:"forms/form.searchGame.tpl.php";b:1;s:31:"forms/form.searchPlayer.tpl.php";b:1;s:33:"forms/form.searchIDPlayer.tpl.php";b:1;s:32:"forms/form.searchIDEntry.tpl.php";b:1;s:22:"elements/right.tpl.php";b:1;s:31:"elements/activeUserInfo.tpl.php";b:1;s:23:"elements/footer.tpl.php";b:1;}s:6:"config";a:6:{s:26:"lang/en/config.en.lang.php";b:1;s:20:"config.languages.php";b:1;s:21:"config.javascript.php";b:1;s:17:"config.inputs.php";b:1;s:15:"config.main.php";b:1;s:15:"config.menu.php";b:1;}s:9:"timestamp";i:1206309890;s:7:"expires";i:1206309900;s:13:"cache_serials";a:0:{}}






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
<input name='sRedirect' type='hidden' value='/standings.php?iYear=2007&amp;sDivision=S' />
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
					
<h2>Standings - 2007 - S Division</h2>
This is the standings of the qualifications. The best qualification entry of each player/team determines his/her/their place in the standings, and the top 8 players/teams in the list when the qualifications are over will make it to the finals.
<br /><br />
<a href='slide.php?bStart=true&amp;iYear=2007&amp;bTotalAndGames=true'>Slide show with Machines AND Total Standings</a> / <a href='slideTotal.php?iYear=2007&amp;bStart=true'>Slide show with total standings only</a>
<br />
<br />
<table class='mainTable' style='text-align:left;'>
<tr>	
		
	
			
		
				
		<td class='HL'>
		<!-- we only want to display the position if it's sorted by score -->
		 
			Pos
				</td>
	
		 
			<td class='HLsortUp'>
			
					<a href='/standings.php?iYear=2007&amp;sDivision=S&amp;sSort=scoreDesc'>Points</a>
			
		</td>
			
		
			<td class='HL'>
	
			<a href='/standings.php?iYear=2007&amp;sDivision=S&amp;sSort=nameAsc'>Name</a>
			
	</td>

			<td class='HL'>
	
			<a href='/standings.php?iYear=2007&amp;sDivision=S&amp;sSort=initialsAsc'>Initials</a>
		
	</td>
	
	<!-- if it's the split division we can't sort on city -->
			<td class='HL'>
		City
		</td>

	<!-- if it's the split division we can't sort on country -->
			<td class='HL'>
		Country
		</td>

			
		
	
	
			<td class='HL'>
		Entry ID
		</td>
		
		<td class='HL' colspan='3'>
		Round Scores
		</td>

		<td class='HL'>
		Last Update
		</td>
	
							
				<td class='HL'>
				<a href='/standings.php?iYear=2007&amp;sDivision=S&amp;sSort=entriesDesc'>Entries</a>
				</td>
						
		
		
	</tr>
<tr>
	<td colspan='16'></td>
</tr>

				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>1</b>		
				</td>
		<td><b>224</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3060'>Fred Perry </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3060'>F P</a>
							
		</td>

					<td>Sollentuna / Enskede</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30098', 'ajax/displayEntry.php?iIDEntry=30098'); return false;">30098</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30098', 'ajax/displayEntry.php?iIDEntry=30098'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30098', 'ajax/displayEntry.php?iIDEntry=30098'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30098', 'ajax/displayEntry.php?iIDEntry=30098'); return false;">
									24
								</a>
			</td>		
						<td>2007-04-06 19:09</td>
		
					<td><a href='player.php?iIDPlayer=3060'>5</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30098">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>2</b>		
				</td>
		<td><b>188</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3067'>JFK </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3067'>JFK</a>
							
		</td>

					<td>Stockholm / Falun</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30520', 'ajax/displayEntry.php?iIDEntry=30520'); return false;">30520</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30520', 'ajax/displayEntry.php?iIDEntry=30520'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30520', 'ajax/displayEntry.php?iIDEntry=30520'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30520', 'ajax/displayEntry.php?iIDEntry=30520'); return false;">
									16
								</a>
			</td>		
						<td>2007-04-07 23:51</td>
		
					<td><a href='player.php?iIDPlayer=3067'>7</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30520">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>3</b>		
				</td>
		<td><b>178</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3069'>Betandlose </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3069'>BAL</a>
							
		</td>

					<td>Stockholm / Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30326', 'ajax/displayEntry.php?iIDEntry=30326'); return false;">30326</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30326', 'ajax/displayEntry.php?iIDEntry=30326'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30326', 'ajax/displayEntry.php?iIDEntry=30326'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30326', 'ajax/displayEntry.php?iIDEntry=30326'); return false;">
									54
								</a>
			</td>		
						<td>2007-04-07 16:09</td>
		
					<td><a href='player.php?iIDPlayer=3069'>9</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30326">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>4</b>		
				</td>
		<td><b>176</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3051'>The Dutch Pinball Elite </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3051'>DPE</a>
							
		</td>

					<td>Muntendam / Groningen</td>
			<td><img src='images/icons/flags/nl.gif' alt='Netherlands' title='Netherlands' /> <img src='images/icons/flags/nl.gif' alt='Netherlands' title='Netherlands' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30604', 'ajax/displayEntry.php?iIDEntry=30604'); return false;">30604</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30604', 'ajax/displayEntry.php?iIDEntry=30604'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30604', 'ajax/displayEntry.php?iIDEntry=30604'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30604', 'ajax/displayEntry.php?iIDEntry=30604'); return false;">
									24
								</a>
			</td>		
						<td>2007-04-08 12:27</td>
		
					<td><a href='player.php?iIDPlayer=3051'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30604">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>5</b>		
				</td>
		<td><b>175</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3044'>Swedish Erotica </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3044'>SWE</a>
							
		</td>

					<td>Stockholm / Göteborg</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30559', 'ajax/displayEntry.php?iIDEntry=30559'); return false;">30559</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30559', 'ajax/displayEntry.php?iIDEntry=30559'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30559', 'ajax/displayEntry.php?iIDEntry=30559'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30559', 'ajax/displayEntry.php?iIDEntry=30559'); return false;">
									35
								</a>
			</td>		
						<td>2007-04-08 11:14</td>
		
					<td><a href='player.php?iIDPlayer=3044'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30559">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>6</b>		
				</td>
		<td><b>168</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3053'>Maverick & Goose </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3053'>TOP</a>
							
		</td>

					<td>Uppsala / Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30222', 'ajax/displayEntry.php?iIDEntry=30222'); return false;">30222</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30222', 'ajax/displayEntry.php?iIDEntry=30222'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30222', 'ajax/displayEntry.php?iIDEntry=30222'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30222', 'ajax/displayEntry.php?iIDEntry=30222'); return false;">
									32
								</a>
			</td>		
						<td>2007-04-07 13:19</td>
		
					<td><a href='player.php?iIDPlayer=3053'>2</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30222">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>7</b>		
				</td>
		<td><b>155</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3034'>Pin-Nuts </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3034'>RIC</a>
							
		</td>

					<td>Skövde / Lidköping</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30565', 'ajax/displayEntry.php?iIDEntry=30565'); return false;">30565</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30565', 'ajax/displayEntry.php?iIDEntry=30565'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30565', 'ajax/displayEntry.php?iIDEntry=30565'); return false;">
									38
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30565', 'ajax/displayEntry.php?iIDEntry=30565'); return false;">
									17
								</a>
			</td>		
						<td>2007-04-08 11:31</td>
		
					<td><a href='player.php?iIDPlayer=3034'>9</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30565">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>8</b>		
				</td>
		<td><b>152</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3041'>Double Helix </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3041'>ROM</a>
							
		</td>

					<td>Stockholm / Enskede</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30115', 'ajax/displayEntry.php?iIDEntry=30115'); return false;">30115</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30115', 'ajax/displayEntry.php?iIDEntry=30115'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30115', 'ajax/displayEntry.php?iIDEntry=30115'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30115', 'ajax/displayEntry.php?iIDEntry=30115'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-06 19:37</td>
		
					<td><a href='player.php?iIDPlayer=3041'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30115">
				</div>
				</td>
			</tr>
				
				
	
				
					
			<tr>
			<td colspan='12'><hr /></td>
		</tr>
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>9</b>		
				</td>
		<td><b>151</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3036'>No Talent </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3036'>NOT</a>
							
		</td>

					<td>Alingsås / Alingsås</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30359', 'ajax/displayEntry.php?iIDEntry=30359'); return false;">30359</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30359', 'ajax/displayEntry.php?iIDEntry=30359'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30359', 'ajax/displayEntry.php?iIDEntry=30359'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30359', 'ajax/displayEntry.php?iIDEntry=30359'); return false;">
									47
								</a>
			</td>		
						<td>2007-04-07 17:14</td>
		
					<td><a href='player.php?iIDPlayer=3036'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30359">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>10</b>		
				</td>
		<td><b>150</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3094'>Gävla Duo </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3094'>LEO</a>
							
		</td>

					<td>Uppsala / Sunne</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30363', 'ajax/displayEntry.php?iIDEntry=30363'); return false;">30363</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30363', 'ajax/displayEntry.php?iIDEntry=30363'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30363', 'ajax/displayEntry.php?iIDEntry=30363'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30363', 'ajax/displayEntry.php?iIDEntry=30363'); return false;">
									38
								</a>
			</td>		
						<td>2007-04-07 17:15</td>
		
					<td><a href='player.php?iIDPlayer=3094'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30363">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>11</b>		
				</td>
		<td><b>138</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3035'>Hoar oui? </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3035'>HOA</a>
							
		</td>

					<td>Stockholm / Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30356', 'ajax/displayEntry.php?iIDEntry=30356'); return false;">30356</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30356', 'ajax/displayEntry.php?iIDEntry=30356'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30356', 'ajax/displayEntry.php?iIDEntry=30356'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30356', 'ajax/displayEntry.php?iIDEntry=30356'); return false;">
									32
								</a>
			</td>		
						<td>2007-04-08 00:10</td>
		
					<td><a href='player.php?iIDPlayer=3035'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30356">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>12</b>		
				</td>
		<td><b>120</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3028'>BAJEN </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3028'>THC</a>
							
		</td>

					<td>Johanne... / STOCKHOLM</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30319', 'ajax/displayEntry.php?iIDEntry=30319'); return false;">30319</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30319', 'ajax/displayEntry.php?iIDEntry=30319'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30319', 'ajax/displayEntry.php?iIDEntry=30319'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30319', 'ajax/displayEntry.php?iIDEntry=30319'); return false;">
									17
								</a>
			</td>		
						<td>2007-04-07 16:40</td>
		
					<td><a href='player.php?iIDPlayer=3028'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30319">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>13</b>		
				</td>
		<td><b>101</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3108'>(fyll i nåt riktigt snärtigt och... </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3108'>BB</a>
							
		</td>

					<td>Bromma / Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30432', 'ajax/displayEntry.php?iIDEntry=30432'); return false;">30432</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30432', 'ajax/displayEntry.php?iIDEntry=30432'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30432', 'ajax/displayEntry.php?iIDEntry=30432'); return false;">
									18
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30432', 'ajax/displayEntry.php?iIDEntry=30432'); return false;">
									15
								</a>
			</td>		
						<td>2007-04-07 19:52</td>
		
					<td><a href='player.php?iIDPlayer=3108'>2</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30432">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>14</b>		
				</td>
		<td><b>99</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3084'>A Pair Of Per </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3084'>POP</a>
							
		</td>

					<td>Falun / Borlänge</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30019', 'ajax/displayEntry.php?iIDEntry=30019'); return false;">30019</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30019', 'ajax/displayEntry.php?iIDEntry=30019'); return false;">
									47
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30019', 'ajax/displayEntry.php?iIDEntry=30019'); return false;">
									35
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30019', 'ajax/displayEntry.php?iIDEntry=30019'); return false;">
									17
								</a>
			</td>		
						<td>2007-04-06 15:25</td>
		
					<td><a href='player.php?iIDPlayer=3084'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30019">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>15</b>		
				</td>
		<td><b>91</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3111'>småland </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3111'>OAK</a>
							
		</td>

					<td>vetlanda / Eksjö</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30482', 'ajax/displayEntry.php?iIDEntry=30482'); return false;">30482</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30482', 'ajax/displayEntry.php?iIDEntry=30482'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30482', 'ajax/displayEntry.php?iIDEntry=30482'); return false;">
									19
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30482', 'ajax/displayEntry.php?iIDEntry=30482'); return false;">
									10
								</a>
			</td>		
						<td>2007-04-07 22:49</td>
		
					<td><a href='player.php?iIDPlayer=3111'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30482">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>16</b>		
				</td>
		<td><b>83</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3106'>Boys without toys </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3106'>bwt</a>
							
		</td>

					<td>Stockholm / Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30347', 'ajax/displayEntry.php?iIDEntry=30347'); return false;">30347</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30347', 'ajax/displayEntry.php?iIDEntry=30347'); return false;">
									35
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30347', 'ajax/displayEntry.php?iIDEntry=30347'); return false;">
									26
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30347', 'ajax/displayEntry.php?iIDEntry=30347'); return false;">
									22
								</a>
			</td>		
						<td>2007-04-07 16:55</td>
		
					<td><a href='player.php?iIDPlayer=3106'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30347">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>17</b>		
				</td>
		<td><b>76</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3097'>Micke&Deniz </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3097'>MMZ</a>
							
		</td>

					<td>Göteborg / Kungsängen</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30058', 'ajax/displayEntry.php?iIDEntry=30058'); return false;">30058</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30058', 'ajax/displayEntry.php?iIDEntry=30058'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30058', 'ajax/displayEntry.php?iIDEntry=30058'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30058', 'ajax/displayEntry.php?iIDEntry=30058'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-06 19:10</td>
		
					<td><a href='player.php?iIDPlayer=3097'>2</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30058">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>18</b>		
				</td>
		<td><b>67</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3065'>The Specials </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3065'>SPC</a>
							
		</td>

					<td>Stockholm / Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30587', 'ajax/displayEntry.php?iIDEntry=30587'); return false;">30587</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30587', 'ajax/displayEntry.php?iIDEntry=30587'); return false;">
									28
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30587', 'ajax/displayEntry.php?iIDEntry=30587'); return false;">
									20
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30587', 'ajax/displayEntry.php?iIDEntry=30587'); return false;">
									19
								</a>
			</td>		
						<td>2007-04-08 12:37</td>
		
					<td><a href='player.php?iIDPlayer=3065'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30587">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>19</b>		
				</td>
		<td><b>0</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3101'>Brommapojkarna </a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3101'>BP</a>
							
		</td>

					<td>Hägersten / Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /> <img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30170', 'ajax/displayEntry.php?iIDEntry=30170'); return false;">30170</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30170', 'ajax/displayEntry.php?iIDEntry=30170'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30170', 'ajax/displayEntry.php?iIDEntry=30170'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30170', 'ajax/displayEntry.php?iIDEntry=30170'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-08 13:43</td>
		
					<td><a href='player.php?iIDPlayer=3101'>2</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30170">
				</div>
				</td>
			</tr>
				</table>


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
			new Ajax.PeriodicalUpdater('activity', 'ajax/setActivity.php?sPage=/standings.php?iYear=2007&amp;sDivision=S', {asynchronous:true, frequency:10});
		}
		womAdd('setActivity()');
		womOn();
	</script>	
	
		<div id='activity'>
	</div>
</body>
</html>