<?php
/**
 * Required plugins
 *
 * @package ETUDE
 * @since ETUDE 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$etude_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'etude' ),
	'page_builders' => esc_html__( 'Page Builders', 'etude' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'etude' ),
	'socials'       => esc_html__( 'Socials and Communities', 'etude' ),
	'events'        => esc_html__( 'Events and Appointments', 'etude' ),
	'content'       => esc_html__( 'Content', 'etude' ),
	'other'         => esc_html__( 'Other', 'etude' ),
);
$etude_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'etude' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'etude' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $etude_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'etude' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'etude' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $etude_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'etude' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'etude' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $etude_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'etude' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'etude' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $etude_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'etude' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'etude' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'woocommerce.png',
		'group'       => $etude_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'etude' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'etude' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $etude_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'etude' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'etude' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $etude_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'etude' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'etude' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $etude_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $etude_theme_required_plugins_groups['events'],
	),
	'quickcal'                     => array(
		'title'       => esc_html__( 'QuickCal', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'quickcal.png',
		'group'       => $etude_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $etude_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'etude' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'etude' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $etude_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'etude' ),
		'description' => '',
		'required'    => false,
		'logo'        => etude_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $etude_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'etude' ),
		'description' => '',
		'required'    => false,
		'logo'        => etude_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => etude_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => etude_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $etude_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => etude_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $etude_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => etude_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'etude' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'etude' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'etude' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'etude' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $etude_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'etude' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'etude' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $etude_theme_required_plugins_groups['other'],
	),
	'gdpr-framework'         => array(
		'title'       => esc_html__( 'The GDPR Framework', 'etude' ),
		'description' => esc_html__( "Tools to help make your website GDPR-compliant. Fully documented, extendable and developer-friendly.", 'etude' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'gdpr-framework.png',
		'group'       => $etude_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'etude' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'etude' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $etude_theme_required_plugins_groups['other'],
	),
);

if ( ETUDE_THEME_FREE ) {
	unset( $etude_theme_required_plugins['js_composer'] );
	unset( $etude_theme_required_plugins['booked'] );
	unset( $etude_theme_required_plugins['quickcal'] );
	unset( $etude_theme_required_plugins['the-events-calendar'] );
	unset( $etude_theme_required_plugins['calculated-fields-form'] );
	unset( $etude_theme_required_plugins['essential-grid'] );
	unset( $etude_theme_required_plugins['revslider'] );
	unset( $etude_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $etude_theme_required_plugins['trx_updater'] );
	unset( $etude_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
etude_storage_set( 'required_plugins', $etude_theme_required_plugins );