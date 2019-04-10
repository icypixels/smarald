jQuery(document).ready(function($) { 

/*-----------------------------------------------------------------------------------*/
/*  Navigation
/*-----------------------------------------------------------------------------------*/	

	jQuery("nav#primary-nav ul, nav#nav ul").supersubs({
			minWidth:    15,			
			maxWidth:    35,   // maximum width of sub-menus in em units
			extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
    }).superfish({
	    delay: 700,
	    animation:     {height:'show'},   // an object equivalent to first parameter of jQuery’s .animate() method. Used to animate the sub-menu open
		animationOut:  {height:'hide'},   // an object equivalent to first parameter of jQuery’s .animate() method Used to animate the sub-menu closed
		speed:         'normal',           // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
		speedOut:      'fast', 
	    autoArrows: false
	});

	jQuery('html').addClass('js-ready');


/*-----------------------------------------------------------------------------------*/
/*  Portfolio Animations
/*-----------------------------------------------------------------------------------*/
function portfolioHover() {	

	jQuery('#portfolio-wrapper .portfolio-image, #portfolio-wrapper .portfolio-content,	#portfolio-wrapper .portfolio-single-title')
		.css({'opacity': '0'});

	var item = jQuery('.portfolio-item');	

	item.each(function() {

		var	height = jQuery(this).children().children('.hover').outerHeight();	
		var title = jQuery(this).find('.portfolio-title').outerHeight();	

		jQuery('.portfolio-title').css(
		{
			marginTop:  -height/2
		});
		
		jQuery(this).hover(				
		function () {
			$(this).css('z-index', '100');
            $(this).children().children('.picture').stop().animate(
            	{
            		opacity:'1', 
            		marginTop: -height/2
            	}, 300, 'easeOutQuad');
            $(this).children().children('.hover').stop().animate(
            	{                      		
            		opacity: 1,
      //      		height: height,     		
            		bottom: -height
            	}, 300, 'easeOutQuad'
  			);
  			jQuery('.portfolio-title').stop().animate(
            	{                               				            	
            		marginTop: 0,
            	}, 400, 'easeOutQuad'
  			);
        },

        function () {
        	$(this).css('z-index', '1');
            $(this).children().children('.picture').stop().animate(
            	{
            		opacity:'0.9',            		
            		marginTop: 0
            	}, 250, 'easeOutQuad');
            $(this).children().children('.hover').stop().animate(
            	{            		
            		bottom: 0,
        //    		height: 0,            	
            		opacity: 0	            		
            	}, 250, 'easeOutQuad');
            jQuery('.portfolio-title').stop().animate(
            	{                             			            	
            		marginTop: -height/2
            	}, 0, 'easeOutQuad'
  			);
        }
  	    
		);	//end hover
		
	});
}

if (jQuery('.icy-portfolio').hasClass('overlap-animation')) {
	// Execute only if the option is selected
	portfolioHover();
}

/*-----------------------------------------------------------------------------------*/
/*  Year animation trigger and fallback
/*-----------------------------------------------------------------------------------*/

jQuery('.year-animation').waypoint(function(){         
      jQuery(this).addClass('animate animated fadeIn');         
  }
  , {
      triggerOnce: true,
      offset: function(){
        return $(window).height() - $(this).outerHeight();
      }
    }
);

function rubbishIEfallback() {
	
	  jQuery('.first-number').stop().animate({
	    'margin-top': '-369px'
	  }, 1500);
	  jQuery('.second-number').stop().animate({
	    'margin-top': '-849px'
	  }, 1500);
	  jQuery('.third-number').stop().animate({
	    'margin-top': '-609px'
	  }, 1500);
	  jQuery('.fourth-number').stop().animate({
	    'margin-top': '-969px'
	  }, 1500);  
	
}

if ( !jQuery( 'html' ).hasClass('csstransitions') ) { 
	jQuery('.icy-foundation .year-animation').css({'opacity': '1'})
	rubbishIEfallback();
}	

/*-----------------------------------------------------------------------------------*/
/*  Touch Events for Posts Navigation
/*-----------------------------------------------------------------------------------*/
if (jQuery('body').hasClass('single')) {
	function wipeLoading() {
	      jQuery('.post-navigation').touchSwipeLeft(
	          function() {	
				if (jQuery('.post-navigation .next-post a').length > 0) {      		
					// Workaround as trigger click didn't work.	                      
	          		var href = jQuery('.post-navigation .next-post a').attr('href');
      			  	window.location.href = href;
      			}
	          }
	      );
	      jQuery('.post-navigation').touchSwipeRight(
	          function() {	    
	        	if (jQuery('.post-navigation .prev-post a').length > 0) {      		
	              var href = jQuery('.post-navigation .prev-post a').attr('href');	              		
      			  window.location.href = href;
      			}
	          }
	      );      
	}
	wipeLoading();
}

/*-----------------------------------------------------------------------------------*/
/*  Responsive Videos & Headlines
/*-----------------------------------------------------------------------------------*/

	jQuery("#primary, .video-frame, .fitvids").fitVids();
	jQuery(".icy-slogan .icy-slogan-title").fitText(1.3);

});

