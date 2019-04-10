<?php

/*--------------------------------------------------------------------------------------------------

	File: functions.php

	Description: Here are a set of custom functions used for this theme framework.
	Please be extremely careful when you are editing this file, because when things
	tend to go bad, they go bad big time. Well, you have been warned ! :-)

--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
	Registering WP3.0+ Custom Menu 
--------------------------------------------------------------------------------------------------*/

function register_menu() {
	register_nav_menu('main-menu', __('Main Menu', 'framework'));
}
add_action('init', 'register_menu');

/*--------------------------------------------------------------------------------------------------
	Loading the Theme Translation Feature
--------------------------------------------------------------------------------------------------*/

load_theme_textdomain('framework');

/*--------------------------------------------------------------------------------------------------
	Registering the Sidebars
--------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Footer 1',
		'description' => 'Display Social Icons here',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Footer 2',		
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer 3',
		'description' => 'Display copyright here.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
}


/*--------------------------------------------------------------------------------------------------
	Configuring WP2.9+ Thumbnails
--------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support')) {
	// set up for fallback to old way of doing things
	$wp_version = get_bloginfo('version');	

	if( version_compare($wp_version, '3.5.1', '>') ) {
		// Using WP 3.6+
		/*add_theme_support( 'post-formats', array(
			'aside', 'audio',  'quote', 'video', 'gallery', 'image', 'chat', 'status', 'link'
		) );		
		*/
		add_theme_support( 'post-formats', array(
			'aside', 'audio','image', 'gallery', 'quote', 'video'
		) );		
	} else {
		//Using WP 3.5.1 or less
		add_theme_support( 'post-formats', array(
			'aside', 'audio','image', 'gallery', 'quote', 'video'
		) );		
	}
	
	add_theme_support( 'post-thumbnails' ); //Adding theme support for post thumbnails
	add_theme_support( 'automatic-feed-links' ); //Adding support for automatic feed links	
	set_post_thumbnail_size( 150, 150, true );
		
	add_image_size('thumb-portfolio-homepage', 772, 434, true);
	add_image_size('single-portfolio', 1160, '', false);
	add_image_size('page', 1160, '', false);
}

/*--------------------------------------------------------------------------------------------------
	Custom Wordpress Customisation		
		a. Custom Excerpt Length
		b. Custom Excerpt String
		c. Separated Pings Listing
		d. Custom Useful is_multiple function
		e. Custom Login Logo	
		f. Custom Caption Function	
--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
		a. Custom Excerpt Length
--------------------------------------------------------------------------------------------------*/
if ( !function_exists('icy_custom_excerpt_length') ) {
	function icy_custom_excerpt_length( $length ) {
		global $post;
		if ($post->post_type == 'post')
			return 20;
	}
}
add_filter('excerpt_length', 'icy_custom_excerpt_length');


/*--------------------------------------------------------------------------------------------------
		b. Custom Excerpt String Text
--------------------------------------------------------------------------------------------------*/
if ( !function_exists('icy_excerpt') ) {
	function icy_excerpt($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'icy_excerpt');


/*--------------------------------------------------------------------------------------------------
		c. Separated Pings Listing
--------------------------------------------------------------------------------------------------*/

function icy_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

<?php }

/*--------------------------------------------------------------------------------------------------
		d. Custom Login Logo Support
--------------------------------------------------------------------------------------------------*/

function icy_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; width: 300px !important; height: 78px !important; }
    </style>';
}
add_action('login_head', 'icy_custom_login_logo');

/*--------------------------------------------------------------------------------------------------
		e. Setting Content Width
--------------------------------------------------------------------------------------------------*/

if( ! isset( $content_width ) ) $content_width = 800;


/*--------------------------------------------------------------------------------------------------
		f. Custom Caption Function
--------------------------------------------------------------------------------------------------*/

