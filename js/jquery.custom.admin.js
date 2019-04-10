/*-----------------------------------------------------------------------------------
 	Portfolio Edit Page Interactions
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function($) {

    jQuery('.colorpicker').wpColorPicker();

/*----------------------------------------------------------------------------------*/
/*	Portfolio Custom Fields Hide/Show
/*----------------------------------------------------------------------------------*/

    var portfolioTypeTrigger = jQuery('#icy_portfolio_type'),
    	portfolioImage = jQuery('#postimagediv'),
        portfolioGallery = jQuery('#icy-metabox-portfolio-gallery'),
        portfolioVideo = jQuery('#icy-metabox-portfolio-video-embed'),        
        currentType = portfolioTypeTrigger.val();
        
    icySwitchPortfolio(currentType);

    portfolioTypeTrigger.change( function() {
       currentType = jQuery(this).val();
       
       icySwitchPortfolio(currentType);
    });
    
    function icySwitchPortfolio(currentType) {
        if( currentType === '0' ) {
            icyHideAllPortfolio(portfolioImage);
        } else if( currentType === '2' ) {
            icyHideAllPortfolio(portfolioVideo);
		} else if( currentType === '1' ) {
            icyHideAllPortfolio(portfolioGallery);            
        } else {
            icyHideAllPortfolio(portfolioImage);
        }
    }
    
    function icyHideAllPortfolio(notThisOne) {
		portfolioImage.css('display', 'none');
		portfolioVideo.css('display', 'none');
		portfolioGallery.css('display', 'none');
		notThisOne.css('display', 'block');
	}

/*----------------------------------------------------------------------------------*/
/*  Post Format Custom Fields Hide/Show
/*----------------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------------------*/
    /*  Quote Options
    /*----------------------------------------------------------------------------------*/

    var quoteOptions = jQuery('#icy-metabox-post-quote');
    var quoteTrigger = jQuery('#post-format-quote');
    
    quoteOptions.css('display', 'none');

    /*----------------------------------------------------------------------------------*/
    /*  Image Options
    /*----------------------------------------------------------------------------------*/

    var imageOptions = jQuery('#icy-metabox-post-gallery');
    var imageTrigger = jQuery('#post-format-gallery');
    
    imageOptions.css('display', 'none');


    /*----------------------------------------------------------------------------------*/
    /*  Link Options
    /*----------------------------------------------------------------------------------*/

    var linkOptions = jQuery('#icy-metabox-post-link');
    var linkTrigger = jQuery('#post-format-link');
    
    linkOptions.css('display', 'none');
        
    /*----------------------------------------------------------------------------------*/
    /*  Audio Options
    /*----------------------------------------------------------------------------------*/

    var audioOptions = jQuery('#icy-metabox-post-audio');
    var audioTrigger = jQuery('#post-format-audio');
    
    audioOptions.css('display', 'none');
    
    /*----------------------------------------------------------------------------------*/
    /*  Video Options
    /*----------------------------------------------------------------------------------*/

    var videoOptions = jQuery('#icy-metabox-post-video');
    var videoTrigger = jQuery('#post-format-video');
    
    videoOptions.css('display', 'none');

    /*----------------------------------------------------------------------------------*/
    /*  The Brain
    /*----------------------------------------------------------------------------------*/

    var group = jQuery('#post-formats-select input');

    
    group.change( function() {
        
        if(jQuery(this).val() == 'quote') {
            quoteOptions.css('display', 'block');
            icyHideAll(quoteOptions);
            
        } else if(jQuery(this).val() == 'link') {
            linkOptions.css('display', 'block');
            icyHideAll(linkOptions);
            
        } else if(jQuery(this).val() == 'audio') {
            audioOptions.css('display', 'block');
            icyHideAll(audioOptions);
            
        } else if(jQuery(this).val() == 'video') {
            videoOptions.css('display', 'block');
            icyHideAll(videoOptions);
            
        } else if(jQuery(this).val() == 'gallery') {
            imageOptions.css('display', 'block');
            icyHideAll(imageOptions);
            
        } else {
            quoteOptions.css('display', 'none');
            videoOptions.css('display', 'none');
            linkOptions.css('display', 'none');
            audioOptions.css('display', 'none');
            imageOptions.css('display', 'none');
        }
        
    });
    
    if(quoteTrigger.is(':checked'))
        quoteOptions.css('display', 'block');
        
    if(linkTrigger.is(':checked'))
        linkOptions.css('display', 'block');
        
    if(audioTrigger.is(':checked'))
        audioOptions.css('display', 'block');
        
    if(videoTrigger.is(':checked'))
        videoOptions.css('display', 'block');
        
    if(imageTrigger.is(':checked'))
        imageOptions.css('display', 'block');
        
    function icyHideAll(notThisOne) {
        videoOptions.css('display', 'none');
        quoteOptions.css('display', 'none');
        linkOptions.css('display', 'none');
        audioOptions.css('display', 'none');
        imageOptions.css('display', 'none');
        notThisOne.css('display', 'block');
    }

});