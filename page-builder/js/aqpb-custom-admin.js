jQuery(document).ready(function($) {

	jQuery( "ul.blocks" ).bind( "sortstop", function(event, ui) {
		if (ui.item.hasClass('ui-draggable-dragging')) {
			//remove fixed item height
		    ui.item.css({
		    	'height' : ''
		    });		 
		}
	});	
	
});