<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<!-- Entry Author -->
<div class="single-entry-author">
	<div class="meta-author-img">
		<?php echo get_avatar(get_the_author_meta('ID'), 40 );?>
	</div>
	<div class="meta-author-info">
		<span><?php esc_html_e('Written by', 'lilac-beauty'); ?></span>
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php esc_attr_e('View all posts by ', 'lilac-beauty'); echo get_the_author();?>"><?php echo get_the_author();?></a>
    </div>
</div><!-- Entry Author -->