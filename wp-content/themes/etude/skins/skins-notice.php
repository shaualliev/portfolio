<?php
/**
 * The template to display Admin notices
 *
 * @package ETUDE
 * @since ETUDE 1.0.64
 */

$etude_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$etude_skins_args = get_query_var( 'etude_skins_notice_args' );
?>
<div class="etude_admin_notice etude_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$etude_theme_img = etude_get_file_url( 'screenshot.jpg' );
	if ( '' != $etude_theme_img ) {
		?>
		<div class="etude_notice_image"><img src="<?php echo esc_url( $etude_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'etude' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="etude_notice_title">
		<?php esc_html_e( 'New skins are available', 'etude' ); ?>
	</h3>
	<?php

	// Description
	$etude_total      = $etude_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$etude_skins_msg  = $etude_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $etude_total, 'etude' ), $etude_total ) . '</strong>'
							: '';
	$etude_total      = $etude_skins_args['free'];
	$etude_skins_msg .= $etude_total > 0
							? ( ! empty( $etude_skins_msg ) ? ' ' . esc_html__( 'and', 'etude' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $etude_total, 'etude' ), $etude_total ) . '</strong>'
							: '';
	$etude_total      = $etude_skins_args['pay'];
	$etude_skins_msg .= $etude_skins_args['pay'] > 0
							? ( ! empty( $etude_skins_msg ) ? ' ' . esc_html__( 'and', 'etude' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $etude_total, 'etude' ), $etude_total ) . '</strong>'
							: '';
	?>
	<div class="etude_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'etude' ), $etude_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="etude_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $etude_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'etude' );
			?>
		</a>
	</div>
</div>
