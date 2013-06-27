<?php /* Smarty version 2.6.16, created on 2008-04-06 13:51:30
         compiled from elements/footer.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'elements/footer.tpl.php', 23, false),)), $this); ?>
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
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/right.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			   				</div>
			  			</div>
			 		</div>
				<div class="ft"><div class="c"></div></div>
			</div>
		</div>
	
		<div class="footer">
		<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['FOOTER']), $this);?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/activeUserInfo.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>

	<?php echo '
	<script type="text/javascript">
		function setActivity()
		{
			new Ajax.PeriodicalUpdater(\'activity\', \'ajax/setActivity.php?sPage=';  echo $this->_tpl_vars['g_sPage'];  echo '\', {asynchronous:true, frequency:';  echo $this->_config[0]['vars']['LOGIN_ACTIVITY_FREQUENCY'];  echo '});
		}
		womAdd(\'setActivity()\');
		womOn();
	</script>	
	'; ?>

		<div id='activity'>
	</div>
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
</body>
</html>