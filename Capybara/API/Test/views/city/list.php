<table>
	<?php 
		foreach($model as $city) {
			$country=$city->getCountry()->name;
			print "<tr><td>$city->name</td><td>$country</td><tr>";
		}
	?>
</table>