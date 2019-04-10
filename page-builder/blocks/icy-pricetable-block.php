<?php
/* Pricing Tables Block */
if(!class_exists('ICY_Pricetable_Block')) {
	class ICY_Pricetable_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Pricing Table',
				'size' => 'span3'
			);
			
			parent::__construct('icy_pricetable_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title' => 'Normal',
				'price' => 'free',
				'timeline' => '',
				'img' => '',
				'features' => '',				
				'color' => '00a78d',
				'btntext' => 'Buy Now',
				'btnlink' => '#'
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Package Title (required)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Upload an image (optional)<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<?php if($img) { ?>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('price') ?>">
					Price (required)<br/>
					<?php echo aq_field_input('price', $block_id, $price) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('timeline') ?>">
					Pricing timeline (e.g. "per month")<br/>
					<?php echo aq_field_input('timeline', $block_id, $timeline) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('features') ?>">
					Features (start each feature on new line)
					<?php echo aq_field_textarea('features', $block_id, $features) ?>
				</label>
			</p>
			<div class="description">
				<label for="<?php echo $this->get_field_id('color') ?>">
					Color<br/>
					<?php echo aq_field_color_picker('color', $block_id, $color) ?>
				</label>			
			</div>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('btntext') ?>">
					Button text<br/>
					<?php echo aq_field_input('btntext', $block_id, $btntext) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('btnlink') ?>">
					Button link<br/>
					<?php echo aq_field_input('btnlink', $block_id, $btnlink) ?>
				</label>
			</p>

			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; ?>

			<div class="icy-pricetable-wrapper">
				<ul class="icy-pricetable-items">
					<?php
					$output = '';
					$output .= '<li class="icy-pricetable-heading" style="background-color: '.$color.';"><h2 class="icy-pricetable-title">'.htmlspecialchars_decode($title).'</h2>';
					
						if(!empty($img)) {
							$grid = $icy_options['grid_size'];
							$width = icy_get_column_width($size, $grid);							
							$output .= '<div class="icy-pricetable-img">';
								$output .= '<img src="'.$img.'"/>';
							$output .= '</div>';
						}
						
						$output .= '<div class="icy-pricetable-price" style="background-color: '.$color.';">';
							$output .= '<h1 class="price">'.htmlspecialchars_decode($price).'</h1>';
							$output .= !empty($timeline) ? '<span>'.htmlspecialchars_decode($timeline).'</span>' : '';
						$output .= '</div>';
					
					$output .= '</li>';
					
					$features = !empty($features) ? explode("\n", trim($features)) : array();
					
					foreach($features as $feature) {
						$output .= '<li class="icy-pricetable-item">'.do_shortcode(htmlspecialchars_decode($feature)).'</li>';
					}

					$output .= '<li class="action-button" style="background-color: '.$color.';"><a href="'.$btnlink.'">'.$btntext.'</a></li>';
					
				$output .= '</ul>';
			$output .= '</div>';
			
			echo $output;	
		}
		
	}
}