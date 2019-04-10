<?php

if(!class_exists('ICY_Year_Block')) {
	class ICY_Year_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Year Founded',
				'size' => 'span12',
				'resizable' => 0,
			);
			
			//create the block
			parent::__construct('icy_year_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(				
				'text1' => 'Smarald was founded by two passionate friends from California in ',
				'year'	=> '2013',
				'text2' => 'Now Smarald is the home of six creatives, each and every one of them focusing on delivering immersive visual experiences using shapes and interactions. We believe design is the core of each of our products and we are relentless in our pursuit  of quality craftsmanship in everything that we do.'
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);						
			?>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('text1') ?>">
					Introduction phrase<br/>
					<?php echo aq_field_input('text1', $block_id, $text1, $size = 'full'); ?>
				</label>
			</p>					
			<p class="description">
				<label for="<?php echo $this->get_field_id('year') ?>">
					Year when the studio was founded<br/>
					<?php echo aq_field_input('year', $block_id, $year, $size = 'full'); ?>
				</label>
			</p>					
			<p class="description">
				<label for="<?php echo $this->get_field_id('text2') ?>">
					Continuation phrase<br/>
					<?php echo aq_field_textarea('text2', $block_id, $text2, $size = 'full'); ?>
				</label>
			</p>		
			<?php
		}
		
		function block($instance) {
			extract($instance);		
			global $icy_options; 			
			?>

			<section class="icy-foundation span8 offset2">

				<h3><?php echo $text1; ?></h2>

				<div class="separator"></div>

				<div class="year-animation">
					<span class="first-number">1 5 3 <?php echo $year[0]; ?></span>
					<span class="second-number">7 7 8 9 0 4 5 <?php echo $year[1]; ?></span>
					<span class="third-number">3 6 8 2 9 <?php echo $year[2]; ?></span>
					<span class="fourth-number">8 9 7 8 5 2 4 0 <?php echo $year[3]; ?></span>
				</div>

				<div class="separator"></div>

				<h3><?php echo $text2; ?></h3>

			</section>
													          
			<?php
		}
		
		function update($new_instance, $old_instance) {
			$new_instance['text1'] = htmlspecialchars(stripslashes($new_instance['text1']));
			$new_instance['text2'] = htmlspecialchars(stripslashes($new_instance['text2']));
			$new_instance['year'] = htmlspecialchars(stripslashes($new_instance['year']));
			return $new_instance;
		}
		
	}
}