<?php 

global $icy_options;

/**
 * Contains arrays for creating metaboxes within the theme.
 * 
 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
 * @since Smarald 1.0
 *
 */

	add_action('add_meta_boxes', 'icy_metabox_posts');
	function icy_metabox_posts(){

		$meta_box = array(
			'id' => 'icy-background-meta-box',
			'title' => __('Custom Background Settings', 'framework'),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
			    array(
		    			'name' =>  __('Custom Background Image', 'framework'),
		    			'desc' => __('Upload a custom background image for this post. Once uploaded, click "Insert to Post".', 'framework'),
		    			'id' => 'icy_background_image',
		    			"type" => "file",
		    			'std' => ''
		    		),	    	
		    	array(
		    	        'name' => __('Custom Background Repeat', 'framework'),
		    	        'desc' => __('Select a custom background repeat for the uploaded image.', 'framework'),
		    	        'id' => 'icy_background_repeat',
		    	        'type' => 'select',
		    	        'std' => '',
		    	        'options' => array(__('No Repeat', 'framework'), __('Repeat', 'framework'), __('Repeat Horizontally', 'framework'), __('Repeat Vertically', 'framework')),
		    	),
		    	array(
		    	        'name' => __('Custom Background Position', 'framework'),
		    	        'desc' => __('Select a custom background position for the uploaded image.', 'framework'),
		    	        'id' => 'icy_background_position',
		    	        'type' => 'select',
		    	        'std' => '',
		    	        'options' => array(__('Left', 'framework'), __('Right', 'framework'), __('Centered', 'framework'), __('Full Screen', 'framework') )
		    	),
		        array(
		                'name' => __('Custom Background Color', 'framework'),
		                'desc' => __('Type a custom background color for the uploaded image. (e.g. #ffffff)', 'framework'),
		                'id' => 'icy_background_color',
		                'type' => 'color',
		                'val' => '#ffffff',
		                'std' => '#fff'
		        ),	
		        array(
		                'name' => __('Content Background Color', 'framework'),
		                'desc' => __('Pick a background color for the content wrapper. (e.g. #ffffff)', 'framework'),
		                'id' => 'icy_content_background_color',
		                'type' => 'color',
		                'val' => '#ffffff',
		                'std' => '#fff'
		        ),
		        array(
		                'name' => __('Remove Content Background Color ?', 'framework'),
		                'desc' => __('Do you wish to remove the content background color completely so your page has a nice fullscreen background photo?', 'framework'),
		                'id' => 'icy_content_background_disable',
		                'type' => 'checkbox',	                
		                'std' => ''
		        )        
			)
		);
		icy_add_meta_box( $meta_box );

		$meta_box = array(
			'id' => 'icy-page-settings-meta-box',
			'title' => __('Page Settings', 'framework'),
			'page' => 'page',
			'context' => 'normal',
			'priority' => 'default',
			'fields' => array(
				array(
		    	   'id' => 'icy_page_title',
		    	   'name' => __('Page Title', 'framework'),
		    	   'desc' => __('Choose a page title to be displayed at the very top of the webpage.', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_page_subtitle',
		    	   'name' => __('Page Subtitle', 'framework'),
		    	   'desc' => __('Choose a page subtitle to be displayed at the very top of the webpage.', 'framework'),
		    	   'type' => 'textarea',
		    	   'std' => ''
		    	),
			    array(
		    			'name' =>  __('Custom Background Image', 'framework'),
		    			'desc' => __('Upload a custom background image for this post. Once uploaded, click "Insert to Post".', 'framework'),
		    			'id' => 'icy_background_image',
		    			"type" => "file",
		    			'std' => ''
		    		),	    	
		    	array(
		    	        'name' => __('Custom Background Repeat', 'framework'),
		    	        'desc' => __('Select a custom background repeat for the uploaded image.', 'framework'),
		    	        'id' => 'icy_background_repeat',
		    	        'type' => 'select',
		    	        'std' => '',
		    	        'options' => array(__('No Repeat', 'framework'), __('Repeat', 'framework'), __('Repeat Horizontally', 'framework'), __('Repeat Vertically', 'framework')),
		    	),
		    	array(
		    	        'name' => __('Custom Background Position', 'framework'),
		    	        'desc' => __('Select a custom background position for the uploaded image.', 'framework'),
		    	        'id' => 'icy_background_position',
		    	        'type' => 'select',
		    	        'std' => '',
		    	        'options' => array(__('Left', 'framework'), __('Right', 'framework'), __('Centered', 'framework'), __('Full Screen', 'framework') )
		    	),
		        array(
		                'name' => __('Custom Background Color', 'framework'),
		                'desc' => __('Type a custom background color for the uploaded image. (e.g. #ffffff)', 'framework'),
		                'id' => 'icy_background_color',
		                'type' => 'color',
		                'val' => '#ffffff',
		                'std' => '#fff'
		        ),	        
		        array(
		                'name' => __('Content Background Color', 'framework'),
		                'desc' => __('Pick a background color for the content wrapper. (e.g. #ffffff)', 'framework'),
		                'id' => 'icy_content_background_color',
		                'type' => 'color',
		                'val' => '#ffffff',
		                'std' => '#fff'
		        ),
		        array(
		                'name' => __('Remove Content Background Color ?', 'framework'),
		                'desc' => __('Do you wish to remove the content background color completely so your page has a nice fullscreen background photo?', 'framework'),
		                'id' => 'icy_content_background_disable',
		                'type' => 'checkbox',	                
		                'std' => ''
		        )
			)
		);
		icy_add_meta_box( $meta_box );
	        
	    $meta_box = array(
			'id' => 'icy-metabox-post-gallery',
			'title' =>  __('Post Gallery', 'framework'),
			'desc' => __('Insert your pictures here.', 'framework'),
			'page' => 'post',
			'context' => 'side',
			'priority' => 'high',
			'fields' => array(
				array(
	    				'name' =>  __('Gallery Type', 'framework'),    				
	    				'desc' => __('Choose your desired format for your gallery', 'framework'),
	    				'id' => 'icy_gallery_type',
	    				"type" => "select",
						'std' => 1,
						'options' => array('Lightbox', 'Slideshow')  				
	    			),
	    		array(
	    				'name' =>  __('Gallery Images', 'framework'),    				
	    				'desc' => __('Upload images for slideshow or lightbox', 'framework'),
	    				'id' => 'icy_gallery_images',
	    				'type' => 'images',
						'std' => __('Upload', 'framework'),						
	    			),
				array(
	    				'name' =>  __('Gallery Columns', 'framework'),    				
	    				'desc' => __('Amount of columns for lightbox gallery type.', 'framework'),
	    				'id' => 'icy_gallery_columns',
	    				"type" => "select",
						'std' => '3',
						'options' => array('1', '2', '3', '4', '5', '8', '10')  				
	    			),		    		
			)
		);
	    icy_add_meta_box( $meta_box );

	    $meta_box = array(
			'id' => 'icy-metabox-post-video',
			'title' =>  __('Video Settings', 'framework'),
			'page' => 'post',
			'context' => 'side',
			'priority' => 'high',
			'fields' => array(		
				array( "name" => __('Embeded Code','framework'),
						"desc" => __('If you\'re not using self hosted video then you can include embeded code here.','framework'),
						"id" => "icy_video_embed",
						"type" => "textarea",
						"std" => ''
					),
				)
		);
		icy_add_meta_box( $meta_box );

		/* Create a quote metabox -----------------------------------------------------*/
	    $meta_box = array(
			'id' => 'icy-metabox-post-quote',
			'title' =>  __('Quote Settings', 'framework'),
			'description' => __('Input your quote.', 'framework'),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
						'name' =>  __('The Quote', 'framework'),
						'desc' => __('Input your quote.', 'framework'),
						'id' => 'icy_quote_text',
						'type' => 'textarea',
	                    'std' => ''
					)
			)
		);
	    icy_add_meta_box( $meta_box );
		
		/* Create a link metabox ----------------------------------------------------*/
		$meta_box = array(
			'id' => 'icy-metabox-post-link',
			'title' =>  __('Link Settings', 'framework'),
			'description' => __('Input your link', 'framework'),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
						'name' =>  __('The Link', 'framework'),
						'desc' => __('Insert your link URL, e.g. http://www.themeicy.com.', 'framework'),
						'id' => 'icy_link_url',
						'type' => 'text',
						'std' => ''
					)
			)
		);
	    icy_add_meta_box( $meta_box );
	    
	    /* Create a video metabox -------------------------------------------------------*/
	    $meta_box = array(
			'id' => 'icy-metabox-post-video',
			'title' => __('Video Settings', 'framework'),
			'description' => __('These settings enable you to embed videos into your posts.', 'framework'),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => __('Video Height', 'framework'),
						'desc' => __('The video height (e.g. 500).', 'framework'),
						'id' => 'icy_video_height',
						'type' => 'text',
						'std' => ''
					),
				array( 
						'name' => __('M4V File URL', 'framework'),
						'desc' => __('The URL to the .m4v video file', 'framework'),
						'id' => 'icy_video_m4v',
						'type' => 'file',
						'std' => ''
					),
				array( 
						'name' => __('OGV File URL', 'framework'),
						'desc' => __('The URL to the .ogv video file', 'framework'),
						'id' => 'icy_video_ogv',
						'type' => 'file',
						'std' => ''
					),
				array( 
						'name' => __('Poster Image', 'framework'),
						'desc' => __('The preview image. The preview image should be 500px wide.', 'framework'),
						'id' => 'icy_video_poster_url',
						'type' => 'file',
						'std' => ''
					),
				array(
						'name' => __('Embedded Code', 'framework'),
						'desc' => __('If you are using something other than self hosted video such as Youtube or Vimeo, paste the embed code here. Width is best at 500px with any height.<br><br> This field will override the above.', 'framework'),
						'id' => 'icy_video_embed_code',
						'type' => 'textarea',
						'std' => ''
					)
			)
		);
		icy_add_meta_box( $meta_box );
		
		/* Create an audio metabox ------------------------------------------------------*/
		$meta_box = array(
			'id' => 'icy-metabox-post-audio',
			'title' =>  __('Audio Settings', 'framework'),
			'description' => __('These settings enable you to embed audio into your posts. You must provide both .mp3 and .agg/.oga file formats in order for self hosted audio to function accross all browsers.', 'framework'),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => __('MP3 File URL', 'framework'),
						'desc' => __('The URL to the .mp3 audio file', 'framework'),
						'id' => 'icy_audio_mp3',
						'type' => 'file',
						'std' => ''
					),
				array( 
						'name' => __('OGA File URL', 'framework'),
						'desc' => __('The URL to the .oga, .ogg audio file', 'framework'),
						'id' => 'icy_audio_ogg',
						'type' => 'file',
						'std' => ''
					),
				array( 
						'name' => __('Audio Poster Image', 'framework'),
						'desc' => __('The preview image for this audio track.', 'framework'),
						'id' => 'icy_audio_poster_url',
						'type' => 'file',
						'std' => ''
					),
				array( 
						'name' => __('Audio Poster Image Height', 'framework'),
						'desc' => __('The height of the poster image. It is really IMPORTANT to set a height if there\'s an image attached to the post.', 'framework'),
						'id' => 'icy_audio_height',
						'type' => 'text',
						'std' => ''
					)
			)
		);
		icy_add_meta_box( $meta_box );

		$meta_box = array(
		'id' => 'icy-metabox-portfolio-gallery',
		'title' =>  __('Gallery Settings', 'framework'),
		'page' => 'portfolio',
		'context' => 'side',
		'priority' => 'default',
		'fields' => array(		
				array(
	    				'name' =>  __('Gallery Type', 'framework'),    				
	    				'desc' => __('Choose your desired format for your gallery', 'framework'),
	    				'id' => 'icy_portfolio_gallery_type',
	    				"type" => "select",
						'std' => 1,
						'options' => array('Lightbox', 'Slideshow')  				
	    			),		
				array(
			    	   'id' => 'icy_portfolio_gallery',
			    	   'name' => __('Project Gallery', 'framework'),
			    	   'desc' => __('Upload images here if you have set the Slideshow Portfolio Type.', 'framework'),
			    	   'type' => 'images',
			    	   'std' => __('Upload to Gallery', 'framework')
		    	),
		    	array(
	    				'name' =>  __('Gallery Columns', 'framework'),    				
	    				'desc' => __('Amount of columns for lightbox gallery type.', 'framework'),
	    				'id' => 'icy_portfolio_gallery_columns',
	    				"type" => "select",
						'std' => '3',
						'options' => array('1', '2', '3', '4', '5', '8', '10')  				
	    			),	
		    	array(
		    	   'id' => 'icy_portfolio_mixed',
		    	   'name' => __('Mixed Media Shortcode ID', 'framework'),
		    	   'desc' => __('Input just the ID of the shortcode. (e.g. 43)', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    )	
		);
		icy_add_meta_box( $meta_box );

		$meta_box = array(
			'id' => 'icy-metabox-portfolio-settings',
			'title' =>  __('Portfolio Settings', 'framework'),
			'description' => __('For Image type, set a featured Image. For Slideshow type, set a featured image and upload a gallery of images using the Gallery Settings found aside of this box. Same goes for Video type. I have tried to make the meta fields as customizable as possible, therefore you can fill in with your desired content, instead of Agency, Date, Client etc. fields.', 'framework'),
			'page' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(		
				array(
		    		'id' => 'icy_portfolio_type',
					'name' =>  __('Portfolio Type', 'framework'),
					'desc' => __('Choose the portfolio type you wish to display:', 'framework'),
					"type" => "select",
					'std' => 'Image',
					'options' => array('Image', 'Slideshow', 'Video')
				),
				array(
		    		'id' => 'icy_portfolio_metadescription',
					'name' =>  __('Display Meta Fields ?', 'framework'),
					'desc' => __('Do you want to display the metafields below?', 'framework'),
					'type' => 'checkbox',
					'std' => 'true'				
				),				    	
				array(
		    	   'id' => 'icy_portfolio_logo',
		    	   'name' => __('Client Logo', 'framework'),
		    	   'desc' => __('Used in the single portfolio page display, in the middle of the page. Recommended : 80x80 size.', 'framework'),
		    	   'type' => 'file',
		    	   'std' => ''
		    	),	    	
		    	array(
		    	   'id' => 'icy_portfolio_agency_t',
		    	   'name' => __('Title 1', 'framework'),
		    	   'desc' => __('Type in the desired text. (e.g. Agency, Date, Client, URL)', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_portfolio_agency',
		    	   'name' => __('Description 1', 'framework'),
		    	   'desc' => __('The agency under which the project was completed.', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_portfolio_client_t',
		    	   'name' => __('Title 2', 'framework'),
		    	   'desc' => __('Type in the desired text. (e.g. Agency, Date, Client, URL)', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_portfolio_client',
		    	   'name' => __('Description 2', 'framework'),
		    	   'desc' => __('For whom the portfolio was completed.', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_portfolio_role_t',
		    	   'name' => __('Title 3', 'framework'),
		    	   'desc' => __('Type in the desired text. (e.g. Agency, Date, Client, URL)', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
				array(
		    	   'id' => 'icy_portfolio_role',
		    	   'name' => __('Portfolio Role', 'framework'),
		    	   'desc' => __('What was your role on this project?', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
		    	array(
		    	   'id' => 'icy_portfolio_url_t',
		    	   'name' => __('Title 4', 'framework'),
		    	   'desc' => __('Type in the desired text. (e.g. Agency, Date, Client, URL)', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	),
				array(
		    	   'id' => 'icy_portfolio_url',
		    	   'name' => __('Portfolio Role', 'framework'),
		    	   'desc' => __('A link to the project.', 'framework'),
		    	   'type' => 'text',
		    	   'std' => ''
		    	)
			)
		);
		icy_add_meta_box( $meta_box );

		$meta_box = array(
		'id' => 'icy-metabox-portfolio-video-embed',
		'title' =>  __('Portfolio Video Embed', 'framework'),
		'page' => 'portfolio',
		'context' => 'side',
		'priority' => 'default',
		'fields' => array(		
			array(
		    	   'id' => 'icy_portfolio_video',
		    	   'name' => __('Project Video', 'framework'),
		    	   'desc' => __('Add in your embed code here (Vimeo, YouTube etc.)', 'framework'),
		    	   'type' => 'textarea',
		    	   'std' => ''
		    	),
		    )		
		);
		icy_add_meta_box( $meta_box );
	}


?>