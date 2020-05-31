<?php
/*
Template Name: Author
*/

$gp_current_user = wp_get_current_user();
$gp_author_url = get_author_posts_url( $gp_current_user->ID );
esc_url_raw( wp_redirect( $gp_author_url ) );
exit();

?>