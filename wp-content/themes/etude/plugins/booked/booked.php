<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'etude_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'etude_booked_theme_setup9', 9 );
	function etude_booked_theme_setup9() {
		if ( etude_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'etude_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'etude_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'etude_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'etude_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'etude_filter_merge_styles', 'etude_booked_merge_styles' );
			add_filter( 'etude_filter_merge_styles_responsive', 'etude_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'etude_filter_tgmpa_required_plugins', 'etude_booked_tgmpa_required_plugins' );
			add_filter( 'etude_filter_theme_plugins', 'etude_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'etude_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('etude_filter_tgmpa_required_plugins',	'etude_booked_tgmpa_required_plugins');
	function etude_booked_tgmpa_required_plugins( $list = array() ) {
		if ( etude_storage_isset( 'required_plugins', 'booked' ) && etude_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && etude_is_theme_activated() ) {
			$path = etude_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || etude_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => etude_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.4.3.1',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'etude_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'etude_filter_theme_plugins', 'etude_booked_theme_plugins' );
	function etude_booked_theme_plugins( $list = array() ) {
		return etude_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'etude_exists_booked' ) ) {
	function etude_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'etude_booked_get_styles_dir' ) ) {
	function etude_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && etude_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'etude_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'etude_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'etude_booked_frontend_scripts', 10, 1 );
	function etude_booked_frontend_scripts( $force = false ) {
		etude_enqueue_optimized( 'booked', $force, array(
			'css' => array(
				'etude-booked' => array( 'src' => etude_booked_get_styles_dir( 'booked.css' ) ),
			)
		) );
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'etude_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'etude_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'etude_booked_frontend_scripts_responsive', 10, 1 );
	function etude_booked_frontend_scripts_responsive( $force = false ) {
		etude_enqueue_optimized_responsive( 'booked', $force, array(
			'css' => array(
				'etude-booked-responsive' => array( 'src' => etude_booked_get_styles_dir( 'booked-responsive.css' ), 'media' => 'all' ),
			)
		) );
	}
}


// Merge custom styles
if ( ! function_exists( 'etude_booked_merge_styles' ) ) {
	//Handler of the add_filter('etude_filter_merge_styles', 'etude_booked_merge_styles');
	function etude_booked_merge_styles( $list ) {
		$list[ etude_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'etude_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('etude_filter_merge_styles_responsive', 'etude_booked_merge_styles_responsive');
	function etude_booked_merge_styles_responsive( $list ) {
		$list[ etude_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( etude_exists_booked() ) {
	$etude_fdir = etude_get_file_dir( etude_booked_get_styles_dir( 'booked-style.php' ) );
	if ( ! empty( $etude_fdir ) ) {
		require_once $etude_fdir;
	}
}
