
function initNote(text,object) {
	object.addEvent('mouseover',function(e) {
		var div=new Element('div',{'html':text,'fade':'hide','id':object.get('id')+'_tooltip'});;
		div.set('styles', {'position':'absolute'});
		div.setPosition({x:e.page.x+5,y:e.page.y+5});
		div.fade('show');
		div.inject('documentBody','top');
	});
	object.addEvent('mouseout',function(e) {
		var div=$(object.get('id')+'_tooltip');
		var myFx = new Fx.Tween(div, {property: 'opacity'});
		myFx.start(1,0).chain(function() {
			div.dispose();
		});
	});
}