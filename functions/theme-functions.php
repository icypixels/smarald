<?php

/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS
/*-----------------------------------------------------------------------------------*/

function icy_head_css() {
    global $icy_options;
		
		$output = '';
			
        $highlight = $icy_options['accent_colour'];
        $headings = $icy_options['headings_colour'];
        //$notification = $icy_options['notif_colour'];
        $text = $icy_options['text_colour'];
        $footer = $icy_options['footer_colour'];
        $css = $icy_options['custom_css'];
        $scheme = $icy_options['color_scheme'];

        //	Set Custom Background Image
        
        //	Gain access to the post id
        global $wp_query;
        if( is_home() && !is_tax( 'type' ) ) {
            $postid = get_option('page_for_posts');
        } elseif( is_tax( 'type' ) || is_search() || is_404() ) {
            $postid = 0;
        } else {
            $postid = $wp_query->post->ID;
        }

        // get custom image for page
        $bg_img = get_post_meta($postid, 'icy_background_image', true);
        $bg_pos = get_post_meta($postid, 'icy_background_position', true);
        $bg_repeat = get_post_meta($postid, 'icy_background_repeat', true);
        $bg_color = get_post_meta($postid, 'icy_background_color', true);
        $content_color = get_post_meta($postid, 'icy_content_background_color', true);
        $disabled = get_post_meta($postid, 'icy_content_background_disable', true);

        switch ($bg_pos) {
            case 0:
                $bg_pos = "left";
            break;
            case 1:
                $bg_pos = "right";
            break;
            case 2:
                $bg_pos = "center";
            break;
            case 3:
                $bg_pos = "; -webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover;  background-size: cover; "; 
            break;
        }

        switch ($bg_repeat) {
            case 0:
                $bg_repeat = "no-repeat";
            break;
            case 1:
                $bg_repeat = "repeat";
            break;
            case 2:
                $bg_repeat = "repeat-x";
            break;
            case 3:
                $bg_repeat = "repeat-y"; 
            break;
        }

        /* NULL OE EMPTY FOR BG IMAGE - ANDROID FIX */
        function IsNullOrEmptyString($question){
            return (!isset($question) || trim($question)==='');
        }

        if (!IsNullOrEmptyString($bg_img))
        {
            $output .= "body { background-color: ".$bg_color."; background-image: url(".$bg_img."); background-position: ".$bg_pos."; background-repeat: ".$bg_repeat."; background-attachment: fixed; }\n";
        } else {
        $output .= "body { background-color: ".$bg_color.";  }\n";
        }

        if ($disabled == 'off') {
            // If Content background color is desired
            $output .= "section.wrapper { background-color: ".$content_color."; }\n";
        }

        if (($disabled == 'on') && ($scheme == 'dark')) {
            $output .= ".dark section.wrapper { background-color: transparent; }";
        }

		
        if ($highlight <> '') {
            $output .= ""; 
        }

        if ($css != '') {
            $output .= $css;
        }

        if ($highlight != '#00a78d') {
            $output .= "button:hover,input[type=\"submit\"]:hover, .more-link:hover, input[type=\"button\"]:hover,input[type=\"submit\"]:hover, .wp-pagenavi a:hover, .wp-pagenavi span.current, .navigation-posts a:hover, .icy-member .icy-member-picture .rotateright, .icy-member .icy-member-picture .rotateleft { background-color: ".$highlight."; }";
            $output .= "input[type=\"button\"],input[type=\"submit\"],.more-link, .navigation-posts a, input:focus,textarea:focus, .dark input:focus,.dark textarea:focus { border-color: ".$highlight."; }";
            $output .= "input[type=\"button\"],input[type=\"submit\"],.more-link,a,a:hover, nav#primary-nav ul li a:hover, nav#primary-nav ul li.current-cat a, nav#primary-nav ul li.current_page_item a, nav#primary-nav ul li.current-menu-item a, .navigation-posts a:hover, .entry-title:hover h1, span.reply-to a:hover, .widget-title span, .icy-portfolio .icy-portfolio-tax li a:hover, .icy-portfolio .icy-portfolio-tax li a.active, .icy-pricetable-wrapper ul li.icy-pricetable-heading, .icy-pricetable-wrapper ul li.action-button, .navigation-posts a { color: ".$highlight."; }";
        }

        if ($text != '#777777') {
            $output .= "body, body.dark, .the-content .chat .chat-text { color: ".$text."; }";
        }

        if ($headings != '#333333') {
            $output .= "h1, h2, h3, h4, h5, h6, .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6,
            .entry-title h1, .dark .entry-title h1, .page-meta .page-title, .dark .page-meta .page-title, .widget-title, .dark .widget-title, .icy-slogan .icy-slogan-title, .dark .icy-slogan .icy-slogan-title, #portfolio-wrapper .portfolio-single-title, .dark #portfolio-wrapper .portfolio-single-title, .single-portfolio .portfolio-single-title, .dark .single-portfolio .portfolio-single-title, .icy-member .icy-member-name, .dark .icy-member .icy-member-name, .icy-skill h4, .dark .icy-skill h4, .icy-centered-text h2, .dark .icy-centered-text h2, .icy-pricetable-wrapper ul li.icy-pricetable-heading .icy-pricetable-title, .dark .icy-pricetable-wrapper ul li.icy-pricetable-heading .icy-pricetable-title { color: ".$headings."; }";
        }

        if ($footer != '#eeeeee') {
            $output .= "footer.footer-container, .dark footer.footer-container { background-color: ".$footer."; }";
        }
		
        if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
}
add_action('wp_head', 'icy_head_css');

