function initBox(box,options) {
	box.store('options',box.get('html'));
	box.store('mustInclude',box.getElements('option.mustInclude'));
	box.addEvent('mousedown',function() {
		var saveSelected=box.getSelected().get('value');
		var optionJSON=JSON.decode(options);
		var mustInclude=box.retrieve('mustInclude');
		var included=new Array();
		box.empty();
		box.set('html',box.retrieve('options'));
		box.getElements('option.autoUpdate').dispose();
		$$(optionJSON.updateClass).each(function(el){
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
				if(!optionJSON.unique)
					return false;
				return opt.value==value;
			}).length==0) {
				var opt=new Element('option',{'value':value,'html':text});
				if(saveSelected==opt.value)
					opt.selected=true;				
				box.adopt(opt);
				if(mustInclude.map(function(opt){ opt.value; }).contains(value))
					included.push(value);
			}
		});
		if(mustInclude.length!=included.length) 
			mustInclude.each(function(opt){
				if(!included.contains(opt.value))
					box.adopt(opt);
			});
		box.value=saveSelected;
	});
}