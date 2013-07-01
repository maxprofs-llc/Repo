<?php
	require_once('simple_html_dom.php');

	// Given a valid IFPA player id, returns player rank, eg. "180".
	// Returns "-1" given an invalid id.
	function get_rank_from_id($id)
	{
		// url player id search pattern
		// http://www.ifpapinball.com/player.php?player_id=9042
		$url = 'http://www.ifpapinball.com/player.php';

		$query = "player_id=" . urlencode($id);

		$full = $url . "?" . $query;
		$html = file_get_html($full);

		// This magic search id is the div containing player rank
		$magic = "#sidebar-content-wrap";
		$raw = $html->find($magic, 0)->find('td', 1)->plaintext;

		$rank = "-1";
		$ranked_player = array();

		$pos = stripos($raw, "not ranked");
		if ($pos === false)
		{
			$result = preg_match("/(?P<digit>\d+)/", $raw, $matches);
			if ($result > 0)
			{
				$rank = $matches[digit];
			}
		}

		$ranked_player = array('id' => $id, 'rank' => $rank);
		return $ranked_player;
	}

	$id = trim($_GET['id']);
	$rank = get_rank_from_id($id);
	
	echo json_encode($rank);
?>
