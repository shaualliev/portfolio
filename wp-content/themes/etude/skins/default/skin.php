<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package ETUDE
 * @since ETUDE 1.0.46
 */



// SKIN SETUP
//--------------------------------------------------------------------

// Setup fonts, colors, blog and single styles, etc.
$etude_skin_path = etude_get_file_dir( etude_skins_get_current_skin_dir() . 'skin-setup.php' );
if ( ! empty( $etude_skin_path ) ) {
	require_once $etude_skin_path;
}

// Skin options
$etude_skin_path = etude_get_file_dir( etude_skins_get_current_skin_dir() . 'skin-options.php' );
if ( ! empty( $etude_skin_path ) ) {
	require_once $etude_skin_path;
}

// Required plugins
$etude_skin_path = etude_get_file_dir( etude_skins_get_current_skin_dir() . 'skin-plugins.php' );
if ( ! empty( $etude_skin_path ) ) {
	require_once $etude_skin_path;
}

// Demo import
$etude_skin_path = etude_get_file_dir( etude_skins_get_current_skin_dir() . 'skin-demo-importer.php' );
if ( ! empty( $etude_skin_path ) ) {
	require_once $etude_skin_path;
}


// TRX_ADDONS SETUP
//--------------------------------------------------------------------

// Filter to add in the required plugins list
// Priority 11 to add new plugins to the end of the list
if ( ! function_exists( 'etude_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'etude_filter_tgmpa_required_plugins', 'etude_skin_tgmpa_required_plugins', 11 );
	function etude_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( etude_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => etude_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug', 'title' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter to add/remove components of ThemeREX Addons when current skin is active
if ( ! function_exists( 'etude_skin_trx_addons_default_components' ) ) {
	add_filter('trx_addons_filter_load_options', 'etude_skin_trx_addons_default_components', 20);
	function etude_skin_trx_addons_default_components($components) {
		// ToDo: Set key value in the array $components to 0 (disable component) or 1 (enable component)
		//---> For example (enable reviews for posts):
		//---> $components['components_components_reviews'] = 1;
		return $components;
	}
}

// Filter to add/remove CPT
if ( ! function_exists( 'etude_skin_trx_addons_cpt_list' ) ) {
	add_filter('trx_addons_cpt_list', 'etude_skin_trx_addons_cpt_list');
	function etude_skin_trx_addons_cpt_list( $list = array() ) {
		// ToDo: Unset CPT slug from list to disable CPT when current skin is active
		//---> For example to disable CPT 'Portfolio':
		//---> unset( $list['portfolio'] );
		return $list;
	}
}

// Filter to add/remove shortcodes
if ( ! function_exists( 'etude_skin_trx_addons_sc_list' ) ) {
	add_filter('trx_addons_sc_list', 'etude_skin_trx_addons_sc_list');
	function etude_skin_trx_addons_sc_list( $list = array() ) {

		unset( $list['blogger']['templates']['default']['classic_2']);
		unset( $list['blogger']['templates']['default']['over_centered']);
		unset( $list['blogger']['templates']['news']['announce']);

        $list['blogger']['templates']['portestate']['default'] = array(
            'title'  => esc_html__('default', 'etude'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title','meta_categories'
                )
            )
        );
        $list['blogger']['templates']['portmodern']['image-over'] = array(
            'title'  => esc_html__('Image over', 'etude'),
            'args' => array( 'image_ratio' =>  '10:9' ),
            'layout' => array(
                'content' => array(
                    'title'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-1'] = array(
            'title'  => esc_html__('Style 1', 'etude'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_5'] = array (
            'title'  => esc_html__('Style 5', 'etude'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_6'] = array (
            'title'  => esc_html__('Style 6', 'etude'),
            'args' => array( 'image_ratio' =>  '10:9', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_7'] = array (
            'title'  => esc_html__('Style 7', 'etude'),
            'args' => array( 'image_ratio' =>  '1:1', 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style-8'] = array(
            'title'  => esc_html__('Style 8', 'etude'),
            'layout' => array(
                'featured' => array(
                ),
                'content' => array(
                    'title', 'meta_categories', 'meta', 'excerpt', 'readmore'
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_14'] = array (
            'title'  => esc_html__('Style 14', 'etude'),
            'args' => array( 'image_ratio' =>  '10:7','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_15'] = array (
            'title'  => esc_html__('Style 15', 'etude'),
            'args' => array( 'image_ratio' =>  '1:1','no_links'  => false, 'hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bc' => array (
                        'title', 'meta_categories'
                    )
                )
            )
        );
        $list['blogger']['templates']['lay_portfolio']['style_16'] = array (
            'title'  => esc_html__('Style 16', 'etude'),
            'args' => array( 'image_ratio' =>  '10:9','hover' => 'link' ),
            'layout' => array (
                'featured' => array (
                    'bl' => array (
                        'title', 'meta_categories', 'readmore'
                    )
                )
            )
        );

        // Grid portfolio
        // Grid Style 3
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_3'] = array (
            'title'  => esc_html__('Grid style 3', 'etude'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 4
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_4'] = array (
            'title'  => esc_html__('Grid style 4', 'etude'),
            'args'  => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 5
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_5'] = array (
            'title'  => esc_html__('Grid style 5', 'etude'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_5',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 7
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_7'] = array(
            'title'  => esc_html__('Grid style 7', 'etude'),
            'args' => array( /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Three posts
                        array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                        ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                        ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                ),
                array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                ),
                array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                ),
                array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                        ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // Grid Style 8
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_8'] = array (
            'title'  => esc_html__('Grid style 8', 'etude'),
            'args' => array( 'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_15',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        )
                    )
                ),
            )
        );

        // Grid Style 9
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_9'] = array (
            'title'  => esc_html__('Grid style 9', 'etude'),
            'args'  => array(  /*'hover' => 'link' - specific hovers work satisfactorily*/ ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_7',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
            )
        );

        // grid Style 13
        $list['blogger']['templates']['lay_portfolio_grid']['grid_style_13'] = array (
            'title'  => esc_html__('Grid style 13', 'etude'),
            'args'  => array(  'hover' => 'link' ),
            'grid'  => array(
                // One post
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Two posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Three posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Four posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                    )
                ),
                // Five posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Six posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Seven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Eight posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Nine posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'big' )
                        ),
                    )
                ),
                // Ten posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
                // Eleven posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                    )
                ),
                // Twelve posts
                array(
                    'grid-layout' => array(
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'full' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '16:9', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'square' )
                        ),
                        array(
                            'template' => 'lay_portfolio/style_16',
                            'args' => array( 'image_ratio' => '1:1', 'thumb_size' => 'masonry-big' )
                        ),
                    )
                ),
            )
        );



		$list['blogger']['templates']['list']['simple'] = array(
			'title'  => esc_html__('Simple', 'etude'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover'] = array(
			'title'  => esc_html__('Simple (hover)', 'etude'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['hover_2'] = array(
			'title'  => esc_html__('Simple (hover 2)', 'etude'),
			'layout' => array(
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['list']['with_image'] = array(
			'title'  => esc_html__('With image', 'etude'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_simple'] = array(
			'title'  => esc_html__('Classic Grid (simple)', 'etude'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_3'] = array(
			'title'  => esc_html__('Classic with header above', 'etude'),
			'layout' => array(
				'header' => array(
					'meta', 'title'
				),
				'featured' => array(
				),
				'content' => array(
					'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time'] = array(
			'title'  => esc_html__('Classic Grid (date)', 'etude'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta_date', 'meta', 'title', 'excerpt', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['classic_time_2'] = array(
			'title'  => esc_html__('Classic Grid (date 2)', 'etude'),
			'layout' => array(
				'featured' => array(
					'tl' => array(
						'meta_categories'
					)
				),
				'content' => array(
					'meta_date', 'title', 'excerpt', 'meta', 'readmore'
				)
			)
		);
		$list['blogger']['templates']['default']['over_bottom'] = array(
			'title'  => esc_html__('Info over image (bottom)', 'etude'),
			'layout' => array(
				'featured' => array(
					'bc' => array(
						'meta', 'title', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'etude'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_2'] = array(
			'title'  => esc_html__('Info over image (hover 2)', 'etude'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover_3'] = array(
			'title'  => esc_html__('Info over image (hover 3)', 'etude'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta_categories', 'title', 'meta'
					)
				),
			)
		);
		$list['blogger']['templates']['default']['over_centered_hover'] = array(
			'title'  => esc_html__('Info over image (hover)', 'etude'),
			'layout' => array(
				'featured' => array(
					'mc' => array(
						'meta', 'title', 'excerpt', 'readmore'
					)
				),
			)
		);

		return $list;
	}
}

// Filter to add/remove widgets
if ( ! function_exists( 'etude_skin_trx_addons_widgets_list' ) ) {
	add_filter('trx_addons_widgets_list', 'etude_skin_trx_addons_widgets_list');
	function etude_skin_trx_addons_widgets_list( $list = array() ) {
		// ToDo: Unset widget's slug from list to disable widget when current skin is active
		//---> For example to disable widget 'About Me':
		//---> unset( $list['aboutme'] );

		$list['categories_list']['layouts_sc'][4] = esc_html__('Extra 1', 'etude');
		$list['categories_list']['layouts_sc'][5] = esc_html__('Extra 2', 'etude');
		$list['categories_list']['layouts_sc'][6] = esc_html__('Extra 3', 'etude');
		$list['categories_list']['layouts_sc'][7] = esc_html__('Grid 1', 'etude');
		$list['categories_list']['layouts_sc'][8] = esc_html__('Grid 2', 'etude');

		return $list;
	}
}


// SCRIPTS AND STYLES
//--------------------------------------------------

// Localize a theme-specific scripts: add variables to use in JS in the frontend.
if ( ! function_exists( 'etude_skin_localize_script' ) ) {
	add_action( 'etude_filter_localize_script', 'etude_skin_localize_script' );
	function etude_skin_localize_script( $vars = array() ) {
		$vars['msg_copied'] = addslashes(esc_html__("Copied!", 'etude'));
        return $vars;
	}
}


// Enqueue skin-specific scripts
// Priority 1050 -  before main theme plugins-specific (1100)
if ( ! function_exists( 'etude_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'etude_skin_frontend_scripts', 1050 );
	function etude_skin_frontend_scripts() {
		$etude_url = etude_get_file_url( etude_skins_get_current_skin_dir() . 'css/style.css' );
		if ( '' != $etude_url ) {
			wp_enqueue_style( 'etude-skin-' . esc_attr( etude_skins_get_current_skin_name() ), $etude_url, array(), null );
		}
		$etude_url = etude_get_file_url( etude_skins_get_current_skin_dir() . 'skin.js' );
		if ( '' != $etude_url ) {
			wp_enqueue_script( 'etude-skin-' . esc_attr( etude_skins_get_current_skin_name() ), $etude_url, array( 'jquery' ), null, true );
		}
	}
}


// QW Extension styles
if ( ! function_exists( 'etude_skin_trx_addons_qw_extension_setup9' ) ) {
	add_action( 'after_setup_theme', 'etude_skin_trx_addons_qw_extension_setup9', 9 );
	function etude_skin_trx_addons_qw_extension_setup9() {
		if ( etude_exists_trx_addons() && function_exists( 'qw_extensions_get_file_dir' ) ) {
            add_action( 'wp_enqueue_scripts', 'etude_skin_trx_addons_qw_extension_frontend_scripts', 1150 );
            add_filter( 'etude_filter_merge_styles', 'etude_skin_trx_addons_qw_extension_merge_styles');
            add_action( 'wp_enqueue_scripts', 'etude_skin_trx_addons_qw_extension_responsive_styles', 2050 );
            add_filter('etude_filter_merge_styles_responsive', 'etude_skin_trx_addons_qw_extension_merge_styles_responsive', 20);
        }
    }
}

// Enqueue QW styles for frontend
if ( ! function_exists( 'etude_skin_trx_addons_qw_extension_frontend_scripts' ) ) {
    //Handler of the add_action( 'wp_enqueue_scripts', 'etude_skin_trx_addons_qw_extension_frontend_scripts', 1150 );
    function etude_skin_trx_addons_qw_extension_frontend_scripts() {
        if ( etude_is_on( etude_get_theme_option( 'debug_mode' ) ) ) {
            $etude_url = etude_get_file_url( 'plugins/trx_addons/trx_addons-qw-extension.css' );
            if ( '' != $etude_url ) {
                wp_enqueue_style( 'etude-trx-addons-qw-extension', $etude_url, array(), null );
            }
        }
    }
}

// Merge QW styles
if ( ! function_exists( 'etude_skin_trx_addons_qw_extension_merge_styles' ) ) {
    //Handler of the add_filter( 'etude_filter_merge_styles', 'etude_skin_trx_addons_qw_extension_merge_styles');
    function etude_skin_trx_addons_qw_extension_merge_styles( $list ) {
        $list[ 'plugins/trx_addons/trx_addons-qw-extension.css' ] = true;
        return $list;
    }
}

// Enqueue QW responsive styles for frontend
if ( ! function_exists( 'etude_skin_trx_addons_qw_extension_responsive_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'etude_skin_trx_addons_qw_extension_responsive_styles', 2050 );
	function etude_skin_trx_addons_qw_extension_responsive_styles() {
		if ( etude_is_on( etude_get_theme_option( 'debug_mode' ) ) ) {
			$etude_url_qw_extension = etude_get_file_url( 'plugins/trx_addons/trx_addons-qw-extension-responsive.css' );
            if ( '' != $etude_url_qw_extension ) {
                wp_enqueue_style( 'etude-trx-addons-qw-extension-responsive', $etude_url_qw_extension, array(), null, etude_media_for_load_css_responsive( 'trx-addons-qw-extension' ) );
            }
		}
	}
}

// Merge QW responsive styles
if ( ! function_exists( 'etude_skin_trx_addons_qw_extension_merge_styles_responsive' ) ) {
	//Handler of the add_filter('etude_filter_merge_styles_responsive', 'etude_skin_trx_addons_qw_extension_merge_styles_responsive', 20);
	function etude_skin_trx_addons_qw_extension_merge_styles_responsive( $list ) {
		$list[] = 'plugins/trx_addons/trx_addons-qw-extension-responsive.css';
		return $list;
	}
}


// Enqueue additional responsive styles for frontend
// Priority 2050 -  after main theme plugins-specific responsive (2000)
if ( ! function_exists( 'etude_skin_trx_addons_responsive_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'etude_skin_trx_addons_responsive_styles', 2050 );
	function etude_skin_trx_addons_responsive_styles() {
		if ( etude_is_on( etude_get_theme_option( 'debug_mode' ) ) ) {
			$etude_url_additional_1 = etude_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-1.css' );
			$etude_url_additional_2 = etude_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-2.css' );
			$etude_url_additional_3 = etude_get_file_url( 'plugins/trx_addons/trx_addons-additional-responsive-3.css' );
            if ( '' != $etude_url_additional_1 ) {
                wp_enqueue_style( 'etude-trx-addons-additional-responsive-1', $etude_url_additional_1, array(), null, etude_media_for_load_css_responsive( 'trx-addons-1' ) );
			}
            if ( '' != $etude_url_additional_2 ) {
                wp_enqueue_style( 'etude-trx-addons-additional-responsive-2', $etude_url_additional_2, array(), null, etude_media_for_load_css_responsive( 'trx-addons-2' ) );
            }
            if ( '' != $etude_url_additional_3 ) {
                wp_enqueue_style( 'etude-trx-addons-additional-responsive-3', $etude_url_additional_3, array(), null, etude_media_for_load_css_responsive( 'trx-addons-3' ) );
            }
		}
	}
}

// Merge responsive styles
if ( ! function_exists( 'etude_skin_trx_addons_merge_styles_responsive' ) ) {
	add_filter('etude_filter_merge_styles_responsive', 'etude_skin_trx_addons_merge_styles_responsive', 20);
	function etude_skin_trx_addons_merge_styles_responsive( $list ) {
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-1.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-2.css';
		$list[] = 'plugins/trx_addons/trx_addons-additional-responsive-3.css';
		return $list;
	}
}


// Custom styles
$etude_style_path = etude_get_file_dir( etude_skins_get_current_skin_dir() . 'css/style.php' );
if ( ! empty( $etude_style_path ) ) {
	require_once $etude_style_path;
}



// ADD NEW PARAMS
//--------------------------------------------------


// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'etude_skin_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'etude_skin_trx_addons_sc_type', 10, 2 );
	function etude_skin_trx_addons_sc_type( $list, $sc ) {

		if ( 'trx_sc_button' == $sc ) {
			$list['decoration'] = esc_html__( 'Decoration', 'etude' );
			$list['hover'] = esc_html__( 'Hover', 'etude' );
			$list['slide'] = esc_html__( 'Slide', 'etude' );
			$list['flow'] = esc_html__( 'Flow', 'etude' );
			$list['veil'] = esc_html__( 'Veil', 'etude' );
			$list['curtain'] = esc_html__( 'Curtain', 'etude' );
			$list['slant'] = esc_html__( 'Slant', 'etude' );
		}
        if ( 'trx_sc_title' == $sc ) {
            $list['icon'] = esc_html__( 'Icon', 'etude' );
            $list['icon_bottom'] = esc_html__( 'Icon (bottom)', 'etude' );
        }
        if ( 'trx_sc_price' == $sc ) {
            $list['light'] = esc_html__( 'Light', 'etude' );
            $list['simple'] = esc_html__( 'Simple', 'etude' );
            $list['simple_shadow'] = esc_html__( 'Simple (shadow)', 'etude' );
            $list['plain'] = esc_html__( 'Plain', 'etude' );
            $list['focus'] = esc_html__( 'Focus', 'etude' );
            $list['metro'] = esc_html__( 'Metro', 'etude' );
        }
        if ( 'trx_sc_skills' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'etude' );
            $list['extra'] = esc_html__( 'Extra', 'etude' );
            $list['modern'] = esc_html__( 'Modern', 'etude' );
            $list['simple'] = esc_html__( 'Simple', 'etude' );
        }
        if ( 'trx_sc_icons' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'etude' );
            $list['light'] = esc_html__( 'Light', 'etude' );
            $list['hover'] = esc_html__( 'Hover', 'etude' );
            $list['hover2'] = esc_html__( 'Hover 2', 'etude' );
            $list['simple'] = esc_html__( 'Simple', 'etude' );
            $list['plate'] = esc_html__( 'Plate', 'etude' );
            $list['extra'] = esc_html__( 'Extra', 'etude' );
            $list['plain'] = esc_html__( 'Plain', 'etude' );
            $list['bordered'] = esc_html__( 'Bordered', 'etude' );
            $list['card'] = esc_html__( 'Card', 'etude' );
            $list['creative'] = esc_html__( 'Creative', 'etude' );
            $list['accent'] = esc_html__( 'Accent', 'etude' );
            $list['accent2'] = esc_html__( 'Accent 2', 'etude' );
            $list['motley'] = esc_html__( 'Motley', 'etude' );
            $list['decoration'] = esc_html__( 'Decoration', 'etude' );
            $list['figure'] = esc_html__( 'Figure', 'etude' );
            $list['number'] = esc_html__( 'Number', 'etude' );
            $list['rounded'] = esc_html__( 'Rounded', 'etude' );
            $list['common'] = esc_html__( 'Common', 'etude' );
            $list['divider'] = esc_html__( 'Divider', 'etude' );
            $list['divider2'] = esc_html__( 'Divider 2', 'etude' );
            $list['divider3'] = esc_html__( 'Divider 3', 'etude' );
            $list['divider4'] = esc_html__( 'Divider 4', 'etude' );
            $list['partners'] = esc_html__( 'Partners', 'etude' );
            $list['fill'] = esc_html__( 'Fill', 'etude' );
        }

        if ( 'trx_sc_services' == $sc ) {
            $list['alter'] = esc_html__( 'Alter', 'etude' );
            $list['modern'] = esc_html__( 'Modern', 'etude' );
            $list['breezy'] = esc_html__( 'Breezy', 'etude' );
            $list['cool'] = esc_html__( 'Cool', 'etude' );
            $list['extra'] = esc_html__( 'Extra', 'etude' );
            $list['strong'] = esc_html__( 'Strong', 'etude' );
            $list['minimal'] = esc_html__( 'Minimal', 'etude' );
            $list['creative'] = esc_html__( 'Creative', 'etude' );
            $list['shine'] = esc_html__( 'Shine', 'etude' );
            $list['motley'] = esc_html__( 'Motley', 'etude' );
            $list['classic'] = esc_html__( 'Classic', 'etude' );
            $list['fashion'] = esc_html__( 'Fashion', 'etude' );
            $list['backward'] = esc_html__( 'Backward', 'etude' );
            $list['accent'] = esc_html__( 'Accent', 'etude' );
            $list['strange'] = esc_html__( 'Strange', 'etude' );
            $list['unusual'] = esc_html__( 'Unusual', 'etude' );
            $list['price'] = esc_html__( 'Price', 'etude' );
            $list['price2'] = esc_html__( 'Price 2', 'etude' );
        }
		if ( 'trx_sc_team' == $sc ) {
			$list['alter'] = esc_html__( 'Alter', 'etude' );
			$list['3d'] = esc_html__( '3D', 'etude' );
			$list['3d-simple'] = esc_html__( '3D (simple)', 'etude' );
			$list['plain'] = esc_html__( 'Plain', 'etude' );
			$list['list'] = esc_html__( 'List', 'etude' );
			$list['metro'] = esc_html__( 'Metro', 'etude' );
			$list['hover'] = esc_html__( 'Hover', 'etude' );
			$list['creative'] = esc_html__( 'Creative', 'etude' );
			$list['accent'] = esc_html__( 'Accent', 'etude' );
			$list['light'] = esc_html__( 'Light', 'etude' );
		}
		if ( 'trx_sc_testimonials' == $sc ) {
			$list['classic'] = esc_html__( 'Classic', 'etude' );
			$list['plain'] = esc_html__( 'Plain', 'etude' );
			$list['extra'] = esc_html__( 'Plain (extra)', 'etude' );
			$list['light'] = esc_html__( 'Light', 'etude' );
			$list['list'] = esc_html__( 'List', 'etude' );
			$list['common'] = esc_html__( 'Common', 'etude' );
			$list['modern'] = esc_html__( 'Modern', 'etude' );
			$list['hover'] = esc_html__( 'Hover', 'etude' );
			$list['accent'] = esc_html__( 'Accent', 'etude' );
			$list['accent2'] = esc_html__( 'Accent 2', 'etude' );
			$list['creative'] = esc_html__( 'Creative', 'etude' );
			$list['fashion'] = esc_html__( 'Fashion', 'etude' );
			$list['alter'] = esc_html__( 'Alter', 'etude' );
			$list['alter2'] = esc_html__( 'Alter 2', 'etude' );
			$list['decoration'] = esc_html__( 'Decoration', 'etude' );
			$list['chit'] = esc_html__( 'Chit', 'etude' );
			$list['bred'] = esc_html__( 'Bred', 'etude' );
		}
        if ( 'trx_sc_blogger' == $sc ) {
            $list['lay_portfolio'] = esc_html__('Layout Portfolio', 'etude' );
            $list['lay_portfolio_grid'] = esc_html__('Layout Portfolio grid', 'etude' );
            $list['portmodern'] = esc_html__('Portfolio Modern', 'etude' );
            $list['portestate'] = esc_html__('Portfolio Real Estate', 'etude' );
        }
        if ( 'trx_sc_portfolio' == $sc ) {
            $list['extra'] = esc_html__('Extra', 'etude' );
            $list['eclipse'] = esc_html__('Eclipse', 'etude' );
            $list['simple'] = esc_html__('Simple', 'etude' );
            $list['band'] = esc_html__('Band', 'etude' );
            $list['fill'] = esc_html__('Fill', 'etude' );
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'etude' );
        }
		if ( 'trx_sc_socials' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'etude' );
			$list['modern_2'] = esc_html__('Modern 2', 'etude' );
			$list['alter'] = esc_html__('Alter (icon+name)', 'etude' );
			$list['extra'] = esc_html__('Extra (icon+name)', 'etude' );
			$list['simple'] = esc_html__('Simple', 'etude' );
		}
		if ( 'trx_sc_layouts_cart' == $sc ) {
			$list['modern'] = esc_html__('Modern', 'etude' );
		}
        if ( 'trx_sc_events' == $sc ) {
            $list['modern'] = esc_html__('Modern', 'etude' );
            $list['alter'] = esc_html__('Alter', 'etude' );
        }
        if ( 'trx_widget_instagram' == $sc ) {
            $list['simple'] = esc_html__('Simple', 'etude' );
            $list['alter'] = esc_html__('Alter', 'etude' );
            $list['modern'] = esc_html__('Modern', 'etude' );
        }

        return $list;
	}
}

// Add new params to the default shortcode's atts
if ( ! function_exists( 'etude_skin_trx_addons_sc_atts' ) ) {
    add_filter('trx_addons_sc_atts', 'etude_skin_trx_addons_sc_atts', 10, 2);
    function etude_skin_trx_addons_sc_atts($atts, $sc)  {
        if ( 'trx_sc_skills' == $sc ) {
            $atts['align'] = 'none';
            $atts['show_divider'] = '';
        }
        if ('trx_sc_icons' == $sc ) {
            $atts['link_text'] = '';
        }
        if ( 'trx_sc_services' == $sc ) {
            $atts['show_subtitle'] = '';
        }
        if ( 'trx_sc_layouts' == $sc ) {
            $atts['panel_menu_style'] = '';
            $atts['vertical_menu_style'] = '';
        }
        if ( 'trx_sc_layouts_search' == $sc ) {
            $atts['logo_search'] = 'url';
            $atts['logo_search_retina'] = 'url';
            $atts['scheme_search'] = '';
        }
        if ( 'trx_sc_events' == $sc ) {
            $atts['hide_excerpt'] = '';
            $atts['more_text'] = '';
        }
        return $atts;
    }
}

// Add item params to icons
if ( ! function_exists( 'etude_skin_filter_icons_add_param' ) ) {
    add_filter( 'trx_addons_sc_param_group_params', 'etude_skin_filter_icons_add_param', 10, 2 );
    function etude_skin_filter_icons_add_param( $params, $sc ) {

        if ( in_array( $sc, array( 'trx_sc_icons' ) ) ) {
            if ( isset( $params[0]['name'] ) && isset( $params[0]['label'] ) ) {
                array_splice($params, 6, 0, array( array(
                    'name'        => 'link_text',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label'       => esc_html__( 'Link text', 'etude' ),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'etude'),
                ) ) );
            }
        }
        return $params;
    }
}


// Add/Remove params
if (!function_exists('etude_add_portfolio_params_to_elements')) {
    add_action( 'elementor/element/before_section_end', 'etude_add_portfolio_params_to_elements', 11, 3 );
    function etude_add_portfolio_params_to_elements($element, $section_id, $args)  {
        if ( is_object( $element ) ) {
            $el_name = $element->get_name();
            if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                $element->remove_control( 'use_masonry' );
                $element->remove_control( 'use_gallery' );

                if ( 'trx_sc_portfolio' == $el_name  && 'section_sc_portfolio' === $section_id ) {
                    $element->add_control(
                        'use_masonry', array(
                            'label' => esc_html__('Use masonry', 'etude'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'etude'),
                            'label_on' => esc_html__('On', 'etude'),
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                    $element->add_control(
                        'use_gallery', array(
                            'label' => esc_html__('Use gallery', 'etude'),
                            'label_block' => false,
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'label_off' => esc_html__('Off', 'etude'),
                            'label_on' => esc_html__('On', 'etude'),
                            'default' => trx_addons_is_on(trx_addons_get_option('portfolio_use_gallery')) ? '1' : '',
                            'return_value' => '1',
                            'condition' => [
                                'type' => ['eclipse']
                            ],
                        )
                    );
                }

            }
        }
    }
}


// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('etude_skin_elm_add_params_new_set_after')) {
    add_action('elementor/element/after_section_start', 'etude_skin_elm_add_params_new_set_after', 10, 3);
    function etude_skin_elm_add_params_new_set_after($element, $section_id, $args)  {
        if (is_object($element)) {
            $el_name = $element->get_name();
            if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
                $element->add_control(
                    'align', array(
                        'label_block' => false,
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'label' => __("Skills alignment", 'etude'),
                        'options' => array(
                            'none' => esc_html__("Default", 'etude'),
                            'left' => esc_html__('Left', 'etude'),
                            'center' => esc_html__('Center', 'etude'),
                            'right' => esc_html__('Right', 'etude'),
                        ),
                        'default' => 'none',
                        'condition' => array(
                            'type' => array('counter','alter','extra', 'simple')
                        )
                    )
                );
            }

            if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
                $element->add_control(
                    'show_subtitle', array(
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label' => esc_html__('Subtitle', 'etude'),
                        'label_off' => esc_html__('Show', 'etude'),
                        'label_on' => esc_html__('Hide', 'etude'),
                        'return_value' => '1',
                        'condition' => array(
                            'type' => array('default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'hover', 'breezy', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal')
                        )
                    )
                );
            }
        }
    }
}

// Add Tab section and params to shortcode events
if (!function_exists('etude_skin_events_elm_add_params_new_set')) {
    add_action('elementor/element/before_section_start', 'etude_skin_events_elm_add_params_new_set', 10, 3);
    function etude_skin_events_elm_add_params_new_set($element, $section_id, $args) {

        if (!is_object($element)) return;
        $el_name = $element->get_name();

        // Add control 'More Text' Events
        if ('trx_sc_events' == $el_name && $section_id == 'section_slider_params') {

            $element->start_controls_section(
                'section_sc_events_details', array(
                    'label' => esc_html__('Details', 'etude'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
                )
            );
            $element->add_control(
                'more_text', array(
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__('More text', 'etude'),
                    'label_block' => false,
                    'default' => esc_html__('Read more', 'etude'),
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );
            $element->add_control(
                'hide_excerpt', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Hide excerpt', 'etude'),
                    'label_off' => __( 'Off', 'etude' ),
                    'label_on' => __( 'On', 'etude' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('default', 'classic', 'modern', 'alter')
                    )
                )
            );


            $element->end_controls_section();
        }
    }
}

// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('etude_elm_add_params_new_set')) {
	add_action( 'elementor/element/before_section_end', 'etude_elm_add_params_new_set', 10, 3 );
	function etude_elm_add_params_new_set($element, $section_id, $args) {

		if ( ! is_object($element) ) return;
		$el_name = $element->get_name();

		// Add template selector
		if ( $el_name == 'trx_sc_button' && $section_id == 'section_sc_button' ) {
			$control   = $element->get_controls( 'buttons' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['shadow'] = 0;
				}
			}
			$fields['shadow'] = array(
				'name' => 'shadow',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Shadow', 'etude' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'etude' ),
				'label_on'     => esc_html__( 'On', 'etude' ),
				'condition'    => array(
					'type' => array('default', 'decoration', 'hover', 'slide', 'veil', 'flow', 'curtain', 'slant')
				)
			);
			$element->update_control( 'buttons', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $el_name == 'trx_sc_price' && $section_id == 'section_sc_price' ) {
			$control   = $element->get_controls( 'prices' );
			$fields    = $control['fields'];
			$default   = $control['default'];
			if ( is_array( $default ) ) {
				for( $i=0; $i < count($default); $i++ ) {
					$default[$i]['price_active'] = 0;
				}
			}
			$fields['price_active'] = array(
				'name' => 'price_active',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Price Active', 'etude' ),
				'label_block'  => false,
				'label_off'    => esc_html__( 'Off', 'etude' ),
				'label_on'     => esc_html__( 'On', 'etude' ),
			);
			$element->update_control( 'prices', array(
					'default' => $default,
					'fields' => $fields
				)
			);
		}

		if ( $section_id == 'section_sc_title' ) {
			$element->add_control( 'sc_button_shadow', array(
				'label_block'  => false,
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__("Shadow", 'etude'),
				'label_on' => esc_html__( 'On', 'etude' ),
				'label_off' => esc_html__( 'Off', 'etude' ),
				'condition'    => array(
					'link_style' => array('default', 'decoration', 'hover', 'slide', 'veil', 'flow', 'curtain', 'slant')
				)
			) );
		}

        if ('trx_sc_skills' == $el_name && $section_id == 'section_sc_skills') {
            $element->add_control(
                'show_divider', array(
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label' => esc_html__('Skills divider', 'etude'),
                    'label_on' => esc_html__( 'On', 'etude' ),
                    'label_off' => esc_html__( 'Off', 'etude' ),
                    'return_value' => '1',
                    'condition' => array(
                        'type' => array('alter', 'simple')
                    )
                )
            );
        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services') {
            $element->update_control(
                'featured', array(
                    'description' => wp_kses_data( __('Please note: some options might be incompatible with certain layouts.', 'etude') ),
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'unusual', 'strong', 'minimal', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_control(
                'featured_position', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['default', 'modern', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple']
                    ],
                )
            );
            $element->update_responsive_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );

        }

        if ('trx_sc_services' == $el_name && $section_id == 'section_slider_params') {
            $element->update_control(
                'slider', array(
                    'condition' => [
                        'type' => ['default', 'alter', 'extra', 'price', 'price2', 'modern', 'breezy', 'cool', 'creative', 'shine', 'motley', 'classic', 'fashion', 'backward', 'accent', 'strange', 'unusual', 'strong', 'minimal', 'callouts', 'light', 'list', 'iconed', 'hover', 'chess']
                    ],
                )
            );
        }
        if ('trx_sc_services' == $el_name && $section_id == 'section_sc_services_details') {
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['default', 'panel', 'alter', 'extra', 'price', 'price2', 'modern', 'shine', 'motley', 'classic', 'backward', 'accent', 'strange', 'unusual', 'cool', 'strong', 'minimal', 'chess', 'callouts', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
                    ],
                )
            );
            $element->update_control(
                'hide_bg_image', array(
                    'description' => '',
                    'condition' => [
                        'type' => ['shine', 'motley', 'breezy', 'cool', 'creative', 'hover', 'classic', 'fashion', 'extra', 'strong', 'minimal']
                    ],
                )
            );
        }
        /* Add control for filter blogger */
        if ( 'trx_sc_blogger' == $el_name  && 'section_sc_blogger' === $section_id ) {
            $element->add_control(
                'filter_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( "Filter style", 'etude' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'etude'),
                        'toggle' => esc_html__('Toggle', 'etude'),
                    ),
                    'default' => 'default',
                    'prefix_class' => 'sc_style_',
                    'condition' => ['filters_tabs_position' => 'top'],
                )
            );
        }

        if ('trx_sc_layouts' == $el_name && $section_id == 'section_sc_layouts') {
            $element->update_control(
                'popup_id', array(
                    'condition' => array(
                        'type' => array('popup', 'panel', 'panel-menu')
                    )
                )
            );

            $element->add_control(
                'panel_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select panel menu style', 'etude' ),
                    'label_block' => false,
                    'options' => array(
                        'fullscreen' => esc_html__('Fullscreen', 'etude'),
                        'narrow' => esc_html__('Narrow', 'etude'),
                    ),
                    'default' => 'fullscreen',
                    'condition' => array(
                         'type' => array('panel-menu')
                    )
                )
            );
            $element->add_control(
                'vertical_menu_style', array(
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'label' => esc_html__( 'Select vertical menu style', 'etude' ),
                    'description' => esc_html__( 'If the vertical menu(dropdown) in the "Panel menu" is used, then some styles are applied to it', 'etude' ),
                    'label_block' => false,
                    'options' => array(
                        'default' => esc_html__('Default', 'etude'),
                        'extra' => esc_html__('Extra', 'etude'),
                    ),
                    'default' => 'default',
                    'condition' => array(
                        'type' => array('panel-menu')
                    )
                )
            );
        }
        //Search controls & dependencies
        if ('trx_sc_layouts_search' == $element->get_name() && 'section_sc_layouts_search' == $section_id) {

            $element->update_control(
                'style',
                [
                    'condition' => [
                        'type' => ['default'],
                    ]
                ]
            );

            $element->add_control(
                'logo_search', array(
                    'label' => esc_html__( 'Logo', 'etude' ),
                    'description' => esc_html__( "Select or upload image for site's logo. If empty - theme-specific logo is used", 'etude'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'logo_search_retina', array(
                    'label' => esc_html__( 'Logo Retina', 'etude' ),
                    'description' => esc_html__( "Select or upload image for site's logo on the Retina displays", 'etude'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => ''
                    ),
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );

            $element->add_control(
                'scheme_search', array(
                    'type'         => \Elementor\Controls_Manager::SELECT,
                    'label'        => esc_html__( 'Search Color scheme', 'etude' ),
                    'label_block'  => false,
                    'options'      => etude_array_merge( array( '' => esc_html__( 'Inherit', 'etude' ) ), etude_get_list_schemes() ),
                    'render_type'  => 'template',	// ( none | ui | template ) - reload template after parameter is changed
                    'default'      => '',
                    'condition' => array(
                        'type' => array('modern')
                    )
                )
            );


        }

		/* categories list */
		if ('trx_widget_categories_list' == $el_name && $section_id == 'section_sc_categories_list') {
			$element->update_control(
				'show_thumbs', array(
					'condition' => [
						'style' => [1, '1', '2', '3']
					],
				)
			);
			$element->update_control(
				'columns', array(
					'condition' => [
						'style' => [1, '1', '2', '3', '4', '5', '6']
					],
				)
			);
		}

        /* Portfolio Fill Hide Columns */
        if ('trx_sc_portfolio' == $el_name && $section_id == 'section_sc_portfolio') {
            $element->update_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'eclipse', 'band', 'extra']
                    ],
                )
            );
            $element->update_control(
                'more_text', array(
                    'condition' => [
                        'type' => ['band']
                    ],
                )
            );
        }
        /* Hide style 'List' in Trx Booked Calendar layout */
        if ('trx_sc_booked_calendar' == $el_name && $section_id == 'section_sc_booked') {
            $element->update_control(
                'style', array(
                    'options' => [
                        'calendar' => esc_html__('Calendar', 'etude'),
                    ],
                )
            );
        }

        /* Columns gap dependencies */
        if ('trx_widget_instagram' == $el_name && $section_id == 'section_sc_instagram') {
            $element->update_control(
                'columns_gap', array(
                    'condition' => [
                        'type' => ['default', 'simple']
                    ],
                )
            );
        }
        /*
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_height', array(
                    'label' => wp_kses_data( __('Min. height of the TOC', 'etude') ),
                )
            );
        }
        if ('trx_widget_slider' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'controller_effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'etude') ),
                )
            );
        }
        if ('trx_widget_controller' == $el_name && $section_id == 'section_sc_slider_controller' ) {
            $element->update_control(
                'effect', array(
                    'description' => wp_kses_data( __('Please note: some effects might be incompatible with multiple items per view.', 'etude') ),
                )
            );
        }
        */
  	}
}

