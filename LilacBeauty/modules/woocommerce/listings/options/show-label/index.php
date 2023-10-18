<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Woo_Listing_Option_Show_Label' ) ) {

    class LilacBeauty_Woo_Listing_Option_Show_Label extends LilacBeauty_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-show-label';
            $this->option_name          = esc_html__('Show Product Label', 'lilac-beauty');
            $this->option_type          = array ( 'html', 'class', 'key-css' );
            $this->option_default_value = 'true';
            $this->option_value_prefix  = '';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lilacbeauty_woo_custom_product_template_common_options', array( $this, 'woo_custom_product_template_common_options'), 70, 1 );
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
                'true'  => esc_html__('True', 'lilac-beauty'),
                'false' => esc_html__('False', 'lilac-beauty'),
            );
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lilacbeauty_woo_listing_option_show_label') ) {
	function lilacbeauty_woo_listing_option_show_label() {
		return LilacBeauty_Woo_Listing_Option_Show_Label::instance();
	}
}

lilacbeauty_woo_listing_option_show_label();