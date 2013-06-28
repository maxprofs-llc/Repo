// JavaScript Document

//Variable to hold running Ajax-Requests
var ajaxRequests=new Hash();
var ajaxResponses=new Hash();
var langStrings=new Hash();
var pendingSearchBoxes=new Hash();
var minimumSearchBoxLength=3;

window.setTimeout(checkLogin,1000);

//Attach to domready to update page when it is loaded
window.addEvent('domready', function() {

	fixExpanders();	
	fixTooltips();

	if(typeof mainSelect != 'undefined'){
		//Add change event to main select box
		$(mainSelect).addEvent('change',function(e) {
			//If any object on the form has been changed, prompt the user
			if(hasChanged() && $(mainSelect).value != "")
			{
				if(!confirm(changeQuestionString+"\n\n"+continueString+"?")) {
					$(mainSelect).value=$(mainSelect).retrieve('lastValue');
					e.stop();
					return;
				}
			}
			//Store the value for later when we need to know what the last value was
			$(mainSelect).store('lastValue',$(mainSelect).value);
			//Clear form contents
			$(standardPrefix+'FormContents').hide();
			$(standardPrefix+'FormContents').empty();
			$(standardPrefix+'FormContents').set('html','&nbsp;');
			//Check if a value is selected
			if(e.target.value!='') {
				//A value was selected, show Ajax spinner while loading form
				$(standardPrefix+'FormContents').addClass('ajaxLoading');
				$(standardPrefix+'FormContents').show();
				//Cancel all pending Ajax requests
				ajaxRequests.each(function(req,url) {
					ajaxRequests.erase(url);
					if(req!=null)
						req.cancel();
				});
				//Get the form through ajax
				var ajax=new Request.HTML({'url':formUrl,update:standardPrefix+'FormContents',onSuccess:function(){
					//Ajax finished loading. Remove ajax spinner
					$(standardPrefix+'FormContents').removeClass('ajaxLoading');
					//Remember what the original values where to track changes
					saveInitialValues();
					//Convert JSON of object (if it exists) into object and store it on form
					if($('objectJSON')!=null) {
						$(standardPrefix+'Form').store('object',JSON.decode($('objectJSON').get('html')));
						$('objectJSON').dispose();
					}
					//Remove request from list of pending requests
					ajaxRequests.erase(formUrl);
					//Update status if a message was sent
					if(e.message!=undefined) 
						$(standardPrefix+'SaveStatus').set('html',e.message);
				}}).get({'id':e.target.value});
				//Add request to list of pending requests
				ajaxRequests.include(formUrl,ajax);
			}
		});	
		//Resest main select box
		$(mainSelect).store('lastValue','');
		$(mainSelect).set('value','');
		var qs=window.location.search.substring(1).parseQueryString();
		if(qs.id!=null) {
			$(mainSelect).set('value',qs.id);
			$(mainSelect).fireEvent('change',{'target':$(mainSelect)});
		}
		
		/*
		var but=new Element('button',{html:'Test',onClick:'fixSearchBoxes()'});
		$("documentBody").adopt(but);
		*/
	}
});

function checkLogin() {
	var ajax=new Request.JSON({url:'security/checkLogin.php',noCache:true,onSuccess:function(response){
		if(response.status!='ok')
			showLoginScreen();
		else
			window.setTimeout(checkLogin,response.timeLeftUntilLogout*1000);			
	},onFailure:function() {
		showLoginScreen();
	}}).get();
}

function showLoginScreen() {
	var win=new popupWindow('security/loginForm.php',{
		onOK:function() {
			this.hide();
		}, 
		onCancel:function() { 
			this.hide();
		},
		onDisplay:function() {
			$('loginFormForm').set('action','');
			var win=this;
			$('loginFormForm').addEvent('submit',function(){
				var ajax=new Request.JSON({url:'security/checkLogin.php',async:false,onSuccess:function(result){
					if(result.status=='ok') {
						win.hide();
						checkLogin();
					} else {
						if($('loginStatus')==null) {
							var tr=new Element('tr');
							var td=new Element('td',{'colspan':2});
							var span=new Element('span',{'class':'error','id':'loginStatus'});
							td.adopt(span);
							tr.adopt(td);
							tr.inject($('loginButton').getParent('tr'),'before');
						}
						$('loginStatus').set('html',result.status);
					}
				}}).post({'loginUsername':$('loginUsername').value,'loginPassword':$('loginPassword').value});
				return false;
			});
		}
	});
	win.showButtons=false;
	win.show();	
}

