<?php
/**
 * Listing Options - Image Effect
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Woo_Listing_Option_Content_Enable' ) ) {

    class LilacBeauty_Woo_Listing_Option_Content_Enable extends LilacBeauty_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-content-enable';
            $this->option_name          = esc_html__('Enable Content Section', 'lilac-beauty');
            $this->option_desc          = esc_html__('YES! to enable content section.', 'lilac-beauty');
            $this->option_type          = array ( 'html', 'key-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = 'product-';

            $this->render_backend();
        }

        /**
         * Backend Render
         */
        function render_backend() {
            add_filter( 'lilacbeauty_woo_custom_product_template_content_options', array( $this, 'woo_custom_product_template_content_options'), 5, 1 );
        }

        /**
         * Custom Product Templates - Options
         */
        function woo_custom_product_template_content_options( $template_options ) {

            array_push( $template_options, $this->setting_args() );

            return $template_options;
        }

        /**
         * Settings Group
         */
        function setting_group() {
            return 'content';
        }

        /**
         * Setting Args
         */
        function setting_args() {
            $settings            =  array ();
            $settings['id']      =  $this->option_slug;
            $settings['type']    =  'switcher';
            $settings['title']   =  $this->option_name;
            $settings['desc']    =  $this->option_desc;
            $settings['default'] =  $this->option_default_value;

            return $settings;
        }
    }

}

if( !function_exists('lilacbeauty_woo_listing_option_content_enable') ) {
	function lilacbeauty_woo_listing_option_content_enable() {
		return LilacBeauty_Woo_Listing_Option_Content_Enable::instance();
	}
}

lilacbeauty_woo_listing_option_content_enable();