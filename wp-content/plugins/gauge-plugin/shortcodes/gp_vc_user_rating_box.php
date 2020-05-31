<?php 

if ( ! function_exists( 'ghostpool_user_rating_box' ) ) {

	function ghostpool_user_rating_box( $atts, $content = null ) {

		ob_start(); ?>

			<?php get_template_part( 'lib/sections/user-rating-box' ); ?>

		<?php

		$output_string = ob_get_contents();
		ob_end_clean();
		return $output_string;

	}

}

add_shortcode( 'user_rating_box', 'ghostpool_user_rating_box' );
	
?>