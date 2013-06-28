function initBox(box,options) {
	box.addEvent('mousedown',function() {
		var saveSelected=box.getSelected().get('value');
		box.empty();
		$$(JSON.decode(options).updateClass).each(function(el){
			var text;
			var value;
			if(el.hasClass('searchBox')) {
				var id=el.get('id');
				value=$(id+"_id").value;
				text=$(id+"_value").value;
			} else if (el.get('tag')=='input') {
				value=el.value;
				text=el.value;
			} else if (el.get('tag')=='select') {
				var list=el.getSelected();
				for(var i=0;i<list.length;i++) {
					value=list[i].value;
					text=list[i].get('html');
				}
			}
			if(box.getElements('option').filter(function(opt) {
				return opt.value==value;
			}).length==0) {
				var opt=new Element('option',{'value':value,'html':text});
				console.log(saveSelected);
				console.log(opt.value);
				if(saveSelected==opt.value)
					opt.selected=true;
				box.adopt(opt);
			}
		});
		
	});
}