<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package ETUDE
 * @since ETUDE 1.71.0
 */

$etude_template_args = get_query_var( 'etude_template_args' );
if ( ! is_array( $etude_template_args ) ) {
	$etude_template_args = array(
								'type'    => 'band',
								'columns' => 1
								);
}

$etude_columns       = 1;

$etude_expanded      = ! etude_sidebar_present() && etude_get_theme_option( 'expand_content' ) == 'expand';

$etude_post_format   = get_post_format();
$etude_post_format   = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );

if ( is_array( $etude_template_args ) ) {
	$etude_columns    = empty( $etude_template_args['columns'] ) ? 1 : max( 1, $etude_template_args['columns'] );
	$etude_blog_style = array( $etude_template_args['type'], $etude_columns );
	if ( ! empty( $etude_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $etude_columns > 1 ) {
	    $etude_columns_class = etude_get_column_class( 1, $etude_columns, ! empty( $etude_template_args['columns_tablet']) ? $etude_template_args['columns_tablet'] : '', ! empty($etude_template_args['columns_mobile']) ? $etude_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $etude_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $etude_post_format ) );
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
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $etude_template_args['thumb_size'] )
								? $etude_template_args['thumb_size']
								: etude_get_thumb_size( 
								in_array( $etude_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( etude_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $etude_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$etude_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$etude_show_title = get_the_title() != '';
		$etude_show_meta  = count( $etude_components ) > 0 && ! in_array( $etude_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $etude_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'etude_filter_show_blog_categories', $etude_show_meta && in_array( 'categories', $etude_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'etude_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						etude_show_post_meta( apply_filters(
															'etude_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $etude_hover, 1
															)
											);
						?>
					</div>
					<?php
					$etude_components = etude_array_delete_by_value( $etude_components, 'categories' );
					do_action( 'etude_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'etude_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'etude_action_before_post_title' );
					if ( empty( $etude_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'etude_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $etude_template_args['excerpt_length'] ) && ! in_array( $etude_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$etude_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'etude_filter_show_blog_excerpt', empty( $etude_template_args['hide_excerpt'] ) && etude_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				etude_show_post_content( $etude_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'etude_filter_show_blog_meta', $etude_show_meta, $etude_components, 'band' ) ) {
			if ( count( $etude_components ) > 0 ) {
				do_action( 'etude_action_before_post_meta' );
				etude_show_post_meta(
					apply_filters(
						'etude_filter_post_meta_args', array(
							'components' => join( ',', $etude_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'etude_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'etude_filter_show_blog_readmore', ! $etude_show_title || ! empty( $etude_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $etude_template_args['no_links'] ) ) {
				do_action( 'etude_action_before_post_readmore' );
				etude_show_post_more_link( $etude_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'etude_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $etude_template_args ) ) {
	if ( ! empty( $etude_template_args['slider'] ) || $etude_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
