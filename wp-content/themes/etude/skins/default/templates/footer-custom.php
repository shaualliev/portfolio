<?php
/**
 * The template to display default site footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */

$etude_footer_id = etude_get_custom_footer_id();
$etude_footer_meta = get_post_meta( $etude_footer_id, 'trx_addons_options', true );
if ( ! empty( $etude_footer_meta['margin'] ) ) {
	etude_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( etude_prepare_css_value( $etude_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $etude_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $etude_footer_id ) ) ); ?>
						<?php
						$etude_footer_scheme = etude_get_theme_option( 'footer_scheme' );
						if ( ! empty( $etude_footer_scheme ) && ! etude_is_inherit( $etude_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $etude_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'etude_action_show_layout', $etude_footer_id );
	?>
</footer><!-- /.footer_wrap -->