/*-----------------------------------------------------------------------------------*/
/* - Color scheme chooser
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_body_class' ) ) { 
    function icy_body_class($classes) {       
    global $icy_options;

        $layout = $icy_options['color_scheme'];
        $logo_align = $icy_options['logo_placement'];
        //$hover_effect = $icy_options['hover_animation'];

        if ($layout == '') { $layout = 'light'; }
        if ($logo_align == '') { $logo_align == 'right-aligned'; }
        if ($hover_effect == '') { $hover_effect == 'overlap-animation'; }

        $classes[] .= $layout;
        $classes[] .= $logo_align; 
        $classes[] .= $hover_effect;
        return $classes;
    }
    add_filter('body_class','icy_body_class');
}


/*-----------------------------------------------------------------------------------*/
/* - Add Favicon
/*-----------------------------------------------------------------------------------*/

function icy_graphics() {
    global $icy_options;

    $output = '';
	$favicon = $icy_options['favicon'] ;
    
	if ($favicon != '') {
	   echo '<link rel="shortcut icon" href="' . $favicon . '"/>'."\n";
	}
}
add_action('wp_head', 'icy_graphics');

/*-----------------------------------------------------------------------------------*/
/*  Show analytics code in footer 													 */
/*-----------------------------------------------------------------------------------*/

function icy_analytics(){
	$shortname =  get_option('icy_shortname');
	$output = get_option($shortname . '_google_analytics');

	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";

}
add_action('wp_footer','icy_analytics');

/*-----------------------------------------------------------------------------------*/
/*  Gallery 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_gallery' ) ) {
    function icy_gallery($postid, $imagesize) {
    	?>

    	<script type="text/javascript">
    	jQuery(window).load(function($){
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
      	</script>

      	<?php 
                
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }                   
        
        $image_ids_raw = get_post_meta($postid, '_icy_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {        	   
            echo "<!-- BEGIN #slider -->\n<div class='flexslider loading'>"; 
            echo '<ul class="slides">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                    if ($caption != '') echo "<p class='flex-caption'>$caption</p>";
                    echo "</li>";
                $i++;
            }
            echo '</ul>';
            echo "<!-- END #slider -->\n</div>";
        }
        
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Gallery 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_lightbox' ) ) {
    function icy_lightbox($postid, $imagesize, $posttype) {
        ?>

        <?php                 
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }                   
        
        $image_ids_raw = get_post_meta($postid, '_icy_image_ids', true);
        
        if ($posttype == 'post') {
            $gallery_columns = get_post_meta($postid, 'icy_gallery_columns', true);            
        } else {
            $gallery_columns = get_post_meta($postid, 'icy_portfolio_gallery_columns', true);

            echo "<script>
                new View( jQuery('.gallery-images a[href]') );
            </script>";
        }

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {               
            echo "<!-- BEGIN .lightbox-gallery -->\n<div class='lightbox-gallery'>"; 
            echo '<ul class="gallery-images">';
            $i = 0;
            $id = rand(1,100);
            
            switch ($gallery_columns) {
                case '0':
                    $columns = "width1";
                break;

                case '1':
                    $columns = "width2";
                break;
                
                case '2':
                    $columns = "width3";
                break;
                
                case '3':
                    $columns = "width4";
                break;

                case '4':
                    $columns ="width5";
                break;

                case '5':
                    $columns ="width8";
                break;

                case '6':
                    $columns ="width10";
                break;
                
                default:
                    $columns = "width3";
                break;
            }

            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;                
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li class='$columns'><a href='$src[0]' rel='gallery[$id]' title='$caption' class='view'><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' /></a></li>";
                                        
                $i++;
            }
            echo '</ul>';
            echo "<!-- END .lightbox-gallery -->\n</div>";
        }
        
    }
}

/*-----------------------------------------------------------------------------------*/
/* Ajax
/*-----------------------------------------------------------------------------------*/

