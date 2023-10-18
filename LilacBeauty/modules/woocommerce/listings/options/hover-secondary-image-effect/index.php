<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Woo_Listing_Option_Hover_Secondary_Image_Effect' ) ) {

    class LilacBeauty_Woo_Listing_Option_Hover_Secondary_Image_Effect extends LilacBeauty_Woo_Listing_Option_Core {

        private static $_instance = null;

        public $option_slug;

        public $option_name;

        public $option_type;

        public $option_default_value;

        public $option_value_prefix;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            $this->option_slug          = 'product-hover-secondary-image-effect';
            $this->option_name          = esc_html__('Hover Secondary Image Effect', 'lilac-beauty');
            $this->option_default_value = 'product-hover-secimage-fade';
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_value_prefix  = 'product-hover-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lilacbeauty_woo_custom_product_template_hover_options', array( $this, 'woo_custom_product_template_hover_options'), 15, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_hover_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'hover';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'select';
            $settings['title']   =  $this->option_name;
            $settings['options'] =  array (
                'product-hover-secimage-fade'         => esc_html__('Fade', 'lilac-beauty'),
                'product-hover-secimage-zoomin'       => esc_html__('Zoom In', 'lilac-beauty'),
                'product-hover-secimage-zoomout'      => esc_html__('Zoom Out', 'lilac-beauty'),
                'product-hover-secimage-zoomoutup'    => esc_html__('Zoom Out Up', 'lilac-beauty'),
                'product-hover-secimage-zoomoutdown'  => esc_html__('Zoom Out Down', 'lilac-beauty'),
                'product-hover-secimage-zoomoutleft'  => esc_html__('Zoom Out Left', 'lilac-beauty'),
                'product-hover-secimage-zoomoutright' => esc_html__('Zoom Out Right', 'lilac-beauty'),
                'product-hover-secimage-pushup'       => esc_html__('Push Up', 'lilac-beauty'),
                'product-hover-secimage-pushdown'     => esc_html__('Push Down', 'lilac-beauty'),
                'product-hover-secimage-pushleft'     => esc_html__('Push Left', 'lilac-beauty'),
                'product-hover-secimage-pushright'    => esc_html__('Push Right', 'lilac-beauty'),
                'product-hover-secimage-slideup'      => esc_html__('Slide Up', 'lilac-beauty'),
                'product-hover-secimage-slidedown'    => esc_html__('Slide Down', 'lilac-beauty'),
                'product-hover-secimage-slideleft'    => esc_html__('Slide Left', 'lilac-beauty'),
                'product-hover-secimage-slideright'   => esc_html__('Slide Right', 'lilac-beauty'),
                'product-hover-secimage-hingeup'      => esc_html__('Hinge Up', 'lilac-beauty'),
                'product-hover-secimage-hingedown'    => esc_html__('Hinge Down', 'lilac-beauty'),
                'product-hover-secimage-hingeleft'    => esc_html__('Hinge Left', 'lilac-beauty'),
                'product-hover-secimage-hingeright'   => esc_html__('Hinge Right', 'lilac-beauty'),
                'product-hover-secimage-foldup'       => esc_html__('Fold Up', 'lilac-beauty'),
                'product-hover-secimage-folddown'     => esc_html__('Fold Down', 'lilac-beauty'),
                'product-hover-secimage-foldleft'     => esc_html__('Fold Left', 'lilac-beauty'),
                'product-hover-secimage-foldright'    => esc_html__('Fold Right', 'lilac-beauty'),
                'product-hover-secimage-fliphoriz'    => esc_html__('Flip Horizontal', 'lilac-beauty'),
                'product-hover-secimage-flipvert'     => esc_html__('Flip Vertical', 'lilac-beauty')
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lilacbeauty_woo_listing_option_hover_secondary_image_effect') ) {
	function lilacbeauty_woo_listing_option_hover_secondary_image_effect() {
		return LilacBeauty_Woo_Listing_Option_Hover_Secondary_Image_Effect::instance();
	}
}

lilacbeauty_woo_listing_option_hover_secondary_image_effect();