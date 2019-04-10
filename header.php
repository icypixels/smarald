<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Icy Pixels | Powered by WordPress -->

<!-- BEGIN head -->
<head>

    <!-- Retrieve Theme Options for further use -->
    <?php global $icy_options;
    $icy_options = thsp_cbp_get_options_values(); ?>

	<!-- Basic Page Needs -->
    <title><?php
    if (is_home()) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif(is_page_template('template-home.php')) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_single() || is_page()) { single_post_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_search()) { _e('Search Results', 'framework'); echo " ".wp_specialchars($s); }
    elseif (is_category() || is_tag()) { single_cat_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    else { echo trim(wp_title(' ',false)); }
    ?></title>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- RSS & Pingbacks -->
   	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php 
    $feed = get_option(' icy_feedburner '); if ($feed != ''){echo get_option(' icy_feedburner ');} else {bloginfo('rss2_url');} ?>" />
   	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <!-- Theme Hook -->
    <?php wp_head(); ?> 
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
  
</head>
<!-- END head section -->

<!-- START body -->
<body <?php body_class('body-content'); ?>>

<!-- START mobile navigation -->
<nav id="nav" class="mobile-nav" role="navigation">
    <div class="block">                
    <?php 
        wp_nav_menu( array( 
            'theme_location' => 'main-menu', 
            'container' => '', 
            'before' => '',
        ) ); 
    ?>
    </div>
<span class="close-btn" id="nav-close-btn"><?php _e('Return to Content', 'framework'); ?></span>                
</nav> 
<!-- END mobile navigation -->

<!-- START Loading animation -->
<div class="icy-loader">
    <ul class="bokeh">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
<!-- END Loading animation -->

<!-- START #main-container -->
<section id="main-container" class="wrapper">

    <!-- START #top -->    
    <header id="top" class="clearfix fadeInDown animated">

        <!-- START .row-fluid -->
        <section class="row-fluid">

            <!-- START #logo -->
            <a href="<?php echo home_url(); ?>" class="logo">
                <?php 
                    $logo = $icy_options['logo'];
                    $logo_retina = $icy_options['logo_retina'];
                    $width = $icy_options['logo_width'];
                    $height = $icy_options['logo_height'];
                ?>
                <span class="normal_logo">
                    <?php if ($logo == '') { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
                    <?php } else { ?>
                        <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>    
                    <?php } ?>                    
                </span>
                <span class="retina_logo">
                    <?php if ($logo_retina == '') { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2x.png" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php bloginfo('name'); ?>" />
                    <?php } else { ?>
                        <img src="<?php echo $logo_retina; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />    
                    <?php } ?>                    
                </span>
            <!-- END #logo -->
            </a>

            <!-- START #primary-nav -->
            <nav id="primary-nav" class="primary-nav" role="navigation">                
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'main-menu', 
                        'container' => '', 
                        'before' => '',
                    ) ); 
                ?>                        
            </nav>
            <!-- END #primary-nav -->   


            <span class="nav-btn" id="nav-open-btn"><?php _e('Navigation', 'framework'); ?></span>         
            
        </section>

    </header>
    <!-- END header -->
