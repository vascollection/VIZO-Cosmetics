<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Woo_Listing_Option_Shadow_Type' ) ) {

    class LilacBeauty_Woo_Listing_Option_Shadow_Type extends LilacBeauty_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-shadow-type';
            $this->option_name          = esc_html__('Shadow Type', 'lilac-beauty');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = 'product-shadow-type-default';
            $this->option_value_prefix  = 'product-shadow-type-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lilacbeauty_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 50, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_common_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'common';
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
                'product-shadow-type-default' => esc_html__('Default', 'lilac-beauty'),
                'product-shadow-type-thumb'   => esc_html__('Thumb', 'lilac-beauty'),
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lilacbeauty_woo_listing_option_shadow_type') ) {
	function lilacbeauty_woo_listing_option_shadow_type() {
		return LilacBeauty_Woo_Listing_Option_Shadow_Type::instance();
	}
}

lilacbeauty_woo_listing_option_shadow_type();