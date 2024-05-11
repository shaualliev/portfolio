<?php
/**
 * The template to display the background video in the header
 *
 * @package ETUDE
 * @since ETUDE 1.0.14
 */
$etude_header_video = etude_get_header_video();
$etude_embed_video  = '';
if ( ! empty( $etude_header_video ) && ! etude_is_from_uploads( $etude_header_video ) ) {
	if ( etude_is_youtube_url( $etude_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $etude_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php etude_show_layout( etude_get_embed_video( $etude_header_video ) ); ?></div>
		<?php
	}
}
