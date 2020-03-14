;(function($){
/**
 * author  Zhao Zahng <zozhang@gmail.com>
 */

//create body laery
$.createLayer = function (options,callback) {
			 var self = this;
			 //defautl settings
			 self.defaults = {
					 id:'layerContent',
					 layerId:'layer',
					 closeId:'layerClose',
					 layerContId: 'layerContainer',
					 layerOpacityId:'layerOpacity',
					 width:500,
					 height:450,
					 top:0,
					 opacity:'0.5',
					 zIndex:1,
					 backgroundColor:'#333'
			  };

       settings = $.extend({}, self.defaults, options || {});

			 var html,isIE6,
					 top					   =   settings.top,
					 width		       =   settings.width,
					 height					 =   settings.height,
					 opacity				 =   settings.opacity,
					 zIndex					 =   settings.zIndex,
					 bgColor				 =   settings.backgroundColor,
					 layerId			   =   '#' + settings.layerId,
					 layerCloseId		 =   '#' + settings.closeId,
					 layerContId	   =   '#' + settings.id,
					 layerOpacityId  =   '#' + settings.layerOpacityId,
					 layerContainerId  = '#' + settings.layerContId

					 if (!callback && $.isArray(options)) callback = function() {};
					 //if browser is ie6
					 if ($.browser.msie && $.browser.version == '6.0') isIE6 = true;

					 html = '<div id="' + settings.layerOpacityId + '"></div><div id="' + settings.layerId + '"><div id="' + settings.layerContId + '"><div id="'+ settings.closeId +'"></div><div id="' + settings.id + '"></div></div></div>';

					 $('body').prepend(html);
						
					 //set laery styles 
					 $(layerOpacityId).css({
						 width	  : '100%' ,
						 height   : '100%' ,
						 position : true == isIE6 ? 'absolute' :'fixed',
						 left     : 0,
						 top      : 0,
						 margin   : 0,
						 padding  : 0,
						 border   : 'none',
						 opacity  : opacity,
						 zIndex   : zIndex ,
						 backgroundColor: bgColor
					 });
						
					 $(layerId).css({
						 width	  : '100%',
						 height	  : '100%',
						 margin   : 0,
						 padding  : 0,
						 left     : 0,
						 top      : 0,
						 border   : 'none',
						 position : true == isIE6 ? 'absolute' :'fixed',
						 zIndex		: ++zIndex ,
						 textAlign: 'center'
					 });

					 $(layerContainerId).css({
						 top			: top,
						 width		: width,
						 height		: height,
						 margin		: '0 auto',
						 zIndex   : ++zIndex,
						 position	: 'relative'
					 });

					 $(layerContId).css({
						 width    : width,
						 height   : height
					 });

					 $(layerCloseId).css({
						 right		: 0,
						 zIndex   : ++zIndex,
						 cursor   : 'pointer',
						 position : 'absolute'
					 });

					 //When the top is not set when the automatic horizontal / vertical center
					 if (!top)  $(layerContainerId).setElementPosition();

					 //close click event
					 $(layerCloseId).click(function(){
							//remove current layer
							 removeLayer();
					 });
					
				  //set ie6 hackcss
					if (isIE6) {
							setIe6Height();
							$(window).resize(function(){
									setIe6Height();
							});
					}
					
					//call function 
				 if ($.isFunction(options)) options(settings);
						else  callback(callback);

				function setIe6Height() {
						$(layerOpacityId).css({
								height  :  $.getPageInfo('windowHeight')
							});
				};

				function removeLayer() {
					$(layerId + ',' + layerOpacityId).empty().remove();
					if (!$(layerId).size()) return true;					 
				};

				$.removeLayer = function(callback) {
					 if (!callback) callback = function() {};
				   if (removeLayer()) callback(callback);
				}
};

 
//Set element horizontal / vertical center
$.fn.setElementPosition = function() {
   var self = $(this);
		 elementPosition();
		 //window resize/scroll run
		 $(window).resize(function(){
				elementPosition();
		 }).scroll(function(){
				elementPosition();
		 });

	 function elementPosition() {
		var pageInfo = $.getPageInfo('windowHeight');
		var elementTop  = parseInt(pageInfo/2 - self.height()/2);
	  self.css({top:elementTop});
	 }
	 return this;
 }
 
//get current page info
$.getPageInfo = function (mark) {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {	// all except Explorer
				if(document.documentElement.clientWidth) {
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight) {
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			switch(mark) {
			 case 'pageWidth':  return pageWidth; break;
			 case 'pageHeight':  return pageHeight; break;
			 case 'windowWidth':  return windowWidth; break;
			 case 'windowHeight':  return windowHeight; break;
			 default : return new Array(pageWidth,pageHeight,windowWidth,windowHeight); break;
			}
};

})(jQuery);