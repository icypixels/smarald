<?php

global $icy_options;

if(!class_exists('ICY_Blog_Block')) {
	class ICY_Blog_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Blog Posts',
				'size' => 'span12',				
			);
			
			//create the block
			parent::__construct('icy_blog_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(		
				'column' => 'three-col',		
				'itemno' => '',
				'types'	=> '',
				'grid_options' => 'regular-view',
				'animation' => 'overlap-animation',		
				'img_width' => '772',
				'img_height' => '434',						
				'gray' => 1,			
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);						

			$columns_options = array(
				'two-col' => 'Two Columns',
				'three-col' => 'Three Columns',
				'four-col' => 'Four Columns',
			);

			$animation_options = array(
				'overlap-animation' => 'Overlapping animation',
				'fade-animation' => 'Fade animation',
			);

			$gridtype_options = array(
				'regular-view' => 'Regular',
				'grid-view' => 'Grid'
			);

			$output_categories = array();
			$categories=get_categories();
			foreach($categories as $category) { 
			     $output_categories[$category->cat_ID] = $category->name;
			}					
			
			?>

			<p>Note: You should only use this block on a full-width template</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('itemno') ?>">
					Number of Items (-1 for All)<br/>
					<?php echo aq_field_input('itemno', $block_id, $itemno, $size = 'full'); ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('types') ?>">
					Blogs Categories (for all leave blank)<br/>
				<?php echo aq_field_multiselect('types', $block_id, $output_categories, $types); ?>
				</label>
			</p>
			<p class="description third">
				<label for="<?php echo $this->get_field_id('column') ?>">
					Number of Columns<br/>
					<?php echo aq_field_select('column', $block_id, $columns_options, $column); ?>
				</label>
			</p>
			<p class="description third">
				<label for="<?php echo $this->get_field_id('animation') ?>">
					Animation Type<br/>
					<?php echo aq_field_select('animation', $block_id, $animation_options, $animation); ?>
				</label>
			</p>
			<p class="description third last">
				<label for="<?php echo $this->get_field_id('grid_options') ?>">
					Grid Type<br/>
					<?php echo aq_field_select('grid_options', $block_id, $gridtype_options, $grid_options); ?>
				</label>
			</p>
			<div class="description half">
				<label for="<?php echo $this->get_field_id('img_width') ?>">
					Thumbnail Width<br/>
					<?php echo aq_field_input('img_width', $block_id, $img_width, 'min', 'number') ?> px
				</label>				
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('img_height') ?>">
					Thumbnail Height<br/>
					<?php echo aq_field_input('img_height', $block_id, $img_height, 'min', 'number') ?> px
				</label>				
			</div>
			<p class="description">
				<label for="<?php echo $this->get_field_id('gray') ?>">
					<?php echo aq_field_checkbox('gray', $block_id, $gray); ?>
					Display blog pictures in grayscale?
				</label>
			</p>			
			<?php
		}
		
		function block($instance) {
			extract($instance);		
			global $icy_options; 

			wp_enqueue_script('isotope');	
			wp_enqueue_script('easing');			
			//wp_enqueue_script('flexslider');
			//wp_enqueue_script( 'scrollTo' );                                    
			?>			

			<section class='icy-portfolio fadeInUp animated <?php echo $column; ?> <?php echo $animation; ?> <?php echo $grid_options; ?>' data-height=''>           
	            <!--  Output filter options -->
	            <div class='filter-layouts'>

	            	<a href='#'><span class='grid'></span></a>
	            	<a href='#'><span class='regular selected'></span></a>

	            </div>

	            <!-- Output portfolio categories for filtering -->
	            <ul class='icy-portfolio-tax'>

	            <?php	
	            	$taxonomy			= 'category';
				    $show_option_all	= '';
				    $orderby			= 'name';
				    $hierarchical		= 1;      // 1 for yes, 0 for no
				    $title				= '';
				    $walker				= new Portfolio_Walker();
				
				    $args = array(
				      'taxonomy'     => $taxonomy,
				      'show_option_all' => $show_option_all,
				      'orderby'      => $orderby,
					  'show_option_none'   => false,
				      'hierarchical' => $hierarchical,
				      'title_li'     => $title,
				      'walker'       => $walker
				    );

					if(!empty($types)) {
				    	$args['include'] = $types;
				    }

	            	$blocktext = __('All', 'framework');
	            	echo "<li><a href='#all' data-filter='portfolio-item' data-name='All' class='active'>$blocktext</a></li>";
	            	wp_list_categories( $args );	            	

	            ?>
	            
	            </ul>

	            <!--Output Portfolio items-->
	            <ul class='portfolio-grid row-fluid'>
				
				<?php 
				
				$type = 'post';
			   	$args = array();
			    $args=array(
				    'post_type' => $type,
			        'posts_per_page' => $itemno,
			        'orderby' => 'date',
			        'order' => 'DESC',
			    );
			    
			    if(!empty($types)) {
			    	$args['tax_query'] = array(
			    			array(
			    				'taxonomy' => 'category',
			    				'field' => 'id',
			    				'terms' => $types
			    			)
			    	);
			    }

			    global $post;
			    
			    $query = new WP_Query( $args );                            
	            $counter = 1;
	            if($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post(); 

	                // taxonomy terms slugs for isotope filtering
	                $terms =  get_the_terms( $post->ID, 'category' ); 
	                $term_list = '';                                
	                if( is_array($terms) ) {
	                    foreach( $terms as $term ) {
	                        $term_list .= $term->slug;
	                        $term_list .= ' ';
	                    }
	                }

	                // taxonomy terms names for output on hover
	                $terms =  get_the_terms( $post->ID, 'category' ); 
	                $term_names = '';                                
	                if( is_array($terms) ) {
	                    foreach( $terms as $term ) {
	                        $term_names .= $term->name;
	                        $term_names .= ' ';
	                    }
	                }
	                
	                // Setting variable width on every 4th item and implementing grayscale option	                
	                if ($counter % 4 == 0) { 
	                	$size = "width2"; 	                	
	                } else { 	              
	                	$size = ""; 
	                } 	                
	                
	                if ($gray == 1) { $grayscale = "grayscale"; } else { $grayscale = ""; }

	                // Setting nonce for AJAX security	                
	                $postid = $post->ID;
	                $nonce = wp_create_nonce('portfolio');

	                ?>						
		            <a class="project-link" href="<?php the_permalink(); ?>" data-post_id="<?php echo $post->ID; ?>" data-nonce="<?php echo $nonce; ?>">
		                <li class="<?php echo $size; ?> portfolio-item width1 animated <?php echo $term_list; ?>" data-post_id="<?php echo $post->ID; ?>" data-nonce="<?php echo $nonce; ?>">      
		                	
                			<figure class="picture<?php echo ' ' . $grayscale; ?>">                				
				               	<?php 
	                			$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url($thumb);							
								$image = aq_resize( $img_url, $img_width, $img_height, true );                		
								?>		
				               	<img src="<?php echo $image; ?>" width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" alt="<?php the_title(); ?>" />		               
                			</figure>                		
                			<section class="hover">                			
                				<h2 class="portfolio-title"><?php the_title(); ?></h2>     
                				<div class="separator"></div>           			                		
                				<span class="portfolio-categories"><?php echo $term_names; ?></span>
                			</section>                			            
		                </li>
    				</a>			        
					
					<?php 
	                
            		$counter++;
        			endwhile; 
					wp_reset_query(); 
				endif;

				?>
            	</ul>
		
			</section>
													          
			<?php
		}
		
		function update($new_instance, $old_instance) {
			$new_instance['itemno'] = htmlspecialchars(stripslashes($new_instance['itemno']));
			return $new_instance;
		}
		
	}
}