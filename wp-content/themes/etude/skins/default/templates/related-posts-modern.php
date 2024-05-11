<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

$etude_link        = get_permalink();
$etude_post_format = get_post_format();
$etude_post_format = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $etude_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	etude_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'etude_filter_related_thumb_size', etude_get_thumb_size( (int) etude_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses( etude_get_post_categories( '' ), 'etude_kses_content' ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $etude_link ) . '">'
										. wp_kses_data( '' == get_the_title() ? esc_html__( '- No title -', 'etude' ) : get_the_title() )
									. '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $etude_link ) . '" class="post_meta_item post_date">' . wp_kses_data( etude_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
