<?php
/**
 * The Front Page template file.
 *
 * @package ETUDE
 * @since ETUDE 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( etude_is_on( etude_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$etude_sections = etude_array_get_keys_by_value( etude_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $etude_sections ) ) {
			foreach ( $etude_sections as $etude_section ) {
				get_template_part( apply_filters( 'etude_filter_get_template_part', 'front-page/section', $etude_section ), $etude_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'etude_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'etude_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'index' ) );
}

get_footer();
