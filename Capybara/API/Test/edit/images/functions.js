window.addEvent('domready', function() {
	var ajax=new Request.HTML({'url':'images/imageForm.php',update:'imageFormContents',onSuccess:function(){
		//Ajax finished loading. Remove ajax spinner
		$('imageFormContents').removeClass('ajaxLoading');
		//Remember what the original values where to track changes
		//saveInitialValues();
		//Convert JSON of object (if it exists) into object and store it on form
		if($('objectJSON')!=null) {
			$('imageForm').store('object',JSON.decode($('objectJSON').get('html')));
			$('objectJSON').dispose();
		}
		//Remove request from list of pending requests
		//ajaxRequests.erase(formUrl);
		//Update status if a message was sent
	}}).get();	
});