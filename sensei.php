<?php	

	/*********************
	 *  Sensei Integration
	 *********************/

	/**
	 * Declare that your theme now supports Sensei
	 */
	add_action( 'after_setup_theme','impreza_sensei_support' );
	function impreza_sensei_support () {
	    add_theme_support( 'sensei' );
	}

	/**
	 * Remove the default Sensei wrappers
	*/
	global $woothemes_sensei;
	remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
	remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );

	/**
	 * Add impreza global sidebar position to right
	*/
	add_action('wp_head', 'define_sidebar_position');

	if (!function_exists('define_sidebar_position')) {
		function define_sidebar_position() {			
			define('SIDEBAR_POS', 'right');
		}
	}	

	/**
	 * Add impreza custom Sensei content wrappers
	*/
	add_action('sensei_before_main_content','impreza_sensei_wrapper_start', 10);
	add_action('sensei_after_main_content','impreza_sensei_wrapper_end', 10);	

	/**
	 * Remove default sensei titles
	 */
	global $woothemes_sensei;
	remove_action( 'sensei_course_single_title', array( $woothemes_sensei->frontend , 'sensei_single_title' ), 10 );
	remove_action( 'sensei_lesson_single_title', array( $woothemes_sensei->frontend , 'sensei_single_title' ), 10 );
	remove_action( 'sensei_quiz_single_title', array( $woothemes_sensei->frontend, 'sensei_single_title' ), 10 );
	remove_action( 'sensei_message_single_title', array( $woothemes_sensei->frontend, 'sensei_single_title' ), 10 );		

	if (!function_exists('impreza_sensei_wrapper_start')) {
		function impreza_sensei_wrapper_start() {			
			// Disabling section shortcode			
			global $disable_section_shortcode;
			$disable_section_shortcode = TRUE
			// Impreza Title
			?>	
			<div class="l-main">	
				<div class="l-submain for_pagehead color_primary size_medium">
					<div class="l-submain-h g-html i-cf">
						<div class="w-pagehead">
							<h1><?php the_title(); ?></h1>
							<div class="g-breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">								
								<?php us_breadcrumbs(); ?>
							</div>
						</div>
					</div>
				</div>						
			<div class="l-submain">	
				<div class="l-submain-h g-html i-cf">
					<div class="l-content">
						<div class="l-content-h i-widgets">
			<?php
		}
	}

	if (!function_exists('impreza_sensei_wrapper_end')) {
		function impreza_sensei_wrapper_end() {
			?>
			</div>
			</div>
			<div class="l-sidebar at_left">
				<div class="l-sidebar-h i-widgets">
					<?php if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'left') dynamic_sidebar('default_sidebar'); ?>
				</div>
			</div>

			<div class="l-sidebar at_right">
				<div class="l-sidebar-h i-widgets">
					<?php if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right') dynamic_sidebar('default_sidebar'); ?>
				</div>
			</div>
			</div>
			</div>
			</div>
		<?php	
		}
	}

	/***************************
	 *  // END Sensei Integration
	 ****************************/
?>