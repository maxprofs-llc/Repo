
function addCohort(caller,org) {
	var win=new popupWindow('cohorts/cohortForm.php?nosave=1'+(org!=undefined?'&id='+org:''),{
		onOK:function() {
			this.hide();
			if(org!=undefined)
				fetchFromMasterDatabase('cohort',function(object) {
					var json=new Request.JSON({'url':'cohorts/cohortJSON.php',onSuccess:function(result){
						setObject(caller,result);
					}}).get({'id':object.id});
				});
			else
				saveCohort(setObject,caller);
		}, 
		onCancel:function() { 
			this.hide();
	}});
	win.show();
}


function saveCohort(onComplete,args) {
	var cohort=new Object();
	if($('selectCohort')!=null)
		cohort.id=$('selectCohort').value;
	else
		cohort.id=-1;
	cohort.startDate=$('cohortStartDate').value;
	cohort.endDate=$('cohortEndDate').value;
	cohort.privateComment=$('cohortPrivateComment').getElement('textarea').value;
	cohort.strings=new Array();
	$('cohortNames').getElements('tr').each(function (tr) {
		var lang=tr.getElement('td').get('html');
		var langId=$(lang+'_id').value;
		var name=tr.getElement(':last-child').getElement('input').value;
		var comment=$('cohortPublicComment_'+lang).value;
		cohort.strings.push({'languageId':langId,'name':name,'publicComment':comment,'cohortId':cohort.id});	
	});
	var ajax=new Request.JSON({url:'cohorts/saveCohort.php',onSuccess:function(result) {
		if(onComplete==null) {
			saveInitialValues();
			if(cohort.id==-1) {
				$('selectCohort').adopt(new Element('option',{'value':result.id,'html':result._name}));
				$('selectCohort').value=result.id;
			}
		} else {
			onComplete(args,result);	
			fixSearchBoxes();
		}
	}}).post(cohort);	
}