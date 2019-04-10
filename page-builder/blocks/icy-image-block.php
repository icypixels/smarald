<?php
/* Image Block */
if(!class_exists('ICY_Image_Block')) {
	class ICY_Image_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Image',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('ICY_Image_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img' => '',
				'height' => '',
				'crop' => 0,
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
			<p class="description half">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Upload an image<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<?php if($img) { ?>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>			
			<?php
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; 						
			
			if($title) echo '<h4 class="aq-block-title">'.strip_tags($title).'</h4>';
			echo '<img class="aq-block-img" src="' . $img . '" />';
		}
		
		
	}
}