<?php
/** Googlemap block **/

if(!class_exists('ICY_Googlemap_Block')) {
	class ICY_Googlemap_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Google Map',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('icy_googlemap_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'text' => '',
				'address' => '',
				'coordinates' => '',
				'height' => '300',
				'zoom' => 8,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('address') ?>">
					Address (required)<br/>
					<?php echo aq_field_input('address', $block_id, $address) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('coordinates') ?>">
					Coordinates (required) e.g. "3.82497,103.32390"<br/>
					<?php echo aq_field_input('coordinates', $block_id, $coordinates) ?>
				</label>
			</p>
			<p class="description fourth">
				<label for="<?php echo $this->get_field_id('coordinates') ?>">
					Zoom Level<br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom, 'min', 'number') ?>
				</label>
			</p>
			<p class="description fourth last">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Map height, in pixels.<br/>
					<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> &nbsp; px
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('pincoordinates') ?>">
					Pin Coordinates (optional) e.g. "3.82497,103.32390"<br/>
					<?php echo aq_field_input('pincoordinates', $block_id, $pincoordinates) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Pin Image.<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
			</p>
			
			<?php
			
		}
		
		function block($instance) {
			$defaults = array(
				'text' => '',
				'address' => '',
				'coordinates' => '',
				'pincoordinates' => '',
				'img' => '',
				'height' => 400,
				'zoom' => 8,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);		
			global $icy_options; 			

			wp_enqueue_script('google-maps-api');
			wp_enqueue_script('google-map');
			$coord = explode(',', $coordinates);
			
			$coord = array_map("floatval", explode(",", $coordinates));
			$pincoord = array_map("floatval", explode(",", $pincoordinates));
						
			wp_localize_script( 'google-map', 'icyMap', 
				array(
					'address' => $address,
					'coordX' => $coord[0], 
					'coordY' => $coord[1],
					'pinImg' => $img,					
					'pincoordX' => $pincoord[0],
					'pincoordY' => $pincoord[1],
					'heading' => $title,
					'zoom' => $zoom,
					'pinImg' => $img,					
					) 
				);
			?>

			<script>
			jQuery(document).ready(function ($) {
				initialize();
			});
			</script>			
			
			<div id="map_canvas" class="map_canvas icy-map-canvas" style="position: relative; overflow: hidden; height: <?php echo $height; ?>px;"></div>
			
			<?php
		}
		
	}
}