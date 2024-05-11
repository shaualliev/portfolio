<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

$etude_template = apply_filters( 'etude_filter_get_template_part', etude_blog_archive_get_template() );

if ( ! empty( $etude_template ) && 'index' != $etude_template ) {

	get_template_part( $etude_template );

} else {

	etude_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$etude_stickies   = is_home()
								|| ( in_array( etude_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) etude_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$etude_post_type  = etude_get_theme_option( 'post_type' );
		$etude_args       = array(
								'blog_style'     => etude_get_theme_option( 'blog_style' ),
								'post_type'      => $etude_post_type,
								'taxonomy'       => etude_get_post_type_taxonomy( $etude_post_type ),
								'parent_cat'     => etude_get_theme_option( 'parent_cat' ),
								'posts_per_page' => etude_get_theme_option( 'posts_per_page' ),
								'sticky'         => etude_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $etude_stickies )
															&& count( $etude_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		etude_blog_archive_start();

		do_action( 'etude_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'etude_action_before_page_author' );
			get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'etude_action_after_page_author' );
		}

		if ( etude_get_theme_option( 'show_filters' ) ) {
			do_action( 'etude_action_before_page_filters' );
			etude_show_filters( $etude_args );
			do_action( 'etude_action_after_page_filters' );
		} else {
			do_action( 'etude_action_before_page_posts' );
			etude_show_posts( array_merge( $etude_args, array( 'cat' => $etude_args['parent_cat'] ) ) );
			do_action( 'etude_action_after_page_posts' );
		}

		do_action( 'etude_action_blog_archive_end' );

		etude_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
