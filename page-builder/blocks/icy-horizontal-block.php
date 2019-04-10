<?php
/** Horizontal line block 
 * 
 * Clear the floats vertically
 * Use horizontal lines/images
**/
class ICY_Horizontal_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Separator',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('icy_horizontal_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'horizontal_line' => 'single',
			'line_color' => '#ebebeb',
			'pattern' => '1',
			'height' => '1',
			'topmargin' => '50',
			'botmargin' => '50'
		);
		
		$line_options = array(
			'none' => 'None',
			'single' => 'Single',
			'double' => 'Double',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#ebebeb';
		
		?>
		<p class="description note">
			<?php _e('Use this block for horizontal separation of elements.', 'framework') ?>
		</p>
		<p class="description third">
			<label for="<?php echo $this->get_field_id('line_color') ?>">
				Pick a horizontal line<br/>
				<?php echo aq_field_select('horizontal_line', $block_id, $line_options, $horizontal_line, $block_id); ?>
			</label>
		</p>
		<div class="description third">
			<label for="<?php echo $this->get_field_id('line_color') ?>">
				Pick a line color<br/>
				<?php echo aq_field_color_picker('line_color', $block_id, $line_color) ?>
			</label>
			
		</div>
		<div class="description third last">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height (optional)<br/>
				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
			</label>
			
		</div>
		<div class="description half">
			<label for="<?php echo $this->get_field_id('topmargin') ?>">
				Top margin<br/>
				<?php echo aq_field_input('topmargin', $block_id, $topmargin, 'min', 'number') ?> px
			</label>
			
		</div>
		<div class="description half last">
			<label for="<?php echo $this->get_field_id('botmargin') ?>">
				Bottom margin<br/>
				<?php echo aq_field_input('botmargin', $block_id, $botmargin, 'min', 'number') ?> px
			</label>
			
		</div>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		global $icy_options; 		
		
		switch($horizontal_line) {
			case 'none':
				break;
			case 'single':
				echo '<hr class="aq-block-hr-single" style="background:'.$line_color.'; margin-top:'.$topmargin.'px; margin-bottom:'.$botmargin.'px; "/>';
				break;
			case 'double':
				echo '<hr class="aq-block-hr-double" style="background:'.$line_color.'; margin-top:'.$topmargin.'px; margin-bottom:'.$botmargin.'px; "/>';
				echo '<hr class="aq-block-hr-single" style="background:'.$line_color.'; margin-top:'.$topmargin.'px; margin-bottom:'.$botmargin.'px; "/>';
				break;			
		}
		
		if($height) {
			echo '<div class="cf" style="height:'.$height.'px"></div>';
		}
		
	}
	
}