//Event to warn user if the page is changed with unsaved content
window.onbeforeunload=function() {
	if(hasChanged() && $(mainSelect).value != "")
	{
		return changeQuestionString;
	}	
};

//Save all values of the form to track changes
function saveInitialValues() {
	//Iterate through all inputs, selects and textareas
	$$('#'+standardPrefix+'FormContents input,#'+standardPrefix+'FormContents select,#'+standardPrefix+'FormContents textarea').each(function(el) {
		//Check that change tracking is not disabled for this element
		if(!el.hasClass('noChangeTrack'))
			el.store('initialValue',el.value);
	});	
}

//Check if any element has changed
function hasChanged() {
	var changed=false;
	$$('#'+standardPrefix+'FormContents select,#'+standardPrefix+'FormContents input,#'+standardPrefix+'FormContents textarea').each(function(el) {
		//Check that change tracking is not disabled for this element
		if(!el.hasClass('noChangeTrack') && el.getParent('.mapViewport')==null) {
			//Check if value has changed
			if(el.value!=el.retrieve('initialValue')) {
				changed=true;
			}
		}
	});
	return changed;
}

//Class change needed for window class
Class.Mutators.Privates = function(self, privates) {
	delete self['Privates'];
	var oldInit = self.initialize;
	self.initialize = function() {
		var tempThis = $unlink(this);
		var instPriv = $unlink(privates);
		var instance = oldInit.apply(tempThis,arguments);
		for(var prop in tempThis) {
			if(instPriv.hasOwnProperty(prop)) {
				instPriv[prop] = tempThis[prop];
			} else  {
				this[prop] = tempThis[prop];
			}
		}
		var that = this;
		for(var key in tempThis) {		
			if($type(tempThis[key]) === 'function' && key !== 'initialize') {
				(function (fn) {
					var oldProp = that[key];					
					that[fn] = function() {
						var my = $merge(that, instPriv);
						var bound = oldProp.bind(my,arguments);
						var returns = bound();
						for(var prop in my) {
							if(instPriv.hasOwnProperty(prop) && $type(instPriv[prop] !== 'function')) {
								instPriv[prop] = my[prop];
							} else  {
								that[prop] = my[prop];
							}						
						}
						return returns;						
					};
				})(key);			
			}
		}
		return instance;
	};	
	return self;
};

//Setup all expanders
function fixExpanders() {
	//Iterate through all expander elements
	$$('.expander').each(function(el) {
		//Get id of expander
		var id=el.id;
		//Get id of expander contents div
		var contid=el.get('id').replace('_expander','');
		//Check if this expander was expanded before and should be so now
		if(window.retrieve(el.get('id'))) {
			//Set as expanded
			el.getElement('.expanded').setStyle('display','');
			el.getElement('.collapsed').setStyle('display','none');			
			$(contid).setStyle('display','');
		} else {
			//Set as collapsed
			el.getElement('.expanded').setStyle('display','none');
			el.getElement('.collapsed').setStyle('display','');
			$(contid).setStyle('display','none');
		}
		//Collapse expander if it is expanded
		el.getElement('.expanded').addEvent('click',function(expel) {
			collapse(el,contid);												 
		});
		//Expand expander if it is collapsed
		el.getElement('.collapsed').addEvent('click',function(expel) {
			expand(el,contid);			 
		});
	});
}

function fixDeletes() {
	$$('.delete').each(function(el) {
		el.addEvent('click',function (e) { 
			e.target.getParent().dispose();									
		});
	});
}

function fixDateFields() {
	$$('.dateField').each(function(el) {
		el.addEvent('focus',function () {
			displayDatePicker(el.get('id'),el);
		});
		el.addEvent('blur',function(el) {
			window.setTimeout(hideDatePicker,200);
		});
	});
}