add_action( "wp_ajax_get_ajax_project", "get_ajax_project" );
add_action( "wp_ajax_nopriv_get_ajax_project", "get_ajax_project" );

function get_ajax_project() {

	if ( !wp_verify_nonce( $_REQUEST['nonce'], "portfolio" ) ) {
        exit("No naughty business please!");
    }

    global $post;   

    $current_post_id = '';
    $prev_item_id = ''; 
    $next_item_id = '';
    $terms = '';
    $content_post = '';
    $content = '';
    $post = '';
			
	if (isset($_REQUEST['post_id'])) { $current_post_id = $_REQUEST['post_id']; }
	if (isset($_REQUEST['prev_item_id'])) { $prev_item_id = $_REQUEST['prev_item_id']; }
	if (isset($_REQUEST['next_item_id'])) { $next_item_id = $_REQUEST['next_item_id']; }
	if (isset($_REQUEST['next_item_id'])) { $terms = get_the_terms( $_REQUEST['post_id'] , 'type', 'string' ); }
	$content_post = get_post( $_REQUEST['post_id'] );
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]>', $content);
	$post = get_post( $current_post_id ); 

	ob_start();
?>

	<?php 
		$nonce_prev = wp_create_nonce("portfolio");
		$nonce_next = wp_create_nonce("portfolio");

		$title = get_the_title( $current_post_id );
		$permalink = get_permalink( $current_post_id );

		// Client Logo
		$logo = get_post_meta( $current_post_id, 'icy_portfolio_logo', true );

		// Meta descriptions
		$metadesc = get_post_meta( $current_post_id, 'icy_portfolio_metadescription', true);
		$agency_t = get_post_meta( $current_post_id, 'icy_portfolio_agency_t', true );		
		$agency = get_post_meta( $current_post_id, 'icy_portfolio_agency', true );		
		$client_t = get_post_meta( $current_post_id, 'icy_portfolio_client_t', true );
		$client = get_post_meta( $current_post_id, 'icy_portfolio_client', true );
		$role_t = get_post_meta( $current_post_id, 'icy_portfolio_role_t', true );
		$role = get_post_meta( $current_post_id, 'icy_portfolio_role', true );
		$url_t = get_post_meta( $current_post_id, 'icy_portfolio_url_t', true );
		$url = get_post_meta( $current_post_id, 'icy_portfolio_url', true );

	?>	

	<div class="portfolio-navigation">

		<div class="show-grid">
			<a href="#" id="show-grid">
				<?php _e('Show Grid', 'framework'); ?>
			</a>
		</div>
		
		<?php if ( $prev_item_id && $next_item_id ) { ?>			
			<div class="prev-post prev-portfolio-post" data-post_id="<?php echo $prev_item_id; ?>" data-nonce="<?php echo $nonce_prev; ?>">
				<a rel="prev" href="#">
					<?php _e('Prev Post', 'framework'); ?>
				</a>
			</div>
			<div class="next-post next-portfolio-post" data-post_id="<?php echo $next_item_id; ?>" data-nonce="<?php echo $nonce_next; ?>">
				<a rel="next" href="#">
					<?php _e('Next Post', 'framework'); ?>
				</a>
			</div>
			
		<?php } else if ( $prev_item_id ) { ?>
		
			<div class="prev-post prev-portfolio-post" data-post_id="<?php echo $prev_item_id; ?>" data-nonce="<?php echo $nonce_prev; ?>">
				<a rel="prev" href="<?php echo $prev_post_link; ?>">
					Prev Post
				</a>
			</div>

		<?php } else if ( $next_item_id ) { ?>

			<div class="next-post next-portfolio-post" data-post_id="<?php echo $next_item_id; ?>" data-nonce="<?php echo $nonce_next; ?>">
				<a rel="next" href="<?php echo $next_post_link; ?>">
					Next Post
				</a>
			</div>
	
		<?php } ?>		

	</div>

	<h1 class="portfolio-single-title"><?php echo $title; ?></h1>			

	<figure class="portfolio-image row-fluid">
		<?php // get the media elements
        $mediaType = get_post_meta($current_post_id, 'icy_portfolio_type', true);        
        $mixedmedia_ID = get_post_meta($current_post_id, 'icy_portfolio_mixed', true);
            switch( $mediaType ) {
                case "0": 
                    if (has_post_thumbnail( $post->ID ) ) {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $current_post_id ), 'single-portfolio' ); ?>
                            <div class="icy-featured-image">
                            	<img src="<?php echo $image[0]; ?>" />   
                            	<?php the_post_thumbnail_caption(); ?>                         
                            </div>
                    <?php } 
                	break;

                case "1":
                    if($mixedmedia_ID != '') {
                        echo do_shortcode("[template id='".$mixedmedia_ID."']");                	
                    } else {
                        $type = get_post_meta($post->ID, 'icy_portfolio_gallery_type', true);
                        switch($type){
                            case "0":
                            
                                icy_lightbox($post->ID, 'thumbnail-large', 'portfolio');
                            
                            break;  
                            
                            case "1":
                            
                                icy_gallery($post->ID, 'thumbnail-large'); 
                            
                            break;

                            default:
                            break;
                        }
                    }
                	break;

                case "2":
                    $embed = get_post_meta($current_post_id, 'icy_portfolio_video', true);
                    if( !empty($embed) ) {
                        echo "<div class='video-frame'>";
                        echo stripslashes(htmlspecialchars_decode($embed));
                        echo "</div>";
                    }
                    break;

                default:
                    break;
            }
    	?>

	</figure>

	<?php if($metadesc == 'on') { ?>
		
	<section class="portfolio-meta">
		
		<div class="separator"></div>

		<section class="portfolio-meta-desc row-fluid">
			<figure class="span2 client-logo">
				<?php if ($logo != '') { ?><img width="80" height="80" src="<?php echo $logo; ?>" alt="<?php echo $title; ?>" /><?php } ?>
			</figure>

			<ul class="span5 left-side">
				<li class="span6">
					<?php if($client_t) { ?><h4><?php echo $client_t; ?></h4><?php } ?>
					<?php if($client) { ?><h5><?php echo $client; ?></h5><?php } ?>
				</li>
				<li class="span6">
					<?php if($role_t) { ?><h4><?php echo $role_t; ?></h4><?php } ?>
					<?php if($role) { ?><h5><?php echo $role; ?></h5><?php } ?>
				</li>
			</ul>
			<ul class="span5 right-side">
				<li class="span6">
					<?php if($agency_t) { ?><h4><?php echo $agency_t; ?></h4><?php } ?>
					<?php if($agency) { ?><h5><?php echo $agency; ?></h5><?php } ?>
				</li>
				<li class="span6">
					<?php if($url_t) { ?><h4><?php echo $url_t; ?></h4><?php } ?>
					<?php if($url) { ?><h5><a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php _e('Link', 'framework'); ?></a></h5><?php } ?>
				</li>
			</ul>
		</section>

		<div class="separator"></div>
	</section>

	<?php } ?>

	<?php if($metadesc != 'on') { 
			$style = "style='margin-top:50px;'";
		} else { $style = ''; }
	?>

	<section class="portfolio-content row-fluid" <?php echo $style; ?>>
		<div class="entry span8 offset2">
			<?php echo $content; ?>
		</div>
	</section>

