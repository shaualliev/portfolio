<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'etude_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'etude_cf7_theme_setup9', 9 );
	function etude_cf7_theme_setup9() {
		if ( etude_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'etude_cf7_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_cf7', 'etude_cf7_frontend_scripts', 10, 1 );
			add_filter( 'etude_filter_merge_styles', 'etude_cf7_merge_styles' );
			add_filter( 'etude_filter_merge_scripts', 'etude_cf7_merge_scripts' );
		}
		if ( is_admin() ) {
			add_filter( 'etude_filter_tgmpa_required_plugins', 'etude_cf7_tgmpa_required_plugins' );
			add_filter( 'etude_filter_theme_plugins', 'etude_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'etude_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('etude_filter_tgmpa_required_plugins',	'etude_cf7_tgmpa_required_plugins');
	function etude_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( etude_storage_isset( 'required_plugins', 'contact-form-7' ) && etude_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => etude_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'etude_cf7_theme_plugins' ) ) {
	//Handler of the add_filter( 'etude_filter_theme_plugins', 'etude_cf7_theme_plugins' );
	function etude_cf7_theme_plugins( $list = array() ) {
		return etude_add_group_and_logo_to_slave( $list, 'contact-form-7', 'contact-form-7-' );
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'etude_exists_cf7' ) ) {
	function etude_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'etude_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'etude_cf7_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_cf7', 'etude_cf7_frontend_scripts', 10, 1 );
	function etude_cf7_frontend_scripts( $force = false ) {
		etude_enqueue_optimized( 'cf7', $force, array(
			'css' => array(
				'etude-contact-form-7' => array( 'src' => 'plugins/contact-form-7/contact-form-7.css' ),
			),
			'js' => array(
				'etude-contact-form-7' => array( 'src' => 'plugins/contact-form-7/contact-form-7.js', 'deps' => array( 'jquery' ) ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'etude_cf7_merge_styles' ) ) {
	//Handler of the add_filter('etude_filter_merge_styles', 'etude_cf7_merge_styles');
	function etude_cf7_merge_styles( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.css' ] = false;
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'etude_cf7_merge_scripts' ) ) {
	//Handler of the add_filter('etude_filter_merge_scripts', 'etude_cf7_merge_scripts');
	function etude_cf7_merge_scripts( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.js' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( etude_exists_cf7() ) {
	$etude_fdir = etude_get_file_dir( 'plugins/contact-form-7/contact-form-7-style.php' );
	if ( ! empty( $etude_fdir ) ) {
		require_once $etude_fdir;
	}
}