function createList(list,url,sBox) {
	if(sBox.getElement('.list')!=null) {
		var result=JSON.decode(sBox.getElement('.list').get('html'));
		list.store('list',result);
		updateList(list,sBox.getElement('input[type=text]').value);
		sBox.getElement('.list').dispose();
		list.getElements('.ajaxSpinner').dispose();
	} else {
		var expander=$(sBox.getParent('.expander_contents').get('id')+'_expander');
		var sbFn=function(e) {
			if(list.retrieve('list')==null) {
				var fn=function(result){
					list.store('list',result);
					txt=sBox.getElement('input[type=text]');
					if(txt!=null)
						updateList(list,txt.value);
					ajaxResponses.include(url,result);
					ajaxRequests.erase(url);
				};
				if(ajaxRequests.has(url)) {
					var req=ajaxRequests.get(url);
					req.addEvent('success',fn);
				} else {
					if(ajaxResponses.has(url))
						fn(ajaxResponses.get(url));
					else {
						var ajax=new Request.JSON({url:url,onSuccess:fn,onFailure:function(xhr){
							if(typeof console != 'undefined') console.log(xhr);
							ajaxResponses.erase(url);
							ajaxRequests.erase(url);
						}});
						ajax.get();
						ajaxRequests.include(url,ajax);
					}
				}
			}
		};
		if(sBox.hasClass('populateOnExpand'))
			expander.addEvent('expanded',sbFn);
		else
			sbFn();
	}
}

function updateAjaxList() {
}

function fixAjaxBoxes() {
	$$('.ajaxBox').each(function(el) {
		el.getElement('input[type=text]').addEvent('keyup',function(e) {
			e.stop();
			var listDiv=$(el.get('id')+"_list");
			if(listDiv==null) {
				listDiv=new Element('div',{'class':'searchBoxList','id':el.get('id')+"_list"});	
				listDiv.addEvent('click',function(e) {
					var obj=e.target.getParent().retrieve('element');
					setValue(el.get('id'),obj.id,decodeEntities(obj._name),obj);
				});
			}	
			if(listDiv.retrieve('positioned')==null) {
				listDiv.setPosition({x:el.getPosition().x,y:el.getPosition().y+el.getSize().y});
				listDiv.setStyle('width',el.getSize().x);
				listDiv.setStyle('height','100px');
				listDiv.setStyle('z-index',getHighestZ()+2);
				listDiv.store('positioned',true);
			}
			listDiv.setStyle('display','');			
			listDiv.adopt(new Element('img',{'src':'icons/ajax-loader.gif','alt':'Loading...'}));
			url=el.getElement('#'+el.get('id')+'_listURL').value;
			
			if(ajaxRequests.has(url)) {
				ajaxRequests.get(url).cancel();
				ajaxRequests.erase(url);
			}
			var ajax=new Request.JSON({'url':url,onSuccess:function(json){
				
			}}).get({search:el.getElement('input[type=text]').value});
			ajaxRequests.include(url,ajax);
		});
		el.getElement('input[type=text]').addEvent('focus',function (e) {
			e.target.fireEvent('keyup',e);
			e.target.select();
		});
		el.getElement('input[type=text]').addEvent('blur', function (e) {
			window.setTimeout(function() { 
				e.target.value=decodeEntities($(el.get('id')+'_value').value);
				listDiv.setStyle('display','none');
			},200);
			return false;
		});		
	});
}

