{include file="elements/header.tpl.php" title=header}

<h2>{#CONTACT_HL#}</h2>

<h3>{#CONTACT_MAIL_LINKS#}</h3>

<a href='mailto:{#EMAIL_SO_INFO#}'>{#EMAIL_SO_INFO#}</a> - {#FOR_GENERAL_INFO#}
<br />
<a href='mailto:{#EMAIL_SO_PRESS#}'>{#EMAIL_SO_PRESS#}</a> - {#FOR_PRESS_MEDIA#}
<br />
<a href='mailto:{#EMAIL_SO_SUPPORT#}'>{#EMAIL_SO_SUPPORT#}</a> - {#IF_YOU_HAVE_PROBLEMS_WITH_THE_SITE#}

<h3>{#TELEPHONE#}</h3>
{eval var=#CONTACT_TELEPHONE_INFO#}

<h3>{#SNAIL_MAIL#}</h3>
{eval var=#CONTACT_SNAIL_INFO#}

{include file="elements/footer.tpl.php" title=footer}