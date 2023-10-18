<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Social Share -->
<div class="single-entry-social-share"><?php
	$output = '<div class="share">';

		$title = get_the_title( $post_ID );
		$title = urlencode($title);

		$link = get_permalink( $post_ID );
		$link = rawurlencode( $link );

		$output .= '<i class="wdticon-share-alt-square"></i>';
		$output .= '<ul class="wdt-share-list">';
			$output .= '<li><a href="http://www.facebook.com/sharer.php?u='.esc_attr($link).'&amp;t='.esc_attr($title).'" class="wdticon-facebook" target="_blank"></a></li>';
			$output .= '<li><a href="http://twitter.com/share?text='.esc_attr($title).'&amp;url='.esc_attr($link).'" class="wdticon-twitter" target="_blank"></a></li>';
			$output .= '<li><a href="http://plus.google.com/share?url='.esc_attr($link).'" class="wdticon-google" target="_blank"></a></li>';
			$output .= '<li><a href="http://pinterest.com/pin/create/button/?url='.esc_attr($link).'&media='.get_the_post_thumbnail_url($post_ID, 'full').'" class="wdticon-pinterest" target="_blank"></a></li>';
			$output .= '<li><a href="mailto:?subject=I%20wanted%20to%20share%20this%20article%20with%20you&body='.esc_attr($link).'" class="wdticon-envelope" target="_blank"></a>';
		$output .= '</ul>';

	$output .= '</div>';
	echo lilacbeauty_html_output($output); ?></div><!-- Entry Social Share -->