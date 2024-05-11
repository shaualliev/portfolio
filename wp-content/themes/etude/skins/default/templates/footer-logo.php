<?php
/**
 * The template to display the site logo in the footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */

// Logo
if ( etude_is_on( etude_get_theme_option( 'logo_in_footer' ) ) ) {
	$etude_logo_image = etude_get_logo_image( 'footer' );
	$etude_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $etude_logo_image['logo'] ) || ! empty( $etude_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $etude_logo_image['logo'] ) ) {
					$etude_attr = etude_getimagesize( $etude_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $etude_logo_image['logo'] ) . '"'
								. ( ! empty( $etude_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $etude_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'etude' ) . '"'
								. ( ! empty( $etude_attr[3] ) ? ' ' . wp_kses_data( $etude_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $etude_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $etude_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
