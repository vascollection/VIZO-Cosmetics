<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $enable_disqus_comments && $post_disqus_shortname != '' ) : ?>
		<!-- Entry Comment -->
		<div class="entry-comments">
			<?php echo '<a href="'.get_permalink($post_ID).'#disqus_thread"></a>'; ?>
			<script id="dsq-count-scr" src='//<?php echo lilacbeauty_html_output($disqus_name);?>.disqus.com/count.js' async></script>
		</div><!-- Entry Comment --><?php
	else :
		if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			comments_popup_link( esc_html__('Add Comment', 'lilac-beauty'), esc_html__('1 Comment', 'lilac-beauty'), esc_html__('% Comments', 'lilac-beauty'), '', esc_html__('Comments Off', 'lilac-beauty'));
		}
	endif; ?>