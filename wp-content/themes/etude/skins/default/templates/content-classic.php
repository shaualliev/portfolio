<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

$etude_template_args = get_query_var( 'etude_template_args' );

if ( is_array( $etude_template_args ) ) {
	$etude_columns    = empty( $etude_template_args['columns'] ) ? 2 : max( 1, $etude_template_args['columns'] );
	$etude_blog_style = array( $etude_template_args['type'], $etude_columns );
    $etude_columns_class = etude_get_column_class( 1, $etude_columns, ! empty( $etude_template_args['columns_tablet']) ? $etude_template_args['columns_tablet'] : '', ! empty($etude_template_args['columns_mobile']) ? $etude_template_args['columns_mobile'] : '' );
} else {
	$etude_template_args = array();
	$etude_blog_style = explode( '_', etude_get_theme_option( 'blog_style' ) );
	$etude_columns    = empty( $etude_blog_style[1] ) ? 2 : max( 1, $etude_blog_style[1] );
    $etude_columns_class = etude_get_column_class( 1, $etude_columns );
}
$etude_expanded   = ! etude_sidebar_present() && etude_get_theme_option( 'expand_content' ) == 'expand';

$etude_post_format = get_post_format();
$etude_post_format = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );

?><div class="<?php
	if ( ! empty( $etude_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( etude_is_blog_style_use_masonry( $etude_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $etude_columns ) : esc_attr( $etude_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $etude_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $etude_columns )
				. ' post_layout_' . esc_attr( $etude_blog_style[0] )
				. ' post_layout_' . esc_attr( $etude_blog_style[0] ) . '_' . esc_attr( $etude_columns )
	);
	etude_add_blog_animation( $etude_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$etude_hover      = ! empty( $etude_template_args['hover'] ) && ! etude_is_inherit( $etude_template_args['hover'] )
							? $etude_template_args['hover']
							: etude_get_theme_option( 'image_hover' );

	$etude_components = ! empty( $etude_template_args['meta_parts'] )
							? ( is_array( $etude_template_args['meta_parts'] )
								? $etude_template_args['meta_parts']
								: explode( ',', $etude_template_args['meta_parts'] )
								)
							: etude_array_get_keys_by_value( etude_get_theme_option( 'meta_parts' ) );

	etude_show_post_featured( apply_filters( 'etude_filter_args_featured',
		array(
			'thumb_size' => ! empty( $etude_template_args['thumb_size'] )
				? $etude_template_args['thumb_size']
				: etude_get_thumb_size(
				'classic' == $etude_blog_style[0]
						? ( strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $etude_columns > 2 ? 'big' : 'huge' )
								: ( $etude_columns > 2
									? ( $etude_expanded ? 'square' : 'square' )
									: ($etude_columns > 1 ? 'square' : ( $etude_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $etude_columns > 2 ? 'masonry-big' : 'full' )
								: ($etude_columns === 1 ? ( $etude_expanded ? 'huge' : 'big' ) : ( $etude_columns <= 2 && $etude_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $etude_hover,
			'meta_parts' => $etude_components,
			'no_links'   => ! empty( $etude_template_args['no_links'] ),
        ),
        'content-classic',
        $etude_template_args
    ) );

	// Title and post meta
	$etude_show_title = get_the_title() != '';
	$etude_show_meta  = count( $etude_components ) > 0 && ! in_array( $etude_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $etude_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'etude_filter_show_blog_meta', $etude_show_meta, $etude_components, 'classic' ) ) {
				if ( count( $etude_components ) > 0 ) {
					do_action( 'etude_action_before_post_meta' );
					etude_show_post_meta(
						apply_filters(
							'etude_filter_post_meta_args', array(
							'components' => join( ',', $etude_components ),
							'seo'        => false,
							'echo'       => true,
						), $etude_blog_style[0], $etude_columns
						)
					);
					do_action( 'etude_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'etude_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'etude_action_before_post_title' );
				if ( empty( $etude_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'etude_action_after_post_title' );
			}

			if( !in_array( $etude_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'etude_filter_show_blog_readmore', ! $etude_show_title || ! empty( $etude_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $etude_template_args['no_links'] ) ) {
						do_action( 'etude_action_before_post_readmore' );
						etude_show_post_more_link( $etude_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'etude_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $etude_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('etude_filter_show_blog_excerpt', empty($etude_template_args['hide_excerpt']) && etude_get_theme_option('excerpt_length') > 0, 'classic')) {
			etude_show_post_content($etude_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $etude_template_args['more_button'] )) {
			if ( empty( $etude_template_args['no_links'] ) ) {
				do_action( 'etude_action_before_post_readmore' );
				etude_show_post_more_link( $etude_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'etude_action_after_post_readmore' );
			}
		}
		$etude_content = ob_get_contents();
		ob_end_clean();
		etude_show_layout($etude_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
