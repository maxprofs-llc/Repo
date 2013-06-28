<?php
	class pages_standardPage extends pages_page {
		
		function __construct() {
			parent::__construct();
			$head=new html_head();
			$head->addStyleSheet("/handboll/aik-main.css");
			$head->addStyleSheet("/handboll/aik-text.css");
			$head->addStyleSheet("/handboll/aik-images.css");
			$head->addStyleSheet("/handboll/aik-tables.css");
			$head->addStyleSheet("css/statistik.css");
			$head->addJavascript("/script/browser.js");
			$head->addJavascript("/script/ajax.js");
			$head->title="AIK Statistikdatabas";
			$this->head=$head;
			
			$topmenu=new html_ul();
			$topmenu->addEntity(new html_li('<a class="link" href="http://www.aik.se">Startsida</a>'));
			$topmenu->addEntity(new html_li('<img src="/aikGif/pil.gif" alt="&gt;" /><a class="link" href="http://www.aikfotboll.se">Fotboll</a>'));
			$topmenu->addEntity(new html_li('<img src="/aikGif/pil.gif" alt="&gt;" /><a class="link" href="http://www.aik.se/fotboll/statistik">Statistik</a>'));
			$this->topmenu=$topmenu;
			
			$rightmenu=new ul();
			$rightmenu->addEntity(new html_li('<a class="link" href="index.php" title="Startsida">Startsida</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="arena.php" title="Arenor">Arenor</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="domare.php" title="Domare">Domare</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="player.php" title="Spelare">Spelare</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="matches.php" title="Matcher">Matcher</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="matchsponsor.php" title="Matchsponsorer">Matchsponsorer</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="opponent.php" title="Motst&aring;ndarlag">Motst&aring;ndarlag</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="opponent_player.php" title="Motspelare">Motspelare</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="links.php" title="Externa l&auml;nkar">Externa l&auml;nkar</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="search.php" title="S&ouml;kfunktion">S&ouml;kfunktion</a>'));
			$rightmenu->addEntity(new html_li('<a class="link" href="about.php" title="Om databasen">Om databasen</a>'));
			$this->rightmenu=$rightmenu;
			
			$contents=new html_div();
			$contents->id='siteContents';
			$this->contents=$contents;
			
		}
		
		function setMenu($menu) {
			$this->topmenu->addEntity(new html_li('<img src="/aikGif/pil.gif" alt="&gt;" />' . $menu));
		}
		
	}
?>