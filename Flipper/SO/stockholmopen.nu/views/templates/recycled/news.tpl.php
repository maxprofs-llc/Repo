{section name=section loop=$aNews}
<h3 class='news'>{#POSTED#} {$aNews[section].news_date|truncate:16:"":true} {#BY#}  {$aNews[section].user_firstname}</h3>
<br />
{$aNews[section].news_text|nl2br}
{/section}