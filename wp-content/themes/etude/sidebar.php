<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

if ( etude_sidebar_present() ) {
	
	$etude_sidebar_type = etude_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $etude_sidebar_type && ! etude_is_layouts_available() ) {
		$etude_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $etude_sidebar_type ) {
		// Default sidebar with widgets
		$etude_sidebar_name = etude_get_theme_option( 'sidebar_widgets' );
		etude_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $etude_sidebar_name ) ) {
			dynamic_sidebar( $etude_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$etude_sidebar_id = etude_get_custom_sidebar_id();
		do_action( 'etude_action_show_layout', $etude_sidebar_id );
	}
	$etude_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $etude_out ) ) {
		$etude_sidebar_position    = etude_get_theme_option( 'sidebar_position' );
		$etude_sidebar_position_ss = etude_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $etude_sidebar_position );
			echo ' sidebar_' . esc_attr( $etude_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $etude_sidebar_type );

			$etude_sidebar_scheme = apply_filters( 'etude_filter_sidebar_scheme', etude_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $etude_sidebar_scheme ) && ! etude_is_inherit( $etude_sidebar_scheme ) && 'custom' != $etude_sidebar_type ) {
				echo ' scheme_' . esc_attr( $etude_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="etude_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'etude_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $etude_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$etude_title = apply_filters( 'etude_filter_sidebar_control_title', 'float' == $etude_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'etude' ) : '' );
				$etude_text  = apply_filters( 'etude_filter_sidebar_control_text', 'above' == $etude_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'etude' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $etude_title ); ?>"><?php echo esc_html( $etude_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'etude_action_before_sidebar', 'sidebar' );
				etude_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $etude_out ) );
				do_action( 'etude_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'etude_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
