<?php if ( $GLOBALS['ghostpool_layout'] == 'gp-left-sidebar' OR $GLOBALS['ghostpool_layout'] == 'gp-right-sidebar' ) { ?>

	<aside id="gp-sidebar">

		<?php if ( ( $GLOBALS['ghostpool_hub_header'] == true OR is_page_template( 'review-template.php' ) ) && ( $GLOBALS['ghostpool_layout'] != 'gp-no-sidebar' OR $GLOBALS['ghostpool_layout'] != 'gp-fullwidth' ) ) { ?>
			<?php if ( $GLOBALS['ghostpool_user_rating_box'] == 'enabled' ) { ?>
				<?php get_template_part( 'lib/sections/user-rating-box' ); ?>
			<?php } ?>
		<?php } ?>

		<?php if ( is_active_sidebar( $GLOBALS['ghostpool_sidebar'] ) ) {
			dynamic_sidebar( $GLOBALS['ghostpool_sidebar'] );
		} ?>		

	</aside>

<?php } ?>