function addTeam(caller,team) {
	var win=new popupWindow('teams/teamForm.php?nosave=1'+(team!=undefined?'&id='+team:''),{
		onOK:function() {
			this.hide();
			if(team!=undefined)
				fetchFromMasterDatabase('team',function(object) {
					var json=new Request.JSON({'url':'teams/teamJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveTeam(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}

function saveTeam(onComplete,args) {
	var team=new Object();
	if($('selectTeam')!=null)
		team.id=$('selectTeam').value;
	else
		team.id=-1;
	team.nativeName=$('teamNativeName').value;
	team.nativeFullName=$('teamNativeFullName').value;
	team.nativeNickName=$('teamNativeNickName').value;
	team.nativeShortName=$('teamNativeShortName').value;
	team.nativeSortName=$('teamNativeSortName').value;
	team.organizationId=$('teamOrganization_id').value;
	team.homeArenaId=$('teamArena_id').value;
	team.sportId=$('teamSport_id').value;
	team.genderId=$('teamGender_id').value;
	team.sectionId=$('teamSection_id').value;
	team.cohortId=$('teamCohort_id').value;
	team.ageGroupId=$('teamAgeGroup_id').value;
	team.foundingDate=$('teamFoundingDate').value;
	team.cessationDate=$('teamCessationDate').value;
	team.privateComment=$('teamPrivateComment').getElement('textarea').value;
	team.logoFileId=$('teamLogoImage').getElement('input').value;

	team.cityId=$('teamCity_id').value;
	team.stateId=$('teamState_id').value;
	team.countryId=$('teamCountry_id').value;
	team.continentId=$('teamContinent_id').value;
	var pos=$('teamMap').retrieve('marker').getPosition();
	if($('teamMap_lat').value!=pos.lat())
		team.latitude=pos.lat();
	if($('teamMap_long').value!=pos.lng())
		team.longitude=pos.lng();
	
	team.strings=new Array();
	$('teamNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var fullName=$('teamFullNames_'+lang).value;
		var nickName=$('teamNickNames_'+lang).value;
		var shortName=$('teamShortNames_'+lang).value;
		var sortName=$('teamSortNames_'+lang).value;
		var url=$('teamHomepage_'+lang).value;
		var comment=$('teamPublicComment_'+lang).value;
		team.strings.push({'languageId':langId,'name':name,'fullName':fullName,'nickName':nickName,'shortName':shortName,'sortName':sortName,'url':url,'publicComment':comment,'teamId':team.id});	
	});
	var ajax=new Request.JSON({url:'teams/saveTeam.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(team.id==-1) {
				$('selectTeam').adopt(new Element('option',{'value':result.id,'html':result._name}));
			}
			$('teamSaveStatus').set('html',result.statusMsg);
			$('selectTeam').value=result.id;
			$('selectTeam').fireEvent('change',{target:$('selectTeam'),message:result.statusMsg});
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(team);	
}

function removeImageLinkToSelected() {
	var list=$('teamImageList');
	list.getElement('.imageList').getElements('.selected').reverse().each(function(el) {
		var id=el.getElement('img').get('id');
		var imgId=$(id+"_id").value;
		var div=$(id+"_popup");
		ajax=new Request({'url':'images/removeImage.php'}).get({'id':imgId});
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
	if(typeof console != 'undefined') console.log(list.getElement('.thumbnail'));
	if(list.getElement('.thumbnail')==null) {
		if(list.getElement('.imageList').getElement('tr')!=null)
			list.getElement('.imageList').getElement('tr').dispose();
		tr=new Element('tr');
		td=new Element('td',{'html':translate('No_images')});
		tr.adopt(td);
		list.getElement('.imageList').adopt(tr);
	} 
}