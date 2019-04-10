<?php get_header(); ?>

	<section id="primary" class="row-fluid">

		<section id="content" class="span12">		

			<?php 
				$title = get_post_meta($post->ID, 'icy_page_title', true);
				$subtitle = get_post_meta($post->ID, 'icy_page_subtitle', true);				

				if ($title) { ?>
					<div class="page-meta">
						<h1 class="page-title fadeInDown animated">
							<?php echo $title; ?>
						</h1>						
						<div class="separator"></div>
						<div class="page-subtitle fadeInUp animated">
							<?php echo wpautop( $subtitle ); ?>
						</div>
					</div>
			<?php }					
          
    	if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        	<!--BEGIN article -->
        	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       

	            <!--BEGIN .entry-content -->
	            <div class="entry-content">

	            	<?php if(has_post_thumbnail()) { 
	            		?>
	            	<figure class="fadeInUp animated">
	            		<?php the_post_thumbnail('page'); ?>
	            	</figure>
	            	<?php } ?>
	                        
	                <?php the_content(); ?>
	                            
	           <!--END .entry-content -->
	            </div>	

	        </article>		

			<?php endwhile; ?>

			<?php comment_form(); ?>

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

			</article>
			<?php endif; ?>

		</section>

	</section>	

<?php get_sidebar(); ?>  	

<?php get_footer(); ?>