<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, lilacbeauty_single_post_params() ); ?>

	<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args ); ?>
	
	<!-- Post Header -->
	<div class="post-header">

	   	<?php if( $template_args['enable_title'] ) : ?>
		        <?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/title', '', $template_args ); ?>
		<?php endif; ?>

		<!-- Post Meta -->
		<div class="post-meta">
			<!-- Meta Left -->
			<div class="meta-left">
				<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/author', '', $template_args ); ?>
			</div><!-- Meta Left -->

			<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/date', '', $template_args ); ?>

			<!-- Meta Right -->
			<div class="meta-right">
				<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/comment', '', $template_args ); ?>
			</div><!-- Meta Right -->
		</div><!-- Post Meta -->

	</div><!-- Post Header -->

	<!-- Post Content -->
	<div class="post-content">
		<div class="post-category">
			<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/category', '', $template_args ); ?>
		</div>
		<div class="post-social">
			<?php lilacbeauty_template_part( 'post', 'templates/'.$Post_Style.'/parts/social', '', $template_args ); ?>
		</div>
	</div>
	<!-- Post Content -->

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'lilacbeauty_single_post_dynamic_template_part', lilacbeauty_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->