<?php

 	$result['html'] = ob_get_clean();

   	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      	$result = json_encode($result);
      	echo $result;
   	}
   	else {
      	header("Location: ".$_SERVER["HTTP_REFERER"]);
   	}

   	die();
}

/*-----------------------------------------------------------------------------------*/
/*   Metaboxes Machine 														 		 */
/*-----------------------------------------------------------------------------------*/


/**
 * Adding Custom CSS & Colorpicker to metabox
 *
 * @package Smarald
 */


function portfolio_admin_style( $hook_suffix ) { 
    $wp_version = get_bloginfo('version');

    wp_enqueue_style( 'portfolio-admin-style', get_stylesheet_directory_uri() . '/functions/css/metabox-style.css' );    
	wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'custom-admin', get_stylesheet_directory_uri() . '/js/jquery.custom.admin.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_print_styles', 'portfolio_admin_style', 11 );


/**
 * Hiding metaboxes on Portfolio Post Type
 *
 * @package Smarald
 */

add_filter('default_hidden_meta_boxes', 'hide_meta_lock', 10, 2);
function hide_meta_lock($hidden, $screen) {
        if ( 'portfolio' == $screen->base )
            $hidden = array('postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
                // removed 'postexcerpt',
        return $hidden;
}

/**
 * Add a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function icy_add_meta_box( $meta_box )
{
    if( !is_array($meta_box) ) return false;
    
    // Create a callback function
    $callback = create_function( '$post,$meta_box', 'icy_create_meta_box( $post, $meta_box["args"] );' );

    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

/**
 * Create content for a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function icy_create_meta_box( $post, $meta_box )
{
	// set up for fallback to old way of doing things
	$wp_version = get_bloginfo('version');
	
    if( !is_array($meta_box) ) return false;
    
    if( isset($meta_box['description']) && $meta_box['description'] != '' ){
    	echo '<p>'. $meta_box['description'] .'</p>';
    }
    
	wp_nonce_field( basename(__FILE__), 'icy_meta_box_nonce' );
	echo '<table class="form-table icy-metabox-table">';
 
	foreach( $meta_box['fields'] as $field ){
		// Get current post meta data
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="'. $field['id'] .'"><strong>'. $field['name'] .'</strong>
			  <span>'. $field['desc'] .'</span></label></th>';
		
		switch( $field['type'] ){	
			case 'text':
				echo '<td><input type="text" name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" /></td>';
				break;	
				
			case 'textarea':
				echo '<td><textarea name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" rows="8" cols="5">'. ($meta ? $meta : $field['std']) .'</textarea></td>';
				break;
				
			case 'file':
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo $field['id']; ?>_button').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php _e("Insert", "framework"); ?>',

								click: function() {
									var models = frame.state().get('selection'),
										url = models.first().attributes.url;

									$('#<?php echo $field['id']; ?>').val( url ); 

									frame.close();
								}
							}
						});
						

					});
					
				});
				</script>
			<?php
				} // if version compare
				echo '<td><input type="text" name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
				break;

			case 'images': 
				if( version_compare($wp_version, '3.4.2', '>') ) {
					// Using Wp3.5+
			?>
				<script>
				jQuery(function($) {
					var frame,
					    images = '<?php echo get_post_meta( $post->ID, '_icy_image_ids', true ); ?>',
					    selection = loadImages(images);

					$('#icy_images_upload').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							title: '<?php _e("Create Featured Gallery", "framework"); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};

						// Check if frame or gallery already exist
						if( frame || selection ) {
							options['title'] = '<?php _e("Edit Featured Gallery", "framework"); ?>';
						}

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('cancel');
						frame.menu.get('view').unset('separateCancel');
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php _e("Edit Featured Gallery", "framework"); ?>';
						frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

						// When we are editing a gallery
						overrideGalleryInsert();
						frame.on( 'toolbar:render:gallery-edit', function() {
    						overrideGalleryInsert();
						});
						
						frame.on( 'content:render:browse', function( browser ) {
						    if ( !browser ) return;
						    // Hide Gallery Settings in sidebar
						    browser.sidebar.on('ready', function(){
						        browser.sidebar.unset('gallery');
						    });
						    // Hide filter/search as they don't work
						    browser.toolbar.on('ready', function(){
    						    if(browser.toolbar.controller._state == 'gallery-library'){
    						        browser.toolbar.$el.hide();
    						    }
						    });
						});
						
						// All images removed
						frame.state().get('library').on( 'remove', function() {
						    var models = frame.state().get('library');
							if(models.length == 0){
							    selection = false;
    							$.post(ajaxurl, { ids: '', action: 'icy_save_images', post_id: icy_ajax.post_id, nonce: icy_ajax.nonce });
							}
						});
						
						// Override insert button
						function overrideGalleryInsert() {
    						frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php _e("Save Featured Gallery", "framework"); ?>',

									click: function() {
										var models = frame.state().get('library'),
										    ids = '';

										models.each( function( attachment ) {
										    ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php _e("Saving...", "framework"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'icy_save_images', 
												post_id: icy_ajax.post_id, 
												nonce: icy_ajax.nonce 
											},
											success: function(){
    											selection = loadImages(ids);
    											$('#_icy_image_ids').val( ids );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.icy-gallery-thumbs').html( data );
										}); 
									}
								}
							});
						}
					});
					
					// Load images
					function loadImages(images) {
						if( images ){
						    var shortcode = new wp.shortcode({
            					tag:    'gallery',
            					attrs:   { ids: images },
            					type:   'single'
            				});
				
						    var attachments = wp.media.gallery.attachments( shortcode );

            				var selection = new wp.media.model.Selection( attachments.models, {
            					props:    attachments.props.toJSON(),
            					multiple: true
            				});
            
            				selection.gallery = attachments.gallery;
            
            				// Fetch the query's attachments, and then break ties from the
            				// query to allow for sorting.
            				selection.more().done( function() {
            					// Break ties with the query.
            					selection.props.set({ query: false });
            					selection.unmirror();
            					selection.props.unset('orderby');
            				});
            				
            				return selection;
						}
						
						return false;
					}
					
				});
				</script>
			<?php
				// SPECIAL CASE:
				// std controls button text; unique meta key for image uploads
				$meta = get_post_meta( $post->ID, '_icy_image_ids', true );
				$thumbs_output = '';
				$button_text = ($meta) ? __('Edit Gallery', 'framework') : $field['std'];
				if( $meta ) {
					$field['std'] = __('Edit Gallery', 'framework');
					$thumbs = explode(',', $meta);
					$thumbs_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
					}
				}

			    echo 
			    	'<td>
			    		<input type="button" class="button" name="' . $field['id'] . '" id="icy_images_upload" value="' . $button_text .'" />
			    		
			    		<input type="hidden" name="icy_meta[_icy_image_ids]" id="_icy_image_ids" value="' . ($meta ? $meta : 'false') . '" />

			    		<ul class="icy-gallery-thumbs">' . $thumbs_output . '</ul>
			    	</td>';
			    } else {
			    	// Using pre-WP3.5
			    	echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="icy_images_upload" value="' . $field['std'] .'" /></td>';
			    }
			    break;
				
			case 'select':
				echo'<td><select name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'">';
				foreach( $field['options'] as $key => $option ){
					echo '<option value="' . $key . '"';
					if( $meta ){ 
						if( $meta == $key ) echo ' selected="selected"'; 
					} else {
						if( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				}
				echo'</select></td>';
				break;
				
			case 'radio':
				echo '<td>';
				foreach( $field['options'] as $key => $option ){
					echo '<label class="radio-label"><input type="radio" name="icy_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
					if( $meta ){ 
						if( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> '. $option .'</label> ';
				}
				echo '</td>';
				break;
			
			case 'color':
			    if( array_key_exists('val', $field) ) $val = ' value="' . $field['val'] . '"';
			    if( $meta ) $val = ' value="' . $meta . '"';
			    echo '<td>';                
                echo '<input type="text" class="colorpicker" id="'. $field['id'] .'" name="icy_meta[' . $field['id'] .']"' . $val . ' />';
                echo '</td>';
			    break;
				
			case 'checkbox':
			    echo '<td>';
			    $val = '';
                if( $meta ) {
                    if( $meta == 'on' ) $val = ' checked="checked"';
                } else {
                    if( $field['std'] == 'on' ) $val = ' checked="checked"';
                }

                echo '<input type="hidden" name="icy_meta['. $field['id'] .']" value="off" />
                <input type="checkbox" id="'. $field['id'] .'" name="icy_meta['. $field['id'] .']" value="on"'. $val .' /> ';
			    echo '</td>';
			    break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}

/**
 * Save custom Meta Box
 *
 * @param int $post_id The post ID
 */
function icy_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['icy_meta']) || !isset($_POST['icy_meta_box_nonce']) || !wp_verify_nonce( $_POST['icy_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['icy_meta'] as $key=>$val ){
		update_post_meta( $post_id, $key, stripslashes(htmlspecialchars($val)) );
	}

}
add_action( 'save_post', 'icy_save_meta_box' );

