function initImagePicker(object,imageList,imageContainer) {
	if(object.getElement('.addPicture')!=null) {
		var acc=new Fx.Accordion($$('.uploadPicture'),$$('.uploadPictureRow'),{'display':-1});
		//acc.addSection(object.getElement('.addPicture'),object.getElement('.addPictureRow'));
		acc.addSection(object.getElement('.uploadPicture'),object.getElement('.uploadPictureRow'));
	}
	/*
	window.addEvent('imageuploadcomplete',function(id) {
		$(onCompleteContainer).empty();
		$(onCompleteContainer).addClass('ajaxLoading');
		var ajax=new Request.HTML({'url':onCompleteAjax,onSuccess:function(tree,els,html){
			$(onCompleteContainer).adopt(els);
			$(onCompleteContainer).removeClass('ajaxLoading');
		}}).get({'id':});
	});
	*/
	window.addEvent('imageuploadcomplete',function(id) {
		if(imageList!=null && $('documentBody').hasChild(imageList)) {
			imageList.addImage('common/getFile.php?id='+id+'&width='+thumbnailWidth+'&height='+thumbnailHeight+'&maxWidth='+thumbnailWidth+'&maxHeight='+thumbnailHeight,id);
		}
		if(imageContainer!=null && $('documentBody').hasChild(imageContainer)) {
			var img=new Element('img',{src:'common/getFile.php?id='+id+'&thumbnail&width='+thumbnailWidth+'&height='+thumbnailHeight+'&maxWidth='+thumbnailWidth+'&maxHeight='+thumbnailHeight});
			var input=new Element('input',{'type':'hidden','value':id});
			imageContainer.empty();
			imageContainer.adopt(img);
			imageContainer.adopt(input);
		}
	});
	
}