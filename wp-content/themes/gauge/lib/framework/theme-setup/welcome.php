<div class="wrap">

	<div class="gp-tabs">

		<h1><?php esc_html_e( 'Gauge Setup', 'gauge' ); ?></h1>

		<ul class="gp-tabs-navigation">
			<li><a data-content="welcome" class="selected" href="#welcome"><span class="count-tab">1</span> <?php esc_html_e( 'Welcome', 'gauge' ); ?></a></li>
			<li><a data-content="updates" href="#updates"><span class="count-tab">2</span> <?php esc_html_e( 'Updates', 'gauge' ); ?></a></li>
			<li><a data-content="addons" href="#addons"><span class="count-tab">3</span> <?php esc_html_e( 'Theme Addons', 'gauge' ); ?></a></li>
			<li><a data-content="demo-data" href="#demo-data"><span class="count-tab">4</span> <?php esc_html_e( 'Import Demo Data', 'gauge' ); ?></a></li>
			<li><a data-content="support" href="#support"><span class="count-tab">5</span> <?php esc_html_e( 'Support', 'gauge' ); ?></a></li>
		</ul>

		<ul class="gp-tabs-content">
		
			<li data-content="welcome" class="selected">

				<div class="postbox">
				
					<h3 class="gp-primary-header"><?php esc_html_e( 'Welcome to Gauge', 'gauge' ); ?></h3>
					
					<div class="gp-primary-text inside">
					
						<p><?php esc_html_e( 'Please follow the steps on this page to setup your theme. It is completely optional but it will help you get started.', 'gauge' ); ?></p>
					
						<p><?php esc_html_e( 'First of all make sure all the server statistics below are green, meaning the theme is compatible with your server. If any statistics are red please follow the steps provided to fix this.', 'gauge' ); ?></p>
						
					</div>
						
				</div>

				<table class="gp-status-table widefat">

					<thead>
						<tr>
							<th colspan="3"><h2><?php esc_html_e( 'Theme', 'gauge' ); ?></h2></th>
						</tr>
					</thead>		
					
					<tbody>
						<tr>
							<td><?php esc_html_e( 'Version', 'gauge' ); ?></td>
							<td class="help"></td>
							<td><?php echo GAUGE_THEME_VERSION; ?></div></td>
						</tr>	
					</tbody>	
						
				</table>
										
				<table class="gp-status-table widefat">

					<thead>
						<tr>
							<th colspan="3"><h2><?php esc_html_e( 'Server', 'gauge' ); ?></h2></th>
						</tr>
					</thead>	
					
					<tbody>

						<?php
						
						$statuses = array();
			
						// WordPress version
						$icon = 'dashicons-yes';
						$message = get_bloginfo( 'version' );
						if ( version_compare( get_bloginfo( 'version' ), '3.8', '<' ) ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - Please update WordPress as version 3.8 or higher is required.', 'gauge' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'WordPress Version', 'gauge' ),
							'title' => esc_html__( 'WordPress version.', 'gauge' ),
							'icon' => $icon,
							'message' => $message,
						);
			
						// Writable directory
						$upload_dir = wp_upload_dir();
						$icon = 'dashicons-yes';
						$message = esc_html__( 'Uploads folder is writable', 'gauge' );
						if ( ! wp_is_writable( trailingslashit( $upload_dir['basedir'] ) ) ) {
							$icon = 'dashicons-no';
							$message = esc_html__( 'Uploads folder is not writable. Please check with your hosting provider.', 'gauge' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'File Permissions', 'gauge' ),
							'title' => esc_html__( 'Whether or not your uploads folder is writable.', 'gauge' ),
							'icon' => $icon,
							'message' => $message,
						);

						// PHP version
						$icon = 'dashicons-yes';
						$php_version = phpversion();
						$message = $php_version;
						if ( version_compare( $php_version, '5.6', '<' ) ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - A PHP version greater than 5.6 is required, to update your this', 'gauge' ) . ' <a href="' . esc_url( 'http://ghostpool.com/knowledge-base/how-to-update-your-php-version/' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						} elseif ( version_compare( $php_version, '7.2', '<' ) ) {
							$icon = 'dashicons-warning';
							$message .= esc_html__( ' - We recommend using PHP version 7.2 or above for greater performance and security, to update this', 'gauge' ) . ' <a href="' . esc_url( 'http://ghostpool.com/knowledge-base/how-to-update-your-php-version/' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Version', 'gauge' ),
							'title' => esc_html__( 'PHP version of your server.', 'gauge' ),
							'icon' => $icon,
							'message' => $message,
						);

						// Memory limit
						$icon = 'dashicons-yes';
						$memory = wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) );
						$message = size_format( $memory );
						if ( $memory < 128000000 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the memory limit to at least 128MB, to do this', 'gauge' ) . ' <a href="' . esc_url( 'http://ghostpool.com/documentation/gauge/getting-started/importing-demo-data/#1523702282824-0cd1b174-559e' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Memory Limit', 'gauge' ),
							'title' => esc_html__( 'The maximum amount of memory that your site can use at one time.', 'gauge' ),
							'icon' => $icon,
							'message' => $message

						);
			
						// Max execution time
						$message = '';
						$icon = 'dashicons-yes';
						$time_limit = @ini_get( 'max_execution_time' );
						$message = $time_limit;
						if ( $time_limit < 180 && $time_limit != 0 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the maximum execution time to at least 180 for running larger tasks, to do this', 'gauge' ) . ' <a href="' . esc_url( 'http://ghostpool.com/documentation/gauge/getting-started/importing-demo-data/#1523702282824-0cd1b174-559e' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Maximum Execution Limit', 'gauge' ),
							'title' => esc_html__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out.', 'gauge' ),
							'icon' => $icon,
							'message' => $message
						);

						// Max input vars
						$icon = 'dashicons-yes';
						$input_vars = ini_get('max_input_vars');
						$message = $input_vars;
						if ( $input_vars < 1000 ) {
							$icon = 'dashicons-no';
							$message .= esc_html__( ' - We recommend setting the maximum input vars to at least 1000 otherwise POST data will be truncated, to do this', 'gauge' ) . ' <a href="' . esc_url( 'http://ghostpool.com/documentation/gauge/how-to-increase-max-input-vars/' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'PHP Maximum Input Vars', 'gauge' ),
							'title' => esc_html__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'gauge' ),
							'icon' => $icon,
							'message' => $message
						);

						// ZipArchive
						$message = esc_html__( 'Installed' , 'gauge' );
						$icon = 'dashicons-yes';
						if ( ! class_exists( 'ZipArchive' ) ) {
							$icon = 'dashicons-no';
							$message = esc_html__( 'Not installed - ZipArchive is required for importing the demo data. Please contact your server administrator and ask them to enable it.', 'gauge' );
						}
						$statuses[] = array(
							'name' => esc_html__( 'ZipArchive', 'gauge' ),
							'title' => esc_html__( 'ZipArchive is required for importing the demo data.', 'gauge' ),
							'icon' => $icon,
							'message' => $message
						);

						// WP DEBUG Mode
						$message = esc_html__( 'OK - DEBUG is OFF' , 'gauge' );
						$icon = 'dashicons-yes';
						if ( defined( 'WP_DEBUG' ) && WP_DEBUG === TRUE ) {
							$icon = 'dashicons-warning';
							$message = esc_html__( 'DEBUG is ON - It is recommended you disable WordPress debugging on your live site, to do this', 'gauge' ) . ' <a href="' . esc_url( 'https://codex.wordpress.org/WP_DEBUG' ) . '" target="_blank">' . esc_html__( 'click here', 'gauge' ) . '</a>.';
						}
						$statuses[] = array(
							'name' => esc_html__( 'WP Debug', 'gauge' ),
							'title' => esc_html__( 'Whether or not WordPress is in Debug Mode.', 'gauge' ),
							'icon' => $icon,
							'message' => $message
						);

						?>

						<?php foreach ( $statuses as $status ) : ?>

							<tr>
								<td><?php echo esc_attr( $status['name'] ); ?></td>
								<td class="help"><span class="tooltip-me dashicons-before dashicons-editor-help" title="<?php echo esc_attr( $status['title'] );?>"></span></td>
								<td><span class="dashicons-before <?php echo esc_attr( $status['icon'] ); ?>"></span> <?php echo wp_kses_post( $status['message'] ); ?></td>
							</tr>

						<?php endforeach; ?>

					</tbody>
				</table>

			</li>

			<li data-content="updates">
				
				<div class="postbox">
					<h3 class="gp-primary-header"><?php esc_html_e( 'Get automatic theme updates', 'gauge' ); ?></h3>
					<div class="gp-primary-text inside">
					
						<p><?php esc_html_e( 'You can now setup automatic theme updates using the', 'gauge' ); ?> <a href="https://envato.com/market-plugin/" target="_blank"><?php esc_html_e( 'Envato Market WordPress Plugin', 'gauge' ); ?></a>.</p>
						
					</div>
				</div>	
						
				<div class="gp-addons-list">
					<?php foreach ( GhostPool_Addons_Manager()->plugins as $plugin ) { ?>

						<?php if ( 'envato-market' == $plugin['slug'] ) {
				
							$plugin_status = GhostPool_Addons_Manager()->get_plugin_status( $plugin['slug'] ); ?>
				
							<div class="postbox gp-addon <?php echo esc_attr( $plugin_status['status'] ); ?>" id="addon-<?php echo esc_attr( $plugin['slug'] ); ?>">
		
								<h4 class="gp-addon-title"><?php echo esc_attr( $plugin['name'] ); ?></h4>
					
								<div class="gp-addon-title"><?php echo esc_attr( $plugin['version'] ); ?></div>
					
								<div class="gp-addon-extra<?php if ( isset( $plugin['required'] ) && $plugin['required'] == true ) { echo ' gp-required-addon'; } ?>"><?php echo ( isset( $plugin['required'] ) && $plugin['required'] == true ) ? esc_html__( 'Required', 'gauge' ) : esc_html__( 'Optional', 'gauge' ); ?></div>
					
								<?php if ( isset( $plugin['description'] ) ) { ?>
									<span class="gp-addon-desc tooltip-me dashicons-before dashicons-info" title="<?php echo esc_attr( $plugin['description'] ); ?>"></span>
								<?php } ?>
														
								 <a class="gp-addon-button button-primary button" data-action="<?php echo esc_attr( $plugin_status['action'] ); ?>" data-status="<?php echo esc_attr( $plugin_status['status'] ); ?>" data-nonce="<?php echo wp_create_nonce( 'ghostpool_addons_action' ); ?>" href="#" data-slug="<?php echo esc_attr( $plugin['slug'] ); ?>"><?php echo esc_attr( $plugin_status['action_text'] ); ?></a><span class="spinner"></span>
					
								<div class="gp-addon-ajax-text"></div>

							</div>
				
						<?php } ?>
					<?php } ?>		
				</div>
				
			</li>

			<li data-content="addons">

				<div class="postbox">
				
					<h3 class="gp-primary-header"><?php esc_html_e( 'Install Addons', 'gauge' ); ?></h3>
					
					<div class="gp-primary-text inside">
						<p><?php esc_html_e( 'Below you will find a list of required and recommended theme plugins. Please make sure you install all the required plugins before proceeding to the next step.', 'gauge' ); ?></p>
					</div>
					
				</div>	

				<div class="gp-addons-list">
					<?php foreach ( GhostPool_Addons_Manager()->plugins as $plugin ) : ?>

						<?php
						
						$plugin_status = GhostPool_Addons_Manager()->get_plugin_status( $plugin['slug'] ); ?>
						
						<div class="postbox gp-addon <?php echo esc_attr( $plugin_status['status'] ); ?>" id="addon-<?php echo esc_attr( $plugin['slug'] ); ?>">
				
							<h4 class="gp-addon-title"><?php echo esc_attr( $plugin['name'] ); ?></h4>
							
							<div class="gp-addon-title"><?php echo esc_attr( $plugin['version'] ); ?></div>
							
							<div class="gp-addon-extra<?php if ( isset( $plugin['required'] ) && $plugin['required'] == true ) { echo ' gp-required-addon'; } ?>"><?php echo ( isset( $plugin['required'] ) && $plugin['required'] == true ) ? esc_html__( 'Required', 'gauge' ) : esc_html__( 'Optional', 'gauge' ); ?></div>
							
							<?php if ( isset( $plugin['description'] ) ) { ?>
								<span class="gp-addon-desc tooltip-me dashicons-before dashicons-info" title="<?php echo esc_attr( $plugin['description'] ); ?>"></span>
							<?php } ?>
																
							 <a class="gp-addon-button button-primary button" data-action="<?php echo esc_attr( $plugin_status['action'] ); ?>" data-status="<?php echo esc_attr( $plugin_status['status'] ); ?>" data-nonce="<?php echo wp_create_nonce( 'ghostpool_addons_action' ); ?>" href="#" data-slug="<?php echo esc_attr( $plugin['slug'] ); ?>"><?php echo esc_attr( $plugin_status['action_text'] ); ?></a><span class="spinner"></span>
							
							<div class="gp-addon-ajax-text"></div>

						</div>
					<?php endforeach; ?>
				</div>
			</li>

			<li data-content="demo-data">

				<?php if ( class_exists( 'GhostPool_Importer' ) ) {
					$GhostPool_Importer = GhostPool_Importer::getInstance();
					$GhostPool_Importer->demo_installer(); 
				} else { ?>
				
					<h3 class="gp-secondary-header"><?php esc_html_e( 'To use the importer please install and active the Gauge Plugin from the Theme Addons tab. If you have activated this plugin please refresh this page.', 'gauge' ); ?></h3>
				
				<?php } ?>
				
			</li>

			<li data-content="support">
				
				<div class="postbox">
					<h3 class="gp-primary-header"><?php esc_html_e( 'Need support?', 'gauge' ); ?></h3>
					<div class="gp-primary-text inside">
						<p><?php esc_html_e( 'Before you submit a support ticket please check out the theme documentation and knowledge base from the links below.', 'gauge'  ); ?></p>
						<a href="<?php echo esc_url( 'https://ghostpool.com/help/gauge/help.html' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Documentation', 'gauge' ); ?></a>
						<a href="<?php echo esc_url( 'https://ghostpool.ticksy.com/articles/6843' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Knowledge Base', 'gauge' ); ?></a>
					</div>
				</div>
			
				<div class="postbox">
					<h3 class="gp-primary-header"><?php esc_html_e( 'Still need support?', 'gauge' ); ?></h3>
					<div class="gp-primary-text inside">
						<p><?php esc_html_e( 'If you still need help after reading through the documentation and knowledge base please open up a support ticket and we will reply to your question within 24 hours Monday to Friday.', 'gauge' ); ?></p>
						<a href="<?php echo esc_url( 'https://ghostpool.ticksy.com' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Submit A Support Ticket', 'gauge' ); ?></a>
					</div>
				</div>	
									
			</li>
			
		</ul>
	</div>
	
</div>