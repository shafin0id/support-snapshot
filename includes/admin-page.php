<?php
/**
 * Admin Page Template
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_output = $collector->format_as_text( $data );
?>

<div class="wrap support-snapshot-wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	
	<div class="support-snapshot-intro">
		<p><?php esc_html_e( 'This page generates a snapshot of your WordPress environment that you can share with support teams when troubleshooting issues.', 'support-snapshot' ); ?></p>
		<p><?php esc_html_e( 'No data is stored or sent anywhere. This information is generated on-demand and exists only on this page.', 'support-snapshot' ); ?></p>
	</div>

	<div class="support-snapshot-actions">
		<button type="button" class="button button-primary button-hero" id="copy-snapshot">
			<span class="dashicons dashicons-clipboard"></span>
			<?php esc_html_e( 'Copy to Clipboard', 'support-snapshot' ); ?>
		</button>
		<span class="copy-feedback"></span>
	</div>

	<div class="support-snapshot-content">
		
		<!-- WordPress Info -->
		<div class="snapshot-section">
			<h2><span class="dashicons dashicons-wordpress"></span> <?php esc_html_e( 'WordPress', 'support-snapshot' ); ?></h2>
			<p class="section-description"><?php esc_html_e( 'Core WordPress installation details', 'support-snapshot' ); ?></p>
			<table class="widefat striped">
				<tbody>
					<tr>
						<th><?php esc_html_e( 'Version', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['version'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Site URL', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['site_url'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Home URL', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['home_url'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Multisite', 'support-snapshot' ); ?></th>
						<td><?php echo $data['wordpress']['is_multisite'] ? esc_html__( 'Yes', 'support-snapshot' ) : esc_html__( 'No', 'support-snapshot' ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Language', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['language'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Timezone', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['timezone'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Permalink Structure', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['permalink'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'HTTPS', 'support-snapshot' ); ?></th>
						<td><?php echo $data['wordpress']['https'] ? esc_html__( 'Yes', 'support-snapshot' ) : esc_html__( 'No', 'support-snapshot' ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Database Version', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['wordpress']['db_version'] ); ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Server Info -->
		<div class="snapshot-section">
			<h2><span class="dashicons dashicons-admin-tools"></span> <?php esc_html_e( 'Server Environment', 'support-snapshot' ); ?></h2>
			<p class="section-description"><?php esc_html_e( 'Server configuration and resource limits', 'support-snapshot' ); ?></p>
			<table class="widefat striped">
				<tbody>
					<tr>
						<th><?php esc_html_e( 'PHP Version', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['php_version'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Server Software', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['server_software'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'PHP Memory Limit', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['memory_limit'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Max Execution Time', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['max_execution_time'] ); ?>s</td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Upload Max Filesize', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['upload_max_filesize'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Post Max Size', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['post_max_size'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'WP Memory Limit', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['wp_memory_limit'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'WP Max Memory Limit', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['server']['wp_max_memory_limit'] ); ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Theme Info -->
		<div class="snapshot-section">
			<h2><span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e( 'Active Theme', 'support-snapshot' ); ?></h2>
			<p class="section-description"><?php esc_html_e( 'Currently active theme information', 'support-snapshot' ); ?></p>
			<table class="widefat striped">
				<tbody>
					<tr>
						<th><?php esc_html_e( 'Name', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['theme']['name'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Version', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['theme']['version'] ); ?></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Author', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['theme']['author'] ); ?></td>
					</tr>
					<?php if ( $data['theme']['is_child'] ) : ?>
					<tr>
						<th><?php esc_html_e( 'Parent Theme', 'support-snapshot' ); ?></th>
						<td><?php echo esc_html( $data['theme']['parent_name'] . ' (v' . $data['theme']['parent_version'] . ')' ); ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- Plugins -->
		<div class="snapshot-section">
			<h2><span class="dashicons dashicons-admin-plugins"></span> <?php esc_html_e( 'Active Plugins', 'support-snapshot' ); ?> (<?php echo count( $data['plugins'] ); ?>)</h2>
			<p class="section-description"><?php esc_html_e( 'All currently active plugins on your site', 'support-snapshot' ); ?></p>
			<?php if ( ! empty( $data['plugins'] ) ) : ?>
			<table class="widefat striped">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Plugin Name', 'support-snapshot' ); ?></th>
						<th><?php esc_html_e( 'Version', 'support-snapshot' ); ?></th>
						<th><?php esc_html_e( 'Author', 'support-snapshot' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $data['plugins'] as $plugin ) : ?>
					<tr>
						<td><?php echo esc_html( $plugin['name'] ); ?></td>
						<td><?php echo esc_html( $plugin['version'] ); ?></td>
						<td><?php echo esc_html( $plugin['author'] ); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php else : ?>
			<p><?php esc_html_e( 'No active plugins found.', 'support-snapshot' ); ?></p>
			<?php endif; ?>
		</div>

		<!-- Debug Constants -->
		<div class="snapshot-section">
			<h2><span class="dashicons dashicons-info"></span> <?php esc_html_e( 'Debug Settings', 'support-snapshot' ); ?></h2>
			<p class="section-description"><?php esc_html_e( 'WordPress debug mode configuration', 'support-snapshot' ); ?></p>
			<table class="widefat striped">
				<tbody>
					<?php foreach ( $data['constants'] as $constant => $value ) : ?>
					<tr>
						<th><code><?php echo esc_html( $constant ); ?></code></th>
						<td>
							<span class="debug-status <?php echo $value ? 'enabled' : 'disabled'; ?>">
								<?php echo $value ? esc_html__( 'Enabled', 'support-snapshot' ) : esc_html__( 'Disabled', 'support-snapshot' ); ?>
							</span>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>

	<!-- Hidden textarea for copying -->
	<textarea id="snapshot-text" style="position: absolute; left: -9999px;" readonly><?php echo esc_textarea( $text_output ); ?></textarea>

</div>
