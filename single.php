<?php get_header(); ?>

<section id="primary" class="row-fluid">

	<section id="content" class="span12" role="main">		
			
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

   			<div class="post-navigation fadeInUp animated">			

   				<?php 
   					// Getting the Blog page ID
   					$postID = get_option('page_for_posts '); 
   					// Getting the Blog page link
   					$blogpage = get_permalink($postID); 
   				?>		
									
				<div class="prev-post">
					<?php previous_post_link('%link'); ?>
				</div>
				<div class="show-grid">
					<a href="<?php echo $blogpage; ?>" id="show-grid" title="<?php _e('Show All Posts', 'framework'); ?>">
						<?php _e('Show All Posts', 'framework'); ?>
					</a>
				</div>
				<div class="next-post">
					<?php next_post_link('%link'); ?> 
				</div>
							
			</div>
	            
	            <!--BEGIN .post -->
	            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       

	                <!--BEGIN .entry-content -->
	                <div class="entry-content fadeInUp animated">					           

			            <?php 
					        $format = get_post_format();
					        if( false === $format ) { $format = 'standard'; }
					    ?>				   

						<!-- Post Format Element-->
					    <?php get_template_part( 'post', $format ); ?>	
					    <!-- End Post Format Element -->     

					    <span class="post-tags offset2 span8"><?php the_tags('Tags:', '', ''); ?></span>                                                              					    

	                <!--END .entry-content -->
	                </div>

				<!--END .post-->  
				</div>

			<?php endwhile; ?>

			<div class="offset2 span8">
				<?php comments_template('', true); ?>			
			</div>

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