function fixSearchBoxes(elements) {
	if(elements==undefined)
		elements=$$('.searchBox');
	else
		elements=elements.getElements('.searchBox');
	$$('.searchBox').each(function(el) {
		try {
			if(el.retrieve('fixed')!=null) {
				updateList($(el.get('id')+"_list"),el.getElement('input[type=text]').value);
				return;
			}
			var listDiv=$(el.get('id')+"_list");
			if(listDiv==null)
				listDiv=new Element('div',{'class':'searchBoxList','id':el.get('id')+"_list"});
			listDiv.erase();
			listDiv.setStyle('display','none');
			listDiv.setStyle('z-index',0);
			listDiv.adopt(new Element('img',{'src':'icons/ajax-loader.gif','alt':'Loading...','class':'ajaxSpinner'}));
			url=el.getElement('#'+el.get('id')+'_listURL').value;

			if(el.getElement('.autoUpdate')!=null) {
				el.getElements('.autoUpdate').each(function(au){
					var autoUpdate=au.getElements('span');
					var id;
					var event;
					if($(autoUpdate[0].get('html'))!=null) {
						var upd=$(autoUpdate[0].get('html'));
						if($(upd).hasClass('searchBox')) {
							id=$(upd.get('id')+"_id").value;
							event='update';
						} else {
							id=$(upd).value;
							event='change';
						}
						$(upd).addEvent(event,function(e) {
							el.store('list',null);
							el.store('fixed',null);
							listDiv.dispose();
							fixSearchBoxes(el);
						});	
						$(upd).store('autoUpdate',true);
					}
					if(autoUpdate[1].get('html')!='')
						url=url+(url.contains("?")?"&":"?")+autoUpdate[1].get('html')+"="+id;					
				});
				ajaxResponses.erase(url);
			}
			el.store('list',null);
			createList(listDiv,url,el);
			
			listDiv.addEvent('click',function(e) {
				var obj=e.target.getParent().retrieve('element');
				setValue(el.get('id'),obj.id,decodeEntities(obj._name),obj);
			});
			$('documentBody').adopt(listDiv);
			
			el.getElement('input[type=text]').addEvent('focus',function (e) {
				e.target.fireEvent('keyup',e);
				e.target.select();
			});
			el.getElement('input[type=text]').addEvent('keyup',function(e) {
				e.stop();
				var list=$(el.get('id')+"_list");
				if(list.retrieve('positioned')==null) {
					list.setPosition({x:el.getPosition().x,y:el.getPosition().y+el.getSize().y});
					list.setStyle('width',el.getSize().x);
					list.setStyle('height','100px');
					list.setStyle('z-index',getHighestZ()+2);
					list.store('positioned',true);
				}
				list.setStyle('display','');
				noUpdate=false;
				if(list.getElement('table')==null) {
					updateList(list,e.target.value);
					noUpdate=true;
				}
				switch(e.code) {
					case 13:	
						//Enter
						if(pendingSearchBoxes.has(list.get('id'))) {
							updateList(list,e.target.value);
						}
						var selEl=list.getElement('table').getElement('.selected');
						if(selEl!=null) {
							e.target.value=decodeEntities(selEl.retrieve('element')._name);
							setValue(el.get('id'),selEl.retrieve('element').id,selEl.retrieve('element')._name,selEl.retrieve('element'));
						}
						break;
					case 40:
						//Down
						var selEl=list.getElement('table').getElement('.selected');
						if(selEl!=null && selEl.getNext()!=null) {
							selEl.removeClass('selected');
							selEl.getNext().addClass('selected');
							var posy=selEl.getNext().getPosition().y+selEl.getNext().getSize().y;
							var listy=el.getPosition().y;
							if(posy>listy+list.getSize().y) {
								list.scrollTo(0,selEl.getNext().getPosition().y-list.getPosition().y);
							}
						}
						break;
					case 38:
						//Up
						var selEl=list.getElement('table').getElement('.selected');
						if(selEl!=null && selEl.getPrevious()!=null) {
							selEl.removeClass('selected');
							selEl.getPrevious().addClass('selected');
							var posy=selEl.getPrevious().getPosition().y;
							var listy=el.getPosition().y+el.getSize().y;
							if(posy<listy) {
								list.scrollTo(0,selEl.getPrevious().getPosition().y-list.getPosition().y);
							}
						}				
						break;
					default:
						list.scrollTo(0,0);
						if(!noUpdate) {
							if(pendingSearchBoxes.has(list.get('id'))) {
								window.clearTimeout(pendingSearchBoxes.get(list.get('id')));
								pendingSearchBoxes.erase(list.get('id'));
							}
							pendingSearchBoxes.include(list.get('id'),window.setTimeout(function() { 
								updateList(list,e.target.value);
							},300));
						}
				}
			});
			el.waitForUpdate=function() {
				el.getElement("input[type=text]").set('disabled','disabled');
			};
			el.updateReady=function() {
				el.getElement("input[type=text]").set('disabled','');
			};
			el.getValue=function() {
				return $(el.get('id')+"_id").value;
			};
			el.getElement('input[type=text]').addEvent('blur', function (e) {
				window.setTimeout(function() { 
					var list=$(el.get('id')+"_list");
					if(pendingSearchBoxes.has(list.get('id'))) {
						window.clearTimeout(pendingSearchBoxes.get(list.get('id')));
						pendingSearchBoxes.erase(list.get('id'));
					}
					e.target.value=decodeEntities($(el.get('id')+'_value').value);
					list.setStyle('display','none');
				},200);
				return false;
			});
			el.store('fixed',true);
		} catch(ex) {
			if(typeof console != 'undefined') console.log("Error while creating a SearchBox:")
			if(typeof console != 'undefined') console.log(ex);
		}
	});
}

