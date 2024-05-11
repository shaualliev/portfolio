<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package ETUDE
 * @since ETUDE 1.0.10
 */

// Footer sidebar
$etude_footer_name    = etude_get_theme_option( 'footer_widgets' );
$etude_footer_present = ! etude_is_off( $etude_footer_name ) && is_active_sidebar( $etude_footer_name );
if ( $etude_footer_present ) {
	etude_storage_set( 'current_sidebar', 'footer' );
	$etude_footer_wide = etude_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $etude_footer_name ) ) {
		dynamic_sidebar( $etude_footer_name );
	}
	$etude_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $etude_out ) ) {
		$etude_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $etude_out );
		$etude_need_columns = true;   //or check: strpos($etude_out, 'columns_wrap')===false;
		if ( $etude_need_columns ) {
			$etude_columns = max( 0, (int) etude_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $etude_columns ) {
				$etude_columns = min( 4, max( 1, etude_tags_count( $etude_out, 'aside' ) ) );
			}
			if ( $etude_columns > 1 ) {
				$etude_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $etude_columns ) . ' widget', $etude_out );
			} else {
				$etude_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $etude_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'etude_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $etude_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $etude_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'etude_action_before_sidebar', 'footer' );
				etude_show_layout( $etude_out );
				do_action( 'etude_action_after_sidebar', 'footer' );
				if ( $etude_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $etude_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'etude_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
