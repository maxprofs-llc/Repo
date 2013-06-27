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
							{include file="elements/right.tpl.php"}
			   				</div>
			  			</div>
			 		</div>
				<div class="ft"><div class="c"></div></div>
			</div>
		</div>
	
		<div class="footer">
		{eval var=#FOOTER#}
		{include file="elements/activeUserInfo.tpl.php"}
		</div>
	</div>

	{literal}
	<script type="text/javascript">
		function setActivity()
		{
			new Ajax.PeriodicalUpdater('activity', 'ajax/setActivity.php?sPage={/literal}{$g_sPage}{literal}', {asynchronous:true, frequency:{/literal}{#LOGIN_ACTIVITY_FREQUENCY#}{literal}});
		}
		womAdd('setActivity()');
		womOn();
	</script>	
	{/literal}
	{* THIS IS USED TO UPDATE THE LAST TIME THE USER WAS ACTIVE *}
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
  
  {literal} 
  <script type="text/javascript">
    var gPlusOptions = {
      contenturl: 'https://www.stockholmopen.nu/social.php',
      contentdeeplinkid: '/pages',
      clientid: '414875301039.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      prefilltext: 'Create your Google+ Page too!',
      calltoactionlabel: 'CREATE',
      calltoactionurl: 'http://plus.google.com/pages/create',
      calltoactiondeeplinkid: '/pages/create'
    };
    
    (function() {
      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
      po.src = 'https://apis.google.com/js/plusone.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
  </script>
  
  <script type="text/javascript">
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=617666601585599";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '617666601585599',                        // App ID from the app dashboard
        channelUrl : '//www.stockholmopen.nu/channel.html', // Channel file for x-domain comms
        status     : true,                                 // Check Facebook Login status
        xfbml      : true                                  // Look for social plugins on the page
      });
    }
  </script>
  
  <script type="text/javascript">
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
  </script>
  {/literal} 
  
	
</body>
</html>
