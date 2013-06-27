<input id='sUsername' name="sUsername" size='11' maxlength='64' type='text' class='{#INPUT_DEFAULT_CLASS#}' value='{#USERNAME#}' {literal}onfocus="clearInput('sUsername')"{/literal}/> 
<input id='sPassword' name="sPassword" size='11' maxlength='64' type='password' class='{#INPUT_DEFAULT_CLASS#}' value='{#PASSWORD#}' {literal}onfocus="clearInput('sPassword')"{/literal}/>
<input name='sRedirect' type='hidden' value='{$g_sPage}' />
<input type='submit' value='{#SUBMIT#}' class='{#INPUT_SUBMIT_DEFAULT#}' />