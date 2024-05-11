<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package ETUDE
 * @since ETUDE 1.0
 */

// Page (category, tag, archive, author) title

if ( etude_need_page_title() ) {
	etude_sc_layouts_showed( 'title', true );
	etude_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								etude_show_post_meta(
									apply_filters(
										'etude_filter_post_meta_args', array(
											'components' => join( ',', etude_array_get_keys_by_value( etude_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', etude_array_get_keys_by_value( etude_get_theme_option( 'counters' ) ) ),
											'seo'        => etude_is_on( etude_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$etude_blog_title           = etude_get_blog_title();
							$etude_blog_title_text      = '';
							$etude_blog_title_class     = '';
							$etude_blog_title_link      = '';
							$etude_blog_title_link_text = '';
							if ( is_array( $etude_blog_title ) ) {
								$etude_blog_title_text      = $etude_blog_title['text'];
								$etude_blog_title_class     = ! empty( $etude_blog_title['class'] ) ? ' ' . $etude_blog_title['class'] : '';
								$etude_blog_title_link      = ! empty( $etude_blog_title['link'] ) ? $etude_blog_title['link'] : '';
								$etude_blog_title_link_text = ! empty( $etude_blog_title['link_text'] ) ? $etude_blog_title['link_text'] : '';
							} else {
								$etude_blog_title_text = $etude_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $etude_blog_title_class ); ?>">
								<?php
								$etude_top_icon = etude_get_term_image_small();
								if ( ! empty( $etude_top_icon ) ) {
									$etude_attr = etude_getimagesize( $etude_top_icon );
									?>
									<img src="<?php echo esc_url( $etude_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'etude' ); ?>"
										<?php
										if ( ! empty( $etude_attr[3] ) ) {
											etude_show_layout( $etude_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $etude_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $etude_blog_title_link ) && ! empty( $etude_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $etude_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $etude_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'etude_action_breadcrumbs' );
						$etude_breadcrumbs = ob_get_contents();
						ob_end_clean();
						etude_show_layout( $etude_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
