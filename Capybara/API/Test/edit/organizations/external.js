
function addOrganization(caller,org) {
	var win=new popupWindow('organizations/organizationForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('organization',function(object) {
					var json=new Request.JSON({'url':'organizations/organizationJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveOrganization(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}


function saveOrganization(onComplete,args) {
	var organization=new Object();
	if($('selectOrganization')!=null)
		organization.id=$('selectOrganization').value;
	else
		organization.id=-1;
	organization.nativeName=$('organizationNativeName').value;
	organization.nativeFullName=$('organizationNativeFullName').value;
	organization.nativeNickName=$('organizationNativeNickName').value;
	organization.nativeShortName=$('organizationNativeShortName').value;
	organization.nativeSortName=$('organizationNativeSortName').value;
	organization.parentOrganizationId=$('organizationParentOrganization_id').value;
	organization.foundingDate=$('organizationFoundingDate').value;
	organization.cessationDate=$('organizationCessationDate').value;
	organization.logoFileId=$('organizationLogoImage').getElement('input').value;
	organization.privateComment=$('organizationPrivateComment').getElement('textarea').value;

	organization.cityId=$('organizationCity_id').value;
	organization.stateId=$('organizationState_id').value;
	organization.countryId=$('organizationCountry_id').value;
	organization.continentId=$('organizationContinent_id').value;
	organization.streetName=$('organizationStreet').value;
	organization.streetNumber=$('organizationStreetNumber').value;
	organization.zipCode=$('organizationZipCode').value;
	organization.zipArea=$('organizationZipArea').value;
	var pos=$('organizationMap').retrieve('marker').getPosition();
	if($('organizationMap_lat').value!=pos.lat())
		organization.latitude=pos.lat();
	if($('organizationMap_long').value!=pos.lng())
		organization.longitude=pos.lng();
	
	organization.strings=new Array();
	$('organizationNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var fullName=$('organizationFullNames_'+lang).value;
		var nickName=$('organizationNickNames_'+lang).value;
		var shortName=$('organizationShortNames_'+lang).value;
		var sortName=$('organizationSortNames_'+lang).value;
		var url=$('organizationHomepage_'+lang).value;
		var comment=$('organizationPublicComment_'+lang).value;
		organization.strings.push({'languageId':langId,'name':name,'fullName':fullName,'nickName':nickName,'shortName':shortName,'sortName':sortName,'url':url,'publicComment':comment,'organizationId':organization.id});	
	});
	var ajax=new Request.JSON({url:'organizations/saveOrganization.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(organization.id==-1) {
				$('selectOrganization').adopt(new Element('option',{'value':result.id,'html':result._name}));
			}
			$('organizationSaveStatus').set('html',result.statusMsg);
			$('selectOrganization').value=result.id;
			$('selectOrganization').fireEvent('change',{target:$('selectOrganization'),message:result.statusMsg});
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(organization);	
}