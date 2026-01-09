<?php
/**
 * Data Collector Class
 *
 * Collects environment information for support purposes
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Support_Snapshot_Data_Collector {

	/**
	 * Collect all support data
	 *
	 * @return array
	 */
	public function collect() {
		return array(
			'wordpress' => $this->get_wordpress_info(),
			'server'    => $this->get_server_info(),
			'theme'     => $this->get_theme_info(),
			'plugins'   => $this->get_plugins_info(),
			'constants' => $this->get_debug_constants(),
		);
	}

	/**
	 * Get WordPress information
	 *
	 * @return array
	 */
	private function get_wordpress_info() {
		global $wpdb;

		return array(
			'version'       => get_bloginfo( 'version' ),
			'site_url'      => get_site_url(),
			'home_url'      => get_home_url(),
			'is_multisite'  => is_multisite(),
			'language'      => get_locale(),
			'timezone'      => wp_timezone_string(),
			'permalink'     => get_option( 'permalink_structure' ) ?: 'Default',
			'https'         => is_ssl(),
			'db_version'    => $wpdb->db_version(),
		);
	}

	/**
	 * Get server information
	 *
	 * @return array
	 */
	private function get_server_info() {
		return array(
			'php_version'         => phpversion(),
			'server_software'     => isset( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : 'Unknown',
			'memory_limit'        => ini_get( 'memory_limit' ),
			'max_execution_time'  => ini_get( 'max_execution_time' ),
			'upload_max_filesize' => ini_get( 'upload_max_filesize' ),
			'post_max_size'       => ini_get( 'post_max_size' ),
			'wp_memory_limit'     => WP_MEMORY_LIMIT,
			'wp_max_memory_limit' => WP_MAX_MEMORY_LIMIT,
		);
	}

	/**
	 * Get active theme information
	 *
	 * @return array
	 */
	private function get_theme_info() {
		$theme        = wp_get_theme();
		$parent_theme = $theme->parent();

		$info = array(
			'name'    => $theme->get( 'Name' ),
			'version' => $theme->get( 'Version' ),
			'author'  => $theme->get( 'Author' ),
			'is_child' => is_child_theme(),
		);

		if ( $parent_theme ) {
			$info['parent_name']    = $parent_theme->get( 'Name' );
			$info['parent_version'] = $parent_theme->get( 'Version' );
		}

		return $info;
	}

	/**
	 * Get active plugins information
	 *
	 * @return array
	 */
	private function get_plugins_info() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$all_plugins    = get_plugins();
		$active_plugins = get_option( 'active_plugins', array() );
		$plugins_list   = array();

		foreach ( $active_plugins as $plugin_path ) {
			if ( isset( $all_plugins[ $plugin_path ] ) ) {
				$plugin = $all_plugins[ $plugin_path ];
				$plugins_list[] = array(
					'name'    => $plugin['Name'],
					'version' => $plugin['Version'],
					'author'  => $plugin['Author'],
				);
			}
		}

		// Sort by name for consistency
		usort( $plugins_list, function( $a, $b ) {
			return strcmp( $a['name'], $b['name'] );
		});

		return $plugins_list;
	}

	/**
	 * Get debug-related constants
	 *
	 * @return array
	 */
	private function get_debug_constants() {
		return array(
			'WP_DEBUG'         => defined( 'WP_DEBUG' ) && WP_DEBUG,
			'WP_DEBUG_LOG'     => defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG,
			'WP_DEBUG_DISPLAY' => defined( 'WP_DEBUG_DISPLAY' ) && WP_DEBUG_DISPLAY,
			'SCRIPT_DEBUG'     => defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG,
			'SAVEQUERIES'      => defined( 'SAVEQUERIES' ) && SAVEQUERIES,
		);
	}

	/**
	 * Format data as plain text for copying
	 *
	 * @param array $data Collected data
	 * @return string
	 */
	public function format_as_text( $data ) {
		$output = "=== SUPPORT SNAPSHOT ===\n";
		$output .= "Generated: " . current_time( 'Y-m-d H:i:s' ) . "\n\n";

		// WordPress Info
		$output .= "--- WordPress ---\n";
		$output .= "Version: " . $data['wordpress']['version'] . "\n";
		$output .= "Site URL: " . $data['wordpress']['site_url'] . "\n";
		$output .= "Home URL: " . $data['wordpress']['home_url'] . "\n";
		$output .= "Multisite: " . ( $data['wordpress']['is_multisite'] ? 'Yes' : 'No' ) . "\n";
		$output .= "Language: " . $data['wordpress']['language'] . "\n";
		$output .= "Timezone: " . $data['wordpress']['timezone'] . "\n";
		$output .= "Permalink: " . $data['wordpress']['permalink'] . "\n";
		$output .= "HTTPS: " . ( $data['wordpress']['https'] ? 'Yes' : 'No' ) . "\n";
		$output .= "Database Version: " . $data['wordpress']['db_version'] . "\n\n";

		// Server Info
		$output .= "--- Server ---\n";
		$output .= "PHP Version: " . $data['server']['php_version'] . "\n";
		$output .= "Server Software: " . $data['server']['server_software'] . "\n";
		$output .= "PHP Memory Limit: " . $data['server']['memory_limit'] . "\n";
		$output .= "Max Execution Time: " . $data['server']['max_execution_time'] . "s\n";
		$output .= "Upload Max Filesize: " . $data['server']['upload_max_filesize'] . "\n";
		$output .= "Post Max Size: " . $data['server']['post_max_size'] . "\n";
		$output .= "WP Memory Limit: " . $data['server']['wp_memory_limit'] . "\n";
		$output .= "WP Max Memory Limit: " . $data['server']['wp_max_memory_limit'] . "\n\n";

		// Theme Info
		$output .= "--- Active Theme ---\n";
		$output .= "Name: " . $data['theme']['name'] . "\n";
		$output .= "Version: " . $data['theme']['version'] . "\n";
		$output .= "Author: " . $data['theme']['author'] . "\n";
		if ( $data['theme']['is_child'] ) {
			$output .= "Parent Theme: " . $data['theme']['parent_name'] . " (v" . $data['theme']['parent_version'] . ")\n";
		}
		$output .= "\n";

		// Plugins
		$output .= "--- Active Plugins (" . count( $data['plugins'] ) . ") ---\n";
		foreach ( $data['plugins'] as $plugin ) {
			$output .= $plugin['name'] . " (v" . $plugin['version'] . ")\n";
		}
		$output .= "\n";

		// Debug Constants
		$output .= "--- Debug Settings ---\n";
		foreach ( $data['constants'] as $constant => $value ) {
			$output .= $constant . ": " . ( $value ? 'Enabled' : 'Disabled' ) . "\n";
		}

		return $output;
	}
}
