<?php
add_action( 'lilacbeauty_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'lilacbeauty-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, LILACBEAUTY_THEME_VERSION, 'all');
}

add_action( 'lilacbeauty_footer', 'footer_content' );
function footer_content() {
    lilacbeauty_template_part( 'content', 'content', 'footer' );
}