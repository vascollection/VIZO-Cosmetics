<?php

/**
 * WooCommerce - Quantity Plus Minus Core Class
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Shop_Others_Quantity_Plus_Minus' ) ) {

    class LilacBeauty_Shop_Others_Quantity_Plus_Minus {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            // Load Modules
                $this->load_modules();

            // Override WooCommerce default template files
                add_filter( 'woocommerce_locate_template',  array( $this, 'woocommerce_locate_template' ), 40, 3 );

            // CSS
                add_filter( 'lilacbeauty_woo_css', array( $this, 'woo_css'), 10, 1 );

            // JS
                add_filter( 'lilacbeauty_woo_js', array( $this, 'woo_js'), 10, 1 );

            // JS
                add_action( 'lilacbeauty_after_woo_js', array ( $this, 'after_woo_js' ) );

        }


        /*
        Module Paths
        */

            function module_dir_path() {

                if( lilacbeauty_is_file_in_theme( __FILE__ ) ) {
                    return LILACBEAUTY_MODULE_DIR . '/woocommerce/others/quantity-plus-minus/';
                } else {
                    return trailingslashit( plugin_dir_path( __FILE__ ) );
                }

            }

            function module_dir_url() {

                if( lilacbeauty_is_file_in_theme( __FILE__ ) ) {
                    return LILACBEAUTY_MODULE_URI . '/woocommerce/others/quantity-plus-minus/';
                } else {
                    return trailingslashit( plugin_dir_url( __FILE__ ) );
                }

            }

        /**
         * Load Modules
         */
            function load_modules() {

                if( function_exists( 'lilacbeauty_pro' ) ) {

                    // Customizer
                        include_once $this->module_dir_path(). 'customizer/index.php';

                }

            }

        /**
         * Override WooCommerce default template files
         */
            function woocommerce_locate_template( $template, $template_name, $template_path ) {

                global $woocommerce;

                $_template = $template;

                if ( ! $template_path ) $template_path = $woocommerce->template_url;

                $plugin_path  = $this->module_dir_path() . 'templates/';

                // Look within passed path within the theme - this is priority
                $template = locate_template(
                    array(
                        $template_path . $template_name,
                        $template_name
                    )
                );

                // Modification: Get the template from this plugin, if it exists
                if ( ! $template && file_exists( $plugin_path . $template_name ) )
                $template = $plugin_path . $template_name;

                // Use default template
                if ( ! $template )
                $template = $_template;

                // Return what we found
                return $template;

            }

        /*
        CSS
        */
            function woo_css( $css ) {

                if( is_product() || is_cart() ) {

                    $css_file_path = $this->module_dir_path() . 'assets/css/style.css';

                    if( file_exists ( $css_file_path ) ) {

                        ob_start();
                        include( $css_file_path );
                        $css .= "\n\n".ob_get_clean();

                    }

                }

                return $css;

            }

        /*
        JS
        */
            function woo_js( $js ) {

                if( is_product() || is_cart() ) {

                    $js_file_path = $this->module_dir_path() . 'assets/js/scripts.js';

                    if( file_exists ( $js_file_path ) ) {

                        ob_start();
                        include( $js_file_path );
                        $js .= "\n\n".ob_get_clean();

                    }

                }

                return $js;

            }

        /*
        Woo Non Archive JS
        */
            function after_woo_js() {

                if( !is_product() && !is_cart() ) {

                    wp_register_script( 'lilacbeauty-woo-quantity-plus-minus', '', array ('jquery'), false, true );
                    wp_enqueue_script( 'lilacbeauty-woo-quantity-plus-minus' );

                    $js = '';

                    $js_file_path = $this->module_dir_path() . 'assets/js/scripts.js';

                    if( file_exists ( $js_file_path ) ) {

                        ob_start();
                        include( $js_file_path );
                        $js .= "\n\n".ob_get_clean();

                    }

                    if( !empty($js) ) {
                        wp_add_inline_script( 'lilacbeauty-woo-quantity-plus-minus', $js );
                    }

                    return $js;
                }

            }

    }

}

if( !function_exists('lilacbeauty_shop_others_quantity_plus_minus') ) {
	function lilacbeauty_shop_others_quantity_plus_minus() {
        $reflection = new ReflectionClass('LilacBeauty_Shop_Others_Quantity_Plus_Minus');
        return $reflection->newInstanceWithoutConstructor();
	}
}

LilacBeauty_Shop_Others_Quantity_Plus_Minus::instance();