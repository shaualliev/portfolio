<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'etude_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'etude_essential_grid_theme_setup9', 9 );
	function etude_essential_grid_theme_setup9() {
		if ( etude_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'etude_essential_grid_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'etude_essential_grid_frontend_scripts', 10, 1 );
			add_filter( 'etude_filter_merge_styles', 'etude_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'etude_filter_tgmpa_required_plugins', 'etude_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'etude_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('etude_filter_tgmpa_required_plugins',	'etude_essential_grid_tgmpa_required_plugins');
	function etude_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( etude_storage_isset( 'required_plugins', 'essential-grid' ) && etude_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && etude_is_theme_activated() ) {
			$path = etude_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || etude_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => etude_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'version'  => '2.2.4.2',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'etude_exists_essential_grid' ) ) {
	function etude_exists_essential_grid() {
		return defined( 'EG_PLUGIN_PATH' ) || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'etude_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'etude_essential_grid_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'etude_essential_grid_frontend_scripts', 10, 1 );
	function etude_essential_grid_frontend_scripts( $force = false ) {
		etude_enqueue_optimized( 'essential_grid', $force, array(
			'css' => array(
				'etude-essential-grid' => array( 'src' => 'plugins/essential-grid/essential-grid.css' ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'etude_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('etude_filter_merge_styles', 'etude_essential_grid_merge_styles');
	function etude_essential_grid_merge_styles( $list ) {
		$list[ 'plugins/essential-grid/essential-grid.css' ] = false;
		return $list;
	}
}
