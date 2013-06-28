
function addImage(caller) {
	var win=new popupWindow('images/imageForm.php?nosave=1',{
		onOK:function() {
			this.hide();
			var list=$('imageImageList');
			list.getElement('.imageList').getElements('.selected').each(function(el) {
				var id=el.getElement('img').get('id');
				var imgId=$(id+"_id").value;
				var url='common/getFile.php?id='+imgId+'&thumbnail&width='+thumbnailWidth+'&height='+thumbnailHeight+'&maxwidth='+thumbnailWidth+'&maxheight='+thumbnailHeight;
				list.addImage(url,imgId,standardPrefix+'ImageList');
			});			
			//savePerson(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function addLogoImage(caller) {
	var win=new popupWindow('images/imageForm.php?nosave=1&single=1',{
		onOK:function() {
			this.hide();
			var list=$('imageImageList');
			var el=list.getElement('.imageList').getElement('.selected');
			var id=el.getElement('img').get('id');
			var imgId=$(id+"_id").value;
			var url='common/getFile.php?id='+imgId+'&thumbnail&width='+thumbnailWidth+'&height='+thumbnailHeight+'&maxwidth='+thumbnailWidth+'&maxheight='+thumbnailHeight;
			$(standardPrefix+'LogoImage').empty();
			var img=new Element('img',{'src':url,'alt':'','class':'thumbnail','opacity':0});
			var input=new Element('input',{'type':'hidden','value':imgId});
			$(standardPrefix+'LogoImage').adopt(img);
			$(standardPrefix+'LogoImage').adopt(input);
			img.fade('in');
			//savePerson(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();	
}

function deleteSelectedImages() {
	var list=$('imageImageList');
	list.getElement('.imageList').getElements('.selected').reverse().each(function(el) {
		var id=el.getElement('img').get('id');
		var imgId=$(id+"_id").value;
		var div=$(id+"_popup");
		ajax=new Request({'url':'images/deleteImage.php'}).get({'id':imgId});
		var td=el;
		while(td!=null) {
			td.removeClass('selected');
			if(td.getNext('td')!=null) {
				td.set('html',td.getNext('td').get('html'));
				td.removeEvents();
				td.cloneEvents(td.getNext('td'));
				td=td.getNext('td');
			} else {
				if(td.getParent('tr').getNext('tr')!=null && td.getParent('tr').getNext('tr').getFirst('td')!=null) {
					td.set('html',td.getParent('tr').getNext('tr').getFirst('td').get('html'));
					td.removeEvents();
					td.cloneEvents(td.getParent('tr').getNext('tr').getFirst('td'));
					td=td.getParent('tr').getNext('tr').getFirst('td');
				}
				else {
					if(td.getParent().getChildren().length==0)
						td.getParent().dispose();
					td.dispose();
					td=null;
					if(div!=null)
						div.dispose();
				}
			}
		}		
	});	
}