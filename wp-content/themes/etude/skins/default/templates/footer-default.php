<?php
/**
 * The template to display default site footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$etude_footer_scheme = etude_get_theme_option( 'footer_scheme' );
if ( ! empty( $etude_footer_scheme ) && ! etude_is_inherit( $etude_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $etude_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
