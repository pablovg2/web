var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

function jsddm_open()
{	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = jQuery(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}




jQuery(document).ready(function(){
	
	// Menu
	jQuery('#navbar ul > li').bind('mouseover', jsddm_open);
	jQuery('#navbar ul > li').bind('mouseout',  jsddm_timer);
	// Slider
	if(jQuery('#slider').length>0) {
		jQuery('#slider').galleryView({
			panel_width: 500,
		    panel_height: 300,
		    show_filmstrip: false,
		    show_overlays: true
		});
	}
	
	if(jQuery('.slider-content').length>0) {
		var buttons = { previous:jQuery('.slider-content .slider-previous') , next:jQuery('.slider-content .slider-next') };
				
		$obj = jQuery('.slider-content').lofJSidernews( { interval : 4000,
										wapperSelector	: '.slider-main-wapper',
										direction		: 'right',	
									 	//easing			: 'easeOutBounce',
										easing			: 'easeInOutExpo', 
										duration		: 1200,
										auto		 	: true,
										maxItemDisplay	: 100, 
										isPreloaded		: false,
										mainWidth:500,
										buttons			: buttons} );
		
		jQuery('.slider-main-outer').mouseenter(function(){ 
			jQuery('.slider-next').addClass('icon');
			jQuery('.slider-previous').addClass('icon');
		});
		
		jQuery('.slider-main-outer').mouseleave(function(){ 
			jQuery('.slider-next').removeClass('icon');
			jQuery('.slider-previous').removeClass('icon');
		});
	}
});
document.onclick = jsddm_close;