<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Title -->
<div class="entry-title">
	<h4><?php
		if( is_sticky( $post_ID ) ) echo '<span class="sticky-post"><i class="wdticon-thumb-tack"></i><span>'.esc_html__('Featured', 'lilac-beauty').'</span></span>'; ?>
    	<a href="<?php echo get_permalink( $post_ID );?>" title="<?php printf(esc_attr__('Permalink to %s','lilac-beauty'), the_title_attribute('echo=0'));?>"><?php the_title();?></a>
	</h4>
</div><!-- Entry Title -->