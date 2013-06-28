$$('.addDimension').each(function(el) {
	el.addEvent('click',function(e) {
		var nr=table.getElements('tr').length-1;
		var tr=new Element('tr',{'class':'dimension'});
		//Add empty TD
		tr.adopt(new Element('td'));
	
		var idTD=new Element('td');
		var idInput=new Element('input',{'type':'hidden','id':standardPrefix+'DimensionId'+nr});
		idTD.adopt(idInput);
		tr.adopt(idTD);
		
		var today=new Date();
		today=today.getFullYear()+"-"+(((today.getMonth()+1) < 10 ? '0' : '') + (today.getMonth()+1))+"-"+today.getDate();
		var dateTD=new Element('td');
		var dateInput=new Element('input',{'type':'text','id':standardPrefix+'DimensionDate'+nr,'class':'dateField dimensionDate','value':today});
		dateTD.adopt(dateInput);
		tr.adopt(dateTD);
		
		var weightTD=new Element('td');
		var weightInput=new Element('input',{'type':'text','id':standardPrefix+'Weight'+nr});
		weightTD.adopt(weightInput);

		var heightTD=new Element('td');
		var heightInput=new Element('input',{'type':'text','id':standardPrefix+'Height'+nr});
		heightTD.adopt(heightInput);
		
		var depthTD=new Element('td');
		var depthInput=new Element('input',{'type':'text','id':standardPrefix+'Depth'+nr});
		depthTD.adopt(depthInput);

		var lengthTD=new Element('td');
		var lengthInput=new Element('input',{'type':'text','id':standardPrefix+'Length'+nr});
		lengthTD.adopt(lengthInput);

		var widthTD=new Element('td');
		var widthInput=new Element('input',{'type':'text','id':standardPrefix+'Width'+nr});
		widthTD.adopt(widthInput);
		
		var areaTD=new Element('td');
		var areaInput=new Element('input',{'type':'text','id':standardPrefix+'Area'+nr});
		areaTD.adopt(areaInput);

		var volumeTD=new Element('td');
		var volumeInput=new Element('input',{'type':'text','id':standardPrefix+'Volume'+nr});
		volumeTD.adopt(volumeInput);
		
		if(showWeight)
			tr.adopt(weightTD);
		if(showHeight)
			tr.adopt(heightTD);
		if(showDepth)
			tr.adopt(depthTD);
		if(showLength)
			tr.adopt(lengthTD);
		if(showWidth)
			tr.adopt(widthTD);
		if(showArea)
			tr.adopt(areaTD);
		if(showVolume)
			tr.adopt(volumeTD);
		
		tr.inject(el.getParent('tr'),'before');
		fixDateFields();
	});
	el.removeClass('addDimension');
});