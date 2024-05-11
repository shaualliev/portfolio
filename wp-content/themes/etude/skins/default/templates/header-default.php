<?php
/**
 * The template to display default site header
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

$etude_header_css   = '';
$etude_header_image = get_header_image();
$etude_header_video = etude_get_header_video();
if ( ! empty( $etude_header_image ) && etude_trx_addons_featured_image_override( is_singular() || etude_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$etude_header_image = etude_get_current_mode_image( $etude_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $etude_header_image ) || ! empty( $etude_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $etude_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $etude_header_image ) {
		echo ' ' . esc_attr( etude_add_inline_css_class( 'background-image: url(' . esc_url( $etude_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( etude_is_on( etude_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight etude-full-height';
	}
	$etude_header_scheme = etude_get_theme_option( 'header_scheme' );
	if ( ! empty( $etude_header_scheme ) && ! etude_is_inherit( $etude_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $etude_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $etude_header_video ) ) {
		get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( etude_is_on( etude_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