function fixTooltips() {
	$$('.tooltip').each(function(el) {
		var parent=el.getParent();
		var tip=el.get('html');
		//if(typeof console != 'undefined') console.log('Fix tooltip: ');
		//if(typeof console != 'undefined') console.log(el);
		el.dispose();
		parent.addEvent('mouseover',function(e) {
			var div=new Element('div',{'html':tip,'fade':'hide','id':parent.get('id')+'_tooltip','class':'tooltip_popup'});;
			div.set('styles', {'position':'absolute'});
			div.setPosition({x:e.page.x+5,y:e.page.y+5});
			div.fade('show');
			div.inject('documentBody','top');
			parent.store('tooltip',div);
			//if(typeof console != 'undefined') console.log(parent);
		});
		parent.addEvent('mouseout',function(e) {
			var div=e.target.retrieve('tooltip');
			var myFx = new Fx.Tween(div, {property: 'opacity'});
			myFx.start(1,0).chain(function() {
				div.dispose();
			});
		});
	});
}

function setValue(searchBoxId,id,text,object,nofire) {
	if(nofire==undefined)
		nofire=false;
	var list=$(searchBoxId+"_list");
	var oldId=$(searchBoxId+'_id');
	var oldText=$(searchBoxId+'_value').value;
	$(searchBoxId+'_id').value=id;
	$(searchBoxId+'_value').value=decodeEntities(text);
	$(searchBoxId).getElement('input[type=text]').value=decodeEntities(text);
	list.setStyle('display','none');
	if(!nofire)
		$(searchBoxId).fireEvent('update',{'oldId':oldId,'oldText':oldText,'newId':id,'newText':text,'object':object});	
}

function decodeEntities(string) {
	//Ugly solution for converting &auml; and such to ascii (UTF-8) since JS does not handle entities
	var tmpEl=new Element('textarea');
	tmpEl.set('html',string);
	var retVal=tmpEl.value;
	tmpEl.destroy();
	return retVal;
}

function updateList(list,value) {
	list=$(list);
	if(pendingSearchBoxes.has(list.get('id'))) {
		pendingSearchBoxes.erase(list.get('id'));
	}
	var objList=list.retrieve('list');
	var lastValue=list.retrieve('lastValue');
	var cancel=false;
	value=value.toUpperCase().standardize();
	if(objList!=null)
	{
		var table=new Element('table');
		list.store('lastValue',value);
		if(value==lastValue) {
			return;
		}
		window.store('iterateValue',value);
		for(o=0;o<objList.length;o++) {
			obj=objList[o];
			if(obj._name.toUpperCase().standardize().contains(value)) {
				tr=new Element('tr');
				tr.adopt(new Element('td',{'html':obj._string}));
				tr.store('element',obj);
				table.grab(tr,'bottom');
			}
		};
		/*
		var a=new Element('a',{'href':'#','html':addNewString+"<br/>"});
		a.addEvent('click',function(e){
			e.stop();
			$(list.get('id').substring(0,list.get('id').indexOf('_list'))).getElement('.addButton').fireEvent('click');
		});
		var a2=new Element('a',{'href':'#','html':findInMasterString+"<br/>"});
		a2.addEvent('click',function(e){
			e.stop();
			$(list.get('id').substring(0,list.get('id').indexOf('_list'))).getElement('.addFromMasterButton').fireEvent('click');			
		});
		*/
		table.getElements(':nth-child(even)').addClass('alternate');
		if(table.getElement(':nth-child(first)')!=null)
			table.getElement(':nth-child(first)').addClass('selected');
		
		list.empty();
		list.adopt(table);
		/*
		list.adopt(a);
		list.adopt(a2);
		*/
		updating=null;
	}
}

function uploadImage(form,maxWidth,maxHeight,targetId,onCompleteAjax,onCompleteAjaxContainer) {
	var url='common/ajaxupload.php?';
	url=url+'filename=filename&';
	url=url+'maxSize=9999999999&';
	url=url+'maxW='+maxWidth+'&';
	url=url+'maxH='+maxHeight+'&';
	url=url+'colorR=255&colorG=255&colorB=255&';
	url=url+'onComplete='+onCompleteAjax+'&';
	url=url+'container='+onCompleteAjaxContainer;
	ajaxUpload(form,url,targetId); 
	return false;	
}

