<!-- Meta Content -->
<div class="entry-meta">				    
	<span class="day"><?php the_time('d'); ?></span>
	<span class="month"><?php the_time('M'); ?></span>
</div>
<!-- End Meta Content -->

<!-- Post Content -->
<div class="the-content offset2 span8">
    <?php the_content(__('Read more', 'framework')); ?>
    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?> 
    
</div>
<!-- End Post Content -->