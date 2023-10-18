<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	$template_args['post_ID'] = $post_ID;
	$template_args = array_merge( $template_args, lilacbeauty_single_post_params() );

    foreach ( $post_dynamic_elements as $key => $value ) {
		lilacbeauty_template_part( 'post', 'templates/'.$post_Style.'/parts/'.$value, '', $template_args );
	}