function getHighestZ() {
	highestZ=0;
	$$('.fillUp').each(function (el) {
		if(el.getStyle('z-index')>highestZ)
			highestZ=el.getStyle('z-index');
	});	
	$$('.searchBoxList').each(function (el) {
		if(el.getStyle('z-index')>highestZ)
			highestZ=el.getStyle('z-index');
	});	
	return parseInt(highestZ);
}

var popupWindow=new Class({
	Implements: [Options,Events],
	Privates: {
	},
    options: {
		windowDiv: $empty,
		blurDiv: $empty,
		fillUpDiv: $empty,
        onOK: $empty,
        onCancel: $empty,
        onDisplay: $empty
    },
    showButtons:true,
    initialize: function(url,options){
		this.url=url;
        this.setOptions(options);
    },
	show: function() {
		var parentClass=this;
		var highestZ=getHighestZ()+1;
		
		var fillUpDiv=new Element('div',{'class':'fillUp'});
		fillUpDiv.setStyle('z-index',highestZ+1);
		var centerDiv=new Element('div');
		centerDiv.setStyle('display','table-cell');
		centerDiv.setStyle('vertical-align','middle');
		var blurDiv=new Element('div',{'class':'blur','opacity':0});
		var windowDiv=new Element('div',{'class':'window','html':'<img src="icons/ajax-loader.gif" />'});
		
		centerDiv.adopt(blurDiv,windowDiv);
		fillUpDiv.adopt(centerDiv);
		fillUpDiv.inject('documentBody','top');
		
		blurDiv.fade('0.7');
		blurDiv.setStyle('height',window.getScrollHeight());
		//blurDiv.setStyle('height',$('documentBody').offsetHeight);
		windowDiv.fade('in');
		
		var ajax=new Request.HTML({url:this.url,onSuccess:function(tree,elements,html,js){
			windowDiv.set('html',html);
			if(parentClass.showButtons) {
				var okButton=new Element('button',{'html':addString});
				var cancelButton=new Element('button',{'html':cancelString});
				windowDiv.adopt(new Element('br'),okButton,cancelButton);
				okButton.addEvent('click',function(e,ctx) {
					parentClass.fireEvent('onOK');		
				});
				cancelButton.addEvent('click',function (e) {
					parentClass.fireEvent('onCancel');
				});
			}
			eval(js);
						
			parentClass.windowDiv=windowDiv;
			parentClass.blurDiv=blurDiv;
			parentClass.fillUpDiv=fillUpDiv;
			parentClass.contents=windowDiv;
			
			parentClass.fireEvent('onDisplay');
		}}).get();	
			
	},
	hide: function() {
		this.windowDiv.getParent().fade('out');
		var parent=this;
		new Fx.Tween(this.blurDiv,{onComplete:function() {
			parent.fillUpDiv.dispose();																		  
		}}).start('opacity','0.7','0');					
	}
});

function hideWindow(win) {
	
	/*
$('fillUp').setStyle('z-index','-1');
	$('blur').fade('out');
	$('window').hide();
	*/
}

function expand(expander,contents) {
	$(contents).setStyle('display','');
	expander.getElement('.expanded').setStyle('display','');
	expander.getElement('.collapsed').setStyle('display','none');
	window.store(expander.get('id'),true);
	expander.fireEvent('expanded');
}

function collapse(expander,contents) {
	$(contents).setStyle('display','none');
	expander.getElement('.collapsed').setStyle('display','');
	expander.getElement('.expanded').setStyle('display','none');
	window.store(expander.get('id'),false);
	expander.fireEvent('collapsed');
}

function setObject(element,object) {
	var id=element.get('id');	
	list=$(id+'_list').retrieve('list');
	if(list!=null)
		list.push(object);
	$(id+'_list').store('list',list);
	var url=$(id+'_listURL').value;
	$$('.searchBox').each(function(el){
		var listURL=$(el.get('id')+"_listURL").value;
		if(listURL==url && element!=el) {
			//list=$(el.get('id')+'_list').retrieve('list');
			//if(list!=null)
			//	list.push(object);
			$(el.get('id')+'_list').store('list',list);
		}
	});
	setValue(id,object.id,object._name,object);
}

