<?php
/** 
 * Skills Block 
 *
 * Options - Title, Skills {Title, Level[Beginner, Intermediate, Expert], Color]
 */
class ICY_Skills_Block extends AQ_Block {
	
	// Construct the subclass via parent::__construct()
	function __construct() {
	
		$block_options = array(
			'name' => 'Skills',
			'size' => 'span4'
		);
		
		parent::__construct('icy_skills_block', $block_options);
		
	}
	
	// Define the form fields in the block
	function form($instance) {
		
		$defaults= array(				
			'skill_title' => 'Skill',
			'skill_level' => '70',			
			'skill_color' => '#ebebeb'		
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_title') ?>">
				Skill Title<br/>
				<?php echo aq_field_input('skill_title', $block_id, $skill_title) ?>		
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_level') ?>">
				Skill Level<br/>
				<?php echo aq_field_input('skill_level', $block_id, $skill_level, 'min', 'number') ?>
			</label>
		</p>
		<div class="description">
			<label for="<?php echo $this->get_field_id('skill_color') ?>">
				Skill Graph Color<br/>
				<?php echo aq_field_color_picker('skill_color', $block_id, $skill_color) ?>
			</label>
			
		</div>
		
		
		<?php
		
	}
	
	// Output the HTML on front end
	function block($instance) {
		extract($instance);
		global $icy_options; 
		wp_enqueue_script('easy-pie-chart');		
		$grid = 1200;
		$width = icy_get_column_width($size, $grid);	
		$rand = rand(1,100);		
		?>

		<script>		
		jQuery(document).ready(function( $ ) {

			// Triggering only when it is inside viewport
			jQuery('.icy-knob-<?php echo $rand; ?>').waypoint(function(){    
        	   	        
					jQuery('.icy-knob-<?php echo $rand; ?>').easyPieChart({
	                    barColor: '<?php echo $skill_color; ?>',
	                    trackColor: '#f6f6f6',
	                    scaleColor: '#f1f1f1',
	                    lineCap: 'butt',
	                    size: jQuery(this).parent().width()-40,
	                    lineWidth: 20,
	                    animate: 3000,	                    
	                });
	   	        }
		        ,{
		          triggerOnce: true,
		          offset: function(){
		            return $(window).height() - $(this).outerHeight(); 
		          }
		        }
	        );    

		});	        
		</script>

		<div class="icy-skill">
			<span class="icy-knob-<?php echo $rand; ?>" data-percent="<?php echo $skill_level; ?>"><span><?php echo $skill_level; ?></span></span>
			<h4><?php echo $skill_title; ?></h4>
		</div>

		<?php 		
	}

}
