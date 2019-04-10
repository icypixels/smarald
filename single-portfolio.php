<?php get_header(); ?>

<section id="primary" class="row-fluid">

	<section id="content" class="span12" role="main">

		<ul class="posts-list">	 
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <!--BEGIN .post -->
            <li <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       

                <!--BEGIN .entry-content -->
                <div class="entry-content">

                	<section id="portfolio-wrapper">	           			                            

	                	<?php 
						$nonce_prev = wp_create_nonce("portfolio");
						$nonce_next = wp_create_nonce("portfolio");
						$current_post_id = $post->ID;

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

						/*$adjacent_post_prev = get_adjacent_post(false,'',false); 
						$prev_post_id = $adjacent_post_prev->ID; 
						$adjacent_post_next = get_adjacent_post(false,'',false);
						$next_post_id =  $adjacent_post_next->ID; 
						$prev_post_link = '#';
						$next_post_link = '#';*/

						$in_same_cat = false;
						$excluded_categories = '';
						$previous = true;
						$previous_post = get_adjacent_post($in_same_cat,$excluded_categories,$previous);
						$prev_id = $previous_post->ID;

						$in_same_cat = false;
						$excluded_categories = '';
						$previous = false;
						$next_post = get_adjacent_post($in_same_cat,$excluded_categories,$previous);
						$next_id = $next_post->ID;

						$prev_post_link = get_permalink( $prev_id );
						$next_post_link = get_permalink( $next_id );
					?>		

						<div class="portfolio-navigation">							
							
							<?php if ( $prev_post_link && $next_post_link ) { ?>			
								<div class="prev-post prev-portfolio-post" data-post_id="<?php echo $prev_item_id; ?>" data-nonce="<?php echo $nonce_prev; ?>">
									<a rel="prev" href="<?php echo $prev_post_link; ?>">
										<?php _e('Prev Post', 'framework'); ?>
									</a>
								</div>
								<div class="next-post next-portfolio-post" data-post_id="<?php echo $next_item_id; ?>" data-nonce="<?php echo $nonce_next; ?>">
									<a rel="next" href="<?php echo $next_post_link; ?>">
										<?php _e('Next Post', 'framework'); ?>
									</a>
								</div>
								
							<?php } else if ( $prev_post_link ) { ?>
							
								<div class="prev-post prev-portfolio-post" data-post_id="<?php echo $prev_item_id; ?>" data-nonce="<?php echo $nonce_prev; ?>">
									<a rel="prev" href="<?php echo $prev_post_link; ?>">
										<?php _e('Prev Post', 'framework'); ?>
									</a>
								</div>

							<?php } else if ( $next_post_link ) { ?>

								<div class="next-post next-portfolio-post" data-post_id="<?php echo $next_item_id; ?>" data-nonce="<?php echo $nonce_next; ?>">
									<a rel="next" href="<?php echo $next_post_link; ?>">
										<?php _e('Next Post', 'framework'); ?>
									</a>
								</div>
						
							<?php } ?>		

						</div>

						<h1 class="portfolio-single-title"><?php the_title(); ?></h1>			

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
								<?php the_content(); ?>
							</div>
						</section>          

					<!--END #portfolio-wrapper -->
					</section>      		           	                   
                              
                <!--END .entry-content -->
                </div>

			<!--END .post-->  
			</li>

		<?php endwhile; ?>
		</ul>

		<!--BEGIN .navigation-->
		<div class="navigation-posts">
	    
			<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
			<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
	        
		<!--END .navigation-->
		</div>

		<?php else : ?>

			<!--BEGIN #post-0-->
			<div id="post-404" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
			
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				<!--END .entry-content-->
				</div>
			
			<!--END #post-0-->
			</div>

		<?php endif; ?>

	<!--BEGIN #content -->
	</section>
<!--BEGIN #primary -->
</section>


<?php get_sidebar(); ?>  	

<?php get_footer(); ?>