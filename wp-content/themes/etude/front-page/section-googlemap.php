<div class="front_page_section front_page_section_googlemap<?php
	$etude_scheme = etude_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $etude_scheme ) && ! etude_is_inherit( $etude_scheme ) ) {
		echo ' scheme_' . esc_attr( $etude_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( etude_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( etude_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$etude_css      = '';
		$etude_bg_image = etude_get_theme_option( 'front_page_googlemap_bg_image' );
		if ( ! empty( $etude_bg_image ) ) {
			$etude_css .= 'background-image: url(' . esc_url( etude_get_attachment_url( $etude_bg_image ) ) . ');';
		}
		if ( ! empty( $etude_css ) ) {
			echo ' style="' . esc_attr( $etude_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$etude_anchor_icon = etude_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$etude_anchor_text = etude_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $etude_anchor_icon ) || ! empty( $etude_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $etude_anchor_icon ) ? ' icon="' . esc_attr( $etude_anchor_icon ) . '"' : '' )
									. ( ! empty( $etude_anchor_text ) ? ' title="' . esc_attr( $etude_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$etude_layout = etude_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $etude_layout );
		if ( etude_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' etude-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$etude_css      = '';
			$etude_bg_mask  = etude_get_theme_option( 'front_page_googlemap_bg_mask' );
			$etude_bg_color_type = etude_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $etude_bg_color_type ) {
				$etude_bg_color = etude_get_theme_option( 'front_page_googlemap_bg_color' );
			} elseif ( 'scheme_bg_color' == $etude_bg_color_type ) {
				$etude_bg_color = etude_get_scheme_color( 'bg_color', $etude_scheme );
			} else {
				$etude_bg_color = '';
			}
			if ( ! empty( $etude_bg_color ) && $etude_bg_mask > 0 ) {
				$etude_css .= 'background-color: ' . esc_attr(
					1 == $etude_bg_mask ? $etude_bg_color : etude_hex2rgba( $etude_bg_color, $etude_bg_mask )
				) . ';';
			}
			if ( ! empty( $etude_css ) ) {
				echo ' style="' . esc_attr( $etude_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $etude_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$etude_caption     = etude_get_theme_option( 'front_page_googlemap_caption' );
			$etude_description = etude_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $etude_caption ) || ! empty( $etude_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $etude_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $etude_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $etude_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $etude_caption, 'etude_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $etude_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $etude_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $etude_description ), 'etude_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $etude_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$etude_content = etude_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $etude_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $etude_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $etude_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $etude_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $etude_content, 'etude_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $etude_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $etude_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! etude_exists_trx_addons() ) {
						etude_customizer_need_trx_addons_message();
					} else {
						etude_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $etude_layout && ( ! empty( $etude_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
