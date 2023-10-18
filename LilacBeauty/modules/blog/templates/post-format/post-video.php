<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( isset( $meta['media-url'] ) && $meta['media-url'] != '' && $enable_video_audio ) : ?>
		<div class="wdt-video-wrap"><?php
			if( $meta['media-type'] == 'oembed' && ! isset( $_COOKIE['wdtPrivacyVideoEmbedsDisabled'] ) ) :
				echo wp_oembed_get($meta['media-url']);
			elseif( $meta['media-type'] == 'self' ) :
				echo wp_video_shortcode( array('src' => $meta['media-url']) );
			endif;?>
		</div><?php
	else:
		$template_args['post_ID'] = $post_ID;
		lilacbeauty_template_part( 'blog', 'templates/post-format/post', 'standard', $template_args );
	endif;
?>