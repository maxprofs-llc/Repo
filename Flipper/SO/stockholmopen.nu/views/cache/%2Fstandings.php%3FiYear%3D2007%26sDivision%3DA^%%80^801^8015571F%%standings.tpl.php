854
a:5:{s:8:"template";a:14:{s:17:"standings.tpl.php";b:1;s:28:"forms/form.loginAjax.tpl.php";b:1;s:18:"ajax/login.tpl.php";b:1;s:22:"menus/mainMenu.tpl.php";b:1;s:23:"elements/header.tpl.php";b:1;s:36:"recycled/playersAndStandings.tpl.php";b:1;s:25:"forms/form.logout.tpl.php";b:1;s:29:"forms/form.searchGame.tpl.php";b:1;s:31:"forms/form.searchPlayer.tpl.php";b:1;s:33:"forms/form.searchIDPlayer.tpl.php";b:1;s:32:"forms/form.searchIDEntry.tpl.php";b:1;s:22:"elements/right.tpl.php";b:1;s:31:"elements/activeUserInfo.tpl.php";b:1;s:23:"elements/footer.tpl.php";b:1;}s:6:"config";a:6:{s:26:"lang/en/config.en.lang.php";b:1;s:20:"config.languages.php";b:1;s:21:"config.javascript.php";b:1;s:17:"config.inputs.php";b:1;s:15:"config.main.php";b:1;s:15:"config.menu.php";b:1;}s:9:"timestamp";i:1206309882;s:7:"expires";i:1206309892;s:13:"cache_serials";a:0:{}}






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
<input name='sRedirect' type='hidden' value='/standings.php?iYear=2007&amp;sDivision=A' />
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
					
<h2>Standings - 2007 - A Division</h2>
This is the standings of the qualifications. The best qualification entry of each player/team determines his/her/their place in the standings, and the top 32 players/teams in the list when the qualifications are over will make it to the finals.
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
			
					<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=scoreDesc'>Points</a>
			
		</td>
			
		
			<td class='HL'>
	
			<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=nameAsc'>Name</a>
			
	</td>

			<td class='HL'>
	
			<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=initialsAsc'>Initials</a>
		
	</td>
	
	<!-- if it's the split division we can't sort on city -->
						<td class='HL'>
		
					<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=cityAsc'>City</a>
				</td>

	<!-- if it's the split division we can't sort on country -->
						<td class='HL'>
		
					<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=countryAsc'>Country</a>
			
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
				<a href='/standings.php?iYear=2007&amp;sDivision=A&amp;sSort=entriesDesc'>Entries</a>
				</td>
						
		
		
	</tr>
<tr>
	<td colspan='16'></td>
