<div class="front_page_section front_page_section_subscribe<?php
	$etude_scheme = etude_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! empty( $etude_scheme ) && ! etude_is_inherit( $etude_scheme ) ) {
		echo ' scheme_' . esc_attr( $etude_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( etude_get_theme_option( 'front_page_subscribe_paddings' ) );
	if ( etude_get_theme_option( 'front_page_subscribe_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$etude_css      = '';
		$etude_bg_image = etude_get_theme_option( 'front_page_subscribe_bg_image' );
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
	$etude_anchor_icon = etude_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$etude_anchor_text = etude_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $etude_anchor_icon ) || ! empty( $etude_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $etude_anchor_icon ) ? ' icon="' . esc_attr( $etude_anchor_icon ) . '"' : '' )
									. ( ! empty( $etude_anchor_text ) ? ' title="' . esc_attr( $etude_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( etude_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' etude-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$etude_css      = '';
			$etude_bg_mask  = etude_get_theme_option( 'front_page_subscribe_bg_mask' );
			$etude_bg_color_type = etude_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $etude_bg_color_type ) {
				$etude_bg_color = etude_get_theme_option( 'front_page_subscribe_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$etude_caption = etude_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $etude_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $etude_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $etude_caption, 'etude_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$etude_description = etude_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $etude_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $etude_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $etude_description ), 'etude_kses_content' ); ?></div>
				<?php
			}

			// Content
			$etude_sc = etude_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $etude_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $etude_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					etude_show_layout( do_shortcode( $etude_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
