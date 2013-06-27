<span class="preload1"></span>
<span class="preload2"></span>

<ul id="nav">
	
	{if #MENU_DISPLAY_HOME# == true}
		<li class="top"><a href="index.php" class="top_link"><span>{#MENU_HOME#}</span></a></li>
	{/if}

	{if #MENU_DISPLAY_GENERAL# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_GENERAL#}</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_OVERVIEW# == true}
				<li><a href="overview.php">{#MENU_OVERVIEW#}</a></li>
			{/if}
			{if #MENU_DISPLAY_PRIZES# == true}
				<li><a href="prizes.php">{#MENU_PRIZES#}</a></li>
			{/if}
			{if #MENU_DISPLAY_NEWS# == true}
				<li><a href="news.php">{#MENU_NEWS#}</a></li>
			{/if}
			{if #MENU_DISPLAY_GAMES# == true}
				<li><a href="games.php">{#MENU_GAMES#}</a></li>
			{/if}
			{if #MENU_DISPLAY_MINI# == true}
				<li><a href="mini.php">{#MENU_MINI#}</a></li>
			{/if}
			{if #MENU_DISPLAY_DIVISION# == true || #MENU_DISPLAY_CLASSICS# == true || #MENU_DISPLAY_SPLIT# == true || #MENU_DISPLAY_JUNIORS# == true}
				<li><a href="#"><b>{#MENU_DIVISIONS_SECTION#}</b></a></li>
			{/if}
			{if #MENU_DISPLAY_DIVISION# == true}
				<li><a href="division.php">A {#MENU_DIVISION#}</a></li>
			{/if}
			{if #MENU_DISPLAY_CLASSICS# == true}
				<li><a href="classics.php">{#MENU_CLASSICS#}</a></li>
			{/if}
			{if #MENU_DISPLAY_SPLIT# == true}
				<li><a href="split.php">{#MENU_SPLIT#}</a></li>
			{/if}
			{if #MENU_DISPLAY_JUNIORS# == true}
				<li><a href="juniors.php">{#MENU_JUNIORS#}</a></li>
			{/if}
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_RULES# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_RULES#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_GENERAL_RULES# == true}
				<li><a href="rules.php">{#MENU_GENERAL_RULES#}</a></li>
			{/if}
			{if #MENU_DISPLAY_GENERAL_RULES_SPLIT# == true}
				<li><a href="rulesSplit.php">{#MENU_GENERAL_RULES_SPLIT#}</a></li>
			{/if}	
			{if #MENU_DISPLAY_QUAL_DETAILS# == true}
				<li><a href="qualDetails.php">{#MENU_QUAL_DETAILS#}</a></li>
			{/if}
			{if #MENU_DISPLAY_FINAL_DETAILS# == true}
				<li><a href="finalsDetails.php">{#MENU_FINAL_DETAILS#}</a></li>
			{/if}	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_LOGISTICS# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_LOGISTICS#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_LOCATION# == true}
				<li><a href="location.php">{#MENU_LOCATION#}</a></li>
			{/if}
			{if #MENU_DISPLAY_TRAVEL# == true}
				<li><a href="travel.php">{#MENU_TRAVEL#}</a></li>
			{/if}
			{if #MENU_DISPLAY_ACC# == true}
				<li><a href="accommodations.php">{#MENU_ACC#}</a></li>
			{/if}	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_REGISTER# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_REGISTER#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_REG_MAIN# == true || #MENU_DISPLAY_REG_SPLIT# == true || #MENU_DISPLAY_ENTRANCE_FEE# == true}
				<li><a href="#"><b>{#MENU_REGISTER_SECTION#}</b></a></li>
			{/if}
			{if #MENU_DISPLAY_REG_MAIN# == true}
				<li><a href="register.php">{#MENU_REGISTER_MAIN#}</a></li>
			{/if}
			{if #MENU_DISPLAY_REG_SPLIT# == true}
				<li><a href="registerSplit.php">{#MENU_REGISTER_SPLIT#}</a></li>
			{/if}
			{if #MENU_DISPLAY_ENTRANCE_FEE# == true}
				<li><a href="entranceFee.php">{#MENU_ENTRANCE_FEE#}</a></li>
			{/if}
			{if #MENU_DISPLAY_REG_PLAYERS# == true}
				<li><a href="#"><b>{#MENU_REGISTERED_SECTION#}</b></a></li>
				{section name=divisions loop=$g_aCurrentYearsDivisions}
					{* EXCLUDED THE SPLIT-DIVISION *}	
					{if $g_aCurrentYearsDivisions[divisions].division_name_short != "S"}
						<li><a href="registeredPlayers.php?iYear={$g_iYear}&amp;sDivision={$g_aCurrentYearsDivisions[divisions].division_name_short}">{$g_aCurrentYearsDivisions[divisions].division_name|upper}</a></li>
					{/if}
				{/section}	
				{if $g_bSplitActive == true}
					<li><a href="registeredPlayers.php?iYear={$g_iYear}&amp;sDivision=S">{#MENU_REGISTERED_TEAMS#}</a></li>
				{/if}
			{/if}	

			{if #MENU_DISPLAY_VOLUNTEER# == true || #MENU_DISPLAY_VOLUNTEERS# == true}
				<li><a href="#"><b>{#MENU_VOLUNTEERS_SECTION#}</b></a></li>
			{/if}

			{if #MENU_DISPLAY_VOLUNTEER# == true}
				<li><a href="volunteer.php">{#MENU_VOLUNTEER#}</a></li>
			{/if}

			{if #MENU_DISPLAY_VOLUNTEERS# == true}
				<li><a href="volunteers.php">{#MENU_VOLUNTEERS#}</a></li>
			{/if}
			
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_RESULTS# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_RESULTS#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{section name=section loop=$g_aYearsWithResults}
				<li><a href="results.php?iYear={$g_aYearsWithResults[section]}">{#MENU_ITEM_RESULTS#} {$g_aYearsWithResults[section]}</a></li>
			{/section}	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_STANDINGS# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_STANDINGS#}</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{section name=section loop=$g_aYearsAndDivisions}
				{if #MENU_YEAR_HIDE# != $g_aYearsAndDivisions[section].dty_year_for_division}
					<li><a href="#"><b>{$g_aYearsAndDivisions[section].dty_year_for_division}</b></a></li>
					{section name=divisions loop=$g_aYearsAndDivisions[section].divisions}
					<li><a href="standings.php?iYear={$g_aYearsAndDivisions[section].dty_year_for_division}&amp;sDivision={$g_aYearsAndDivisions[section].divisions[divisions].division_name_short}">{#MENU_ITEM_STANDINGS#} ({$g_aYearsAndDivisions[section].divisions[divisions].division_name_short})</a></li>
					{/section}
		
					{section name=divisions loop=$g_aYearsAndDivisions[section].divisions}			
						<li><a href="game.php?iYear={$g_aYearsAndDivisions[section].dty_year_for_division}&amp;sDivision={$g_aYearsAndDivisions[section].divisions[divisions].division_name_short}&amp;bShowAll=true">{#MENU_GAME_STANDINGS#} ({$g_aYearsAndDivisions[section].divisions[divisions].division_name_short})</a></li>
					{/section}
				{/if}
			{/section}
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}
	
	{if #MENU_DISPLAY_FINALS# == true}
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_FINALS#}</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->			
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{section name=section loop=$g_aYearsWithFinals}
				<li><a href="finalResults.php?iYear={$g_aYearsWithFinals[section].year}&amp;sDivision={$g_aYearsWithFinals[section].division}">{#MENU_FINALS#} {$g_aYearsWithFinals[section].division} {#DIVISION_SHORT#} - {$g_aYearsWithFinals[section].year}</a></li>
			{/section}	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>	
	{/if}
	
	{if #MENU_DISPLAY_STATS# == true}
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_CHARTS_STATS#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_STATS_YEARLY# == true}
				{section name=section loop=$g_aYearsAndDivisions}
					{* TO BE ABLE TO HIDE A YEAR'S STATS *}
					{if #MENU_YEAR_HIDE# != $g_aYearsAndDivisions[section].dty_year_for_division}
						<li><a href="statsYearly.php?iYear={$g_aYearsAndDivisions[section].dty_year_for_division}">{#MENU_CHARTS_STATS_YEARLY#} - {$g_aYearsAndDivisions[section].dty_year_for_division}</a></li>
					{/if}
				{/section}
			{/if}
			{if #MENU_DISPLAY_STATS_TOP_ALL_TIME# == true || #MENU_DISPLAY_BEST_ENTRIES# == true}
				<li><a href="#"><b>{#MENU_CHARTS_STATS_ALL_YEARS_SECTION#}</b></a></li>
			{/if}
			{if #MENU_DISPLAY_STATS_TOP_ALL_TIME# == true}
				<li><a href="statsTopScores.php">{#MENU_CHARTS_STATS_TOP_ALL_TIME#}</a></li>
			{/if}
			{if #MENU_DISPLAY_BEST_ENTRIES# == true}
				<li><a href="statsBestEntries.php">{#MENU_CHARTS_STATS_BEST_ENTRIES#}</a></li>
			{/if}		
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}	
	
	{if #MENU_DISPLAY_MISC# == true}	
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_MISC#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			
			{if #MENU_DISPLAY_PROMOTION# == true}
				<li><a href="promotion.php">{#MENU_PROMOTION#}</a></li>
			{/if}
			{if #MENU_DISPLAY_PRESS# == true}
				<li><a href="press.php">{#MENU_PRESS#}</a></li>
			{/if}		
			{if #MENU_DISPLAY_STPB# == true}
				<li><a href="stpb.php">{#MENU_STPB#}</a></li>
			{/if}		
			{if #MENU_DISPLAY_GALLERY# == true}
				<li><a href="#"><b>{#MENU_GALLERY_SECTION#}</b></a></li>
				{section name=section loop=$g_aYearsWithGallery}
					<li><a href="gallery.php?iYear={$g_aYearsWithGallery[section]}">{$g_aYearsWithGallery[section]}</a></li>
				{/section}
			{/if}

			{if #MENU_DISPLAY_SLIDE# == true}
				{if #MENU_YEAR_HIDE# == null}
					<li><a href="#"><b>{#MENU_SLIDE_SECTION#}</b></a></li>
					<li><a href="slide.php?bStart=true&amp;iYear={$g_iYear}&amp;bTotalAndGames=true">{#MENU_SLIDE_TOTAL_AND_GAMES#}</a></li>
					<li><a href="slideTotal.php?iYear={$g_iYear}&amp;bStart=true">{#MENU_SLIDE_TOTAL#}</a></li>
				{/if}
			{/if}
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}

	{if #MENU_DISPLAY_CONTACT# == true}
		<li class="top"><a href="contact.php" class="top_link"><span>{#MENU_CONTACT#}</span></a></li>
	{/if}

	{if $g_bIsLoggedIn != "true"}
		{if #USE_AJAX_LOGIN# == true}
			<li class="top"><a href="javascript:Effect.toggle('login','appear');" class="top_link"><span>{#MENU_LOGIN#}</span></a></li>
		{else}
			<li class="top"><a href="login.php" class="top_link"><span>{#MENU_LOGIN#}</span></a></li>
		{/if}
	{/if}

	{if $g_aUserAdminTasks != null}
		<li class="top"><a href="#"  class="top_link"><span class="down">{#MENU_ADMIN#}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			{if #MENU_DISPLAY_ENTRY_REG# == true}
				<li><a href="#"><b>{#MENU_ADMIN_ENTRY_REG#}</b></a></li>
				<li><a href="adminEntryCreateStart.php">{#MENU_RECEPTION_CREATE_ENTRY#}</a></li>
				<li><a href="adminEntryRegStart.php">{#MENU_SCOREKEEP_REG_ENTRY#}</a></li>
				<li><a href="adminEntranceFee.php">{#MENU_ADMIN_SET_PAID#}</a></li>
				<li><a href="adminVoidSplitStart.php">{#MENU_VOID_SPLIT_TEAM#}</a></li>
			{/if}
			
			{if $g_aUserAdminTasks.admin_uber == "true"}		
				<li><a href="#"><b>{#MENU_ADMIN_PLAYERS_TEAMS#}</b></a></li>
				<li><a href="adminEmailAddresses.php">{#MENU_ADMIN_PLAYER_EMAIL_ADDRESSES#}</a></li>
				<li><a href="adminPlayersEdit.php">{#MENU_ADMIN_EDIT_PLAYERS_TEAMS#}</a></li>
				<li><a href="adminPlayersDelete.php">{#MENU_ADMIN_DELETE_PLAYER_TEAMS#}</a></li>
				<li><a href="#"><b>{#MENU_ADMIN_ENTRIES#}</b></a></li>
				<li><a href="adminEntryEdit.php">{#MENU_ADMIN_EDIT_ENTRY#}</a></li>
				<li><a href="adminEntriesOpen.php">{#MENU_ADMIN_OPEN_ENTRIES#}</a></li>
				<li><a href="adminEntriesDeleted.php">{#MENU_ADMIN_DELETED_ENTRIES#}</a></li>		
				<!-- <li><a href="#"><b>{#MENU_ADMIN_TOURNAMENT#}</b></a></li> -->
				<li><a href="#"><b>{#MENU_ADMIN_GAMES_HL#}</b></a></li>
				<li><a href="adminGamesTournament.php">{#MENU_ADMIN_TOURN_GAMES#}</a></li>
				<li><a href="adminGames.php">{#MENU_ADMIN_GAMES#}</a></li>
				<li><a href="#"><b>{#MENU_ADMIN_USERS#}</b></a></li>
				<li><a href="adminUserEdit.php">{#MENU_ADMIN_EDIT_USERS#}</a></li>
				<li><a href="adminUser.php">{#MENU_ADMIN_ADD_USERS#}</a></li>
				<li><a href="#"><b>{#MENU_ADMIN_MISC#}</b></a></li>
				<li><a href="adminNews.php">{#MENU_ADMIN_NEWS#}</a></li>
				<li><a href="slideCustom.php">{#MENU_ADMIN_SLIDE_CUSTOM#}</a></li>

				{if #MENU_DISPLAY_USER_ACTIVITY# == true}
					<li><a href="userActivity.php">{#MENU_USER_ACTIVITY#}</a></li>
				{/if}

				<li><a href="adminCalcStandings.php">{#MENU_ADMIN_CALC_STANDINGS#}</a></li>
								
			{/if}	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	{/if}		
</ul>