</tr>

				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>1</b>		
				</td>
		<td><b>232</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3048'>Albert Nomden</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3048'>ANO</a>
							
		</td>

					<td>Muntendam</td>
			<td><img src='images/icons/flags/nl.gif' alt='Netherlands' title='Netherlands' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30392', 'ajax/displayEntry.php?iIDEntry=30392'); return false;">30392</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30392', 'ajax/displayEntry.php?iIDEntry=30392'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30392', 'ajax/displayEntry.php?iIDEntry=30392'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30392', 'ajax/displayEntry.php?iIDEntry=30392'); return false;">
									50
								</a>
			</td>		
						<td>2007-04-07 18:49</td>
		
					<td><a href='player.php?iIDPlayer=3048'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30392">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>2</b>		
				</td>
		<td><b>222</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3021'>Jorian Engelbrektsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3021'>JOE</a>
							
		</td>

					<td>Falun</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30542', 'ajax/displayEntry.php?iIDEntry=30542'); return false;">30542</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30542', 'ajax/displayEntry.php?iIDEntry=30542'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30542', 'ajax/displayEntry.php?iIDEntry=30542'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30542', 'ajax/displayEntry.php?iIDEntry=30542'); return false;">
									32
								</a>
			</td>		
						<td>2007-04-08 02:11</td>
		
					<td><a href='player.php?iIDPlayer=3021'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30542">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>3</b>		
				</td>
		<td><b>222</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3030'>Svante Ericsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3030'>SVE</a>
							
		</td>

					<td>Bromma</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30251', 'ajax/displayEntry.php?iIDEntry=30251'); return false;">30251</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30251', 'ajax/displayEntry.php?iIDEntry=30251'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30251', 'ajax/displayEntry.php?iIDEntry=30251'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30251', 'ajax/displayEntry.php?iIDEntry=30251'); return false;">
									50
								</a>
			</td>		
						<td>2007-04-07 14:33</td>
		
					<td><a href='player.php?iIDPlayer=3030'>5</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30251">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>4</b>		
				</td>
		<td><b>220</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3049'>Paul Jongma</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3049'>PFJ</a>
							
		</td>

					<td>Groningen</td>
			<td><img src='images/icons/flags/nl.gif' alt='Netherlands' title='Netherlands' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30303', 'ajax/displayEntry.php?iIDEntry=30303'); return false;">30303</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30303', 'ajax/displayEntry.php?iIDEntry=30303'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30303', 'ajax/displayEntry.php?iIDEntry=30303'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30303', 'ajax/displayEntry.php?iIDEntry=30303'); return false;">
									62
								</a>
			</td>		
						<td>2007-04-07 16:18</td>
		
					<td><a href='player.php?iIDPlayer=3049'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30303">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>5</b>		
				</td>
		<td><b>219</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3013'>David Kjellberg</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3013'>LDK</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30443', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">30443</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30443', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30443', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30443', 'ajax/displayEntry.php?iIDEntry=30443'); return false;">
									47
								</a>
			</td>		
						<td>2007-04-07 21:59</td>
		
					<td><a href='player.php?iIDPlayer=3013'>7</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30443">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>6</b>		
				</td>
		<td><b>217</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3083'>Victor Håkansson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3083'>TFF</a>
							
		</td>

					<td>Johanneshov</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30628', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">30628</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30628', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30628', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30628', 'ajax/displayEntry.php?iIDEntry=30628'); return false;">
									35
								</a>
			</td>		
						<td>2007-04-08 13:17</td>
		
					<td><a href='player.php?iIDPlayer=3083'>9</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30628">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>7</b>		
				</td>
		<td><b>216</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3031'>Mats Runsten</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3031'>MCR</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30237', 'ajax/displayEntry.php?iIDEntry=30237'); return false;">30237</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30237', 'ajax/displayEntry.php?iIDEntry=30237'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30237', 'ajax/displayEntry.php?iIDEntry=30237'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30237', 'ajax/displayEntry.php?iIDEntry=30237'); return false;">
									16
								</a>
			</td>		
						<td>2007-04-07 14:25</td>
		
					<td><a href='player.php?iIDPlayer=3031'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30237">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>8</b>		
				</td>
		<td><b>204</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3059'>Fredrik Lindberg</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3059'>F L</a>
							
		</td>

					<td>Sollentuna</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30350', 'ajax/displayEntry.php?iIDEntry=30350'); return false;">30350</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30350', 'ajax/displayEntry.php?iIDEntry=30350'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30350', 'ajax/displayEntry.php?iIDEntry=30350'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30350', 'ajax/displayEntry.php?iIDEntry=30350'); return false;">
									22
								</a>
			</td>		
						<td>2007-04-07 17:03</td>
		
					<td><a href='player.php?iIDPlayer=3059'>10</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30350">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>9</b>		
				</td>
		<td><b>202</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3007'>Michael Lindström</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3007'>MIC</a>
							
		</td>

					<td>Lidköping</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30147', 'ajax/displayEntry.php?iIDEntry=30147'); return false;">30147</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30147', 'ajax/displayEntry.php?iIDEntry=30147'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30147', 'ajax/displayEntry.php?iIDEntry=30147'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30147', 'ajax/displayEntry.php?iIDEntry=30147'); return false;">
									54
								</a>
			</td>		
						<td>2007-04-06 21:54</td>
		
					<td><a href='player.php?iIDPlayer=3007'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30147">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>10</b>		
				</td>
		<td><b>199</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3045'>Helena Walter</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3045'>YOO</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30176', 'ajax/displayEntry.php?iIDEntry=30176'); return false;">30176</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30176', 'ajax/displayEntry.php?iIDEntry=30176'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30176', 'ajax/displayEntry.php?iIDEntry=30176'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30176', 'ajax/displayEntry.php?iIDEntry=30176'); return false;">
									19
								</a>
			</td>		
						<td>2007-04-06 22:58</td>
		
					<td><a href='player.php?iIDPlayer=3045'>5</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30176">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>11</b>		
				</td>
		<td><b>198</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3014'>Karl Broström</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3014'>KGB</a>
							
		</td>

					<td>Göteborg</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30417', 'ajax/displayEntry.php?iIDEntry=30417'); return false;">30417</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30417', 'ajax/displayEntry.php?iIDEntry=30417'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30417', 'ajax/displayEntry.php?iIDEntry=30417'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30417', 'ajax/displayEntry.php?iIDEntry=30417'); return false;">
									30
								</a>
			</td>		
						<td>2007-04-07 19:02</td>
		
					<td><a href='player.php?iIDPlayer=3014'>11</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30417">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>12</b>		
				</td>
		<td><b>198</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3001'>Patrik Bodin</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3001'>PAL</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30214', 'ajax/displayEntry.php?iIDEntry=30214'); return false;">30214</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30214', 'ajax/displayEntry.php?iIDEntry=30214'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30214', 'ajax/displayEntry.php?iIDEntry=30214'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30214', 'ajax/displayEntry.php?iIDEntry=30214'); return false;">
									16
								</a>
			</td>		
						<td>2007-04-07 13:07</td>
		
					<td><a href='player.php?iIDPlayer=3001'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30214">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>13</b>		
				</td>
		<td><b>192</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3040'>Reidar Spets</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3040'>LEL</a>
							
		</td>

					<td>Sunne</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30257', 'ajax/displayEntry.php?iIDEntry=30257'); return false;">30257</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30257', 'ajax/displayEntry.php?iIDEntry=30257'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30257', 'ajax/displayEntry.php?iIDEntry=30257'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30257', 'ajax/displayEntry.php?iIDEntry=30257'); return false;">
									30
								</a>
			</td>		
						<td>2007-04-07 15:58</td>
		
					<td><a href='player.php?iIDPlayer=3040'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30257">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>14</b>		
				</td>
		<td><b>183</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3091'>Linus Jorenbo</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3091'>S P</a>
							
		</td>

					<td>STOCKHOLM</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30339', 'ajax/displayEntry.php?iIDEntry=30339'); return false;">30339</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30339', 'ajax/displayEntry.php?iIDEntry=30339'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30339', 'ajax/displayEntry.php?iIDEntry=30339'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30339', 'ajax/displayEntry.php?iIDEntry=30339'); return false;">
									47
								</a>
			</td>		
						<td>2007-04-07 16:24</td>
		
					<td><a href='player.php?iIDPlayer=3091'>9</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30339">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>15</b>		
				</td>
		<td><b>178</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3066'>Jörgen Holm</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3066'>IFK</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30374', 'ajax/displayEntry.php?iIDEntry=30374'); return false;">30374</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30374', 'ajax/displayEntry.php?iIDEntry=30374'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30374', 'ajax/displayEntry.php?iIDEntry=30374'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30374', 'ajax/displayEntry.php?iIDEntry=30374'); return false;">
									54
								</a>
			</td>		
						<td>2007-04-07 18:01</td>
		
					<td><a href='player.php?iIDPlayer=3066'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30374">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>16</b>		
				</td>
		<td><b>173</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3003'>Stefan Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3003'>FEZ</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30175', 'ajax/displayEntry.php?iIDEntry=30175'); return false;">30175</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30175', 'ajax/displayEntry.php?iIDEntry=30175'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30175', 'ajax/displayEntry.php?iIDEntry=30175'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30175', 'ajax/displayEntry.php?iIDEntry=30175'); return false;">
									41
								</a>
			</td>		
						<td>2007-04-06 23:20</td>
		
					<td><a href='player.php?iIDPlayer=3003'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30175">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>17</b>		
				</td>
		<td><b>172</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3017'>Christian Balac</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3017'>BLA</a>
							
		</td>

					<td>Alingsås</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30524', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">30524</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30524', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30524', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30524', 'ajax/displayEntry.php?iIDEntry=30524'); return false;">
									22
								</a>
			</td>		
						<td>2007-04-08 00:31</td>
		
					<td><a href='player.php?iIDPlayer=3017'>11</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30524">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>18</b>		
				</td>
		<td><b>168</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3022'>Magnus Rostö</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3022'>LIX</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30149', 'ajax/displayEntry.php?iIDEntry=30149'); return false;">30149</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30149', 'ajax/displayEntry.php?iIDEntry=30149'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30149', 'ajax/displayEntry.php?iIDEntry=30149'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30149', 'ajax/displayEntry.php?iIDEntry=30149'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 21:07</td>
		
					<td><a href='player.php?iIDPlayer=3022'>10</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30149">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>19</b>		
				</td>
		<td><b>156</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3016'>Per Ahlenius</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3016'>PER</a>
							
		</td>

					<td>Falun</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30421', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">30421</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30421', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30421', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30421', 'ajax/displayEntry.php?iIDEntry=30421'); return false;">
									12
								</a>
			</td>		
						<td>2007-04-07 19:15</td>
		
					<td><a href='player.php?iIDPlayer=3016'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30421">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>20</b>		
				</td>
		<td><b>156</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3043'>P-J Snygg</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3043'>PJS</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30220', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">30220</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30220', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30220', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30220', 'ajax/displayEntry.php?iIDEntry=30220'); return false;">
									24
								</a>
			</td>		
						<td>2007-04-07 13:20</td>
		
					<td><a href='player.php?iIDPlayer=3043'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30220">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>21</b>		
				</td>
		<td><b>153</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3004'>Fredrik Malmqvist</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3004'>REY</a>
							
		</td>

					<td>Skövde</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30252', 'ajax/displayEntry.php?iIDEntry=30252'); return false;">30252</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30252', 'ajax/displayEntry.php?iIDEntry=30252'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30252', 'ajax/displayEntry.php?iIDEntry=30252'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30252', 'ajax/displayEntry.php?iIDEntry=30252'); return false;">
									22
								</a>
			</td>		
						<td>2007-04-07 15:30</td>
		
					<td><a href='player.php?iIDPlayer=3004'>10</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30252">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>22</b>		
				</td>
		<td><b>153</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3076'>Lars Blomgren</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3076'>BLO</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30044', 'ajax/displayEntry.php?iIDEntry=30044'); return false;">30044</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30044', 'ajax/displayEntry.php?iIDEntry=30044'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30044', 'ajax/displayEntry.php?iIDEntry=30044'); return false;">
									47
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30044', 'ajax/displayEntry.php?iIDEntry=30044'); return false;">
									32
								</a>
			</td>		
						<td>2007-04-06 16:23</td>
		
					<td><a href='player.php?iIDPlayer=3076'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30044">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>23</b>		
				</td>
		<td><b>150</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3008'>Henrik Hultman</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3008'>HNK</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30416', 'ajax/displayEntry.php?iIDEntry=30416'); return false;">30416</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30416', 'ajax/displayEntry.php?iIDEntry=30416'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30416', 'ajax/displayEntry.php?iIDEntry=30416'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30416', 'ajax/displayEntry.php?iIDEntry=30416'); return false;">
									18
								</a>
			</td>		
						<td>2007-04-07 19:56</td>
		
					<td><a href='player.php?iIDPlayer=3008'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30416">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>24</b>		
				</td>
		<td><b>148</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3032'>Per Holknekt</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3032'>APB</a>
							
		</td>

					<td>Enskede</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30139', 'ajax/displayEntry.php?iIDEntry=30139'); return false;">30139</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30139', 'ajax/displayEntry.php?iIDEntry=30139'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30139', 'ajax/displayEntry.php?iIDEntry=30139'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30139', 'ajax/displayEntry.php?iIDEntry=30139'); return false;">
									30
								</a>
			</td>		
						<td>2007-04-06 21:42</td>
		
					<td><a href='player.php?iIDPlayer=3032'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30139">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>25</b>		
				</td>
		<td><b>145</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3062'>Henrik Lagercrantz</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3062'>HEN</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30238', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">30238</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30238', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30238', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30238', 'ajax/displayEntry.php?iIDEntry=30238'); return false;">
									1
								</a>
			</td>		
						<td>2007-04-07 14:10</td>
		
					<td><a href='player.php?iIDPlayer=3062'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30238">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>26</b>		
				</td>
		<td><b>144</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3029'>Martin Tiljander</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3029'>MIT</a>
							
		</td>

					<td>boxholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30023', 'ajax/displayEntry.php?iIDEntry=30023'); return false;">30023</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30023', 'ajax/displayEntry.php?iIDEntry=30023'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30023', 'ajax/displayEntry.php?iIDEntry=30023'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30023', 'ajax/displayEntry.php?iIDEntry=30023'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 15:14</td>
		
					<td><a href='player.php?iIDPlayer=3029'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30023">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>27</b>		
				</td>
		<td><b>140</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3020'>Henrik Tomson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3020'>HOT</a>
							
		</td>

					<td>Alingsås</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30278', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">30278</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30278', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30278', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30278', 'ajax/displayEntry.php?iIDEntry=30278'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 15:21</td>
		
					<td><a href='player.php?iIDPlayer=3020'>11</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30278">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>28</b>		
				</td>
		<td><b>139</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3050'>Mark Van der Gugten</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3050'>MVG</a>
							
		</td>

					<td>Zwolle</td>
			<td><img src='images/icons/flags/nl.gif' alt='Netherlands' title='Netherlands' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30396', 'ajax/displayEntry.php?iIDEntry=30396'); return false;">30396</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30396', 'ajax/displayEntry.php?iIDEntry=30396'); return false;">
									<b>100</b>
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30396', 'ajax/displayEntry.php?iIDEntry=30396'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30396', 'ajax/displayEntry.php?iIDEntry=30396'); return false;">
									9
								</a>
			</td>		
						<td>2007-04-07 19:07</td>
		
					<td><a href='player.php?iIDPlayer=3050'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30396">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>29</b>		
				</td>
		<td><b>135</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3015'>Lars-Erik Brattström</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3015'>CNT</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30405', 'ajax/displayEntry.php?iIDEntry=30405'); return false;">30405</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30405', 'ajax/displayEntry.php?iIDEntry=30405'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30405', 'ajax/displayEntry.php?iIDEntry=30405'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30405', 'ajax/displayEntry.php?iIDEntry=30405'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-07 20:09</td>
		
					<td><a href='player.php?iIDPlayer=3015'>7</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30405">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>30</b>		
				</td>
		<td><b>132</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3095'>Peter Johansson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3095'>POP</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30155', 'ajax/displayEntry.php?iIDEntry=30155'); return false;">30155</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30155', 'ajax/displayEntry.php?iIDEntry=30155'); return false;">
									74
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30155', 'ajax/displayEntry.php?iIDEntry=30155'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30155', 'ajax/displayEntry.php?iIDEntry=30155'); return false;">
									28
								</a>
			</td>		
						<td>2007-04-06 23:33</td>
		
					<td><a href='player.php?iIDPlayer=3095'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30155">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>31</b>		
				</td>
		<td><b>130</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3087'>Carl Gustaf Forssbeck</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3087'>CGF</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30553', 'ajax/displayEntry.php?iIDEntry=30553'); return false;">30553</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30553', 'ajax/displayEntry.php?iIDEntry=30553'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30553', 'ajax/displayEntry.php?iIDEntry=30553'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30553', 'ajax/displayEntry.php?iIDEntry=30553'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-08 02:07</td>
		
					<td><a href='player.php?iIDPlayer=3087'>11</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30553">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>32</b>		
				</td>
		<td><b>125</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3071'>Olli-Mikko Ojamies</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3071'>OMO</a>
							
		</td>

					<td>Espoo</td>
			<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30617', 'ajax/displayEntry.php?iIDEntry=30617'); return false;">30617</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30617', 'ajax/displayEntry.php?iIDEntry=30617'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30617', 'ajax/displayEntry.php?iIDEntry=30617'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30617', 'ajax/displayEntry.php?iIDEntry=30617'); return false;">
									11
								</a>
			</td>		
						<td>2007-04-08 12:34</td>
		
					<td><a href='player.php?iIDPlayer=3071'>11</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30617">
				</div>
				</td>
			</tr>
				
				
	
				
					
			<tr>
			<td colspan='12'><hr /></td>
		</tr>
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>33</b>		
				</td>
		<td><b>124</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3061'>Tobias Lund</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3061'>RED</a>
							
		</td>

					<td>Eskilstuna</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30246', 'ajax/displayEntry.php?iIDEntry=30246'); return false;">30246</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30246', 'ajax/displayEntry.php?iIDEntry=30246'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30246', 'ajax/displayEntry.php?iIDEntry=30246'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30246', 'ajax/displayEntry.php?iIDEntry=30246'); return false;">
									26
								</a>
			</td>		
						<td>2007-04-07 14:49</td>
		
					<td><a href='player.php?iIDPlayer=3061'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30246">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>34</b>		
				</td>
		<td><b>121</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3055'>Magnus Gustafsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3055'>GUZ</a>
							
		</td>

					<td>Bagarmossen</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30025', 'ajax/displayEntry.php?iIDEntry=30025'); return false;">30025</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30025', 'ajax/displayEntry.php?iIDEntry=30025'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30025', 'ajax/displayEntry.php?iIDEntry=30025'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30025', 'ajax/displayEntry.php?iIDEntry=30025'); return false;">
									17
								</a>
			</td>		
						<td>2007-04-06 15:21</td>
		
					<td><a href='player.php?iIDPlayer=3055'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30025">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>35</b>		
				</td>
		<td><b>117</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3039'>Sampo Simonen</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3039'>SAM</a>
							
		</td>

					<td>Espoo</td>
			<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30583', 'ajax/displayEntry.php?iIDEntry=30583'); return false;">30583</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30583', 'ajax/displayEntry.php?iIDEntry=30583'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30583', 'ajax/displayEntry.php?iIDEntry=30583'); return false;">
									38
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30583', 'ajax/displayEntry.php?iIDEntry=30583'); return false;">
									11
								</a>
			</td>		
						<td>2007-04-08 12:40</td>
		
					<td><a href='player.php?iIDPlayer=3039'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30583">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>36</b>		
				</td>
		<td><b>116</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3088'>Deniz Dogan</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3088'>DNZ</a>
							
		</td>

					<td>Göteborg</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30425', 'ajax/displayEntry.php?iIDEntry=30425'); return false;">30425</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30425', 'ajax/displayEntry.php?iIDEntry=30425'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30425', 'ajax/displayEntry.php?iIDEntry=30425'); return false;">
									28
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30425', 'ajax/displayEntry.php?iIDEntry=30425'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-07 20:05</td>
		
					<td><a href='player.php?iIDPlayer=3088'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30425">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>37</b>		
				</td>
		<td><b>114</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3072'>Nicklas Karlbom</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3072'>DEM</a>
							
		</td>

					<td>Hägersten</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30496', 'ajax/displayEntry.php?iIDEntry=30496'); return false;">30496</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30496', 'ajax/displayEntry.php?iIDEntry=30496'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30496', 'ajax/displayEntry.php?iIDEntry=30496'); return false;">
									17
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30496', 'ajax/displayEntry.php?iIDEntry=30496'); return false;">
									15
								</a>
			</td>		
						<td>2007-04-07 23:12</td>
		
					<td><a href='player.php?iIDPlayer=3072'>7</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30496">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>38</b>		
				</td>
		<td><b>113</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3098'>Per-Olof Romell</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3098'>PRO</a>
							
		</td>

					<td>Tyresö</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30300', 'ajax/displayEntry.php?iIDEntry=30300'); return false;">30300</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30300', 'ajax/displayEntry.php?iIDEntry=30300'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30300', 'ajax/displayEntry.php?iIDEntry=30300'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30300', 'ajax/displayEntry.php?iIDEntry=30300'); return false;">
									15
								</a>
			</td>		
						<td>2007-04-07 16:48</td>
		
					<td><a href='player.php?iIDPlayer=3098'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30300">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>39</b>		
				</td>
		<td><b>111</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3019'>Alvar Palm</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3019'>C P</a>
							
		</td>

					<td>Göteborg</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30499', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">30499</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30499', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30499', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30499', 'ajax/displayEntry.php?iIDEntry=30499'); return false;">
									12
								</a>
			</td>		
						<td>2007-04-07 23:30</td>
		
					<td><a href='player.php?iIDPlayer=3019'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30499">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>40</b>		
				</td>
		<td><b>110</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3110'>Mikael Telerud</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3110'>MIW</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30479', 'ajax/displayEntry.php?iIDEntry=30479'); return false;">30479</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30479', 'ajax/displayEntry.php?iIDEntry=30479'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30479', 'ajax/displayEntry.php?iIDEntry=30479'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30479', 'ajax/displayEntry.php?iIDEntry=30479'); return false;">
									7
								</a>
			</td>		
						<td>2007-04-07 22:10</td>
		
					<td><a href='player.php?iIDPlayer=3110'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30479">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>41</b>		
				</td>
		<td><b>108</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3103'>daniel håkansson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3103'>VPK</a>
							
		</td>

					<td>söööööööder</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30367', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">30367</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30367', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30367', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">
									9
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30367', 'ajax/displayEntry.php?iIDEntry=30367'); return false;">
									9
								</a>
			</td>		
						<td>2007-04-07 17:11</td>
		
					<td><a href='player.php?iIDPlayer=3103'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30367">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>42</b>		
				</td>
		<td><b>105</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3114'>Purre Persson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3114'>PUR</a>
							
		</td>

					<td>Solna</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30543', 'ajax/displayEntry.php?iIDEntry=30543'); return false;">30543</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30543', 'ajax/displayEntry.php?iIDEntry=30543'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30543', 'ajax/displayEntry.php?iIDEntry=30543'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30543', 'ajax/displayEntry.php?iIDEntry=30543'); return false;">
									17
								</a>
			</td>		
						<td>2007-04-08 01:35</td>
		
					<td><a href='player.php?iIDPlayer=3114'>2</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30543">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>43</b>		
				</td>
		<td><b>104</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3056'>Antti Peltonen</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3056'>AEP</a>
							
		</td>

					<td>Helsinki</td>
			<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30087', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">30087</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30087', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">
									54
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30087', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">
									26
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30087', 'ajax/displayEntry.php?iIDEntry=30087'); return false;">
									24
								</a>
			</td>		
						<td>2007-04-06 20:14</td>
		
					<td><a href='player.php?iIDPlayer=3056'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30087">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>44</b>		
				</td>
		<td><b>102</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3109'>Joakim Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3109'>JOA</a>
							
		</td>

					<td>stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30418', 'ajax/displayEntry.php?iIDEntry=30418'); return false;">30418</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30418', 'ajax/displayEntry.php?iIDEntry=30418'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30418', 'ajax/displayEntry.php?iIDEntry=30418'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30418', 'ajax/displayEntry.php?iIDEntry=30418'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 19:24</td>
		
					<td><a href='player.php?iIDPlayer=3109'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30418">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>45</b>		
				</td>
		<td><b>99</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3085'>Freja Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3085'>FAN</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30349', 'ajax/displayEntry.php?iIDEntry=30349'); return false;">30349</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30349', 'ajax/displayEntry.php?iIDEntry=30349'); return false;">
									82
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30349', 'ajax/displayEntry.php?iIDEntry=30349'); return false;">
									17
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30349', 'ajax/displayEntry.php?iIDEntry=30349'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 17:45</td>
		
					<td><a href='player.php?iIDPlayer=3085'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30349">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>46</b>		
				</td>
		<td><b>96</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3102'>Hanna Allergren</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3102'>HEA</a>
							
		</td>

					<td>Bagis</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30208', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">30208</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30208', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">
									68
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30208', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">
									28
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30208', 'ajax/displayEntry.php?iIDEntry=30208'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 01:48</td>
		
					<td><a href='player.php?iIDPlayer=3102'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30208">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>47</b>		
				</td>
		<td><b>94</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3000'>Roger Ström</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3000'>ROS</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30500', 'ajax/displayEntry.php?iIDEntry=30500'); return false;">30500</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30500', 'ajax/displayEntry.php?iIDEntry=30500'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30500', 'ajax/displayEntry.php?iIDEntry=30500'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30500', 'ajax/displayEntry.php?iIDEntry=30500'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-07 22:38</td>
		
					<td><a href='player.php?iIDPlayer=3000'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30500">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>48</b>		
				</td>
		<td><b>91</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3082'>Mithras Ljungberg</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3082'>FRI</a>
							
		</td>

					<td>sthlm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30073', 'ajax/displayEntry.php?iIDEntry=30073'); return false;">30073</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30073', 'ajax/displayEntry.php?iIDEntry=30073'); return false;">
									90
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30073', 'ajax/displayEntry.php?iIDEntry=30073'); return false;">
									1
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30073', 'ajax/displayEntry.php?iIDEntry=30073'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 17:45</td>
		
					<td><a href='player.php?iIDPlayer=3082'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30073">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>49</b>		
				</td>
		<td><b>91</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3105'>Maria Lindgren</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3105'>M L</a>
							
		</td>

					<td>Hisings BAcka</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30313', 'ajax/displayEntry.php?iIDEntry=30313'); return false;">30313</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30313', 'ajax/displayEntry.php?iIDEntry=30313'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30313', 'ajax/displayEntry.php?iIDEntry=30313'); return false;">
									20
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30313', 'ajax/displayEntry.php?iIDEntry=30313'); return false;">
									9
								</a>
			</td>		
						<td>2007-04-07 16:34</td>
		
					<td><a href='player.php?iIDPlayer=3105'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30313">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>50</b>		
				</td>
		<td><b>89</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3038'>Leif Spångberg</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3038'>LEF</a>
							
		</td>

					<td>JÄRFÄLLA</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30412', 'ajax/displayEntry.php?iIDEntry=30412'); return false;">30412</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30412', 'ajax/displayEntry.php?iIDEntry=30412'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30412', 'ajax/displayEntry.php?iIDEntry=30412'); return false;">
									15
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30412', 'ajax/displayEntry.php?iIDEntry=30412'); return false;">
									12
								</a>
			</td>		
						<td>2007-04-07 19:15</td>
		
					<td><a href='player.php?iIDPlayer=3038'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30412">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>51</b>		
				</td>
		<td><b>88</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3026'>Johan Småros</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3026'>JOS</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30200', 'ajax/displayEntry.php?iIDEntry=30200'); return false;">30200</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30200', 'ajax/displayEntry.php?iIDEntry=30200'); return false;">
									38
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30200', 'ajax/displayEntry.php?iIDEntry=30200'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30200', 'ajax/displayEntry.php?iIDEntry=30200'); return false;">
									18
								</a>
			</td>		
						<td>2007-04-07 00:18</td>
		
					<td><a href='player.php?iIDPlayer=3026'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30200">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>52</b>		
				</td>
		<td><b>87</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3075'>Mikael Tillander</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3075'>MMT</a>
							
		</td>

					<td>Kungsängen</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30298', 'ajax/displayEntry.php?iIDEntry=30298'); return false;">30298</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30298', 'ajax/displayEntry.php?iIDEntry=30298'); return false;">
									62
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30298', 'ajax/displayEntry.php?iIDEntry=30298'); return false;">
									15
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30298', 'ajax/displayEntry.php?iIDEntry=30298'); return false;">
									10
								</a>
			</td>		
						<td>2007-04-07 16:54</td>
		
					<td><a href='player.php?iIDPlayer=3075'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30298">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>53</b>		
				</td>
		<td><b>82</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3037'>Henrik Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3037'>LHA</a>
							
		</td>

					<td>Bromma</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30089', 'ajax/displayEntry.php?iIDEntry=30089'); return false;">30089</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30089', 'ajax/displayEntry.php?iIDEntry=30089'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30089', 'ajax/displayEntry.php?iIDEntry=30089'); return false;">
									38
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30089', 'ajax/displayEntry.php?iIDEntry=30089'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 21:02</td>
		
					<td><a href='player.php?iIDPlayer=3037'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30089">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>54</b>		
				</td>
		<td><b>81</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3089'>Marcus Boman</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3089'>MAC</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30018', 'ajax/displayEntry.php?iIDEntry=30018'); return false;">30018</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30018', 'ajax/displayEntry.php?iIDEntry=30018'); return false;">
									58
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30018', 'ajax/displayEntry.php?iIDEntry=30018'); return false;">
									16
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30018', 'ajax/displayEntry.php?iIDEntry=30018'); return false;">
									7
								</a>
			</td>		
						<td>2007-04-06 15:16</td>
		
					<td><a href='player.php?iIDPlayer=3089'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30018">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>55</b>		
				</td>
		<td><b>80</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3107'>Johan Svensson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3107'>JOS</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30371', 'ajax/displayEntry.php?iIDEntry=30371'); return false;">30371</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30371', 'ajax/displayEntry.php?iIDEntry=30371'); return false;">
									38
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30371', 'ajax/displayEntry.php?iIDEntry=30371'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30371', 'ajax/displayEntry.php?iIDEntry=30371'); return false;">
									10
								</a>
			</td>		
						<td>2007-04-07 17:35</td>
		
					<td><a href='player.php?iIDPlayer=3107'>7</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30371">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>56</b>		
				</td>
		<td><b>77</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3012'>Henrik Björk</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3012'>RIK</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30233', 'ajax/displayEntry.php?iIDEntry=30233'); return false;">30233</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30233', 'ajax/displayEntry.php?iIDEntry=30233'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30233', 'ajax/displayEntry.php?iIDEntry=30233'); return false;">
									19
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30233', 'ajax/displayEntry.php?iIDEntry=30233'); return false;">
									14
								</a>
			</td>		
						<td>2007-04-07 14:11</td>
		
					<td><a href='player.php?iIDPlayer=3012'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30233">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>57</b>		
				</td>
		<td><b>76</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3011'>Erik Blücher</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3011'>BLE</a>
							
		</td>

					<td>Svartsjö</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30080', 'ajax/displayEntry.php?iIDEntry=30080'); return false;">30080</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30080', 'ajax/displayEntry.php?iIDEntry=30080'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30080', 'ajax/displayEntry.php?iIDEntry=30080'); return false;">
									35
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30080', 'ajax/displayEntry.php?iIDEntry=30080'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 19:53</td>
		
					<td><a href='player.php?iIDPlayer=3011'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30080">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>58</b>		
				</td>
		<td><b>74</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3057'>Vesa Tyry</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3057'>VT</a>
							
		</td>

					<td>Helsinki</td>
			<td><img src='images/icons/flags/fi.gif' alt='Finland' title='Finland' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30140', 'ajax/displayEntry.php?iIDEntry=30140'); return false;">30140</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30140', 'ajax/displayEntry.php?iIDEntry=30140'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30140', 'ajax/displayEntry.php?iIDEntry=30140'); return false;">
									22
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30140', 'ajax/displayEntry.php?iIDEntry=30140'); return false;">
									20
								</a>
			</td>		
						<td>2007-04-06 21:05</td>
		
					<td><a href='player.php?iIDPlayer=3057'>12</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30140">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>59</b>		
				</td>
		<td><b>67</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3093'>Simon Måssebäck</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3093'>SIM</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30373', 'ajax/displayEntry.php?iIDEntry=30373'); return false;">30373</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30373', 'ajax/displayEntry.php?iIDEntry=30373'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30373', 'ajax/displayEntry.php?iIDEntry=30373'); return false;">
									13
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30373', 'ajax/displayEntry.php?iIDEntry=30373'); return false;">
									10
								</a>
			</td>		
						<td>2007-04-07 17:38</td>
		
					<td><a href='player.php?iIDPlayer=3093'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30373">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>60</b>		
				</td>
		<td><b>63</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3010'>Stefan Arkinger</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3010'>ARK</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30548', 'ajax/displayEntry.php?iIDEntry=30548'); return false;">30548</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30548', 'ajax/displayEntry.php?iIDEntry=30548'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30548', 'ajax/displayEntry.php?iIDEntry=30548'); return false;">
									22
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30548', 'ajax/displayEntry.php?iIDEntry=30548'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-08 01:35</td>
		
					<td><a href='player.php?iIDPlayer=3010'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30548">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>61</b>		
				</td>
		<td><b>63</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3080'>Linnea Edlund</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3080'>NEA</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30378', 'ajax/displayEntry.php?iIDEntry=30378'); return false;">30378</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30378', 'ajax/displayEntry.php?iIDEntry=30378'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30378', 'ajax/displayEntry.php?iIDEntry=30378'); return false;">
									22
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30378', 'ajax/displayEntry.php?iIDEntry=30378'); return false;">
									11
								</a>
			</td>		
						<td>2007-04-07 17:52</td>
		
					<td><a href='player.php?iIDPlayer=3080'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30378">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>62</b>		
				</td>
		<td><b>58</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3033'>Rolph Ericson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3033'>REC</a>
							
		</td>

					<td>Enskede</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30372', 'ajax/displayEntry.php?iIDEntry=30372'); return false;">30372</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30372', 'ajax/displayEntry.php?iIDEntry=30372'); return false;">
									35
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30372', 'ajax/displayEntry.php?iIDEntry=30372'); return false;">
									16
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30372', 'ajax/displayEntry.php?iIDEntry=30372'); return false;">
									7
								</a>
			</td>		
						<td>2007-04-07 18:14</td>
		
					<td><a href='player.php?iIDPlayer=3033'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30372">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>63</b>		
				</td>
		<td><b>55</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3023'>Dan Hagman</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3023'>DAH</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30584', 'ajax/displayEntry.php?iIDEntry=30584'); return false;">30584</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30584', 'ajax/displayEntry.php?iIDEntry=30584'); return false;">
									44
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30584', 'ajax/displayEntry.php?iIDEntry=30584'); return false;">
									8
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30584', 'ajax/displayEntry.php?iIDEntry=30584'); return false;">
									3
								</a>
			</td>		
						<td>2007-04-08 12:36</td>
		
					<td><a href='player.php?iIDPlayer=3023'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30584">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>64</b>		
				</td>
		<td><b>55</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3100'>Andreas Pettersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3100'>ARP</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30178', 'ajax/displayEntry.php?iIDEntry=30178'); return false;">30178</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30178', 'ajax/displayEntry.php?iIDEntry=30178'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30178', 'ajax/displayEntry.php?iIDEntry=30178'); return false;">
									15
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30178', 'ajax/displayEntry.php?iIDEntry=30178'); return false;">
									8
								</a>
			</td>		
						<td>2007-04-06 22:44</td>
		
					<td><a href='player.php?iIDPlayer=3100'>5</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30178">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>65</b>		
				</td>
		<td><b>50</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3025'>Simon Olsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3025'>ZPY</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30265', 'ajax/displayEntry.php?iIDEntry=30265'); return false;">30265</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30265', 'ajax/displayEntry.php?iIDEntry=30265'); return false;">
									50
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30265', 'ajax/displayEntry.php?iIDEntry=30265'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30265', 'ajax/displayEntry.php?iIDEntry=30265'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 15:47</td>
		
					<td><a href='player.php?iIDPlayer=3025'>8</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30265">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>66</b>		
				</td>
		<td><b>50</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3064'>Sebastian Evans</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3064'>SBA</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30498', 'ajax/displayEntry.php?iIDEntry=30498'); return false;">30498</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30498', 'ajax/displayEntry.php?iIDEntry=30498'); return false;">
									41
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30498', 'ajax/displayEntry.php?iIDEntry=30498'); return false;">
									8
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30498', 'ajax/displayEntry.php?iIDEntry=30498'); return false;">
									1
								</a>
			</td>		
						<td>2007-04-08 00:22</td>
		
					<td><a href='player.php?iIDPlayer=3064'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30498">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>67</b>		
				</td>
		<td><b>42</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3079'>Johanna Finne</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3079'>JOJ</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30020', 'ajax/displayEntry.php?iIDEntry=30020'); return false;">30020</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30020', 'ajax/displayEntry.php?iIDEntry=30020'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30020', 'ajax/displayEntry.php?iIDEntry=30020'); return false;">
									18
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30020', 'ajax/displayEntry.php?iIDEntry=30020'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 15:33</td>
		
					<td><a href='player.php?iIDPlayer=3079'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30020">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>68</b>		
				</td>
		<td><b>40</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3074'>marcus hugosson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3074'>MSH</a>
							
		</td>

					<td>vetlanda</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30525', 'ajax/displayEntry.php?iIDEntry=30525'); return false;">30525</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30525', 'ajax/displayEntry.php?iIDEntry=30525'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30525', 'ajax/displayEntry.php?iIDEntry=30525'); return false;">
									10
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30525', 'ajax/displayEntry.php?iIDEntry=30525'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-08 00:10</td>
		
					<td><a href='player.php?iIDPlayer=3074'>5</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30525">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>69</b>		
				</td>
		<td><b>36</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3099'>Viktor Steinbruck</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3099'>DIL</a>
							
		</td>

					<td>Årsta</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30168', 'ajax/displayEntry.php?iIDEntry=30168'); return false;">30168</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30168', 'ajax/displayEntry.php?iIDEntry=30168'); return false;">
									19
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30168', 'ajax/displayEntry.php?iIDEntry=30168'); return false;">
									17
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30168', 'ajax/displayEntry.php?iIDEntry=30168'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 22:53</td>
		
					<td><a href='player.php?iIDPlayer=3099'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30168">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>70</b>		
				</td>
		<td><b>32</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3104'>Mattias Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3104'>JAG</a>
							
		</td>

					<td>Uppsala</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30295', 'ajax/displayEntry.php?iIDEntry=30295'); return false;">30295</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30295', 'ajax/displayEntry.php?iIDEntry=30295'); return false;">
									32
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30295', 'ajax/displayEntry.php?iIDEntry=30295'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30295', 'ajax/displayEntry.php?iIDEntry=30295'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 16:31</td>
		
					<td><a href='player.php?iIDPlayer=3104'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30295">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>71</b>		
				</td>
		<td><b>30</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3096'>Frej Naimi-Akbar</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3096'>FNA</a>
							
		</td>

					<td>Stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30003', 'ajax/displayEntry.php?iIDEntry=30003'); return false;">30003</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30003', 'ajax/displayEntry.php?iIDEntry=30003'); return false;">
									30
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30003', 'ajax/displayEntry.php?iIDEntry=30003'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30003', 'ajax/displayEntry.php?iIDEntry=30003'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 15:29</td>
		
					<td><a href='player.php?iIDPlayer=3096'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30003">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>72</b>		
				</td>
		<td><b>27</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3078'>Linus Andersson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3078'>SAN</a>
							
		</td>

					<td>Eksjö</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30529', 'ajax/displayEntry.php?iIDEntry=30529'); return false;">30529</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30529', 'ajax/displayEntry.php?iIDEntry=30529'); return false;">
									17
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30529', 'ajax/displayEntry.php?iIDEntry=30529'); return false;">
									7
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30529', 'ajax/displayEntry.php?iIDEntry=30529'); return false;">
									3
								</a>
			</td>		
						<td>2007-04-08 00:24</td>
		
					<td><a href='player.php?iIDPlayer=3078'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30529">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>73</b>		
				</td>
		<td><b>24</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3027'>Mikael Gunnarsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3027'>ROK</a>
							
		</td>

					<td>Haninge</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30127', 'ajax/displayEntry.php?iIDEntry=30127'); return false;">30127</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30127', 'ajax/displayEntry.php?iIDEntry=30127'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30127', 'ajax/displayEntry.php?iIDEntry=30127'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30127', 'ajax/displayEntry.php?iIDEntry=30127'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 20:43</td>
		
					<td><a href='player.php?iIDPlayer=3027'>6</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30127">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>74</b>		
				</td>
		<td><b>24</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3054'>Anders Larsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3054'>AL</a>
							
		</td>

					<td>Eskilstuna</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30015', 'ajax/displayEntry.php?iIDEntry=30015'); return false;">30015</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30015', 'ajax/displayEntry.php?iIDEntry=30015'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30015', 'ajax/displayEntry.php?iIDEntry=30015'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30015', 'ajax/displayEntry.php?iIDEntry=30015'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 11:30</td>
		
					<td><a href='player.php?iIDPlayer=3054'>1</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30015">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>75</b>		
				</td>
		<td><b>24</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3112'>Björn Eriksson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3112'>XYZ</a>
							
		</td>

					<td>stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30518', 'ajax/displayEntry.php?iIDEntry=30518'); return false;">30518</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30518', 'ajax/displayEntry.php?iIDEntry=30518'); return false;">
									24
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30518', 'ajax/displayEntry.php?iIDEntry=30518'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30518', 'ajax/displayEntry.php?iIDEntry=30518'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-07 23:58</td>
		
					<td><a href='player.php?iIDPlayer=3112'>4</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30518">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>76</b>		
				</td>
		<td><b>23</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3058'>Peter Ahremark</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3058'>PET</a>
							
		</td>

					<td>SOLNA</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30066', 'ajax/displayEntry.php?iIDEntry=30066'); return false;">30066</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30066', 'ajax/displayEntry.php?iIDEntry=30066'); return false;">
									12
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30066', 'ajax/displayEntry.php?iIDEntry=30066'); return false;">
									11
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30066', 'ajax/displayEntry.php?iIDEntry=30066'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 17:56</td>
		
					<td><a href='player.php?iIDPlayer=3058'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30066">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#ffffff'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>77</b>		
				</td>
		<td><b>4</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3052'>Håkan Larsson</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3052'>HL</a>
							
		</td>

					<td>Eskilstuna</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30014', 'ajax/displayEntry.php?iIDEntry=30014'); return false;">30014</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30014', 'ajax/displayEntry.php?iIDEntry=30014'); return false;">
									4
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30014', 'ajax/displayEntry.php?iIDEntry=30014'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30014', 'ajax/displayEntry.php?iIDEntry=30014'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-06 14:13</td>
		
					<td><a href='player.php?iIDPlayer=3052'>1</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30014">
				</div>
				</td>
			</tr>
				
				
	
				
		
		
			<tr class='lineDark' onmouseover="this.style.backgroundColor='#dae5fa'" onmouseout="this.style.backgroundColor='#eaeaea'">
		
	
	
			
																																																																									
		<td align='center'>
							<b>78</b>		
				</td>
		<td><b>0</b></td>
	
				
		<td>
							<a href='player.php?iIDPlayer=3113'>Mayako Fagerfjäll</a>
						
		</td>
		
		<td>
				
				<a href='player.php?iIDPlayer=3113'>MYA</a>
							
		</td>

					<td>stockholm</td>
			<td><img src='images/icons/flags/se.gif' alt='Sweden' title='Sweden' /></td>
				
		
		
					<td><a href="#" onclick="new Ajax.Updater('entry30531', 'ajax/displayEntry.php?iIDEntry=30531'); return false;">30531</a></td>
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30531', 'ajax/displayEntry.php?iIDEntry=30531'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30531', 'ajax/displayEntry.php?iIDEntry=30531'); return false;">
									0
								</a>
			</td>		
						<td>
				<a href="#" onclick="new Ajax.Updater('entry30531', 'ajax/displayEntry.php?iIDEntry=30531'); return false;">
									0
								</a>
			</td>		
						<td>2007-04-08 00:49</td>
		
					<td><a href='player.php?iIDPlayer=3113'>3</a></td>		
		
		
		
		</tr>
		
						
				
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry30531">
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
			new Ajax.PeriodicalUpdater('activity', 'ajax/setActivity.php?sPage=/standings.php?iYear=2007&amp;sDivision=A', {asynchronous:true, frequency:10});
		}
		womAdd('setActivity()');
		womOn();
	</script>	
	
		<div id='activity'>
	</div>
</body>
</html>