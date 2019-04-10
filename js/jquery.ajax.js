jQuery(document).ready(function( $ ) {   

   /*-----------------------------------------------------------------------------------*/
	/*	Ajax Call
	/*-----------------------------------------------------------------------------------*/
	
	current_post_id = '';
   
	var $portfolioWrapper = jQuery("#portfolio-wrapper"),
        portfolioNav      = jQuery('#portfolio-wrapper .portfolio-navigation'),
        portfolioGrid     = jQuery('.icy-portfolio'),
        header            = jQuery('header#top'),
        slogan            = jQuery('.icy-slogan');
   		
   	getProjectViaAjax = function(e) {
   		   		
        // Getting post ID's, nonce's and previous and next item's ID
   		var post_id = $( this ).attr( "data-post_id" );
   		current_post_id = post_id;
        var nonce = $( this ).attr("data-nonce");
        var itemID = $( '.portfolio-item[data-post_id="' + post_id + '"]' );
      	var $prev = itemID.prev('.portfolio-item').find('.project-link');
      	var $next = itemID.next('.portfolio-item').find('.project-link');
      	var prev_item_id, prev_post_id = '';
      	var next_item_id, next_post_id = '';         
      	      	
      	if ( $prev.length !== 0 && $next.length !== 0 ) {
      		prev_item_id = $prev.attr( "data-post_id" );
      		next_item_id = $next.attr( "data-post_id" );
      	}
      	else if ( $prev.length !== 0 ) {
      		prev_item_id = $prev.attr( "data-post_id" );
      	}
      	else if ( $next.length !== 0 ) {
      		next_item_id = $next.attr( "data-post_id" );
      	}      	      	      

        // Start up your engine!
      	$.ajax({
        	type : "post",
        	context: this,
         	dataType : "json",
         	url : icyAjax.ajaxurl,
         	data : {
                action: "get_ajax_project", 
                post_id : post_id, 
                nonce: nonce, 
                prev_item_id : prev_item_id, 
                next_item_id : next_item_id
            },
         	beforeSend: function() {
                showLoader();
                
         	},
         	success: function(e) {                                    
                $portfolioWrapper.html( e.html );               
                hideGrid();
         	},
         	complete: function() {		            
                openProject();				
                wipeLoading();
                loadGallery();  
                hideLoader();                           
			          jQuery( ".prev-portfolio-post, .next-portfolio-post" ).click( getProjectViaAjax );				     
				        jQuery( ".show-grid" ).click( showGrid );								     				     
                jQuery( ".prev-portfolio-post, .next-portfolio-post" ).click( showLoader );                     
                jQuery( ".video-frame" ).fitVids();
                jQuery( ".icy-portfolio" ).addClass('ajax-active');
                jQuery( ".portolio-grid" ).isotope('reLayout');
			    }
      	});      	
      	e.preventDefault();   		
   	}
   	
	if ( !jQuery( 'body' ).hasClass('ie8') ) { // IE8's inability to process correctly AJAX stuff is driven to the single-portfolio.php
		jQuery( ".project-link" ).click( getProjectViaAjax );   		
	}

   function showLoader() {
      jQuery('.icy-loader').fadeIn(500);      
      jQuery('.icy-loader').stop().animate({
         opacity: 1
      }, 500);
      jQuery('.aq-block-icy_horizontal_block').stop().animate({
         opacity: 0
      }, 500);
   }

   function hideLoader() {         
      jQuery('.icy-loader').stop().animate({
         opacity: 0
      }, 500);               
      jQuery('.icy-loader').fadeOut(500);           
   }

   function hideGrid() {

    // Scroll to the top of the page
    jQuery.scrollTo( jQuery('body').offset().top, 1000, {
        easing: "easeOutQuad",
        'axis':'y' // fixes stutter on iPad
    });

    // Hide Slogan
    slogan.stop().animate({
        height: 0,
        paddingBottom: 0,
        opacity: 0,
    }, 1000, 'easeOutQuad');

    // Reduce header margin so the portfolio navigation fits nicely ;)
    header.stop().animate({
        marginBottom: 0
    }, 1000, 'easeOutQuad');

    // Hide the portfolio grid of items
    portfolioGrid.stop().animate({
        opacity: 0,        
        padding: 0
    }, 100, 'easeOutQuad', function() {
        if ( jQuery( 'body' ).hasClass('ie') ) { // Nasty IE bug. Check my comment in the showGrid function. I HATE IE!          
            jQuery( ".show-grid" ).css({'display': 'block'});                     
            jQuery('.portfolio-single-title, .portfolio-image, .portfolio-content').css({'opacity': '0'});
        }
        jQuery('.icy-portfolio').css({
          'overflow': 'hidden',
          'display': 'none'          
        });
    });
      
   }
		   	
	function showGrid() {
		
	var $clickedObject   = $(this);
    var headerHeight     = jQuery('.icy-slogan-title').outerHeight(true),
        separator        = jQuery('.icy-slogan .slogan-separator').outerHeight(true),
        text             = jQuery('.icy-slogan p').outerHeight(true),          
        portfolioNav     = jQuery('#portfolio-wrapper .portfolio-navigation'),
        header           = jQuery('header#top'),
        slogan           = jQuery('.icy-slogan'),
        portfolioHeight  = jQuery('.icy-portfolio').attr('data-height'),          
        sloganHeight  = headerHeight + separator + text;

        // Hiding the Single Portfolio AJAX container
        $portfolioWrapper.stop().animate({
            height: 0,
            opacity: 0            
        }, 300, 'easeOutQuad');              

        // Hiding the Portfolio Navigation
        portfolioNav.stop().animate({
            height: 0,
            margin: 0,
            padding: 0,
            opacity: 0,
            'min-height': 0
        }, 300, 'easeOutQuad', function() {
            portfolioNav.css({'overflow': 'hidden'});
            if ( jQuery( 'body' ).hasClass('ie') ) { // Nasty IE bug making the Show grid button to still show. I HATE IE!          
                jQuery( ".show-grid" ).css({'display': 'none', 'opacity' : '0'});         
            }
        });   

        // Adding the margin again to the header
        header.stop().animate({
            marginBottom: 50
        }, 1000, 'easeOutQuad');                 

        // Reconstructing slogan
        slogan.stop().animate({
            height: sloganHeight,
            paddingBottom: 50,
            opacity: 1
        }, 1000, 'easeOutQuad');
        // Special IE treatment...
        jQuery('.portfolio-image, .portfolio-meta, .portfolio-content, .portfolio-single-title').css({'display': 'none'})

        // Animating height of Portfolio Grid.
        portfolioGrid.delay(1000).stop().animate({
            opacity: 1,            
            paddingTop: 25
        }, 1000, 'easeOutQuad', function() {          
         
            jQuery('.icy-portfolio').css(
              {'overflow': 'visible',
                'display' : 'block'});

            // Scroll to the portfolio items grid
            jQuery.scrollTo( jQuery('.icy-portfolio').offset().top, 1000, {
               easing: "easeOutQuad",
               'axis':'y'
            });

            jQuery( ".portolio-grid" ).isotope('reLayout');
        });

        // Add a class to keep track of AJAX loading
        jQuery('.icy-portfolio').addClass('ajax-activated');

   }
	
	function openProject() {

      var navHeight = jQuery('#portfolio-wrapper .portfolio-navigation').outerHeight(),
          image     = jQuery('.portfolio-image img').outerHeight(),
          title     = jQuery('.portfolio-single-title').outerHeight(),
          meta      = jQuery('.portfolio-meta').outerHeight(),
          content   = jQuery('.portfolio-content').outerHeight(),
          totalHeight = navHeight + image + title + meta + content;
								
		$portfolioWrapper.stop().animate({			        
         opacity: 1
		}, 1000, 'easeOutQuad', function() {

            jQuery('.aq-block-icy_horizontal_block').stop().animate({
               opacity: 1
            }, 500);
        
            jQuery(this).css({'height': "auto", "overflow": 'visible'});            
            triggerAnimations();

            // Enhance the website if it's not Internet Explorer :)
            if ( !(jQuery( 'body' ).hasClass('ie9')) || !(jQuery( 'body' ).hasClass('ie8'))) {           
               jQuery('.portfolio-single-title').addClass('animated fadeInDown');
               jQuery('.portfolio-image').addClass('animated fadeInUp');
               jQuery('.portfolio-navigation').css({'overflow': 'visible', 'min-height': '40px'});                  
            } else {
               // Else do opacity 1, so items can be shown in IE, because IE doesn't support CSS3 animations
               jQuery('.portfolio-single-title, .portfolio-image, .portfolio-meta, .portfolio-content').css({'opacity': '1'});
            }
      });		   
	}

   function triggerAnimations() {

      // Triggering animations only when they become visible into the viewport.
      
      jQuery('.portfolio-meta').waypoint(function(){         
          //jQuery(this).addClass('animated fadeInDown');         
      }
      , {
          triggerOnce: true,
          offset: function(){
            return $(window).height() - $(this).outerHeight();
          }
        }
      );    
      jQuery('.portfolio-content').waypoint(function(){         
          //jQuery(this).addClass('animated fadeInUp');         
      }
      , {
          triggerOnce: true,
          offset: function(){
            return $(window).height() - $(this).outerHeight();
          }
        }
      );

   }

   function loadGallery() {
      if (jQuery().flexslider) {

         jQuery('.flexslider').imagesLoaded(function() {
            jQuery(".flexslider").flexslider({ 
              animation: 'fade', 
              controlNav: false, 
              animationLoop: true, 
              slideshow: true, 
              smoothHeight: true,
              useCSS: true,
              start: function(slider) {
                slider.removeClass('loading');}   
           }); 
        });
      }    
   }

  
  function wipeLoading() {
      jQuery('.portfolio-navigation').touchSwipeLeft(
          function() {
              jQuery( ".next-portfolio-post" ).trigger('click');
          }
      );
      jQuery('.portfolio-navigation').touchSwipeRight(
          function() {
              jQuery( ".prev-portfolio-post" ).trigger('click');
          }
      );      
   }

});