<?php
/**
 * Upgrade theme to the PRO version
 *
 * @package ETUDE
 * @since ETUDE 1.0.41
 */


// Add buttons, tabs and form to the 'Theme panel' screen
//--------------------------------------------------------------------

if ( ! function_exists( 'etude_pro_add_section_to_about' ) ) {
	add_action( 'trx_addons_action_theme_panel_section_end', 'etude_pro_add_section_to_about', 10, 2 );
	/**
	 * Add a table 'Free vs PRO' to the section 'General' of the 'Theme panel'
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'trx_addons_action_theme_panel_section_end', 'etude_pro_add_section_to_about', 10, 2 );
	 *
	 * @param string $tab_id     A current tab ID of 'Theme panel'
	 * @param array $theme_info  A current theme info.
	 */
	function etude_pro_add_section_to_about( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id || ! ETUDE_THEME_FREE ) {
			return;
		}
		?>
		<div class="etude_theme_panel_table_free_vs_pro">
			<div class="etude_theme_panel_table_row etude_theme_panel_table_head">
				<div class="etude_theme_panel_table_info">
					&nbsp;
				</div>
				<div class="etude_theme_panel_table_check">
					<?php esc_html_e( 'Free version', 'etude' ); ?>
				</div>
				<div class="etude_theme_panel_table_check">
					<?php esc_html_e( 'PRO version', 'etude' ); ?>
				</div>
			</div>
			<div class="etude_theme_panel_table_row">
				<div class="etude_theme_panel_table_info">
					<h2 class="etude_theme_panel_table_info_title">
						<?php esc_html_e( 'Mobile friendly', 'etude' ); ?>
					</h2>
					<div class="etude_theme_panel_table_info_description">
						<?php esc_html_e( 'Responsive layout. Looks great on any device.', 'etude' ); ?>
					</div>
				</div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<div class="etude_theme_panel_table_row">
				<div class="etude_theme_panel_table_info">
					<h2 class="etude_theme_panel_table_info_title">
						<?php esc_html_e( 'Built-in posts slider', 'etude' ); ?>
					</h2>
					<div class="etude_theme_panel_table_info_description">
						<?php esc_html_e( 'Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'etude' ); ?>
					</div>
				</div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<?php
			// Revolution slider
			if ( isset( $theme_info['theme_plugins']['revslider'] ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'Revolution Slider Compatibility', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['elementor'] ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'Elementor (free PageBuilder)', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'Full integration with a powerful page builder "Elementor".', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['js_composer'] ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'WPBakery PageBuilder', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'Full integration with a very popular page builder "WPBakery PageBuilder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'Additional shortcodes pack', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery PageBuilder.', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			?>
			<div class="etude_theme_panel_table_row">
				<div class="etude_theme_panel_table_info">
					<h2 class="etude_theme_panel_table_info_title">
						<?php esc_html_e( 'Headers and Footers builder', 'etude' ); ?>
					</h2>
					<div class="etude_theme_panel_table_info_description">
						<?php esc_html_e( 'Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'etude' ); ?>
					</div>
				</div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<?php
			if ( isset( $theme_info['theme_plugins']['woocommerce'] ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'WooCommerce Compatibility', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'Ready for e-commerce. You can build an online store with this theme.', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			if ( isset( $theme_info['theme_plugins']['easy-digital-downloads'] ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">
						<h2 class="etude_theme_panel_table_info_title">
							<?php esc_html_e( 'Easy Digital Downloads Compatibility', 'etude' ); ?>
						</h2>
						<div class="etude_theme_panel_table_info_description">
							<?php esc_html_e( 'Ready for digital e-commerce. You can build an online digital store with this theme.', 'etude' ); ?>
						</div>
					</div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
					<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
				</div>
				<?php
			}
			?>
			<div class="etude_theme_panel_table_row">
				<div class="etude_theme_panel_table_info">
					<h2 class="etude_theme_panel_table_info_title">
						<?php esc_html_e( 'Many other popular plugins compatibility', 'etude' ); ?>
					</h2>
					<div class="etude_theme_panel_table_info_description">
						<?php esc_html_e( 'PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'etude' ); ?>
					</div>
				</div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<div class="etude_theme_panel_table_row">
				<div class="etude_theme_panel_table_info">
					<h2 class="etude_theme_panel_table_info_title">
						<?php esc_html_e( 'Support', 'etude' ); ?>
					</h2>
					<div class="etude_theme_panel_table_info_description">
						<?php esc_html_e( 'Our premium support is going to take care of any problems, in case there will be any of course.', 'etude' ); ?>
					</div>
				</div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-no"></i></div>
				<div class="etude_theme_panel_table_check"><i class="dashicons dashicons-yes"></i></div>
			</div>
			<?php
			if ( current_user_can( 'manage_options' ) ) {
				?>
				<div class="etude_theme_panel_table_row">
					<div class="etude_theme_panel_table_info">&nbsp;</div>
					<div class="etude_theme_panel_table_check">
						<a href="#" target="_blank" class="trx_addons_classic_block_link trx_addons_pro_link button button-action">
							<?php esc_html_e( 'Get PRO version', 'etude' ); ?>
						</a>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'etude_pro_add_button' ) ) {
	remove_action('trx_addons_action_theme_panel_activation_form', 'trx_addons_theme_panel_activation_form');
	add_action( 'trx_addons_action_theme_panel_activation_form', 'etude_pro_add_button', 10, 2 );
	/**
	 * Add the button 'Get PRO Version' to the 'About theme' screen
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'trx_addons_action_theme_panel_activation_form', 'etude_pro_add_button', 10, 2 );
	 *
	 * @param string $tab_id     A current tab ID of 'Theme panel'
	 * @param array $theme_info  A current theme info.
	 */
	function etude_pro_add_button( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id || ! current_user_can( 'manage_options' ) || ! ETUDE_THEME_FREE ) {
			return;
		}
		?>
		<a href="#" class="etude_pro_link button button-action"><?php esc_html_e( 'Get PRO version', 'etude' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'etude_pro_add_form' ) ) {
	add_action( 'trx_addons_action_theme_panel_activation_form', 'etude_pro_add_form', 12, 2 );
	/**
	 * Display an upgrade form on the tab 'General' of the 'Theme panel'
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'trx_addons_action_theme_panel_activation_form', 'etude_pro_add_form', 12, 2 );
	 *
	 * @param string $tab_id     A current tab ID of 'Theme panel'
	 * @param array $theme_info  A current theme info.
	 */
	function etude_pro_add_form( $tab_id, $theme_info ) {
		if ( 'general' !== $tab_id || ! current_user_can( 'manage_options' ) || ! ETUDE_THEME_FREE ) {
			return;
		}
		?>
		<div class="etude_pro_form_wrap">
			<div class="etude_pro_form">
				<span class="etude_pro_close"><?php esc_html_e( 'Close', 'etude' ); ?></span>
				<h2 class="etude_pro_title">
				<?php
					echo esc_html(
						sprintf(
							// Translators: Add theme name and version to the 'Upgrade to PRO' message
							__( 'Upgrade %1$s Free v.%2$s to PRO', 'etude' ),
							$theme_info['theme_name'],
							$theme_info['theme_version']
						)
					);
				?>
				</h2>
				<div class="etude_pro_fields">
					<div class="etude_pro_field etude_pro_step1">
						<h3 class="etude_pro_step_title">
							<?php esc_html_e( 'Step 1:', 'etude' ); ?>
							<a href="<?php echo esc_url( etude_storage_get( 'theme_download_url' ) ); ?>" target="_blank" class="etude_pro_link_get">
												<?php
												esc_html_e( 'Get a License Key', 'etude' );
												?>
							</a>
						</h3>
						<label><input type="text" class="etude_pro_key" value="" placeholder="<?php esc_attr_e( 'Paste License Key here', 'etude' ); ?>"></label>
					</div>
					<?php
					if ( substr( etude_get_theme_pro_key(), 0, 3 ) == 'env' ) {
						?>
						<div class="etude_pro_field etude_pro_step2">
							<h3 class="etude_pro_step_title">
								<?php esc_html_e( 'Step 2:', 'etude' ); ?>
								<a href="<?php echo esc_url( etude_storage_get( 'upgrade_token_url' ) ); ?>" target="_blank" class="etude_pro_link_get">
													<?php
													esc_html_e( 'Generate an Envato API Personal Token', 'etude' );
													?>
								</a>
							</h3>
							<label><input type="text" class="etude_pro_token" value="" placeholder="<?php esc_attr_e( 'Paste Personal Token here', 'etude' ); ?>"></label>
						</div>
						<?php
					}
					?>
					<div class="etude_pro_field etude_pro_step3">
						<h3 class="etude_pro_step_title"><?php printf( esc_html__( 'Step %d: Upgrade to PRO Version', 'etude' ), substr( etude_get_theme_pro_key(), 0, 3 ) == 'env' ? 3 : 2); ?></h3>
						<a href="#" class="button button-action etude_pro_upgrade" disabled="disabled">
						<?php
							esc_html_e( 'Upgrade to PRO', 'etude' );
						?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'etude_pro_add_messages' ) ) {
	add_filter( 'etude_filter_localize_script_admin', 'etude_pro_add_messages' );
	/**
	 * Add messages to the admin script for both 'About' screen and Customizer
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_filter( 'etude_filter_localize_script_admin', 'etude_pro_add_messages' );
	 *
	 * @param array $vars  A localization variables to use in the JS code
	 *
	 * @return array       An array with new messages.
	 */
	function etude_pro_add_messages( $vars ) {
		$vars['msg_get_pro_error']    = esc_html__( 'Error getting data from the update server!', 'etude' );
		$vars['msg_get_pro_upgrader'] = esc_html__( 'Upgrade details:', 'etude' );
		$vars['msg_get_pro_success']  = esc_html__( 'Theme upgraded successfully! Now you have the PRO version!', 'etude' );
		return $vars;
	}
}


// Create a control for 'Theme Options'
//--------------------------------------------------------------------

if ( ! function_exists( 'etude_pro_get_custom_field' ) ) {
	add_filter( 'etude_filter_get_custom_field', 'etude_pro_get_custom_field', 10, 5 );
	/**
	 * Create a control with an upgrade form for 'Theme Options'
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_filter( 'etude_filter_get_custom_field', 'etude_pro_get_custom_field', 10, 5 );
	 *
	 * @param string $output       A layout of the current field layout. Replace it with a form if a field name is 'get_pro_version'.
	 * @param string $name         A name of the current field.
	 * @param array $field         An array with a field parameters.
	 * @param bool $inherit_allow  If true - add to the layout a 'inherit' mask
	 * @param bool $inherit_state  If true - a value of the current field is 'inherit'
	 *
	 * @return string              A new layout of the field
	 */
	function etude_pro_get_custom_field( $output, $name, $field, $inherit_allow, $inherit_state ) {
		if ( ETUDE_THEME_FREE && 'get_pro_version' == $field['type'] ) {
			ob_start();
			$theme_slug  = get_template();
			$theme       = wp_get_theme( $theme_slug );
			etude_pro_add_form( 'general', array(
				'theme_name'    => $theme->get( 'Name' ),
				'theme_version' => $theme->get( 'Version' ),
				)
			);
			$output .= ob_get_contents();
			ob_end_clean();
		}
		return $output;
	}
}


// Create control for Customizer
//--------------------------------------------------------------------

if ( ! function_exists( 'etude_pro_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'etude_pro_theme_setup3', 3 );
	/**
	 * Add a new section to the Theme options with a control 'Get PRO version'
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'after_setup_theme', 'etude_pro_theme_setup3', 3 ); // 3 - add/remove Theme Options elements
	 */
	function etude_pro_theme_setup3() {

		if ( ! ETUDE_THEME_FREE ) {
			return;
		}

		// Add section "Get PRO Version" if current theme is free
		// ------------------------------------------------------
		etude_storage_set_array_before(
			'options', 'title_tagline', array(
				'pro_section' => array(
					'title'    => esc_html__( 'Get PRO Version', 'etude' ),
					'desc'     => '',
					'priority' => 5,
					'type'     => 'section',
				),
				'pro_version' => array(
					'title'   => esc_html__( 'Upgrade to the PRO Version', 'etude' ),
					'desc'    => wp_kses_data( __( 'Get the PRO License Key and paste it to the field below to upgrade current theme to the PRO Version', 'etude' ) ),
					'std'     => '',
					'refresh' => false,
					'type'    => 'get_pro_version',
				),
			)
		);
	}
}

if ( ! function_exists( 'etude_pro_customizer_custom_controls' ) ) {
	add_action( 'customize_register', 'etude_pro_customizer_custom_controls' );
	/**
	 * Define a custom control class for the Customizer
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'customize_register', 'etude_pro_customizer_custom_controls' );
	 *
	 * @param object $wp_customize  An object with instance of the class WP_Customize
	 */
	function etude_pro_customizer_custom_controls( $wp_customize ) {
		class Etude_Customize_Get_Pro_Version_Control extends Etude_Customize_Theme_Control {
			public $type = 'get_pro_version';

			public function render_content() {
				$this->start_render_field();
				$this->render_field_title();
				$this->render_field_description();
				?>
				<span class="customize-control-field-wrap">
					<?php
					$theme_slug  = get_template();
					$theme       = wp_get_theme( $theme_slug );
					etude_pro_add_form( 'general', array(
						'theme_name'    => $theme->get( 'Name' ),
						'theme_version' => $theme->get( 'Version' ),
						)
					);
					?>
				</span>
				<?php
				$this->end_render_field();
			}
		}
	}
}

if ( ! function_exists( 'etude_pro_customizer_register_controls' ) ) {
	add_filter( 'etude_filter_register_customizer_control', 'etude_pro_customizer_register_controls', 10, 7 );
	/**
	 * Register a custom control for the Customizer
	 * if a current theme is free (with limited functionality).
	 *
	 * @param bool $result          Operation success flag
	 * @param object $wp_customize  An object with instance of the class WP_Customize
	 * @param string $id            A control ID
	 * @param string $section       A slug of the current section.
	 * @param int $priority         Priority of the control.
	 * @param string $transport     A transport type.
	 * @param array $opt            An array with additional options for the control.
	 *
	 * @return bool                 true if a field created successfull.
	 */
	function etude_pro_customizer_register_controls( $result, $wp_customize, $id, $section, $priority, $transport, $opt ) {

		if ( 'get_pro_version' == $opt['type'] ) {
			$wp_customize->add_setting(
				$id, array(
					'default'           => etude_get_theme_option( $id ),
					'sanitize_callback' => ! empty( $opt['sanitize'] )
												? $opt['sanitize']
												: 'wp_kses_post',
					'transport'         => $transport,
				)
			);

			$args = array(
						'label'           => $opt['title'],
						'description'     => $opt['desc'],
						'section'         => esc_attr( $section ),
						'priority'        => $priority,
						'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
					);

			$wp_customize->add_control( new Etude_Customize_Get_Pro_Version_Control( $wp_customize, $id, $args ) );

			$result = true;
		}

		return $result;
	}
}



// Upgrade a free theme
//--------------------------------------------------------------------

if ( ! function_exists( 'etude_pro_get_pro_version_callback' ) ) {
	add_action( 'wp_ajax_etude_get_pro_version', 'etude_pro_get_pro_version_callback' );
	/**
	 * Validate a key and get a PRO version of the theme
	 * if a current theme is free (with limited functionality).
	 *
	 * Hooks: add_action( 'wp_ajax_etude_get_pro_version', 'etude_pro_get_pro_version_callback' );
	 */
	function etude_pro_get_pro_version_callback() {

		etude_verify_nonce();

		if ( ! current_user_can( 'manage_options' ) ) {
			etude_forbidden( esc_html__( 'Sorry, you are not allowed to manage options.', 'etude' ) );
		}

		$response    = array(
			'error' => '',
			'data'  => '',
		);

		$theme_slug  = get_template();
		$key         = etude_get_value_gp( 'license_key' );
		$token       = etude_get_value_gp( 'access_token' );

		if ( ! empty( $key ) ) {
			$result = etude_get_upgrade_data( array(
				'action'   => 'upgrade',
				'key'      => $key,
				'token'    => $token,
			) );
			if ( substr( $result['data'], 0, 2 ) == 'PK' ) {
				etude_allow_upload_archives();
				$tmp_name = 'tmp-' . rand() . '.zip';
				$tmp      = wp_upload_bits( $tmp_name, null, $result['data'] );
				etude_disallow_upload_archives();
				if ( $tmp['error'] ) {
					$response['error'] = esc_html__( 'Problem with save upgrade file to the folder with uploads', 'etude' );
				} else {
					if ( file_exists( $tmp['file'] ) ) {
						ob_start();
						// Upgrade theme
						$response['error'] .= etude_pro_upgrade_theme( $theme_slug, $tmp['file'] );
						// Remove uploaded archive
						unlink( $tmp['file'] );
						// Upgrade plugin
						$plugin      = 'trx_addons';
						$plugin_path = etude_get_file_dir( "plugins/{$plugin}/{$plugin}.zip" );
						if ( ! empty( $plugin_path ) ) {
							$response['error'] .= etude_pro_upgrade_plugin( $plugin, $plugin_path );
						}
						$log = ob_get_contents();
						ob_end_clean();
						// Mark theme as activated
						etude_set_theme_activated( $key, $token );
					} else {
						$response['error'] = esc_html__( 'Uploaded file with upgrade package is not available', 'etude' );
					}
				}
			} else {
				$response['error'] = ! empty( $result['error'] )
												? $result['error']
												: esc_html__( 'Package with upgrade is corrupt', 'etude' );
			}
		} else {
			$response['error'] = esc_html__( 'Entered key is not valid!', 'etude' );
		}

		etude_ajax_response( $response );
	}
}

if ( ! function_exists( 'etude_set_theme_activated' ) ) {
	/**
	 * Set a status 'theme activated' for the current theme after upgrade.
	 *
	 * @param string $code   A purchase code of the theme
	 * @param string $token  An access token if the theme loaded from Elements.
	 */
	function etude_set_theme_activated( $code='', $token='' ) {
		if ( function_exists( 'trx_addons_set_theme_activated' ) ) {
			trx_addons_set_theme_activated( $code, etude_get_theme_pro_key(), $token );
		}
	}
}

if ( ! function_exists( 'etude_pro_upgrade_theme' ) ) {
	/**
	 * Upgrade a free theme from the uploaded file with a full version of the theme.
	 *
	 * @param string $theme_slug  A theme slug.
	 * @param string $path        Path to the uploaded package.
	 *
	 * @return string             An empty string if success or an error message.
	 */
	function etude_pro_upgrade_theme( $theme_slug, $path ) {

		$msg = '';

		$theme_slug = get_template();
		$theme      = wp_get_theme( $theme_slug );

		// Load WordPress Upgrader
		if ( ! class_exists( 'Theme_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		// Prep variables for Theme_Installer_Skin class
		$extra         = array();
		$extra['slug'] = $theme_slug;   // Needed for potentially renaming of directory name
		$source        = $path;
		$api           = null;

		$url = add_query_arg(
			array(
				'action' => 'update-theme',
				'theme'  => urlencode( $theme_slug ),
			),
			'update.php'
		);

		// Create Skin
		$skin_args = array(
			'type'  => 'upload',
			'title' => '',
			'url'   => esc_url_raw( $url ),
			'nonce' => 'update-theme_' . $theme_slug,
			'theme' => $path,
			'api'   => $api,
			'extra' => array(
				'slug' => $theme_slug,
			),
		);
		$skin      = new Theme_Upgrader_Skin( $skin_args );

		// Create a new instance of Theme_Upgrader
		$upgrader = new Theme_Upgrader( $skin );

		// Inject our info into the update transient
		$repo_updates = get_site_transient( 'update_themes' );
		if ( ! is_object( $repo_updates ) ) {
			$repo_updates = new stdClass;
		}
		if ( empty( $repo_updates->response[ $theme_slug ] ) ) {
			$repo_updates->response[ $theme_slug ] = array();
		}
		$repo_updates->response[ $theme_slug ]['slug']        = $theme_slug;
		$repo_updates->response[ $theme_slug ]['theme']       = $theme_slug;
		$repo_updates->response[ $theme_slug ]['new_version'] = $theme->get( 'Version' );
		$repo_updates->response[ $theme_slug ]['package']     = $path;
		$repo_updates->response[ $theme_slug ]['url']         = $path;
		set_site_transient( 'update_themes', $repo_updates );

		// Upgrade theme
		$upgrader->upgrade( $theme_slug );

		return $msg;
	}
}

if ( ! function_exists( 'etude_pro_upgrade_plugin' ) ) {
	/**
	 * Upgrade a free theme's plugin-companion from the uploaded file with a full version of the plugin.
	 *
	 * @param string $plugin_slug  A plugin slug.
	 * @param string $path         Path to the uploaded package.
	 *
	 * @return string             An empty string if success or an error message.
	 */
	function etude_pro_upgrade_plugin( $plugin_slug, $path ) {

		$msg = '';

		// Load plugin utilities
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		// Detect plugin path
		$plugin_base = "{$plugin_slug}/{$plugin_slug}.php";
		$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . $plugin_base;

		// If not installed - exit
		if ( ! file_exists( $plugin_path ) ) {
			return '';
		}

		// Get plugin info
		$plugin_data = get_plugin_data( $plugin_path );
		$tmp         = explode( '.', $plugin_data['Version'] );
		$tmp[ count( $tmp ) - 1 ]++;
		$plugin_data['Version'] = implode( '.', $tmp );

		// Load WordPress Upgrader
		if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		// Prep variables for Plugin_Installer_Skin class
		$extra         = array();
		$extra['slug'] = $plugin_slug;  // Needed for potentially renaming of directory name
		$source        = $path;
		$api           = null;

		$url = add_query_arg(
			array(
				'action' => 'update-plugin',
				'theme'  => urlencode( $plugin_slug ),
			),
			'update.php'
		);

		// Create Skin
		$skin_args = array(
			'type'  => 'upload',
			'title' => '',
			'url'   => esc_url_raw( $url ),
			'nonce' => 'update-plugin_' . $plugin_slug,
			'theme' => $path,
			'api'   => $api,
			'extra' => array(
				'slug' => $plugin_slug,
			),
		);
		$skin      = new Plugin_Upgrader_Skin( $skin_args );

		// Create a new instance of Theme_Upgrader
		$upgrader = new Plugin_Upgrader( $skin );

		// Inject our info into the update transient
		$repo_updates = get_site_transient( 'update_plugins' );
		if ( ! is_object( $repo_updates ) ) {
			$repo_updates = new stdClass;
		}
		if ( empty( $repo_updates->response[ $plugin_base ] ) ) {
			$repo_updates->response[ $plugin_base ] = new stdClass;
		}
		$repo_updates->response[ $plugin_base ]->slug        = $plugin_slug;
		$repo_updates->response[ $plugin_base ]->plugin      = $plugin_base;
		$repo_updates->response[ $plugin_base ]->new_version = $plugin_data['Version'];
		$repo_updates->response[ $plugin_base ]->package     = $path;
		$repo_updates->response[ $plugin_base ]->url         = $path;
		set_site_transient( 'update_plugins', $repo_updates );

		// Upgrade plugin
		$upgrader->upgrade( $plugin_base );

		// Activate plugin
		if ( is_plugin_inactive( $plugin_base ) ) {
			$result = activate_plugin( $plugin_base );
			if ( is_wp_error( $result ) ) {
				$msg = esc_html__( 'Error with plugin activation. Try to manually activate in the Plugins menu', 'etude' );
			}
		}

		return $msg;
	}
}