/**
 * Save image ids
 */
function icy_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'icy-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], '_icy_image_ids', $ids);

	// update thumbs
	$thumbs = explode(',', $ids);
	$thumbs_output = '';
	foreach( $thumbs as $thumb ) {
		$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
	}

	echo $thumbs_output;

	die();
}
add_action('wp_ajax_icy_save_images', 'icy_save_images');


/*-----------------------------------------------------------------------------------*/
/*	Register related Scripts and Styles
/*-----------------------------------------------------------------------------------*/

function icy_metabox_portfolio_scripts() {
    global $post;
    $wp_version = get_bloginfo('version');
    
	wp_enqueue_script('media-upload');
	wp_enqueue_script('iris');
	wp_enqueue_script('wp-color-picker');
	
	if( version_compare( $wp_version, '3.4.2', '<=') ) {
		// Using pre-WP3.5
		wp_enqueue_script('thickbox');
		wp_register_script('icy-upload', ICY_URL .'/scripts/upload-button.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('icy-upload');

		wp_enqueue_style('thickbox');
		wp_enqueue_style('farbtastic');
	}
	
	if( isset($post) ) {
		wp_localize_script( 'jquery', 'icy_ajax', array(
		    'post_id' => $post->ID,
		    'nonce' => wp_create_nonce( 'icy-ajax' )
		) );
	}
}
add_action('admin_enqueue_scripts', 'icy_metabox_portfolio_scripts');

/*-----------------------------------------------------------------------------------*/
/*  Get column size
/*-----------------------------------------------------------------------------------*/

function icy_get_column_width($size, $grid = 1200, $margin = 20) {
        
        $columns = range(1,12);
        $widths = array();
        foreach($columns as $column) {
            $width = (( $grid + $margin ) / 12 * $column) - 3 * $margin;
            $width = round($width);
            $widths[$column] = $width;
        }
        
        $column_id = absint(preg_replace("/[^0-9]/", '', $size));
        $column_width = $widths[$column_id];
        return $column_width;
}


/*-----------------------------------------------------------------------------------*/
/* Aqua Resizer
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'aq_resize' ) ) {
    function aq_resize($url, $width, $height = null, $crop = null, $single = true) {
        //validate inputs
        if(!$url OR !$width ) return false;
        
        //define upload path & dir
        $upload_info = wp_upload_dir();
        $upload_dir = $upload_info['basedir'];
        $upload_url = $upload_info['baseurl'];
        
        //check if $url is local
        if(strpos( $url, $upload_url ) === false) return false;
        
        //define path of image
        $rel_path = str_replace( $upload_url, '', $url);
        $img_path = $upload_dir . $rel_path;
        
        //check if img path exists, and is an image indeed
        if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
        
        //get image info
        $info = pathinfo($img_path);
        $ext = $info['extension'];
        list($orig_w,$orig_h) = getimagesize($img_path);
        
        //get image size after cropping
        $dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
        $dst_w = $dims[4];
        $dst_h = $dims[5];
        
        //use this to check if cropped image already exists, so we can return that instead
        $suffix = "{$dst_w}x{$dst_h}";
        $dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
        $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
        
        //can't resize, so return original url
        if(!$dst_h) {
                $img_url = $url;
                $dst_w = $orig_w;
                $dst_h = $orig_h;
        }
        //else check if cache exists
        elseif(file_exists($destfilename) && getimagesize($destfilename)) {
            $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
        } 
        //else, we resize the image and return the new resized image url
        else {
            $resized_img_path = image_resize( $img_path, $width, $height, $crop );
            if(!is_wp_error($resized_img_path)) {
                $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
                $img_url = $upload_url . $resized_rel_path;
            } else {
                return false;
            }
        }
        
        //return the output
        if(!$single) {
            //array return
            $image = array (
                'url' => $img_url,
                'width' => $dst_w,
                'height' => $dst_h
            );
            
        } else {
            //url return
            $image = $img_url;
        }
        
        return $image;
    }
}
/*-----------------------------------------------------------------------------------*/
/* - Portfolio Walker
/*-----------------------------------------------------------------------------------*/

class Portfolio_Walker extends Walker_Category {
    function start_el(&$output, $category, $depth, $args) {
            extract($args);

            $cat_name = esc_attr( $category->name );
            $cat_name = apply_filters( 'list_cats', $cat_name, $category );
            $link = '<a href="' . esc_attr( get_term_link($category) ) . '" ';
            $link .= 'data-filter="' . $category->slug . '" ';
            if ( $use_desc_for_title == 0 || empty($category->description) )
                    $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s', 'framework' ), $cat_name) ) . '"';
            else
                    $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
            $link .= '>';
            $link .= $cat_name . '</a>';
            if ( !empty($feed_image) || !empty($feed) ) {
                    $link .= ' ';
                    if ( empty($feed_image) )
                            $link .= '(';
                    $link .= '<a href="' . get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) . '"';
                    if ( empty($feed) ) {
                            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'framework' ), $cat_name ) . '"';
                    } else {
                            $title = ' title="' . $feed . '"';
                            $alt = ' alt="' . $feed . '"';
                            $name = $feed;
                            $link .= $title;
                    }
            $link .= '>';

            if ( empty($feed_image) )
                    $link .= $name;
            else
                    $link .= "<img src='$feed_image'$alt$title" . ' />';

            $link .= '</a>';

            if ( empty($feed_image) )
                    $link .= ')';
		    }

            if ( !empty($show_count) )
                    $link .= ' (' . intval($category->count) . ')';

            if ( !empty($show_date) )
                    $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);

            if ( 'list' == $args['style'] ) {
                    $output .= "\t<li";
                    $class = 'cat-item cat-item-' . $category->term_id;
                    if ( !empty($current_category) ) {
                            $_current_category = get_term( $current_category, $category->taxonomy );
                            if ( $category->term_id == $current_category )
                                    $class .=  ' current-cat';
                            elseif ( $category->term_id == $_current_category->parent )
                                    $class .=  ' current-cat-parent';
                    }
                    $output .=  ' class="' . $class . '"';
                    $output .= ">$link\n";
            } else {
                    $output .= "\t$link<br />\n";
            }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/* 
/*  @param int $postid the post id
/*  @param int $width the width of the audio player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_audio' ) ) {
    function icy_audio($postid, $width = 1160) {

        global $post;
	
    	$mp3 = get_post_meta($postid, 'icy_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, 'icy_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, 'icy_audio_poster_url', TRUE);
    	$height = get_post_meta($postid, 'icy_audio_height', TRUE);
    	$height = ($height) ? $height : 75;
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page' );;
        if ($poster == '') {
            $poster = $thumbnail[0];
        }        
	
    ?>

    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	    			
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							$(this).jPlayer("setMedia", {
							    <?php if($poster != '') : ?>
							    poster: "<?php echo $poster; ?>",
							    <?php endif; ?>
							    <?php if($mp3 != '') : ?>
								mp3: "<?php echo $mp3; ?>",
								<?php endif; ?>
								<?php if($ogg != '') : ?>
								oga: "<?php echo $ogg; ?>",
								<?php endif; ?>
								end: ""
							});
						},
						size: {
        				    width: "<?php echo $width; ?>px",
        				    height: "<?php echo $height . 'px'; ?>"
        				},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
					});

    			});
    		</script>
		
    	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div class="jp-type-single">
                        <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                            <ul class="jp-controls">
                            	<li><div class="seperator-first"></div></li>
                                <li><div class="seperator-second"></div></li>
                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                            </ul>
                            <div class="jp-progress-container">
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-bar-container">
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Output video
/*
/*  @param int $postid the post id
/*  @param int $width the width of the video player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_video' ) ) {
    function icy_video($postid, $width = 1160) {

        global $post;
	
    	$height = get_post_meta($postid, 'icy_video_height', true);
    	$height = ($height) ? $height : 425;
    	$m4v = get_post_meta($postid, 'icy_video_m4v', true);
    	$ogv = get_post_meta($postid, 'icy_video_ogv', true);
    	$poster = get_post_meta($postid, 'icy_video_poster_url', true);
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page' );;
        if ($poster == '') {
            $poster = $thumbnail[0];
        }
	   echo $thumbnail[0];
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
		
    		if($().jPlayer) {
    			$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					$(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
    				    width: "<?php echo $width ?>px",
    				    height: "<?php echo $height . 'px'; ?>"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
    			});
    			
    		}
    	});
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"></div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div class="jp-type-single">
                <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                    <ul class="jp-controls">
                    	<li><div class="seperator-first"></div></li>
                        <li><div class="seperator-second"></div></li>
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                    </ul>
                    <div class="jp-progress-container">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-volume-bar-container">
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }
}


?>