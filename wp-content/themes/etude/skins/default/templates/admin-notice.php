<?php
/**
 * The template to display Admin notices
 *
 * @package ETUDE
 * @since ETUDE 1.0.1
 */

$etude_theme_slug = get_option( 'template' );
$etude_theme_obj  = wp_get_theme( $etude_theme_slug );
?>
<div class="etude_admin_notice etude_welcome_notice notice notice-info is-dismissible" data-notice="admin">
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
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'etude' ),
				$etude_theme_obj->get( 'Name' ) . ( ETUDE_THEME_FREE ? ' ' . __( 'Free', 'etude' ) : '' ),
				$etude_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="etude_notice_text">
		<p class="etude_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $etude_theme_obj->description ) );
			?>
		</p>
		<p class="etude_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'etude' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="etude_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=etude_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'etude' );
			?>
		</a>
	</div>
</div>
