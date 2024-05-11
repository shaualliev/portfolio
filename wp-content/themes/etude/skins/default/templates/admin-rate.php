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
<div class="etude_admin_notice etude_rate_notice notice notice-info is-dismissible" data-notice="rate">
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
	<h3 class="etude_notice_title"><a href="<?php echo esc_url( etude_storage_get( 'theme_rate_url' ) ); ?>" target="_blank">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Rate our theme "%s", please', 'etude' ),
				$etude_theme_obj->get( 'Name' ) . ( ETUDE_THEME_FREE ? ' ' . __( 'Free', 'etude' ) : '' )
			)
		);
		?>
	</a></h3>
	<?php

	// Description
	?>
	<div class="etude_notice_text">
		<p><?php echo wp_kses_data( __( "We are glad you chose our WP theme for your website. You've done well customizing your website and we hope that you've enjoyed working with our theme.", 'etude' ) ); ?></p>
		<p><?php echo wp_kses_data( __( "It would be just awesome if you spend just a minute of your time to rate our theme or the customer service you've received from us.", 'etude' ) ); ?></p>
		<p class="etude_notice_text_info"><?php echo wp_kses_data( __( '* We love receiving your reviews! Every time you leave a review, our CEO Henry Rise gives $5 to homeless dog shelter! Save the planet with us!', 'etude' ) ); ?></p>
	</div>
	<?php

	// Buttons
	?>
	<div class="etude_notice_buttons">
		<?php
		// Link to the theme download page
		?>
		<a href="<?php echo esc_url( etude_storage_get( 'theme_rate_url' ) ); ?>" class="button button-primary" target="_blank"><i class="dashicons dashicons-star-filled"></i> 
			<?php
			// Translators: Add theme name
			echo esc_html( sprintf( __( 'Rate theme %s', 'etude' ), $etude_theme_obj->name ) );
			?>
		</a>
		<?php
		// Link to the theme support
		?>
		<a href="<?php echo esc_url( etude_storage_get( 'theme_support_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-sos"></i> 
			<?php
			esc_html_e( 'Support', 'etude' );
			?>
		</a>
		<?php
		// Link to the theme documentation
		?>
		<a href="<?php echo esc_url( etude_storage_get( 'theme_doc_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-book"></i> 
			<?php
			esc_html_e( 'Documentation', 'etude' );
			?>
		</a>
	</div>
</div>
