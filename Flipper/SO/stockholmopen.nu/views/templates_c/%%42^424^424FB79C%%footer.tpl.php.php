<?php /* Smarty version 2.6.16, created on 2013-06-18 02:43:54
         compiled from elements/footer.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'elements/footer.tpl.php', 30, false),)), $this); ?>
                  <div id="share">
                    <fb:like href="https://www.facebook.com/StockholmOpen" type="button_count" id="fb-like">
                    </fb:like>
                    <fb:share-button type="button_count" id="fb-share">
                    </fb:share-button>
                    <g:plus action="share" annotation="bubble"></g:plus>
                  </div>
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

	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-1150720-1");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
  
  <?php echo ' 
  <script type="text/javascript">
    var gPlusOptions = {
      contenturl: \'https://www.stockholmopen.nu/social.php\',
      contentdeeplinkid: \'/pages\',
      clientid: \'414875301039.apps.googleusercontent.com\',
      cookiepolicy: \'single_host_origin\',
      prefilltext: \'Create your Google+ Page too!\',
      calltoactionlabel: \'CREATE\',
      calltoactionurl: \'http://plus.google.com/pages/create\',
      calltoactiondeeplinkid: \'/pages/create\'
    };
    
    (function() {
      var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
      po.src = \'https://apis.google.com/js/plusone.js\';
      var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
    })();
  </script>
  
  <script type="text/javascript">
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=617666601585599";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, \'script\', \'facebook-jssdk\'));
    window.fbAsyncInit = function() {
      FB.init({
        appId      : \'617666601585599\',                        // App ID from the app dashboard
        channelUrl : \'//www.stockholmopen.nu/channel.html\', // Channel file for x-domain comms
        status     : true,                                 // Check Facebook Login status
        xfbml      : true                                  // Look for social plugins on the page
      });
    }
  </script>
  
  <script type="text/javascript">
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
  </script>
  '; ?>
 
  
	
</body>
</html>