if ( !function_exists('the_post_thumbnail_caption') ) {
	function the_post_thumbnail_caption() {
	  global $post;

	  $thumb_id = get_post_thumbnail_id($post->id);

	  $args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
		); 

	   $thumbnail_image = get_posts($args);

	   if ($thumbnail_image && isset($thumbnail_image[0])) {
	     //show thumbnail title
	     //echo $thumbnail_image[0]->post_title; 

	     //Uncomment to show the thumbnail caption
	     echo '<div class="icy_caption"><h3>'.$thumbnail_image[0]->post_excerpt.'</h3></div>';

	     //Uncomment to show the thumbnail description
	     //echo $thumbnail_image[0]->post_content; 

	     //Uncomment to show the thumbnail alt field
	     //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	     //if(count($alt)) echo $alt;
	  }
	}
}

/*--------------------------------------------------------------------------------------------------
	Register and load common JS & CSS
--------------------------------------------------------------------------------------------------*/

function icy_register_js() {
	if (!is_admin()) {

		// Registering Javascripts				
		wp_register_script('google-maps-api', 'http://maps.google.com/maps/api/js?sensor=false');
		wp_register_script('google-map',	get_template_directory_uri() . '/js/map.js', 'google-maps-api', TRUE);
		wp_register_script('modernizr', 	get_template_directory_uri() . '/js/modernizr.js', 'jquery', '2.6.2', TRUE);		
		wp_register_script('superfish',     get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);
		wp_register_script('isotope',		get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', TRUE);
		wp_register_script('easing',		get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', TRUE);
		wp_register_script('scrollTo',		get_template_directory_uri() . '/js/jquery.scrollTo.min.js', 'jquery', TRUE);	
		wp_register_script('waypoint',		get_template_directory_uri() . '/js/jquery.waypoints.js', 'jquery', TRUE);		
		wp_register_script('flexslider',	get_template_directory_uri() . '/js/jquery.flexslider.min.js', 'jquery', TRUE);
		wp_register_script('fitVids',		get_template_directory_uri() . '/js/jquery.fitvids.min.js', 'jquery', TRUE);
		wp_register_script('touch',			get_template_directory_uri() . '/js/jquery.touchwipe.min.js', 'jquery', TRUE);
		wp_register_script('knob',			get_template_directory_uri() . '/js/jquery.knob.js', 'jquery', TRUE);
		wp_register_script('view',			get_template_directory_uri() . '/js/view.min.js?auto', 'jquery', TRUE);
		wp_register_script('imageloader', 	get_template_directory_uri() . '/js/jquery.imageloader.js', 'jquery', TRUE);		
		wp_register_script('resp-nav',		get_template_directory_uri() . '/js/responsive.nav.js', array('jquery', 'modernizr'), TRUE);				
		wp_register_script('jplayer', 		get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery');
		wp_register_script('excanvas',		get_template_directory_uri() . '/js/excanvas.js', 'jquery');
		wp_register_script('easy-pie-chart',get_template_directory_uri() . '/js/jquery.easy-pie-chart.js', array('jquery', 'excanvas'));
		wp_register_script('imagesloaded',	get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'));
		wp_register_script('icy_custom',    get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'scrollTo', 'easing', 'isotope', 'fitVids', 'waypoint', 'touch'), '1.0', TRUE);
		wp_register_script('custom_ajax',	get_template_directory_uri() . '/js/jquery.ajax.js', array('jquery', 'touch', 'waypoint'), TRUE);		
		
		wp_localize_script('custom_ajax', 
			'icyAjax', 
			array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 			
			'templateurl' => get_template_directory_uri(), 
			'themePath' => get_template_directory_uri(), 
			'prevPost' => __( 'Go to the previous post', 'framework' ), 
			'nextPost' => __( 'Go to the next post', 'framework'), 
			) 
		);

		// Enqueueing Javascripts
		wp_enqueue_script( 'jquery' );		
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'resp-nav' );
		wp_enqueue_script( 'view' );
		wp_enqueue_script ('imagesloaded');
		wp_enqueue_script( 'superfish' );						
		wp_enqueue_script( 'waypoint' );	
		wp_enqueue_script( 'icy_custom' );	

		// Loading conditional scripts
		if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 	
	}
}
add_action('wp_enqueue_scripts', 'icy_register_js');

/**
 * Enqueue the Google Fonts.
 */
function icy_google_fonts() {
  $protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'icy-google-font', "$protocol://fonts.googleapis.com/css?family=Merriweather:300|Merriweather+Sans:300,400,800|Open+Sans:800' rel='stylesheet' type='text/css" );}
