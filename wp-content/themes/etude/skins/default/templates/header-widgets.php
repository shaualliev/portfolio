<?php
/**
 * The template to display the widgets area in the header
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

// Header sidebar
$etude_header_name    = etude_get_theme_option( 'header_widgets' );
$etude_header_present = ! etude_is_off( $etude_header_name ) && is_active_sidebar( $etude_header_name );
if ( $etude_header_present ) {
	etude_storage_set( 'current_sidebar', 'header' );
	$etude_header_wide = etude_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $etude_header_name ) ) {
		dynamic_sidebar( $etude_header_name );
	}
	$etude_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $etude_widgets_output ) ) {
		$etude_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $etude_widgets_output );
		$etude_need_columns   = strpos( $etude_widgets_output, 'columns_wrap' ) === false;
		if ( $etude_need_columns ) {
			$etude_columns = max( 0, (int) etude_get_theme_option( 'header_columns' ) );
			if ( 0 == $etude_columns ) {
				$etude_columns = min( 6, max( 1, etude_tags_count( $etude_widgets_output, 'aside' ) ) );
			}
			if ( $etude_columns > 1 ) {
				$etude_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $etude_columns ) . ' widget', $etude_widgets_output );
			} else {
				$etude_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $etude_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'etude_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $etude_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $etude_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'etude_action_before_sidebar', 'header' );
				etude_show_layout( $etude_widgets_output );
				do_action( 'etude_action_after_sidebar', 'header' );
				if ( $etude_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $etude_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'etude_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
