/* Sutra 2.1.1 // initializing scripts, etc */

// iphone / ipad orientation
if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) { var viewportmeta = document.querySelector('meta[name="viewport"]'); if (viewportmeta) { viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0'; document.body.addEventListener('gesturestart', function() { viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6'; }, false); } }

// initialize selectnav.min.js menu script 	
selectnav('mobile-menu'); 

jQuery( document ).ready( function( $ ) { 
	
	// remove border-bottom on last post
	jQuery(".post").last().css('border-bottom','none');
	
});