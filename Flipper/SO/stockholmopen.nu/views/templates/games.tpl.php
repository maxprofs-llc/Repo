{include file="elements/header.tpl.php" title=header}

<h2>{#GAMES_HL#}</h2>
{#GAMES_MAIN#}
<p>
{#GAMES_CONTRIBUTORS#}
</p>

<p>
{#GAMES_TOTAL_NUMBER#} <b>{$aGames|@count}</b>
</p>

{include file="recycled/gameList.tpl.php" title=footer}

{include file="elements/footer.tpl.php" title=footer}