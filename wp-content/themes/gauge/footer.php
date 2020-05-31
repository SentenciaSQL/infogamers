<?php if ( ! is_page_template( 'blank-page-template.php' ) ) { ?>

			<?php if ( ghostpool_option( 'footer_ad' ) ) { ?>
				<?php if ( ghostpool_option( 'footer_ad_exclude' ) == 'enabled' && ( is_404() OR is_attachment() ) ) { 
					} else { ?>
						<div id="gp-footer-area">
							<div class="gp-container">
								<?php echo do_shortcode( ghostpool_option( 'footer_ad' ) ); ?>
							</div>
						</div>
				<?php } ?>	
			<?php } ?>
		
			<footer id="gp-footer">

				<div id="gp-footer-3d">
					<div class="gp-container">
						<?php if ( ghostpool_option( 'footer_widget_layout' ) == 'gp-footer-larger-first-col' ) { ?>
							<span class="gp-first-widget-bend"></span>
						<?php } ?>	
					</div>		
				</div>

				<?php if ( is_active_sidebar( 'gp-footer-1' ) OR is_active_sidebar( 'gp-footer-2' ) OR is_active_sidebar( 'gp-footer-3' ) OR is_active_sidebar( 'gp-footer-4' ) OR is_active_sidebar( 'gp-footer-5' ) ) { ?>

					<div id="gp-footer-widgets" class="<?php echo sanitize_html_class( ghostpool_option( 'footer_widget_layout' ) ); ?>">
			
						<div class="gp-container">

							<?php if ( ghostpool_option( 'footer_widget_layout' ) == 'gp-footer-larger-first-col' ) { ?>
						
								<?php
								if ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) && is_active_sidebar( 'gp-footer-4' ) && is_active_sidebar( 'gp-footer-5' ) ) {
									$gp_footer_widget_class = 'gp-footer-fourth';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) && is_active_sidebar( 'gp-footer-4' ) ) { 			
									$gp_footer_widget_class = 'gp-footer-third';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) ) {
									$gp_footer_widget_class = 'gp-footer-half';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) ) {
									$gp_footer_widget_class = 'gp-footer-whole';
								} else {
									$gp_footer_widget_class = '';						
								} ?>

								<?php if ( is_active_sidebar( 'gp-footer-1' ) ) { ?>
									<div class="gp-footer-widget gp-footer-1">
										<?php dynamic_sidebar( 'gp-footer-1' ); ?>
									</div>
								<?php } ?>
						
								<div class="gp-footer-cols">

									<?php if ( is_active_sidebar( 'gp-footer-2' ) ) { ?>
										<div class="gp-footer-widget gp-footer-2 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
											<?php dynamic_sidebar( 'gp-footer-2' ); ?>
										</div>
									<?php } ?>

									<?php if ( is_active_sidebar( 'gp-footer-3' ) ) { ?>
										<div class="gp-footer-widget gp-footer-3 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
											<?php dynamic_sidebar( 'gp-footer-3' ); ?>
										</div>
									<?php } ?>

									<?php if ( is_active_sidebar( 'gp-footer-4' )  ) { ?>
										<div class="gp-footer-widget gp-footer-4 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
											<?php dynamic_sidebar( 'gp-footer-4' ); ?>
										</div>
									<?php } ?>

									<?php if ( is_active_sidebar( 'gp-footer-5' ) ) { ?>
										<div class="gp-footer-widget gp-footer-5 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
											<?php dynamic_sidebar( 'gp-footer-5' ); ?>
										</div>
									<?php } ?>
						
								</div>
						
							<?php } else { ?>
						
								<?php
								if ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) && is_active_sidebar( 'gp-footer-4' ) && is_active_sidebar( 'gp-footer-5' ) ) {
									$gp_footer_widget_class = 'gp-footer-fifth';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) && is_active_sidebar( 'gp-footer-4' ) ) { 			
									$gp_footer_widget_class = 'gp-footer-fourth';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) && is_active_sidebar( 'gp-footer-3' ) ) {
									$gp_footer_widget_class = 'gp-footer-third';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) && is_active_sidebar( 'gp-footer-2' ) ) {
									$gp_footer_widget_class = 'gp-footer-half';
								} elseif ( is_active_sidebar( 'gp-footer-1' ) ) {
									$gp_footer_widget_class = 'gp-footer-whole';
								} else {
									$gp_footer_widget_class = '';						
								} ?>

								<?php if ( is_active_sidebar( 'gp-footer-1' ) ) { ?>
									<div class="gp-footer-widget gp-footer-1 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
										<?php dynamic_sidebar( 'gp-footer-1' ); ?>
									</div>
								<?php } ?>

								<?php if ( is_active_sidebar( 'gp-footer-2' ) ) { ?>
									<div class="gp-footer-widget gp-footer-2 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
										<?php dynamic_sidebar( 'gp-footer-2' ); ?>
									</div>
								<?php } ?>

								<?php if ( is_active_sidebar( 'gp-footer-3' ) ) { ?>
									<div class="gp-footer-widget gp-footer-3 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
										<?php dynamic_sidebar( 'gp-footer-3' ); ?>
									</div>
								<?php } ?>

								<?php if ( is_active_sidebar( 'gp-footer-4' )  ) { ?>
									<div class="gp-footer-widget gp-footer-4 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
										<?php dynamic_sidebar( 'gp-footer-4' ); ?>
									</div>
								<?php } ?>

								<?php if ( is_active_sidebar( 'gp-footer-5' ) ) { ?>
									<div class="gp-footer-widget gp-footer-5 <?php echo sanitize_html_class( $gp_footer_widget_class ); ?>">
										<?php dynamic_sidebar( 'gp-footer-5' ); ?>
									</div>
								<?php } ?>
							
							<?php } ?>
							
						</div>
				
					</div>

				<?php } ?>
			
				<div id="gp-copyright">	
	
					<div class="gp-container">

						<div id="gp-copyright-text">
							<?php if ( ghostpool_option( 'copyright_text' ) ) { ?>
								<?php echo wp_kses_post( ghostpool_option( 'copyright_text' ) ); ?>
							<?php } else { ?>
								<?php esc_html_e( 'Copyright &copy;', 'gauge' ); ?> <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( 'http://themeforest.net/user/GhostPool/portfolio?ref=GhostPool' ); ?>" rel="nofollow"><?php esc_html_e( 'GhostPool.com', 'gauge' ); ?></a>. <?php esc_html_e( 'All rights reserved.', 'gauge' ); ?>
							<?php } ?>
						</div>

						<?php if ( ghostpool_option( 'top_header' ) != 'gp-top-header' ) { ?>
							<?php get_template_part( 'lib/sections/social', 'icons' ); ?>
						<?php } ?>
										
						<?php if ( has_nav_menu( 'footer-nav' ) ) { ?>
							<div id="gp-footer-nav" class="gp-nav">
								<?php wp_nav_menu( array( 'theme_location' => 'footer-nav', 'sort_column' => 'menu_order', 'container' => 'ul', 'fallback_cb' => 'null', 'walker' => new Ghostpool_Custom_Menu ) ); ?>			
							</div>
						<?php } ?>
				
					</div>
					
				</div>

			</footer>
		
		</div>

		<?php if ( ghostpool_option( 'popup_box' ) == 'enabled' ) { get_template_part( 'lib/sections/login', 'form' ); } ?>
	
	</div>
	
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>