<?php
/**
 * Plugin Name: Support Snapshot
 * Plugin URI: https://github.com/shafinoid/support-snapshot
 * Description: Generate a clean, readable support report with environment details for troubleshooting.
 * Version: 1.0.0
 * Author: Shafinoid
 * Author URI: https://shafinoid.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: support-snapshot
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'SUPPORT_SNAPSHOT_VERSION', '1.0.0' );
define( 'SUPPORT_SNAPSHOT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SUPPORT_SNAPSHOT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main plugin class
 */
class Support_Snapshot {

	/**
	 * Initialize the plugin
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Add admin menu page
	 */
	public function add_admin_menu() {
		add_management_page(
			__( 'Support Snapshot', 'support-snapshot' ),
			__( 'Support Snapshot', 'support-snapshot' ),
			'manage_options',
			'support-snapshot',
			array( $this, 'render_admin_page' )
		);
	}

	/**
	 * Enqueue admin assets
	 */
	public function enqueue_admin_assets( $hook ) {
		if ( 'tools_page_support-snapshot' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			'support-snapshot-admin',
			SUPPORT_SNAPSHOT_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			SUPPORT_SNAPSHOT_VERSION
		);

		wp_enqueue_script(
			'support-snapshot-admin',
			SUPPORT_SNAPSHOT_PLUGIN_URL . 'assets/js/admin.js',
			array( 'jquery' ),
			SUPPORT_SNAPSHOT_VERSION,
			true
		);

		wp_localize_script(
			'support-snapshot-admin',
			'supportSnapshotData',
			array(
				'copySuccess' => __( 'Copied to clipboard!', 'support-snapshot' ),
				'copyError'   => __( 'Failed to copy. Please select and copy manually.', 'support-snapshot' ),
			)
		);
	}

	/**
	 * Render the admin page
	 */
	public function render_admin_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'support-snapshot' ) );
		}

		require_once SUPPORT_SNAPSHOT_PLUGIN_DIR . 'includes/class-data-collector.php';
		$collector = new Support_Snapshot_Data_Collector();
		$data      = $collector->collect();

		require_once SUPPORT_SNAPSHOT_PLUGIN_DIR . 'includes/admin-page.php';
	}
}

// Initialize the plugin
new Support_Snapshot();
