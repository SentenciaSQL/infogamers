<?php
/*
Template Name: Link
*/

if ( have_posts() ) : the_post();
	
	$link = get_post_meta( get_the_ID(), 'link_template_link', true );
	
	if ( ! preg_match( '/^http:\/\//', $link ) && ! preg_match( '/^https:\/\//', $link ) ) {
		$link = 'http://' . $link;
	}

	header( 'Location:' .  esc_url_raw( $link ) );
	
	exit();

endif; ?>