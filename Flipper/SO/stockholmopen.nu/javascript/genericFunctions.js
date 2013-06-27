function clearInput(sInputName)
{
	document.getElementById(sInputName).value = '';
}

function popup(url, width, height, top, left) 
{ 
	settings="toolbar=no,location=no,directories=no,"+"status=no,menubar=no,scrollbars=yes,"+"resizable=yes,width="+width+",height="+height+",top="+top+",left="+left+"";
	window.open(url,"popuppop",settings); 
}

function focus(sInputID)
{
	document.getElementById(sInputID).focus();
}

