<?php
/**
 * The Portfolio template to display the content
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

$etude_post_format = get_post_format();
$etude_post_format = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );

?><div class="
<?php
if ( ! empty( $etude_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( etude_is_blog_style_use_masonry( $etude_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $etude_columns ) : esc_attr( $etude_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $etude_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $etude_columns )
		. ( 'portfolio' != $etude_blog_style[0] ? ' ' . esc_attr( $etude_blog_style[0] )  . '_' . esc_attr( $etude_columns ) : '' )
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

	$etude_hover   = ! empty( $etude_template_args['hover'] ) && ! etude_is_inherit( $etude_template_args['hover'] )
								? $etude_template_args['hover']
								: etude_get_theme_option( 'image_hover' );

	if ( 'dots' == $etude_hover ) {
		$etude_post_link = empty( $etude_template_args['no_links'] )
								? ( ! empty( $etude_template_args['link'] )
									? $etude_template_args['link']
									: get_permalink()
									)
								: '';
		$etude_target    = ! empty( $etude_post_link ) && false === strpos( $etude_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$etude_components = ! empty( $etude_template_args['meta_parts'] )
							? ( is_array( $etude_template_args['meta_parts'] )
								? $etude_template_args['meta_parts']
								: explode( ',', $etude_template_args['meta_parts'] )
								)
							: etude_array_get_keys_by_value( etude_get_theme_option( 'meta_parts' ) );

	// Featured image
	etude_show_post_featured( apply_filters( 'etude_filter_args_featured',
        array(
			'hover'         => $etude_hover,
			'no_links'      => ! empty( $etude_template_args['no_links'] ),
			'thumb_size'    => ! empty( $etude_template_args['thumb_size'] )
								? $etude_template_args['thumb_size']
								: etude_get_thumb_size(
									etude_is_blog_style_use_masonry( $etude_blog_style[0] )
										? (	strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false || $etude_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false || $etude_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => etude_is_blog_style_use_masonry( $etude_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $etude_components,
			'class'         => 'dots' == $etude_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $etude_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $etude_post_link )
												? '<a href="' . esc_url( $etude_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $etude_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $etude_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $etude_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!