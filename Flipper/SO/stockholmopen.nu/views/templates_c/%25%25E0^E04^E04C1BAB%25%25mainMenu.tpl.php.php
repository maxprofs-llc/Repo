<?php /* Smarty version 2.6.16, created on 2008-04-07 06:55:40
         compiled from menus/mainMenu.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'menus/mainMenu.tpl.php', 99, false),)), $this); ?>
<span class="preload1"></span>
<span class="preload2"></span>

<ul id="nav">
	
	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_HOME'] == true): ?>
		<li class="top"><a href="index.php" class="top_link"><span><?php echo $this->_config[0]['vars']['MENU_HOME']; ?>
</span></a></li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_GENERAL'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_GENERAL']; ?>
</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_OVERVIEW'] == true): ?>
				<li><a href="overview.php"><?php echo $this->_config[0]['vars']['MENU_OVERVIEW']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_NEWS'] == true): ?>
				<li><a href="news.php"><?php echo $this->_config[0]['vars']['MENU_NEWS']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_GAMES'] == true): ?>
				<li><a href="games.php"><?php echo $this->_config[0]['vars']['MENU_GAMES']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_MINI'] == true): ?>
				<li><a href="mini.php"><?php echo $this->_config[0]['vars']['MENU_MINI']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_DIVISION'] == true || $this->_config[0]['vars']['MENU_DISPLAY_CLASSICS'] == true || $this->_config[0]['vars']['MENU_DISPLAY_SPLIT'] == true || $this->_config[0]['vars']['MENU_DISPLAY_JUNIORS'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_DIVISIONS_SECTION']; ?>
</b></a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_DIVISION'] == true): ?>
				<li><a href="division.php">A <?php echo $this->_config[0]['vars']['MENU_DIVISION']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_CLASSICS'] == true): ?>
				<li><a href="classics.php"><?php echo $this->_config[0]['vars']['MENU_CLASSICS']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_SPLIT'] == true): ?>
				<li><a href="split.php"><?php echo $this->_config[0]['vars']['MENU_SPLIT']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_JUNIORS'] == true): ?>
				<li><a href="juniors.php"><?php echo $this->_config[0]['vars']['MENU_JUNIORS']; ?>
</a></li>
			<?php endif; ?>
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_RULES'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_RULES']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_GENERAL_RULES'] == true): ?>
				<li><a href="rules.php"><?php echo $this->_config[0]['vars']['MENU_GENERAL_RULES']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_GENERAL_RULES_SPLIT'] == true): ?>
				<li><a href="rulesSplit.php"><?php echo $this->_config[0]['vars']['MENU_GENERAL_RULES_SPLIT']; ?>
</a></li>
			<?php endif; ?>	
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_QUAL_DETAILS'] == true): ?>
				<li><a href="qualDetails.php"><?php echo $this->_config[0]['vars']['MENU_QUAL_DETAILS']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_FINAL_DETAILS'] == true): ?>
				<li><a href="finalsDetails.php"><?php echo $this->_config[0]['vars']['MENU_FINAL_DETAILS']; ?>
</a></li>
			<?php endif; ?>	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_LOGISTICS'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_LOGISTICS']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_LOCATION'] == true): ?>
				<li><a href="location.php"><?php echo $this->_config[0]['vars']['MENU_LOCATION']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_TRAVEL'] == true): ?>
				<li><a href="travel.php"><?php echo $this->_config[0]['vars']['MENU_TRAVEL']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_ACC'] == true): ?>
				<li><a href="accommodations.php"><?php echo $this->_config[0]['vars']['MENU_ACC']; ?>
</a></li>
			<?php endif; ?>	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_REGISTER'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_REGISTER']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_REG_MAIN'] == true || $this->_config[0]['vars']['MENU_DISPLAY_REG_SPLIT'] == true || $this->_config[0]['vars']['MENU_DISPLAY_ENTRANCE_FEE'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_REGISTER_SECTION']; ?>
</b></a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_REG_MAIN'] == true): ?>
				<li><a href="register.php"><?php echo $this->_config[0]['vars']['MENU_REGISTER_MAIN']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_REG_SPLIT'] == true): ?>
				<li><a href="registerSplit.php"><?php echo $this->_config[0]['vars']['MENU_REGISTER_SPLIT']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_ENTRANCE_FEE'] == true): ?>
				<li><a href="entranceFee.php"><?php echo $this->_config[0]['vars']['MENU_ENTRANCE_FEE']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_REG_PLAYERS'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_REGISTERED_SECTION']; ?>
</b></a></li>
				<?php unset($this->_sections['divisions']);
$this->_sections['divisions']['name'] = 'divisions';
$this->_sections['divisions']['loop'] = is_array($_loop=$this->_tpl_vars['g_aCurrentYearsDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['divisions']['show'] = true;
$this->_sections['divisions']['max'] = $this->_sections['divisions']['loop'];
$this->_sections['divisions']['step'] = 1;
$this->_sections['divisions']['start'] = $this->_sections['divisions']['step'] > 0 ? 0 : $this->_sections['divisions']['loop']-1;
if ($this->_sections['divisions']['show']) {
    $this->_sections['divisions']['total'] = $this->_sections['divisions']['loop'];
    if ($this->_sections['divisions']['total'] == 0)
        $this->_sections['divisions']['show'] = false;
} else
    $this->_sections['divisions']['total'] = 0;
if ($this->_sections['divisions']['show']):

            for ($this->_sections['divisions']['index'] = $this->_sections['divisions']['start'], $this->_sections['divisions']['iteration'] = 1;
                 $this->_sections['divisions']['iteration'] <= $this->_sections['divisions']['total'];
                 $this->_sections['divisions']['index'] += $this->_sections['divisions']['step'], $this->_sections['divisions']['iteration']++):
$this->_sections['divisions']['rownum'] = $this->_sections['divisions']['iteration'];
$this->_sections['divisions']['index_prev'] = $this->_sections['divisions']['index'] - $this->_sections['divisions']['step'];
$this->_sections['divisions']['index_next'] = $this->_sections['divisions']['index'] + $this->_sections['divisions']['step'];
$this->_sections['divisions']['first']      = ($this->_sections['divisions']['iteration'] == 1);
$this->_sections['divisions']['last']       = ($this->_sections['divisions']['iteration'] == $this->_sections['divisions']['total']);
?>
						
					<?php if ($this->_tpl_vars['g_aCurrentYearsDivisions'][$this->_sections['divisions']['index']]['division_name_short'] != 'S'): ?>
						<li><a href="registeredPlayers.php?iYear=<?php echo $this->_tpl_vars['g_iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['g_aCurrentYearsDivisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['g_aCurrentYearsDivisions'][$this->_sections['divisions']['index']]['division_name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a></li>
					<?php endif; ?>
				<?php endfor; endif; ?>	
				<?php if ($this->_tpl_vars['g_bSplitActive'] == true): ?>
					<li><a href="registeredPlayers.php?iYear=<?php echo $this->_tpl_vars['g_iYear']; ?>
&amp;sDivision=S"><?php echo $this->_config[0]['vars']['MENU_REGISTERED_TEAMS']; ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>	

			
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_RESULTS'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_RESULTS']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsWithResults']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<li><a href="results.php?iYear=<?php echo $this->_tpl_vars['g_aYearsWithResults'][$this->_sections['section']['index']]; ?>
"><?php echo $this->_config[0]['vars']['MENU_ITEM_RESULTS']; ?>
 <?php echo $this->_tpl_vars['g_aYearsWithResults'][$this->_sections['section']['index']]; ?>
</a></li>
			<?php endfor; endif; ?>	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STANDINGS'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_STANDINGS']; ?>
</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsAndDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($this->_config[0]['vars']['MENU_YEAR_HIDE'] != $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']): ?>
					<li><a href="#"><b><?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']; ?>
</b></a></li>
					<?php unset($this->_sections['divisions']);
$this->_sections['divisions']['name'] = 'divisions';
$this->_sections['divisions']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['divisions']['show'] = true;
$this->_sections['divisions']['max'] = $this->_sections['divisions']['loop'];
$this->_sections['divisions']['step'] = 1;
$this->_sections['divisions']['start'] = $this->_sections['divisions']['step'] > 0 ? 0 : $this->_sections['divisions']['loop']-1;
if ($this->_sections['divisions']['show']) {
    $this->_sections['divisions']['total'] = $this->_sections['divisions']['loop'];
    if ($this->_sections['divisions']['total'] == 0)
        $this->_sections['divisions']['show'] = false;
} else
    $this->_sections['divisions']['total'] = 0;
if ($this->_sections['divisions']['show']):

            for ($this->_sections['divisions']['index'] = $this->_sections['divisions']['start'], $this->_sections['divisions']['iteration'] = 1;
                 $this->_sections['divisions']['iteration'] <= $this->_sections['divisions']['total'];
                 $this->_sections['divisions']['index'] += $this->_sections['divisions']['step'], $this->_sections['divisions']['iteration']++):
$this->_sections['divisions']['rownum'] = $this->_sections['divisions']['iteration'];
$this->_sections['divisions']['index_prev'] = $this->_sections['divisions']['index'] - $this->_sections['divisions']['step'];
$this->_sections['divisions']['index_next'] = $this->_sections['divisions']['index'] + $this->_sections['divisions']['step'];
$this->_sections['divisions']['first']      = ($this->_sections['divisions']['iteration'] == 1);
$this->_sections['divisions']['last']       = ($this->_sections['divisions']['iteration'] == $this->_sections['divisions']['total']);
?>
					<li><a href="standings.php?iYear=<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
"><?php echo $this->_config[0]['vars']['MENU_ITEM_STANDINGS']; ?>
 (<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
)</a></li>
					<?php endfor; endif; ?>
		
					<?php unset($this->_sections['divisions']);
$this->_sections['divisions']['name'] = 'divisions';
$this->_sections['divisions']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['divisions']['show'] = true;
$this->_sections['divisions']['max'] = $this->_sections['divisions']['loop'];
$this->_sections['divisions']['step'] = 1;
$this->_sections['divisions']['start'] = $this->_sections['divisions']['step'] > 0 ? 0 : $this->_sections['divisions']['loop']-1;
if ($this->_sections['divisions']['show']) {
    $this->_sections['divisions']['total'] = $this->_sections['divisions']['loop'];
    if ($this->_sections['divisions']['total'] == 0)
        $this->_sections['divisions']['show'] = false;
} else
    $this->_sections['divisions']['total'] = 0;
if ($this->_sections['divisions']['show']):

            for ($this->_sections['divisions']['index'] = $this->_sections['divisions']['start'], $this->_sections['divisions']['iteration'] = 1;
                 $this->_sections['divisions']['iteration'] <= $this->_sections['divisions']['total'];
                 $this->_sections['divisions']['index'] += $this->_sections['divisions']['step'], $this->_sections['divisions']['iteration']++):
$this->_sections['divisions']['rownum'] = $this->_sections['divisions']['iteration'];
$this->_sections['divisions']['index_prev'] = $this->_sections['divisions']['index'] - $this->_sections['divisions']['step'];
$this->_sections['divisions']['index_next'] = $this->_sections['divisions']['index'] + $this->_sections['divisions']['step'];
$this->_sections['divisions']['first']      = ($this->_sections['divisions']['iteration'] == 1);
$this->_sections['divisions']['last']       = ($this->_sections['divisions']['iteration'] == $this->_sections['divisions']['total']);
?>			
						<li><a href="game.php?iYear=<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
&amp;bShowAll=true"><?php echo $this->_config[0]['vars']['MENU_GAME_STANDINGS']; ?>
 (<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
)</a></li>
					<?php endfor; endif; ?>
				<?php endif; ?>
			<?php endfor; endif; ?>
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>
	
	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_FINALS'] == true): ?>
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_FINALS']; ?>
</span><!--[if gte IE 7]><!--></a><!--			<![endif]-->			
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsWithFinals']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<li><a href="finalResults.php?iYear=<?php echo $this->_tpl_vars['g_aYearsWithFinals'][$this->_sections['section']['index']]['year']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['g_aYearsWithFinals'][$this->_sections['section']['index']]['division']; ?>
"><?php echo $this->_config[0]['vars']['MENU_FINALS']; ?>
 <?php echo $this->_tpl_vars['g_aYearsWithFinals'][$this->_sections['section']['index']]['division']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
 - <?php echo $this->_tpl_vars['g_aYearsWithFinals'][$this->_sections['section']['index']]['year']; ?>
</a></li>
			<?php endfor; endif; ?>	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>	
	<?php endif; ?>
	
	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STATS'] == true): ?>
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_CHARTS_STATS']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STATS_YEARLY'] == true): ?>
				<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsAndDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
										<?php if ($this->_config[0]['vars']['MENU_YEAR_HIDE'] != $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']): ?>
						<li><a href="statsYearly.php?iYear=<?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']; ?>
"><?php echo $this->_config[0]['vars']['MENU_CHARTS_STATS_YEARLY']; ?>
 - <?php echo $this->_tpl_vars['g_aYearsAndDivisions'][$this->_sections['section']['index']]['dty_year_for_division']; ?>
</a></li>
					<?php endif; ?>
				<?php endfor; endif; ?>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STATS_TOP_ALL_TIME'] == true || $this->_config[0]['vars']['MENU_DISPLAY_BEST_ENTRIES'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_CHARTS_STATS_ALL_YEARS_SECTION']; ?>
</b></a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STATS_TOP_ALL_TIME'] == true): ?>
				<li><a href="statsTopScores.php"><?php echo $this->_config[0]['vars']['MENU_CHARTS_STATS_TOP_ALL_TIME']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_BEST_ENTRIES'] == true): ?>
				<li><a href="statsBestEntries.php"><?php echo $this->_config[0]['vars']['MENU_CHARTS_STATS_BEST_ENTRIES']; ?>
</a></li>
			<?php endif; ?>		
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>	
	
	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_MISC'] == true): ?>	
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_MISC']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_PROMOTION'] == true): ?>
				<li><a href="promotion.php"><?php echo $this->_config[0]['vars']['MENU_PROMOTION']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_PRESS'] == true): ?>
				<li><a href="press.php"><?php echo $this->_config[0]['vars']['MENU_PRESS']; ?>
</a></li>
			<?php endif; ?>		
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_STPB'] == true): ?>
				<li><a href="stpb.php"><?php echo $this->_config[0]['vars']['MENU_STPB']; ?>
</a></li>
			<?php endif; ?>		
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_GALLERY'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_GALLERY_SECTION']; ?>
</b></a></li>
				<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['g_aYearsWithGallery']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<li><a href="gallery.php?iYear=<?php echo $this->_tpl_vars['g_aYearsWithGallery'][$this->_sections['section']['index']]; ?>
"><?php echo $this->_tpl_vars['g_aYearsWithGallery'][$this->_sections['section']['index']]; ?>
</a></li>
				<?php endfor; endif; ?>
			<?php endif; ?>

			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_SLIDE'] == true): ?>
				<?php if ($this->_config[0]['vars']['MENU_YEAR_HIDE'] == null): ?>
					<li><a href="slide.php?bStart=true&amp;iYear=<?php echo $this->_tpl_vars['g_iYear']; ?>
&amp;bTotalAndGames=true"><?php echo $this->_config[0]['vars']['MENU_SLIDE_TOTAL_AND_GAMES']; ?>
</a></li>
					<li><a href="slideTotal.php?iYear=<?php echo $this->_tpl_vars['g_iYear']; ?>
&amp;bStart=true"><?php echo $this->_config[0]['vars']['MENU_SLIDE_TOTAL']; ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>
				
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>

	<?php if ($this->_config[0]['vars']['MENU_DISPLAY_CONTACT'] == true): ?>
		<li class="top"><a href="contact.php" class="top_link"><span><?php echo $this->_config[0]['vars']['MENU_CONTACT']; ?>
</span></a></li>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['g_bIsLoggedIn'] != 'true'): ?>
		<?php if ($this->_config[0]['vars']['USE_AJAX_LOGIN'] == true): ?>
			<li class="top"><a href="javascript:Effect.toggle('login','appear');" class="top_link"><span><?php echo $this->_config[0]['vars']['MENU_LOGIN']; ?>
</span></a></li>
		<?php else: ?>
			<li class="top"><a href="login.php" class="top_link"><span><?php echo $this->_config[0]['vars']['MENU_LOGIN']; ?>
</span></a></li>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['g_aUserAdminTasks'] != null): ?>
		<li class="top"><a href="#"  class="top_link"><span class="down"><?php echo $this->_config[0]['vars']['MENU_ADMIN']; ?>
</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="sub">
			<?php if ($this->_config[0]['vars']['MENU_DISPLAY_ENTRY_REG'] == true): ?>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_ENTRY_REG']; ?>
</b></a></li>
				<li><a href="adminEntryCreateStart.php"><?php echo $this->_config[0]['vars']['MENU_RECEPTION_CREATE_ENTRY']; ?>
</a></li>
				<li><a href="adminEntryRegStart.php"><?php echo $this->_config[0]['vars']['MENU_SCOREKEEP_REG_ENTRY']; ?>
</a></li>
				<li><a href="adminVoidSplitStart.php"><?php echo $this->_config[0]['vars']['MENU_VOID_SPLIT_TEAM']; ?>
</a></li>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['g_aUserAdminTasks']['admin_uber'] == 'true'): ?>		
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_PLAYERS_TEAMS']; ?>
</b></a></li>
				<li><a href="adminEntranceFee.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_SET_PAID']; ?>
</a></li>
				<li><a href="adminEmailAddresses.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_PLAYER_EMAIL_ADDRESSES']; ?>
</a></li>
				<li><a href="adminPlayersEdit.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_EDIT_PLAYERS_TEAMS']; ?>
</a></li>
				<li><a href="adminPlayersDelete.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_DELETE_PLAYER_TEAMS']; ?>
</a></li>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_ENTRIES']; ?>
</b></a></li>
				<li><a href="adminEntryEdit.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_EDIT_ENTRY']; ?>
</a></li>
				<li><a href="adminEntriesOpen.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_OPEN_ENTRIES']; ?>
</a></li>
				<li><a href="adminEntriesDeleted.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_DELETED_ENTRIES']; ?>
</a></li>		
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_TOURNAMENT']; ?>
</b></a></li>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_GAMES_HL']; ?>
</b></a></li>
				<li><a href="adminGamesTournament.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_TOURN_GAMES']; ?>
</a></li>
				<li><a href="adminGames.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_GAMES']; ?>
</a></li>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_USERS']; ?>
</b></a></li>
				<li><a href="adminUserEdit.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_EDIT_USERS']; ?>
</a></li>
				<li><a href="adminUser.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_ADD_USERS']; ?>
</a></li>
				<li><a href="#"><b><?php echo $this->_config[0]['vars']['MENU_ADMIN_MISC']; ?>
</b></a></li>
				<li><a href="adminNews.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_NEWS']; ?>
</a></li>
				<li><a href="slideCustom.php"><?php echo $this->_config[0]['vars']['MENU_ADMIN_SLIDE_CUSTOM']; ?>
</a></li>

				<?php if ($this->_config[0]['vars']['MENU_DISPLAY_USER_ACTIVITY'] == true): ?>
					<li><a href="userActivity.php"><?php echo $this->_config[0]['vars']['MENU_USER_ACTIVITY']; ?>
</a></li>
				<?php endif; ?>				
			<?php endif; ?>	
			</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	<?php endif; ?>		
</ul>