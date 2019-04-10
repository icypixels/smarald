
<!-- Post Title -->
<a class="entry-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
    <h1>
        <?php the_title(); ?>
    </h1>                      
</a>
<!-- End Post Title -->

<!--BEGIN .post-media -->
<div class="post-media icy_video">

    <?php 
        $embed = get_post_meta($post->ID, 'icy_video_embed_code', true);
        if( !empty( $embed ) ) {
            echo stripslashes(htmlspecialchars_decode($embed));
        } else {
            icy_video($post->ID, 1160);
        }
    ?>
    
<!--END .post-media -->
</div>

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
