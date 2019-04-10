<?php
/* Image Block */
if(!class_exists('ICY_Team_Member_Block')) {
	class ICY_Team_Member_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Team Member',
				'size' => 'span4',
			);
			
			//create the widget
			parent::__construct('ICY_Team_Member_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img' => '',
				'position' => '',
				'bio' => ''				
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
			<p class="description">
				<label for="<?php echo $this->get_field_id('position') ?>">
					Position held<br/>
					<?php echo aq_field_input('position', $block_id, $position) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('bio') ?>">
					Bio<br/>
					<?php echo aq_field_textarea('bio', $block_id, $bio, $size = 'full') ?>
				</label>
			</p>
			<?php
		}
		
		function block($instance) {
			extract($instance);	
			global $icy_options; 								
			
			echo '<div class="icy-member">';
			if ($img) {				
				echo '<figure class="icy-member-picture offset2 span8">';
					echo '<div class="rotateleft"></div>';
					echo '<div class="rotateright"></div>';
					echo '<img alt="'.$title.'" src="'.$img.'" />';
				echo '</figure>';
			}
			
			if($title) {
				echo '<h2 class="icy-member-name">'.strip_tags($title).'</h2>';
			}

			if ($position) {
				echo '<h4 class="icy-position">' . $position . '</h4>';
			}

			if ($bio) {
				echo '<div class="icy-bio">';
				echo wpautop(do_shortcode(htmlspecialchars_decode($bio)));
				echo '</div>';
			}
			
			
			echo '</div>';
		}
		
		
	}
}