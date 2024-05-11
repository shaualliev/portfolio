<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$etude_copyright_scheme = etude_get_theme_option( 'copyright_scheme' );
if ( ! empty( $etude_copyright_scheme ) && ! etude_is_inherit( $etude_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $etude_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$etude_copyright = etude_get_theme_option( 'copyright' );
			if ( ! empty( $etude_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$etude_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $etude_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$etude_copyright = etude_prepare_macros( $etude_copyright );
				// Display copyright
				echo wp_kses( nl2br( $etude_copyright ), 'etude_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
