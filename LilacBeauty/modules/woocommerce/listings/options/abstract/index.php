<?php
/**
 * Listing Options - Core Abstract Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class LilacBeauty_Woo_Listing_Option_Core {

    private static $_instance = null;

    private $wdt_shop_loaded_files = array ();

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    /*
    Module Paths
    */

        function module_dir_path() {

            if( lilacbeauty_is_file_in_theme( __FILE__ ) ) {
                return LILACBEAUTY_MODULE_DIR . '/woocommerce/listings/options/';
            } else {
                return trailingslashit( plugin_dir_path( __FILE__ ) );
            }

        }

        function module_dir_url() {

            if( lilacbeauty_is_file_in_theme( __FILE__ ) ) {
                return LILACBEAUTY_MODULE_URI . '/woocommerce/listings/options/';
            } else {
                return trailingslashit( plugin_dir_url( __FILE__ ) );
            }

        }

    /**
     * Frontend Render
     */
        function render_frontend() {

            /* Options Class Names */
                add_filter( 'lilacbeauty_woo_listings_class', array( $this, 'woo_listings_class_load'), 10, 1 );

            $non_archive_listing = wc_get_loop_prop('non_archive_listing');
            if( $non_archive_listing ) {

                /* Options CSS */
                    add_filter( 'lilacbeauty_woo_non_archive_css', array( $this, 'woo_listings_css_load'), 10, 1 );

                /* Options JS */
                    add_filter( 'lilacbeauty_woo_non_archive_js', array( $this, 'woo_listings_js_load'), 10, 1 );

            } else {

                /* Options CSS */
                    add_filter( 'lilacbeauty_woo_archive_css', array( $this, 'woo_listings_css_load'), 10, 1 );

                /* Options JS */
                    add_filter( 'lilacbeauty_woo_archive_js', array( $this, 'woo_listings_js_load'), 10, 1 );
            }

        }

    /**
     * Option Class Names
     */
        function woo_listings_class_load( $classes ) {

            if( in_array( 'class', $this->option_type ) ) {
                if( is_array ( $this->option_default_value ) && !empty ( $this->option_default_value ) ) {

                    if( isset ( $this->option_default_value['enabled'] ) && !empty ( $this->option_default_value['enabled'] ) ) {
                        array_push( $classes, implode( ' ', array_keys ( $this->option_default_value['enabled'] ) ) );
                    } else {
                        array_push( $classes, implode( ' ', $this->option_default_value ) );
                    }

                } else if( $this->option_default_value == true && isset($this->option_class_name) && $this->option_class_name != '' ) {
                    array_push( $classes, $this->option_class_name );
                } else if( $this->option_default_value != '' ) {
                    array_push( $classes, $this->option_default_value );
                }
            }

            return $classes;
        }

    /**
     * Options CSS
     */
        function woo_listings_css_load( $css ) {

            if( in_array( 'value-css', $this->option_type ) ) {

                if( is_array ( $this->option_default_value ) && !empty ( $this->option_default_value ) ) {
                    if( isset ( $this->option_default_value['enabled'] ) ) {
                        if( !empty ( $this->option_default_value['enabled'] ) ) {
                            $option_default_values = array_keys ( $this->option_default_value['enabled'] );
                        } else {
                            $option_default_values = array ();
                        }
                    } else if( isset ( $this->option_default_value['disabled'] ) ) {
                        $option_default_values = array ();
                    } else {
                        $option_default_values = $this->option_default_value;
                    }

                    if( !empty($option_default_values) ) {
                        foreach( $option_default_values as $option_default_value ) {
                            $css .= $this->load_options_css( $option_default_value );
                            $css .= $this->load_options_skin_css( $option_default_value );
                        }
                    }

                } else if( !empty($this->option_default_value) ) {
                    $css .= $this->load_options_css( $this->option_default_value );
                    $css .= $this->load_options_skin_css( $this->option_default_value );
                }

            }

            if( in_array( 'key-css', $this->option_type ) ) {

                if( !empty($this->option_default_value) ) {
                    $css .= $this->load_options_css( $this->option_slug );
                    $css .= $this->load_options_skin_css( $this->option_slug );
                }

            }


            return $css;
        }

    /**
     * Option Main CSS
     */
        function load_options_css( $style ) {

            $css =  $file = '';

            if(!empty($this->option_value_prefix)) {
                if(is_array($this->option_value_prefix)) {
                    $file = $style;
                    foreach($this->option_value_prefix as $option_value_prefix) {
                        $file = str_replace ( $option_value_prefix, '', $file );
                    }
                } else {
                    $file = str_replace ( $this->option_value_prefix, '', $style );
                }
            } else {
                $file = $style;
            }

            if($file != '') {
                $option_key = str_replace( 'product-', '', $this->option_slug);
                $css_file_path = $this->module_dir_path().$option_key.'/assets/css/'.$file.'.css';

                if(!isset($GLOBALS['wdt_shop_loaded_files']) || (isset($GLOBALS['wdt_shop_loaded_files']) && !in_array($css_file_path, $GLOBALS['wdt_shop_loaded_files']))) {

                    if( file_exists ( $css_file_path ) ) {
                        ob_start();
                        include( $css_file_path );
                        $css .= "\n\n".ob_get_clean();
                    }

                    if(!isset($GLOBALS['wdt_shop_loaded_files'])) {
                        $GLOBALS['wdt_shop_loaded_files'] = array ();
                    }

                    array_push($GLOBALS['wdt_shop_loaded_files'], $css_file_path);
                }
            }

            return $css;

        }

    /**
     * Option Skin CSS
     */
        function load_options_skin_css( $style ) {
            $css = '';
            return $css;
        }

    /**
     * Option JS
     */
        function woo_listings_js_load( $js ) {
            return $js;
        }

    /**
     * Option Loop Property
     */
        function woo_listings_loop_prop() {

            if( in_array( 'html', $this->option_type ) ) {
                if( !empty ( $this->option_default_value ) ) {

                    wc_set_loop_prop($this->option_slug, $this->option_default_value);

                    $lilacbeauty_shop_loop_prop = wc_get_loop_prop('wdt-shop-loop-prop', array ());
                    array_push( $lilacbeauty_shop_loop_prop, $this->option_slug );
                    wc_set_loop_prop('wdt-shop-loop-prop', $lilacbeauty_shop_loop_prop);

                }
            }
        }

}

if( !function_exists('lilacbeauty_woo_listing_option_core') ) {
	function lilacbeauty_woo_listing_option_core() {
		return LilacBeauty_Woo_Listing_Option_Core::instance();
	}
}