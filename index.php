<?php get_header(); ?>

<section id="primary" class="row-fluid">

	<section id="content" class="span12" role="main">

		<?php 
			// Getting the ID of the Page for Posts (which is the Blog)
			$postID = get_option('page_for_posts '); 
		
			// Now we can retrieve meta box information like page title and subtitle
			$title = get_post_meta($postID, 'icy_page_title', true);
			$subtitle = get_post_meta($postID, 'icy_page_subtitle', true);

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
		<?php }		?>

		<ul class="posts-list animated fadeInUp">	 
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <!--BEGIN .post -->
            <li <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       

                <!--BEGIN .entry-content -->
                <div class="entry-content">					           			                            

	                <?php 
				        $format = get_post_format();
				        if( false === $format ) { $format = 'standard'; }
				    ?>				   

					<!-- Post Format Element-->
				    <?php get_template_part( 'post', $format ); ?>	
				    <!-- End Post Format Element -->				    	                               		                              
                <!--END .entry-content -->
                </div>

			<!--END .post-->  
			</li>

		<?php endwhile; ?>
		</ul>		

		<?php if (function_exists('wp_pagenavi')) { ?> <div class="offset2 span8"><?php wp_pagenavi(); ?></div> <?php } else { ?>
		<!--BEGIN .navigation-->
		<div class="navigation-posts offset2 span8">

				    
				<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>			       
		<!--END .navigation-->
		</div>
		<?php } ?>

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