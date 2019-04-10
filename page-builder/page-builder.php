<?php
/**
 *	Adds and register blocks for the Aqua Page Builder
 *
 *	@package Smarald
 *
 */


if(class_exists('AQ_Page_Builder')) {
	define('ICY_CUSTOM_DIR', get_template_directory() . '/page-builder/');
	define('ICY_CUSTOM_URI', get_template_directory_uri() . '/page-builder/');
	
	//include the block files
	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-blog-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slogan-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-image-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-testimonial-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-pricetable-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contact-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-horizontal-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-slider-block.php');	
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-portfolio-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-year-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-team-member-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-skills-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-centered-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-google-map-block.php');
	require_once(ICY_CUSTOM_DIR . 'blocks/icy-contact-block.php');
	
	//register the blocks
	
	aq_register_block('ICY_Blog_Block');
	aq_register_block('ICY_Centered_Block');	
	aq_register_block('ICY_Contact_Block');
	aq_register_block('ICY_Googlemap_Block');
	aq_register_block('ICY_Image_Block');
	aq_register_block('ICY_Portfolio_Block');
	aq_register_block('ICY_Pricetable_Block');
	aq_register_block('ICY_Horizontal_Block');
	aq_register_block('ICY_Skills_Block');
	aq_register_block('ICY_Slogan_Block');
	aq_register_block('ICY_Slider_Block');
	aq_register_block('ICY_Team_Member_Block');
	aq_register_block('ICY_Testimonial_Block');			
	aq_register_block('ICY_Year_Block');	

	if(is_admin()) add_action('aq-page-builder-admin-enqueue', 'aqpb_custom_admin_js');
	function aqpb_custom_admin_js() {
		wp_register_style( 'aqpb-custom-admin-css',  ICY_CUSTOM_URI . 'css/aqpb-custom-admin.css', array(), time(), 'all');
		wp_register_script('aqpb-custom-admin-js', ICY_CUSTOM_URI . 'js/aqpb-custom-admin.js', array('jquery', 'aqpb-js'), time(), true);
		
		wp_enqueue_style('aqpb-custom-admin-css');
		wp_enqueue_script('aqpb-custom-admin-js');
	}
		
}

?>