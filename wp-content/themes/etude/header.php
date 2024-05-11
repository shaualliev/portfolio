<?php
/**
 * The Header: Logo and main menu
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( etude_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'etude_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'etude_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('etude_action_body_wrap_attributes'); ?>>

		<?php do_action( 'etude_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'etude_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('etude_action_page_wrap_attributes'); ?>>

			<?php do_action( 'etude_action_page_wrap_start' ); ?>

			<?php
			$etude_full_post_loading = ( etude_is_singular( 'post' ) || etude_is_singular( 'attachment' ) ) && etude_get_value_gp( 'action' ) == 'full_post_loading';
			$etude_prev_post_loading = ( etude_is_singular( 'post' ) || etude_is_singular( 'attachment' ) ) && etude_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $etude_full_post_loading && ! $etude_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="etude_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'etude_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'etude' ); ?></a>
				<?php if ( etude_sidebar_present() ) { ?>
				<a class="etude_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'etude_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'etude' ); ?></a>
				<?php } ?>
				<a class="etude_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'etude_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'etude' ); ?></a>

				<?php
				do_action( 'etude_action_before_header' );

				// Header
				$etude_header_type = etude_get_theme_option( 'header_type' );
				if ( 'custom' == $etude_header_type && ! etude_is_layouts_available() ) {
					$etude_header_type = 'default';
				}
				get_template_part( apply_filters( 'etude_filter_get_template_part', "templates/header-" . sanitize_file_name( $etude_header_type ) ) );

				// Side menu
				if ( in_array( etude_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'etude_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'etude_action_after_header' );

			}
			?>

			<?php do_action( 'etude_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( etude_is_off( etude_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $etude_header_type ) ) {
						$etude_header_type = etude_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $etude_header_type && etude_is_layouts_available() ) {
						$etude_header_id = etude_get_custom_header_id();
						if ( $etude_header_id > 0 ) {
							$etude_header_meta = etude_get_custom_layout_meta( $etude_header_id );
							if ( ! empty( $etude_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$etude_footer_type = etude_get_theme_option( 'footer_type' );
					if ( 'custom' == $etude_footer_type && etude_is_layouts_available() ) {
						$etude_footer_id = etude_get_custom_footer_id();
						if ( $etude_footer_id ) {
							$etude_footer_meta = etude_get_custom_layout_meta( $etude_footer_id );
							if ( ! empty( $etude_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'etude_action_page_content_wrap_class', $etude_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'etude_filter_is_prev_post_loading', $etude_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( etude_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'etude_action_page_content_wrap_data', $etude_prev_post_loading );
			?>>
				<?php
				do_action( 'etude_action_page_content_wrap', $etude_full_post_loading || $etude_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'etude_filter_single_post_header', etude_is_singular( 'post' ) || etude_is_singular( 'attachment' ) ) ) {
					if ( $etude_prev_post_loading ) {
						if ( etude_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'etude_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$etude_path = apply_filters( 'etude_filter_get_template_part', 'templates/single-styles/' . etude_get_theme_option( 'single_style' ) );
					if ( etude_get_file_dir( $etude_path . '.php' ) != '' ) {
						get_template_part( $etude_path );
					}
				}

				// Widgets area above page
				$etude_body_style   = etude_get_theme_option( 'body_style' );
				$etude_widgets_name = etude_get_theme_option( 'widgets_above_page' );
				$etude_show_widgets = ! etude_is_off( $etude_widgets_name ) && is_active_sidebar( $etude_widgets_name );
				if ( $etude_show_widgets ) {
					if ( 'fullscreen' != $etude_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					etude_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $etude_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'etude_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $etude_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'etude_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'etude_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="etude_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( etude_is_singular( 'post' ) || etude_is_singular( 'attachment' ) )
							&& $etude_prev_post_loading 
							&& etude_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'etude_action_between_posts' );
						}

						// Widgets area above content
						etude_create_widgets_area( 'widgets_above_content' );

						do_action( 'etude_action_page_content_start_text' );
