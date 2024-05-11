<?php
/**
 * The template to display the socials in the footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */


// Socials
if ( etude_is_on( etude_get_theme_option( 'socials_in_footer' ) ) ) {
	$etude_output = etude_get_socials_links();
	if ( '' != $etude_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php etude_show_layout( $etude_output ); ?>
			</div>
		</div>
		<?php
	}
}