// Substitute tab content with layout
if (!function_exists('etude_elm_add_params_class_new_set')) {
	add_filter( 'elementor/widget/render_content', 'etude_elm_add_params_class_new_set', 10, 2 );
	function etude_elm_add_params_class_new_set($html, $element) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			$settings = $element->get_settings();
			if ( $el_name == 'trx_sc_button' ) {
				if ( is_array( $settings['buttons'] ) ) {
					foreach( $settings['buttons'] as $k => $tab ) {
						if ( ! empty( $tab['shadow'] ) && ($tab['type'] == 'default' || $tab['type'] == 'decoration' || $tab['type'] == 'hover' || $tab['type'] == 'slide' || $tab['type'] == 'veil' || $tab['type'] == 'flow' || $tab['type'] == 'curtain' || $tab['type'] == 'slant')) {
							$parts = explode( 'class="sc_button ', $html );
							$parts[ $k + 1 ] = 'sc_button_shadow ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_button ', $parts );
						}
					}
				}
			}

			if ( $el_name == 'trx_sc_price' ) {
				if ( is_array( $settings['prices'] ) ) {
					foreach( $settings['prices'] as $k => $tab ) {
						if ( ! empty( $tab['price_active'] ) ) {
							$parts = explode( 'class="sc_price_item ', $html );
							$parts[ $k + 1 ] = 'sc_price_active ' . $parts[ $k + 1 ];
							$html = join( 'class="sc_price_item ', $parts );
						}
					}
				}
			}

			$settings = $element->get_settings();
			if ( ! empty( $settings['sc_button_shadow'] ) ) {
				$html = preg_replace('/(class="sc_button sc_button_)(default|hover|decoration|slide|veil|flow|curtain|slant) /', '$1$2 sc_button_shadow ', $html);
			}

		}
		return $html;
	}
}
// Enqueue script tilt for some Shortcodes
if ( ! function_exists( 'etude_skin_filter_trx_addons_sc_output' ) ) {
    add_filter('trx_addons_sc_output', 'etude_skin_filter_trx_addons_sc_output', 10, 4);
    function etude_skin_filter_trx_addons_sc_output($output, $sc, $atts, $content)   {
        if (
        	( 'trx_sc_services' == $sc && ( 'hover' == $atts['type'] || 'creative' == $atts['type'] ) )
		  	|| ( 'trx_sc_team' == $sc && ( '3d' == $atts['type'] || '3d-simple' == $atts['type'] ) )
		) {
            wp_enqueue_script('tilt', etude_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
        }
        // Change Output Panel Menu
        if  ( 'trx_sc_layouts' == $sc && 'panel-menu' == $atts['type'] ) {
            trx_addons_add_inline_html($output);
            return '';
        }

        return $output;
    }
}

// Add parameter to the list controls styles
if ( ! function_exists( 'etude_skin_filter_get_list_sc_slider_controls_styles' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_styles', 'etude_skin_filter_get_list_sc_slider_controls_styles', 10, 2 );
	function etude_skin_filter_get_list_sc_slider_controls_styles( $list ) {
		$list['light'] = esc_html__( 'Light', 'etude' );
		$list['alter'] = esc_html__( 'Alter', 'etude' );
		return $list;
	}
}
// Add parameter to the list controls styles
if ( ! function_exists( 'etude_skin_filter_get_list_sc_slider_paginations_types' ) ) {
	//add_filter( 'trx_addons_filter_get_list_sc_slider_paginations_types', 'etude_skin_filter_get_list_sc_slider_paginations_types', 10 );
	add_filter( 'trx_addons_filter_get_list_sc_slider_controls_paginations_types', 'etude_skin_filter_get_list_sc_slider_paginations_types', 10 );
	function etude_skin_filter_get_list_sc_slider_paginations_types( $list ) {
		$list['title'] = esc_html__( 'Title', 'etude' );
		return $list;
	}
}


// Add parameter to the list layouts type
if ( ! function_exists( 'etude_skin_filter_get_list_sc_layouts_type' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_layouts_type', 'etude_skin_filter_get_list_sc_layouts_type', 10, 2 );
    function etude_skin_filter_get_list_sc_layouts_type( $list ) {
        $list['panel-menu'] = esc_html__( 'Panel Menu', 'etude' );
        return $list;
    }
}

// Add parameter to the list Extend background
if ( ! function_exists( 'etude_skin_filter_get_list_sc_content_extra_bg' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_content_extra_bg', 'etude_skin_filter_get_list_sc_content_extra_bg', 10, 2 );
	function etude_skin_filter_get_list_sc_content_extra_bg( $list ) {
		$list['large_left'] = esc_html__( 'Large Left', 'etude' );
		$list['extra_left'] = esc_html__( 'Extra Left', 'etude' );
		$list['large_right'] = esc_html__( 'Large Right', 'etude' );
		return $list;
	}
}
// Remove 'Bottom' item from list Services
if ( ! function_exists( 'etude_skin_filter_get_list_sc_services_featured_positions' ) ) {
    add_filter( 'trx_addons_filter_get_list_sc_services_featured_positions', 'etude_skin_filter_get_list_sc_services_featured_positions', 10, 2 );
    function etude_skin_filter_get_list_sc_services_featured_positions( $list ) {
        unset( $list['bottom'] );
        return $list;
    }
}

// Show post link 'Read more' in the blog posts
if ( ! function_exists( 'etude_show_post_more_link' ) ) {
	function etude_show_post_more_link( $args = array(), $otag='', $ctag='' ) {
		if ( ! isset( $args['more_button'] ) || $args['more_button'] ) {
			etude_show_layout(
				'<a class="post-more-link" href="' . esc_url( get_permalink() ) . '"><span class="link-text">'
				. ( ! empty( $args['more_text'] )
					? esc_html( $args['more_text'] )
					: esc_html__( 'Read More', 'etude' )
				)
				. '</span><span class="more-link-icon"></span></a>',
				$otag,
				$ctag
			);
		}
	}
}


if (!function_exists('etude_elm_add_script')) {
	add_filter( 'elementor/frontend/widget/before_render', 'etude_elm_add_script', 10, 2 );
	function etude_elm_add_script($content, $widget=null) {
			$setting_class = $content->get_settings('_css_classes');
			$cheack = strpos($setting_class, 'VanillaTiltHover');    
			if(isset($cheack) && $cheack !== false) {
				wp_enqueue_script('tilt', etude_get_file_url('js/tilt/vanilla-tilt.min.js'), array('jquery'), null, true);
			}
		return $content;
	}
}


// Add default prefix in Blogger toggle filter
if (!function_exists('etude_localize_scripts_skin')) {
    add_filter( 'etude_filter_localize_script', 'etude_localize_scripts_skin', 2 );
    function etude_localize_scripts_skin($arg) {
        $arg['toggle_title'] = esc_html__( "Filter by ", 'etude' );
        return $arg;
    }
}


// Add cat_sep in meta single
if (!function_exists('etude_filter_post_meta_args_single')) {
	add_filter( 'etude_filter_post_meta_args', 'etude_filter_post_meta_args_single', 2, 2 );
	function etude_filter_post_meta_args_single($arg, $type) {
		if('single' == $type)
			$arg['cat_sep'] = false;
		return $arg;
	}
}


// cpt_team -> wrap contact form fns info des
if ( !function_exists( 'etude_cpt_team_contact_form_after_article_before' ) ) {
	add_action('trx_addons_action_after_article', 'etude_cpt_team_contact_form_after_article_before', 49, 2);
	function etude_cpt_team_contact_form_after_article_before( $mode, $out='' ) {
		if ($mode == 'team.single') {
			$class = "comments_close";
			if ( comments_open() || get_comments_number() ) {
				$class = "comments_open";
			}
			etude_show_layout('<section class="team_page_wrap_info '.esc_attr($class).'"><div class="team_page_wrap_info_over">'.$out);
		}
	}
}
if ( !function_exists( 'etude_cpt_team_contact_form_after_article_after' ) ) {
	add_action('trx_addons_action_after_article', 'etude_cpt_team_contact_form_after_article_after', 51, 1);
	function etude_cpt_team_contact_form_after_article_after( $mode ) {
		if ($mode == 'team.single') {
			echo '</div></section>';
		}
	}
}
if ( !function_exists( 'etude_cpt_team_contact_form_posts_title' ) ) {
	add_filter('trx_addons_filter_team_posts_title', 'etude_cpt_team_contact_form_posts_title');
	function etude_cpt_team_contact_form_posts_title() {
		return esc_html__( "Contact Form", 'etude' );
	}
}

// Return tag SVG from specified file
if (!function_exists('etude_get_svg_from_file')) {
	function etude_get_svg_from_file($svg) {
		$content = etude_fgc($svg);
		preg_match("#<\s*?svg\b[^>]*>(.*?)</svg\b[^>]*>#s", $content, $matches);
		return !empty($matches[0]) ? str_replace(array("\r", "\n"), array('', ' '), $matches[0]) : '';
	}
}

// Modified Scroll To Top
if (!function_exists('etude_skin_filter_scroll_to_top')) {
    add_filter('trx_addons_filter_scroll_to_top', 'etude_skin_filter_scroll_to_top');
    function etude_skin_filter_scroll_to_top( $output ) {
        if ( etude_get_theme_option( 'scroll_to_top_style') == 'modern' )  {
            $output = '<a href="#" class="trx_addons_scroll_to_top scroll_to_top_style_' . esc_attr(etude_get_theme_option( 'scroll_to_top_style')) . esc_attr(etude_is_on(etude_get_theme_option('scroll_to_top_scheme_watchers')) ? ' watch_scheme' : '') . '" title="' . esc_attr__('Scroll to top', 'etude') . '">'
                      . '<span class="scroll_to_top_text">' . esc_html__('Go to Top', 'etude') . '</span>'
                      . '<span class="scroll_to_top_icon"></span>'
                      . '</a>';

        } else {
            $output = '<a href="#" class="trx_addons_scroll_to_top trx_addons_icon-up scroll_to_top_style_' . esc_attr(etude_get_theme_option( 'scroll_to_top_style')) . '" title="' . esc_attr__('Scroll to top', 'etude') . '">'
                      . ( ! empty( $type )
                          ? '<span class="trx_addons_scroll_progress trx_addons_scroll_progress_type_' . esc_attr( $type ) . '"></span>'
                          : ''
                        )
                      . '</a>';
        }
        return $output;
    }
}

// Add sticky socials
if ( !function_exists( 'etude_skin_wp_footer' ) ) {
    add_action('wp_footer', 'etude_skin_wp_footer');
    function etude_skin_wp_footer() {

        if (( etude_exists_trx_addons() && trx_addons_get_socials_links() != '') && etude_is_on( etude_get_theme_option( 'sticky_socials' ) ) ) {

            $wrap_start = '<div class="sticky_socials_wrap sticky_socials_' . esc_attr( etude_get_theme_option( 'sticky_socials_style' ) ) . esc_attr( etude_is_on( etude_get_theme_option( 'sticky_socials_scheme_watchers' ) ) ? ' watch_scheme' : '') . '">';
            $wrap_end   = '</div>';

            if ( etude_get_theme_option( 'sticky_socials_style' ) == 'modern' ) {
                // Social icons
                etude_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons_names'),
                    $wrap_start, $wrap_end);
            } else {
                etude_show_layout(trx_addons_get_socials_links($style = 'icons', $show = 'icons'),
                    $wrap_start, $wrap_end);
            }
        }
    }
}


// Detect blog mode 404
if (!function_exists('etude_filter_detect_blog_mode_404')) {
	add_filter( 'etude_filter_detect_blog_mode', 'etude_filter_detect_blog_mode_404' );
	function etude_filter_detect_blog_mode_404($mode) {
		return is_404() ? '404' : $mode;
	}
}

// TweenMax library for 404
if (!function_exists('trx_addons_filter_load_tweenmax_404')) {
	add_filter('trx_addons_filter_load_tweenmax', 'trx_addons_filter_load_tweenmax_404');
	function trx_addons_filter_load_tweenmax_404($status) {
		return is_404() ? true : $status;
	}
}
// Add single portfolio navigation
if ( !function_exists( 'etude_single_portfolio_navigation' ) ) {
    add_filter('trx_addons_action_after_article', 'etude_single_portfolio_navigation');
    function etude_single_portfolio_navigation( $args ) {
        if( etude_get_theme_option( 'cpt_navigation_portfolio' ) && 'portfolio.single' == $args ) {
            $post_nav = get_the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next Project', 'etude') . '</span> ',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Prev Project', 'etude') . '</span> ',
            ) );
            etude_show_layout($post_nav);
        }
    }
}
// Display begin of the slider layout for some shortcodes
if (!function_exists('etude_skin_filter_sc_show_slider_args')) {
    add_filter( 'trx_addons_filter_sc_show_slider_args', 'etude_skin_filter_sc_show_slider_args' );
    function etude_skin_filter_sc_show_slider_args( $args = array() ) {
        if ('sc_events' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        if ('sc_portfolio' == $args['sc']) {
            $args['args']['slides_min_width'] = 220;
        }
        return  $args;
    }
}

// Remove input hover effects
if ( !function_exists( 'etude_skin_filter_get_list_input_hover' ) ) {
    add_filter( 'trx_addons_filter_get_list_input_hover', 'etude_skin_filter_get_list_input_hover');
    function etude_skin_filter_get_list_input_hover($list) {
        unset($list['accent']);
        unset($list['path']);
        unset($list['jump']);
        unset($list['underline']);
        unset($list['iconed']);
        return $list;
    }
}

// Add new image's hovers
if ( ! function_exists( 'etude_skin_filter_get_list_hovers' ) ) {
	add_filter(	'etude_filter_list_hovers', 'etude_skin_filter_get_list_hovers' );
	function etude_skin_filter_get_list_hovers( $list ) {
		$list['link'] = esc_html__( 'Link', 'etude' );
		return $list;
	}
}

// New Functions
//--------------------------------------------------
if ( ! function_exists( 'etude_skin_theme_specific_setup9' ) ) {
    add_action( 'after_setup_theme', 'etude_skin_theme_specific_setup9', 9 );
    function etude_skin_theme_specific_setup9() {
        if ( etude_exists_trx_addons() ) {
            remove_action( 'trx_addons_action_before_single_post_video', 'trx_addons_cpt_post_before_video_sticky' );
        }
    }
}
// Open wrapper around single post video
if (!function_exists('etude_skin_trx_addons_cpt_post_before_video_sticky')) {
    add_action( 'trx_addons_action_before_single_post_video', 'etude_skin_trx_addons_cpt_post_before_video_sticky', 10, 1 );
    function etude_skin_trx_addons_cpt_post_before_video_sticky( $args = array() ) {
        if ( ! empty( $args['singular'] ) || ! empty( $args['singular_extra'] ) ) {
            $post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
            if ( ! empty( $post_meta['video_sticky'] ) ) {
                ?>
                <div class="trx_addons_video_sticky">
                <div class="trx_addons_video_sticky_inner">
                <h5 class="trx_addons_video_sticky_title">
                    <?php echo esc_html(get_the_title(get_the_ID())); ?></h5>
                <?php
                $GLOBALS['TRX_ADDONS_STORAGE']['video_sticky_opened'] = true;
            }
        }
    }
}

// Display prices with tags in ALL places
if ( false && ! function_exists( 'etude_skin_trx_addons_filter_custom_meta_value_strip_tags_new' ) ) {
    add_filter( 'trx_addons_filter_custom_meta_value_strip_tags', 'etude_skin_trx_addons_filter_custom_meta_value_strip_tags_new', 11, 3 );
    function etude_skin_trx_addons_filter_custom_meta_value_strip_tags_new( $arr, $key, $value ) {
		foreach ($arr as $k => $v) 
    		if ($v === 'price') unset($arr[$k]);
        return $arr;
    }
}

// Change "load more" button text 
if ( ! function_exists( 'etude_skin_load_more_text_new' ) ) {
    add_filter( 'etude_filter_load_more_text', 'etude_skin_load_more_text_new' );
    function etude_skin_load_more_text_new() {
		$text = esc_html__('Load More', 'etude');
        return $text;
    }
}

// Change option 'Not selected' for all tag select
if ( ! function_exists( 'etude_skin_not_selected_mask' ) ) {
    add_filter( 'trx_addons_filter_not_selected_mask', 'etude_skin_not_selected_mask' );
    function etude_skin_not_selected_mask() {
        return __( '%s', 'etude' );
    }
}

// Activation methods
if ( ! function_exists( 'etude_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'etude_skin_filter_activation_methods', 10, 1 );
    function etude_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = false;
        return $args;
    }
}