function initMap() {
	$$('.mapContainer').each(function(el) {
		fn=function() { 
			var prefix=el.get('id');
			prefix=String(prefix).substring(0,String(prefix).length-3);
			var map;
			var marker;
			var opt;
			var lat=$(el.get('id')+'_lat').value;
			var long=$(el.get('id')+'_long').value;
			try {
				var latlng = new google.maps.LatLng(lat, long);
			} catch(e) {
				console.log("Could not init maps");
				return;
			}
			if(mapZoom==null)
				mapZoom=15;
			opt= {
				zoom:mapZoom,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map=new google.maps.Map($(el.get('id')+'_map'), opt);
			if(lat=='') {
				map.setZoom(3);
				latlng=new google.maps.LatLng(10000,10000);
			}
			marker=new google.maps.Marker({map: map});				
			el.store('map',map);
			el.store('marker',marker);
			google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(event.latLng,map,marker);
			});
			google.maps.event.addListener(marker, 'position_changed', function(event) {
				el.getElement('.mapPositionText').set('html',marker.getPosition().toUrlValue());
			});
			marker.setPosition(latlng);
			el.getElement('input[name=btnCenter]').addEvent('click',function() { 
				map.setCenter(marker.getPosition());
			});
			el.getElement('input[name=btnReset]').addEvent('click',function() { 
				marker.setPosition(latlng); 
			});			
			el.getElement('input[name=btnSearch]').addEvent('click',function() { 
				var gc=new google.maps.Geocoder();
				var name='';
				if($(prefix+'Arena')!=null) 
					name=$(prefix+'Arena').value;
				else {
					if($(prefix+'Names')!=null)
						name=$(prefix+'Names').getElement('.defaultValue').value;
				}
				var city='';
				var country='';
				var street='';
				var zip='';
				if($(prefix+'City_value')!=null)
					city=$(prefix+'City_value').value;
				if($(prefix+'Country_value')!=null)
					country=$(prefix+'Country_value').value;
				if($(prefix+'Street')!=null)				
					street=$(prefix+'Street').value+' '+$(prefix+'StreetNumber').value;
				if($(prefix+'ZipCode')!=null)
					zip=$(prefix+'ZipCode').value+' '+$(prefix+'ZipArea').value;
				var addr=name+', '+street+', '+zip+', '+city+', '+country;
				////if(typeof console != 'undefined') console.log(addr);
				gc.geocode({'address':addr},function(responseArray,responseStatus) {
					if(responseStatus=='OK') {
						////if(typeof console != 'undefined') console.log(responseArray);
						map.setCenter(responseArray[0].geometry.location);
						marker.setPosition(responseArray[0].geometry.location);
						if(responseArray[0].geometry.bounds!=null)
							map.fitBounds(responseArray[0].geometry.bounds);
						else
							map.setZoom(15);
						if($(prefix+'Street')!=null) {
							responseArray[0].address_components.each(function(comp) {
								if(comp.types.contains('street_number') && $(prefix+'StreetNumber').value=='')
									$(prefix+'StreetNumber').value=comp.long_name;
								if(comp.types.contains('route') && $(prefix+'Street').value=='')
									$(prefix+'Street').value=comp.long_name;
								if(comp.types.contains('postal_code') && $(prefix+'ZipCode').value=='')
									$(prefix+'ZipCode').value=comp.long_name;
								if(comp.types.contains('locality') && $(prefix+'ZipArea').value=='')
									$(prefix+'ZipArea').value=comp.long_name;
							});
						}
					}
				});
			});	
			if($(prefix+'Street')!=null) {
				el.getElement('input[name=btnAddress]').addEvent('click',function() { 
					var gc=new google.maps.Geocoder();
					var loc=marker.getPosition();
					gc.geocode({'latLng':loc},function(responseArray,responseStatus) {
						if(responseStatus=='OK') {
							////if(typeof console != 'undefined') console.log(responseArray);
							responseArray[0].address_components.each(function(comp) {
								if(comp.types.contains('street_number') && $(prefix+'StreetNumber').value=='')
									$(prefix+'StreetNumber').value=comp.long_name;
								if(comp.types.contains('route') && $(prefix+'Street').value=='')
									$(prefix+'Street').value=comp.long_name;
								if(comp.types.contains('postal_code') && $(prefix+'ZipCode').value=='')
									$(prefix+'ZipCode').value=comp.long_name;
								if(comp.types.contains('locality') && $(prefix+'ZipArea').value=='')
									$(prefix+'ZipArea').value=comp.long_name;
							});
						}
					});
				});
			} else {
				el.getElement('input[name=btnAddress]').setStyle('display','none');
			}

			
			//el.getElement('input[name=btnSearch]').hide();
		};			
		var expander=$(el.getParent('.expander_contents').get('id')+'_expander');
		expander.addEvent('expanded',fn);
		expander.fireEvent('expanded');
	});
}