add_action( 'wp_enqueue_scripts', 'icy_google_fonts' );


//register my own styles
function icy_enqueue_stylesheets() {    	
		//Registering Stylesheets
    	wp_register_style('style_css',			get_template_directory_uri() . '/style.css');
    	wp_register_style('pagenavi',			get_template_directory_uri() . '/css/pagenavi-css.css');
    	wp_register_style('flexslider_css',		get_template_directory_uri() . '/css/flexslider.css');
    	wp_deregister_style( 'wp-mediaelement' );

    	//Enqueue Stylesheets
		wp_enqueue_style('style_css');
		wp_enqueue_style('flexslider_css');	

		//load Slides on appropriate pages
    	if( ( 'portfolio' == get_post_type() ) || has_post_format('gallery') || is_home() || is_archive() ) {
    	    wp_enqueue_script('flexslider');
    	    wp_enqueue_style('pagenavi');    	    
    	}		

    	if( (has_post_format('audio') || has_post_format('video') || is_home() ) ) {
    		wp_enqueue_script('jplayer');
    	}


    	if ( is_child_theme() && 'smarald' == get_template() ) { 
 	        wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'style_css' ), '1.0'); 
 	    } 
}
add_action('wp_enqueue_scripts', 'icy_enqueue_stylesheets');

/*-----------------------------------------------------------------------------------*/
/*	Adding Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_browser_body_class' ) ) {
    function icy_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
    }
    
    add_filter('body_class','icy_browser_body_class');
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function icy_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<!--BEGIN .comment -->
    	<div id="comment-<?php comment_ID(); ?>" class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>bypostauthor<?php endif; ?>">
    		<!--BEGIN .comment-author -->
    		<div class="comment-author commentary">

    			<figure class="author-avatar">
        			<?php echo get_avatar($comment,$size='64'); ?>        		
		        </figure>    			
    			<span class="author-name"><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></span>

    			<span class="reply-to"><?php printf(__('%1$s at %2$s', 'framework'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('[Edit]', 'framework'),' / ',' / ') ?><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
         	<!--END .comment-author -->
    		</div>    		
      
    	<?php if ($comment->comment_approved == '0') : ?>
        	<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>     
      	<?php endif; ?>
	  		
	  		<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary span12">
    			<?php comment_text() ?>
      		<!--END .comment-entry -->      		
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Post Types & Metas
/*-----------------------------------------------------------------------------------*/

// Add the Custom Flickr Photos Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom Twitter Widget
//include("functions/widget-tweets.php");

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Give all images a class
/*-----------------------------------------------------------------------------------*/

function lightbox_regex($content){ 
    global $post; 

    $content = preg_replace("/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:gif|jpg|jpeg|png)\?{0,1}\S{0,}['\"][^\>]*)>/i" , '$1 class="lightbox view" rel="gallery['.$post->ID.']">', $content); 
    return $content; 
} 

add_filter('post_format_meta', 'lightbox_regex');
add_filter('the_content', 'lightbox_regex');

/*-----------------------------------------------------------------------------------*/
/*	Remove Version, which minimizes redirects
/*-----------------------------------------------------------------------------------*/
function _remove_wp_ver_css_js( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', '_remove_wp_ver_css_js', 10 );
add_filter( 'script_loader_src', '_remove_wp_ver_css_js', 10 );



/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options & Auto-Update feature
/*-----------------------------------------------------------------------------------*/

define('ICY_FILEPATH', get_template_directory());
define('ICY_DIRECTORY', get_template_directory_uri());

require_once (ICY_FILEPATH . '/functions/theme-functions.php');
require_once (ICY_FILEPATH . '/functions/theme-metabox.php');
require_once (ICY_FILEPATH . '/functions/theme-require-plugins.php');
require_once (ICY_FILEPATH . '/page-builder/page-builder.php');
require_once (ICY_FILEPATH . '/customizer/customizer.php' );
require_once (ICY_FILEPATH . '/functions/class-pixelentity-theme-update.php');

$theme_options = thsp_cbp_get_options_values();
$user = $theme_options['buyer_username'];
$api = $theme_options['buyer_apikey'];
PixelentityThemeUpdate::init($user,$api, 'Icy Pixels');

?>