var editWindow=new Class({
	Implements: [Options,Events],
	Privates: {
	},
    options: {
		windowDiv: $empty,
		blurDiv: $empty,
		fillUpDiv: $empty,
		text: '',
        onOK: $empty,
        onCancel: $empty
    },
    initialize: function(text,options){
		this.text=text;
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
		var windowDiv=new Element('div',{'class':'window'});
		
		centerDiv.adopt(blurDiv,windowDiv);
		fillUpDiv.adopt(centerDiv);
		fillUpDiv.inject('documentBody','top');
		
		blurDiv.fade('0.7');
		blurDiv.setStyle('height',(typeof( window.innerWidth ) == 'number')?window.innerHeight:document.documentElement.clientHeight);
		windowDiv.fade('in');
		
		var textBox=new Element('textarea',{'value':parentClass.text});
		windowDiv.adopt(new Element('p',{'html':translate('Note')+':'}));
		windowDiv.adopt(textBox);
		var okButton=new Element('button',{'html':translate('Save')});
		var cancelButton=new Element('button',{'html':translate('Cancel')});
		windowDiv.adopt(okButton,cancelButton);
		okButton.addEvent('click',function(e,ctx) {
			parentClass.text=textBox.value;
			parentClass.fireEvent('onOK');		
		});
		cancelButton.addEvent('click',function (e) {
			parentClass.fireEvent('onCancel');
		});						
		parentClass.windowDiv=windowDiv;
		parentClass.blurDiv=blurDiv;
		parentClass.fillUpDiv=fillUpDiv;
		parentClass.contents=windowDiv;			
	},
	hide: function() {
		this.windowDiv.getParent().fade('out');
		var parent=this;
		new Fx.Tween(this.blurDiv,{onComplete:function() {
			parent.fillUpDiv.dispose();																		  
		}}).start('opacity','0.7','0');					
	}
});

function initNote(text,object) {
	object.store('text',text);
	if(text=='')
		object.getElement('.editText').setStyle('opacity','0.25');
	else
		object.getElement('.editText').setStyle('opacity','1');
		
	object.addEvent('mouseover',function(e) {
		if(object.retrieve('text')!='') {
			var div=new Element('div',{'html':object.retrieve('text'),'opacity':'0','id':object.get('id')+'_tooltip','class':'tooltip'});;
			div.set('styles', {'position':'absolute'});
			div.setPosition({x:e.page.x+5,y:e.page.y+5});
			div.fade('show');
			div.inject('documentBody','top');
		}
	});
	object.addEvent('mouseout',function(e) {
		var div=$(object.get('id')+'_tooltip');
		var myFx = new Fx.Tween(div, {property: 'opacity',onStart:function() {
		},
		onComplete:function() {
			div.dispose();
		}});
		if(div!=null)
			myFx.start(1,0);
	});
	object.getElement('.editText').addEvent('click',function(e) {
		var win=new editWindow(object.retrieve('text'),{
			onOK:function() {
				this.hide();
				object.store('text',this.text);
				if(this.text=='')
					object.getElement('.editText').setStyle('opacity','0.25');
				else
					object.getElement('.editText').setStyle('opacity','1');
			}, 
			onCancel:function() { 
				this.hide();
			}
		});
		win.show();
	});
}