<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

$etude_template_args = get_query_var( 'etude_template_args' );
$etude_columns = 1;
if ( is_array( $etude_template_args ) ) {
	$etude_columns    = empty( $etude_template_args['columns'] ) ? 1 : max( 1, $etude_template_args['columns'] );
	$etude_blog_style = array( $etude_template_args['type'], $etude_columns );
	if ( ! empty( $etude_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $etude_columns > 1 ) {
	    $etude_columns_class = etude_get_column_class( 1, $etude_columns, ! empty( $etude_template_args['columns_tablet']) ? $etude_template_args['columns_tablet'] : '', ! empty($etude_template_args['columns_mobile']) ? $etude_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $etude_columns_class ); ?>">
		<?php
	}
} else {
	$etude_template_args = array();
}
$etude_expanded    = ! etude_sidebar_present() && etude_get_theme_option( 'expand_content' ) == 'expand';
$etude_post_format = get_post_format();
$etude_post_format = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $etude_post_format ) );
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
								: array_map( 'trim', explode( ',', $etude_template_args['meta_parts'] ) )
								)
							: etude_array_get_keys_by_value( etude_get_theme_option( 'meta_parts' ) );
	etude_show_post_featured( apply_filters( 'etude_filter_args_featured',
		array(
			'no_links'   => ! empty( $etude_template_args['no_links'] ),
			'hover'      => $etude_hover,
			'meta_parts' => $etude_components,
			'thumb_size' => ! empty( $etude_template_args['thumb_size'] )
							? $etude_template_args['thumb_size']
							: etude_get_thumb_size( strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $etude_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$etude_template_args
	) );

	// Title and post meta
	$etude_show_title = get_the_title() != '';
	$etude_show_meta  = count( $etude_components ) > 0 && ! in_array( $etude_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $etude_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'etude_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'etude_action_before_post_title' );
				if ( empty( $etude_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'etude_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'etude_filter_show_blog_excerpt', empty( $etude_template_args['hide_excerpt'] ) && etude_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'etude_filter_show_blog_meta', $etude_show_meta, $etude_components, 'excerpt' ) ) {
				if ( count( $etude_components ) > 0 ) {
					do_action( 'etude_action_before_post_meta' );
					etude_show_post_meta(
						apply_filters(
							'etude_filter_post_meta_args', array(
								'components' => join( ',', $etude_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'etude_action_after_post_meta' );
				}
			}

			if ( etude_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'etude_action_before_full_post_content' );
					the_content( '' );
					do_action( 'etude_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'etude' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'etude' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				etude_show_post_content( $etude_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'etude_filter_show_blog_readmore',  ! isset( $etude_template_args['more_button'] ) || ! empty( $etude_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $etude_template_args['no_links'] ) ) {
					do_action( 'etude_action_before_post_readmore' );
					if ( etude_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						etude_show_post_more_link( $etude_template_args, '<p>', '</p>' );
					} else {
						etude_show_post_comments_link( $etude_template_args, '<p>', '</p>' );
					}
					do_action( 'etude_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $etude_template_args ) ) {
	if ( ! empty( $etude_template_args['slider'] ) || $etude_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