jQuery(window).load(function($){

	if (jQuery().flexslider) {
         jQuery('.flexslider').imagesLoaded(function() {
            jQuery(".flexslider").flexslider({ 
              animation: 'fade', 
              controlNav: false, 
              animationLoop: true, 
              slideshow: true, 
              smoothHeight: true,
              useCSS: true
           }); 
        });
      }   

	if ( jQuery( 'body' ).hasClass('single-portfolio') ) {
		jQuery('.portfolio-single-title, .portfolio-image, .portfolio-meta, .portfolio-content').css({'opacity': '1'});
	}

	if (jQuery().isotope) {

		

	    jQuery(function () {
	        var grid = jQuery(".portfolio-grid");
	        var sort = jQuery(".icy-portfolio-tax");
	        var link = sort.find("a");        
	            
	        link.attr("href", "#");            	        	        

			grid.imagesLoaded(function() {
				grid.isotope({
	            	itemSelector: '.portfolio-item',			  
			  		layoutMode: 'masonry',
			  		animationEngine: 'best-available',
			  		resizable: false,
			  		animationOptions: {
					    complete: set_height
					}
				});								
			});
			
			function set_height() {
				if (jQuery('.portfolio-grid').hasClass('lazy-load')) {
					jQuery(function() {
					    jQuery('.portfolio-grid img').imageloader(
					    	{
						        selector: '.portfolio-grid img',
						        each: function (elm) {
						          console.log(elm);
						        },
						        callback: function (elm) {
						        	jQuery(elm).waypoint(function(){         
									      jQuery(this).addClass('animated fadeInUp');
									      if (jQuery('body').hasClass('ie')) { jQuery(this).animate({'opacity': '1'})}         
									  }
									  , {
									      triggerOnce: true,
									      offset: function(){
									        return jQuery(window).height() - jQuery(this).outerHeight() + 100;
									      }
									    }
									);					          
						        }
						    }
					    );
					});				
				}
			}
			
         	link.click(function(e) {
	            var filter = jQuery(this).attr("data-filter");

	            e.preventDefault();
	            grid.isotope({
	            	filter: "." + filter,	         
	            });	            
	                
	            link.removeClass("active");
	            jQuery(this).addClass("active");	            
	        });	        	        	        	        	        

			if ( jQuery('.icy-portfolio').hasClass('grid-view') ) {
				jQuery('.filter-layouts').hide();
			}
	        
		    jQuery('.filter-layouts').find('a').click(function(event){
			  	if(jQuery(this).hasClass('selected'))
			  	{ return false; }

				jQuery('.filter-layouts').find('a').removeClass('toggle-selected');
				jQuery(this).addClass('toggle-selected');

				if(!jQuery('.filter-layouts a:last-child').hasClass('toggle-selected')) { 										
					grid.find('.portfolio-item.width2').removeClass('width2').addClass('width1 large'); 										
				} else { 										
					grid.find('.portfolio-item.width1.large').removeClass('width1').addClass('width2'); 										
				}				
		        grid.isotope('layout');		          

		        event.preventDefault();
		      });		    		
	    });	

	    setInterval(function(){
			jQuery( ".portolio-grid" ).isotope('layout');
		},3000);	
	}	


});