function placeMarker(location,map,marker) {
 	var clickedLocation = new google.maps.LatLng(location);
	marker.setPosition(location);
	map.setCenter(location);
}

function updatePosition(object) {
	var obj=$(standardPrefix+'Form').retrieve('object');
	if(obj!=null && obj.longitude==null && obj.latitude==null) {
		var pos=$(standardPrefix+'Map').retrieve('marker').getPosition();
		if(($(standardPrefix+'Map_lat').value==pos.lat() || $(standardPrefix+'Map_lat').value=='') && ($(standardPrefix+'Map_long').value==pos.lng() || $(standardPrefix+'Map_long').value=='')) {
			$(standardPrefix+'Map_lat').value=object._latitude;
			$(standardPrefix+'Map_long').value=object._longitude;
			initMap();
		}
	}	
}

function addNameEvents(prefix) {
	$(prefix+'Names').getElement('.defaultValue').addEvent('change',function(e) {
		var oldName=$(prefix+'Form').getElement('p.headline').get('html');
		var newName=this.value;
		$(prefix+'Form').getElement('p.headline').set('html',newName);
		$(prefix+'Names').getElements('input[type=text]').each(function(el) {
			if(el.value=='')
				el.value=newName;
		});
		if($(prefix+'FirstNames')!=null) {
			var firstName=newName.substring(0,newName.lastIndexOf(" "));
			$(prefix+'FirstNames').getElements('input[type=text]').each(function(el) {
				if(el.value=='')
					el.value=firstName;
			});			
		}
		if($(prefix+'LastNames')!=null) {
			var lastName=newName.substring(newName.lastIndexOf(" ")+1);
			$(prefix+'LastNames').getElements('input[type=text]').each(function(el) {
				if(el.value=='')
					el.value=lastName;
			});
		}
		if($(prefix+'FullNames')!=null) 
			$(prefix+'FullNames').getElements('input[type=text]').each(function(el) {
				if(el.value=='')
					el.value=newName;
			});
		if($(prefix+'SortNames')!=null) 
			$(prefix+'SortNames').getElements('input[type=text]').each(function(el) {
				if(el.value=='')
					el.value=newName;
			});
		if($(prefix+'NativeName')!=null){
			if($(prefix+'NativeName').value=='')
				$(prefix+'NativeName').value=newName;
		}
		if($(prefix+'NativeFullName')!=null){
			if($(prefix+'NativeFullName').value=='')
				$(prefix+'NativeFullName').value=newName;
		}
		if($(prefix+'NativeSortName')!=null){
			if($(prefix+'NativeSortName').value=='')
				$(prefix+'NativeSortName').value=newName;
		}
	});
	$$('.defaultValue').each(function(el) {
		if(el.getParent('table').get('id')!=(prefix+'Names'))
			el.addEvent('change',function(e) {
				el.getParent('table').getElements('input[type=text]').each(function(inp){
					if(inp.value=='')
						inp.value=el.value;
				});
			});
	});
}

function translate(string) {
	var retVal;
	if(langStrings.has(string))
		return langStrings.get(string);
	var req=new Request({url:'lang/translate.php',async:false,onSuccess:function(translation){
		retVal=translation;
		langStrings.include(string,translation);
	}}).get({'string':string});
	return retVal;
}

function fetchFromMasterDatabase(table,onReady) {
	$('masterDatabaseList').getElements('option').each(function(el) {
		if(el.get('selected')) {
			var ajax=new Request.JSON({'url':'master/fetchObject.php',onSuccess:function(object) {
				if(object.status=="OK") {
					if(onReady==undefined) {
						var newQs = window.location.search.substring(1).cleanQueryString(function(set){
						    return !set.split("=")[0]=="id";
						});
						newQs="?"+newQs+(newQs==''?'':'&')+"id="+object.id;
						window.location.href=window.location.href.substring(0, window.location.href.indexOf(window.location.search))+newQs;
					} else {
						onReady(object);
					}
				} else {
					checkLogin();
				}
			}}).get({'table':table,'id':el.value});
		}
	});
}
