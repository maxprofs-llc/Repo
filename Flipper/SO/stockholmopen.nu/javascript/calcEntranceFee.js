function calcEntranceFee()
{
	var sForm = $('form').serialize()
	new Ajax.Updater('payEntranceFee', 'ajax/payEntranceFee.php?'+sForm+"&bPosted=true");
}