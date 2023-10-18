<?php
add_action( 'lilacbeauty_after_main_css', 'header_style' );
function header_style() {
    wp_enqueue_style( 'lilacbeauty-header', get_theme_file_uri('/modules/header/assets/css/header.css'), false, LILACBEAUTY_THEME_VERSION, 'all');
}

if( ! function_exists( 'lilacbeauty_get_header_wrapper_classes' )  ) {
	function lilacbeauty_get_header_wrapper_classes() {
        return implode(' ', apply_filters( 'lilacbeauty_header_wrapper_classes', array ( 'header-top-absolute' ) ));
	}
}

if( ! function_exists( 'lilacbeauty_header_template' )  ) {
	function lilacbeauty_header_template() {
		lilacbeauty_template_part( 'header', 'templates/header' );
	}

	add_action( 'lilacbeauty_header', 'lilacbeauty_header_template' );
}

if( ! function_exists('lilacbeauty_get_header_logo') ) {
	function lilacbeauty_get_header_logo() {
		$logo = '<img class="normal_logo" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="'.esc_url(LILACBEAUTY_ROOT_URI.'/assets/images/logo.svg').'"/>';

		$customizer_logo = get_custom_logo();
		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );

			if ( $customizer_logo_id ) {
				$alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				$logo_attr = array(
					'class' => 'normal_logo'
				);

				if ( empty( $image_alt ) ) {
					$logo_attr['alt'] = get_bloginfo( 'name', 'display' );
				}

				$logo = wp_get_attachment_image( $customizer_logo_id, 'full', false, $logo_attr );

			}
		}

		return $logo;
	}
}

if( !class_exists( 'LilacBeauty_Default_Header_Walker_Nav_Menu' ) ) {

	class LilacBeauty_Default_Header_Walker_Nav_Menu extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			$classes = array( 'sub-menu', 'is-hidden' );
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul$class_names>{$n}";
			$output .= '<li class="close-nav"><a href="javascript:void(0);"></a></li>';
			$output .= '<li class="go-back"><a href="javascript:void(0);"></a></li>';
			$output .= '<li class="see-all"></li>';
		}
	}
}

if( !function_exists('lilacbeauty_nav_menu_class') ) {
	function lilacbeauty_nav_menu_class( $classes, $item, $args, $depth ) {

		$classes[] = 'menu-item-depth-' . $depth;
		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'lilacbeauty_nav_menu_class', 10, 4 );
}