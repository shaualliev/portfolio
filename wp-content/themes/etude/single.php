<?php
/**
 * The template to display single post
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

// Full post loading
$full_post_loading          = etude_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = etude_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = etude_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$etude_related_position   = etude_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$etude_posts_navigation   = etude_get_theme_option( 'posts_navigation' );
$etude_prev_post          = false;
$etude_prev_post_same_cat = etude_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( etude_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	etude_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'etude_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $etude_posts_navigation ) {
		$etude_prev_post = get_previous_post( $etude_prev_post_same_cat );  // Get post from same category
		if ( ! $etude_prev_post && $etude_prev_post_same_cat ) {
			$etude_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $etude_prev_post ) {
			$etude_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $etude_prev_post ) ) {
		etude_sc_layouts_showed( 'featured', false );
		etude_sc_layouts_showed( 'title', false );
		etude_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $etude_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/content', 'single-' . etude_get_theme_option( 'single_style' ) ), 'single-' . etude_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $etude_related_position, 'inside' ) === 0 ) {
		$etude_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'etude_action_related_posts' );
		$etude_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $etude_related_content ) ) {
			$etude_related_position_inside = max( 0, min( 9, etude_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $etude_related_position_inside ) {
				$etude_related_position_inside = mt_rand( 1, 9 );
			}

			$etude_p_number         = 0;
			$etude_related_inserted = false;
			$etude_in_block         = false;
			$etude_content_start    = strpos( $etude_content, '<div class="post_content' );
			$etude_content_end      = strrpos( $etude_content, '</div>' );

			for ( $i = max( 0, $etude_content_start ); $i < min( strlen( $etude_content ) - 3, $etude_content_end ); $i++ ) {
				if ( $etude_content[ $i ] != '<' ) {
					continue;
				}
				if ( $etude_in_block ) {
					if ( strtolower( substr( $etude_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$etude_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $etude_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $etude_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$etude_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $etude_content[ $i + 1 ] && in_array( $etude_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$etude_p_number++;
					if ( $etude_related_position_inside == $etude_p_number ) {
						$etude_related_inserted = true;
						$etude_content = ( $i > 0 ? substr( $etude_content, 0, $i ) : '' )
											. $etude_related_content
											. substr( $etude_content, $i );
					}
				}
			}
			if ( ! $etude_related_inserted ) {
				if ( $etude_content_end > 0 ) {
					$etude_content = substr( $etude_content, 0, $etude_content_end ) . $etude_related_content . substr( $etude_content, $etude_content_end );
				} else {
					$etude_content .= $etude_related_content;
				}
			}
		}

		etude_show_layout( $etude_content );
	}

	// Comments
	do_action( 'etude_action_before_comments' );
	comments_template();
	do_action( 'etude_action_after_comments' );

	// Related posts
	if ( 'below_content' == $etude_related_position
		&& ( 'scroll' != $etude_posts_navigation || etude_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || etude_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'etude_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $etude_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $etude_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $etude_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $etude_prev_post ) ); ?>"
			<?php do_action( 'etude_action_nav_links_single_scroll_data', $etude_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
