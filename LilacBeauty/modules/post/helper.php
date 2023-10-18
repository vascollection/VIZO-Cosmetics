<?php

if( !function_exists('lilacbeauty_single_post_params_default') ) {
    function lilacbeauty_single_post_params_default() {
        $params = array(
            'enable_title'   		 => 0,
            'enable_image_lightbox'  => 0,
            'enable_disqus_comments' => 0,
            'post_disqus_shortname'  => '',
            'post_dynamic_elements'  => array( 'content', 'author_bio', 'comment_box', 'navigation' ),
            'post_commentlist_style' => 'rounded'
        );

        return $params;
    }
}

if( !function_exists('lilacbeauty_single_post_misc_default') ) {
    function lilacbeauty_single_post_misc_default() {
        $params = array(
            'enable_related_article'=> 0,
            'rposts_title'   		=> esc_html__('Related Posts', 'lilac-beauty'),
            'rposts_column'         => 'one-third-column',
            'rposts_count'          => 3,
            'rposts_excerpt'        => 0,
            'rposts_excerpt_length' => 25,
            'rposts_carousel'       => 0,
            'rposts_carousel_nav'   => ''
        );

        return $params;
    }
}

if( !function_exists('lilacbeauty_single_post_params') ) {
    function lilacbeauty_single_post_params() {
        $params = lilacbeauty_single_post_params_default();
        return apply_filters( 'lilacbeauty_single_post_params', $params );
    }
}

add_action( 'lilacbeauty_after_main_css', 'post_style' );
function post_style() {
    if( is_singular('post') || is_attachment() ) {
        wp_enqueue_style( 'lilacbeauty-post', get_theme_file_uri('/modules/post/assets/css/post.css'), false, LILACBEAUTY_THEME_VERSION, 'all');

        $post_style = lilacbeauty_get_single_post_style( get_the_ID() );
        wp_enqueue_style( 'lilacbeauty-post-'.$post_style, get_theme_file_uri('/modules/post/templates/'.$post_style.'/assets/css/post-'.$post_style.'.css'), false, LILACBEAUTY_THEME_VERSION, 'all');
    }
}

if( !function_exists('lilacbeauty_get_single_post_style') ) {
	function lilacbeauty_get_single_post_style( $post_id ) {
		return apply_filters( 'lilacbeauty_single_post_style', 'minimal', $post_id );
	}
}

add_action( 'lilacbeauty_after_main_css', 'lilacbeauty_single_post_enqueue_css' );
if( !function_exists( 'lilacbeauty_single_post_enqueue_css' ) ) {
    function lilacbeauty_single_post_enqueue_css() {

        wp_enqueue_style( 'lilacbeauty-magnific-popup', get_theme_file_uri('/modules/post/assets/css/magnific-popup.css'), false, LILACBEAUTY_THEME_VERSION, 'all');
    }
}

add_action( 'lilacbeauty_before_enqueue_js', 'lilacbeauty_single_post_enqueue_js' );
if( !function_exists( 'lilacbeauty_single_post_enqueue_js' ) ) {
    function lilacbeauty_single_post_enqueue_js() {

        wp_enqueue_script('jquery-magnific-popup', get_theme_file_uri('/modules/post/assets/js/jquery.magnific-popup.js'), array(), false, true);
    }
}

add_filter('post_class', 'lilacbeauty_single_set_post_class', 10, 3);
if( !function_exists('lilacbeauty_single_set_post_class') ) {
    function lilacbeauty_single_set_post_class( $classes, $class, $post_id ) {

        if( is_singular('post') || is_attachment() ) {
        	$classes[] = 'blog-single-entry';
        	$classes[] = 'post-'.lilacbeauty_get_single_post_style( $post_id );
        }

        return $classes;
    }
}


add_filter( 'comment_form_default_fields', 'lilacbeauty_custom_placeholder_comment_section', 10 );
function lilacbeauty_custom_placeholder_comment_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $fields['author'] = sprintf(
        '<p class="comment-form-author">%s %s</p>',
        sprintf(
            '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245" %s />',
            esc_attr( $commenter['comment_author'] ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            '<label for="author">%s%s</label>',
            esc_html__( 'Name', 'lilac-beauty' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['email'] = sprintf(
        '<p class="comment-form-email">%s %s</p>',
        sprintf(
            '<input id="email" name="email" type="email" value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
            esc_attr( $commenter['comment_author_email'] ),
            ( $req ? $required_attribute : '' )
        ),
        sprintf(
            '<label for="email">%s%s</label>',
            esc_html__( 'Email', 'lilac-beauty' ),
            ( $req ? $required_indicator : '' )
        )
    );
    $fields['url'] = sprintf(
        '<p class="comment-form-url">%s %s</p>',
        sprintf(
            '<input id="url" name="url" type="text" value="%s" size="30" maxlength="200" />',
            esc_attr( $commenter['comment_author_url'] )
        ),
        sprintf(
            '<label for="url">%s</label>',
            esc_html__( 'Website', 'lilac-beauty' )
        )
    );

    return $fields;

}

add_filter( 'comment_form_defaults', 'lilacbeauty_custom_placeholder_textarea_section', 10 );
function lilacbeauty_custom_placeholder_textarea_section( $fields ) {

    $req = get_option( 'require_name_email' );
    $required_attribute = 'required="required"';
    $required_indicator = '<span class="required" aria-hidden="true">*</span>';

    $replace_comment = esc_html__('Enter your comment', 'lilac-beauty');

    $fields['comment_field'] = sprintf(
        '<p class="comment-form-comment">%s %s</p>',
        '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" ' . $required_attribute . '></textarea>',
        sprintf(
            '<label for="comment">%s%s</label>',
            esc_html__( 'Comment', 'lilac-beauty' ),
            $required_indicator
        )
    );

    return $fields;
}