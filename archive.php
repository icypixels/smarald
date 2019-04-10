<?php get_header(); ?>  

<?php

/* Fetching the Current Author Data */ 
if(get_query_var('author_name')) :
	$curauth = get_userdatabylogin(get_query_var('author_name'));
else :
	$curauth = get_userdata(get_query_var('author'));
endif;

?>

<section id="primary" class="row-fluid">

	<section id="content" class="span12" role="main">

		<div class="page-meta">
			<h1 class="page-title fadeInDown animated"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
				<?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?>
	 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?>
	 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?>
	 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?>
	 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?>
		  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?>
	 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<?php _e('Blog Archives', 'framework') ?>
	 	  	<?php } ?></h1>  
	 	</div>    

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

		<!--BEGIN .navigation-->
		<div class="navigation-posts offset2 span8">

			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>	    
				<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
			<?php } ?>
	        
		<!--END .navigation-->
		</div>

		<?php else : ?>

		<?php if ( is_category() ) { 
			// If this is a category archive
				printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'framework'), single_cat_title('',false));
			} elseif ( is_tag() ) { 
			// If this is a tag archive
			    printf(__('<h2>Sorry, but there aren\'t any posts tagged %s yet.</h2>', 'framework'), single_tag_title('',false));
			} elseif ( is_date() ) { 
			// If this is a date archive
				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'framework'));
			} elseif ( is_author() ) { 
			// If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'framework'), $userdata->display_name);
			} else {
				echo(__('<h2>No posts found.</h2>', 'framework'));
			}
		endif; ?>

	<!--BEGIN #content -->
	</section>
<!--BEGIN #primary -->
</section>


<?php get_sidebar(); ?>  	

<?php get_footer(); ?>
