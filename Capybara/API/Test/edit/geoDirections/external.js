
function addGeoDirection(caller,geoDirection) {
	var win=new popupWindow('geoDirections/geoDirectionForm.php?nosave=1'+(geoDirection!=undefined?'&id='+geoDirection:''),{
		onOK:function() {
			this.hide();
			if(geoDirection!=undefined)
				fetchFromMasterDatabase('geoDirection',function(object) {
					var json=new Request.JSON({'url':'geoDirections/geoDirectionJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveGeoDirection(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
		},
		showButtons: false
	});
	win.show();
}

function saveGeoDirection(onComplete,args) {
	var geoDirection=new Object();
	if($('selectGeoDirection')!=null)
		geoDirection.id=$('selectGeoDirection').value;
	else
		geoDirection.id=-1;
	geoDirection.degrees=$('geoDirectionDegrees').value;
	geoDirection.strings=new Array();
	$('geoDirectionNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var shortName=$('geoDirectionShortNames_'+lang).value;
		var comment=$('geoDirectionPublicComment_'+lang).value;
		geoDirection.strings.push({'languageId':langId,'name':name,'shortName':shortName,'publicComment':comment,'geoDirectionId':geoDirection.id});	
	});
	var ajax=new Request.JSON({url:'geoDirections/saveGeoDirection.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(geoDirection.id==-1) {
				$('selectGeoDirection').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectGeoDirection').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
		$('selectGeoDirection').fireEvent('change',{target:$('selectGeoDirection'),message:result.statusMsg});
	}}).post(geoDirection);	
}