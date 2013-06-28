<?php
	class html_html {
		
		function addEntity($htmlEntity) {
			print $htmlEntity->printHTML();
		}
		
		function startContents() {
			print '<div id="siteContents">';
		}
		
		function endContents() {
			print '</div>';
		}
	}
?>