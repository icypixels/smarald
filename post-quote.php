

	<!-- Post Content -->
	<div class="the-content offset2 span8">
	<!-- Post Title -->
	    <h1 class="icy-quote">
	    	<?php $quote = get_post_meta($post->ID, 'icy_quote_text', true); 
	    	echo $quote; ?>    
		</h1>
		<div class="separator"></div>	       
		<a class="entry-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
			<h1 class="sub-title"><?php the_title(); ?></h1>        
		</a>

		<?php the_content(__('Read more', 'framework')); ?>
	    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>     
	<!-- End Post Title -->

	</div>
	<!-- End Post Content -->

