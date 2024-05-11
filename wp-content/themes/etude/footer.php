<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

							do_action( 'etude_action_page_content_end_text' );
							
							// Widgets area below the content
							etude_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'etude_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'etude_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'etude_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'etude_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$etude_body_style = etude_get_theme_option( 'body_style' );
					$etude_widgets_name = etude_get_theme_option( 'widgets_below_page' );
					$etude_show_widgets = ! etude_is_off( $etude_widgets_name ) && is_active_sidebar( $etude_widgets_name );
					$etude_show_related = etude_is_single() && etude_get_theme_option( 'related_position' ) == 'below_page';
					if ( $etude_show_widgets || $etude_show_related ) {
						if ( 'fullscreen' != $etude_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $etude_show_related ) {
							do_action( 'etude_action_related_posts' );
						}

						// Widgets area below page content
						if ( $etude_show_widgets ) {
							etude_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $etude_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'etude_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'etude_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! etude_is_singular( 'post' ) && ! etude_is_singular( 'attachment' ) ) || ! in_array ( etude_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="etude_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'etude_action_before_footer' );

				// Footer
				$etude_footer_type = etude_get_theme_option( 'footer_type' );
				if ( 'custom' == $etude_footer_type && ! etude_is_layouts_available() ) {
					$etude_footer_type = 'default';
				}
				get_template_part( apply_filters( 'etude_filter_get_template_part', "templates/footer-" . sanitize_file_name( $etude_footer_type ) ) );

				do_action( 'etude_action_after_footer' );

			}
			?>

			<?php do_action( 'etude_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'etude_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'etude_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>