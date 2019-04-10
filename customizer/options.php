<?php

/**
 * Get Theme Customizer Fields
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function thsp_cbp_get_fields() {

	/*
	 * Using helper function to get default required capability
	 */
	$thsp_cbp_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'icy_theme_logo' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Logo Setup', 'framework' ),
				'description' => __( 'Setup your own logo for your website.', 'framework' ),
				'priority' => 1
			),
			'fields' => array(				
				'logo' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 1
					)
				),
				'logo_width' => array(
					'setting_args' => array(
						'default' => '132',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Width (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 3
					)
				),
				'logo_height' => array(
					'setting_args' => array(
						'default' => '43',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Height (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 4
					)
				),				
				'logo_retina' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Retina', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 2
					)
				),
				'favicon' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Favicon', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 6
					)
				),
				'logo_placement' => array(
					'setting_args' => array(
						'default' => 'right-aligned',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo placement', 'framework' ),
						'type' => 'select',
						'choices' => array(
							'left-aligned' => array(
								'label' => __( 'Left Aligned', 'framework' )
							),
							'center-aligned' => array(
								'label' => __( 'Centered', 'framework' )
							),
							'right-aligned' => array(
								'label' => __( 'Right Aligned', 'framework' )
							)
						),					
						'priority' => 5
					)
				),

			),
			
		),
		// Section ID
		'icy_theme_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Theme Settings', 'framework' ),
				'description' => __( 'Theme settings helping you customize your brand new theme and make it your own.', 'framework' ),
				'priority' => 2
			),
			'fields' => array(											
				'custom_css' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Custom CSS', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 3
					)
				),

			),
			
		),
		'colors' => array(
			'existing_section' => true,
			'fields' => array(
				'color_scheme' => array(
					'setting_args' => array(
						'default' => 'light',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Color Scheme', 'framework' ),
						'type' => 'radio', // Radio control
						'choices' => array(
							'light' => array(
								'label' => __( 'Light', 'framework' )
							),
							'dark' => array(
								'label' => __( 'Dark', 'framework' )
							),							
						),					
						'priority' => 1
					),								
				),	
				'accent_colour' => array(
						'setting_args' => array(
							'default' => '#00a78d',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Accent colour', 'framework' ),
							'type' => 'color',
							'priority' => 2
						)
				),			
				'text_colour' => array(
						'setting_args' => array(
							'default' => '#777777',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Text colour', 'framework' ),
							'type' => 'color',
							'priority' => 4
						)
				),
				'headings_colour' => array(
						'setting_args' => array(
							'default' => '#333333',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Headings colour', 'framework' ),
							'type' => 'color',
							'priority' => 5
						)
				),		
				'footer_colour' => array(
						'setting_args' => array(
							'default' => '#fff',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Footer background colour', 'framework' ),
							'type' => 'color',
							'priority' => 6
						)
				),									
			)
		)

	);
	
	/* 
	 * 'thsp_cbp_options_array' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options_array', $options );
	
}