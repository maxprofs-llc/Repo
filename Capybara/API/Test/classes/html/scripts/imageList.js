function initImageList(listId,table,tableRowId,multiSelect) {
	var list=$(listId);
	var showRemoveLink='';
	mover=function(e) {
		var thumbnail;
		if(e.target.get('tag')=='td')
			thumbnail=e.target.getElement('.thumbnail');
		else
			thumbnail=e.target;
		var id=thumbnail.get('id');
		if($(id+'_popup')!=null) {
			$(id+'_popup').fireEvent('mouseover');
			return;
		}
		var div=new Element('div',{'opacity':'0','id':id+'_popup','class':'tooltip'});;
		var url=thumbnail.get('src');
		if(url.indexOf('&thumbnail')>0)
			url=url.substring(0,url.indexOf('&thumbnail'));
		var img=new Element('img',{src:url,'border':0});
		if($(id+'_id')==null) {
			if(typeof console != 'undefined') console.log(div);
			if(typeof console != 'undefined') console.log(id);
			if(typeof console != 'undefined') console.log(img);
			if(typeof console != 'undefined') console.log(thumbnail);
			return;
		}
		var imgId=$(id+"_id").value;
		div.adopt(img);
		div.set('styles', {'position':'absolute'});
		div.setPosition({x:e.page.x+5,y:e.page.y+5});
		highestZ=0;
		$$('.fillUp').each(function (el) {
			if(el.getStyle('z-index')>highestZ)
				highestZ=el.getStyle('z-index');
		});	
		$$('.searchBoxList').each(function (el) {
			if(el.getStyle('z-index')>highestZ)
				highestZ=el.getStyle('z-index');
		});	
		div.setStyle('z-index',parseInt(highestZ));
		
		div.inject('documentBody','bottom');
		div.fade('show');
	};
	mout=function(e) {
		var thumbnail;
		if(e.target.get('tag')=='td')
			thumbnail=e.target.getElement('.thumbnail');
		else
			thumbnail=e.target;
		var div=$(thumbnail.get('id')+'_popup');
		var myFx = new Fx.Tween(div, {property: 'opacity',onStart:function() {
		},
		onComplete:function() {
			div.dispose();
		}});
		div.addEvent('mouseover',function(e) {
			myFx.cancel();
			div.set('opacity','1');
		});			
		div.addEvent('mouseout',function(e) {
			myFx.start(1,0);
		});
		if(div!=null)
			myFx.start(1,0);
	};
	var mclick=function(e) {
		var selTd;
		if(e.target.get('tag')=='td')
			selTd=e.target;
		else
			selTd=e.target.getParent('td');
		if(multiSelect)
			selTd.toggleClass('selected');
		else {
			selTd.getParent('table').getElements('td.selected').each(function(el) {
				el.removeClass('selected');
			});
			selTd.addClass('selected');
		}
	};
	list.getElement('.imageList').getElements('img').each(function(object) {
		object.getParent('td').addEvent('mouseover',mover);
		object.getParent('td').addEvent('mouseout',mout);
		object.getParent('td').addEvent('click',mclick);
	});
	list.addImage=function(url,id,targetListId) {
		if(targetListId!=null)
			list=$(targetListId);
		var columns=list.getElement('input[name="columns"]').value;
		var tr=list.getElement('.imageList').getElements('tr:last-child');
		if(tr.getChildren('td')[0].length==columns) {
			tr=new Element('tr');
			list.getElement('.imageList').adopt(tr);
		}
		if(tr.getFirst('td')!=null && ((tr.getFirst('td').$family='array') || tr.getFirst('td').getElement('img')==null)) {
			if(tr.getFirst('td').$family='array')
				tr.getFirst('td').each(function(el) {
					if(el!=null && el.getElement('img')==null) {
						el.dispose();
					}
				});
			else
				tr.getFirst('td').dispose();
		}
		var td=new Element('td');
		td.addEvent('mouseover',mover);
		td.addEvent('mouseout',mout);
		td.addEvent('click',mclick);
		x=1;
		while($('newImage'+x)!=null) {
			x+=1;
		}
		var _id='newImage'+x;
		var img=new Element('img',{'src':url,'alt':'','class':'thumbnail','id':_id,'opacity':0});
		tr.adopt(td);
		td.adopt(img);
		td.setStyle('padding','0px');
		td.addClass('ajaxLoading');
		if(table=='' && typeof(window['databaseTable'])!='undefined')
			table=databaseTable;
		if(table!='') {
			if(tableRowId==0)
				tableRowId=$(mainSelect).value;
			var ajax=new Request.JSON({'url':'images/saveImage.php','noCache':true,onSuccess:function(imgObject) {
				var input=new Element('input',{'type':'hidden','value':imgObject.id,'id':_id+'_id'})
				td.setStyle('padding','');
				td.removeClass('ajaxLoading');
				td.adopt(input);
				img.fade('in');
			}}).get({'table':table,'rowId':tableRowId,'imageId':id});
		} else {
			var input=new Element('input',{'type':'hidden','value':id,'id':_id+'_id'})
			td.setStyle('padding','');
			td.removeClass('ajaxLoading');
			td.adopt(input);
			img.fade('in');		
		}
	};
}
