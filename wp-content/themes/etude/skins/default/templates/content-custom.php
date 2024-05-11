<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package ETUDE
 * @since ETUDE 1.0.50
 */

$etude_template_args = get_query_var( 'etude_template_args' );
if ( is_array( $etude_template_args ) ) {
	$etude_columns    = empty( $etude_template_args['columns'] ) ? 2 : max( 1, $etude_template_args['columns'] );
	$etude_blog_style = array( $etude_template_args['type'], $etude_columns );
} else {
	$etude_template_args = array();
	$etude_blog_style = explode( '_', etude_get_theme_option( 'blog_style' ) );
	$etude_columns    = empty( $etude_blog_style[1] ) ? 2 : max( 1, $etude_blog_style[1] );
}
$etude_blog_id       = etude_get_custom_blog_id( join( '_', $etude_blog_style ) );
$etude_blog_style[0] = str_replace( 'blog-custom-', '', $etude_blog_style[0] );
$etude_expanded      = ! etude_sidebar_present() && etude_get_theme_option( 'expand_content' ) == 'expand';
$etude_components    = ! empty( $etude_template_args['meta_parts'] )
							? ( is_array( $etude_template_args['meta_parts'] )
								? join( ',', $etude_template_args['meta_parts'] )
								: $etude_template_args['meta_parts']
								)
							: etude_array_get_keys_by_value( etude_get_theme_option( 'meta_parts' ) );
$etude_post_format   = get_post_format();
$etude_post_format   = empty( $etude_post_format ) ? 'standard' : str_replace( 'post-format-', '', $etude_post_format );

$etude_blog_meta     = etude_get_custom_layout_meta( $etude_blog_id );
$etude_custom_style  = ! empty( $etude_blog_meta['scripts_required'] ) ? $etude_blog_meta['scripts_required'] : 'none';

if ( ! empty( $etude_template_args['slider'] ) || $etude_columns > 1 || ! etude_is_off( $etude_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $etude_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( etude_is_off( $etude_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $etude_custom_style ) ) . "-1_{$etude_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $etude_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $etude_columns )
					. ' post_layout_' . esc_attr( $etude_blog_style[0] )
					. ' post_layout_' . esc_attr( $etude_blog_style[0] ) . '_' . esc_attr( $etude_columns )
					. ( ! etude_is_off( $etude_custom_style )
						? ' post_layout_' . esc_attr( $etude_custom_style )
							. ' post_layout_' . esc_attr( $etude_custom_style ) . '_' . esc_attr( $etude_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'etude_action_show_layout', $etude_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $etude_template_args['slider'] ) || $etude_columns > 1 || ! etude_is_off( $etude_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
