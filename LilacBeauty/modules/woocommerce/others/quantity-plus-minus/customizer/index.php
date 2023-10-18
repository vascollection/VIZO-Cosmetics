<?php

/**
 * WooCommerce - Others - Quantity Plus Minus - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Shop_Customizer_Others_Quantity_Plus_Minus' ) ) {

    class LilacBeauty_Shop_Customizer_Others_Quantity_Plus_Minus {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'lilacbeauty_woo_others_settings', array( $this, 'others_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function others_settings( $settings ) {

            $enable_quantity_plusminus             = lilacbeauty_customizer_settings('wdt-woo-others-enable-quantity-plusminus' );
            $settings['enable_quantity_plusminus'] = $enable_quantity_plusminus;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
             * Option : Enable Quantity Plus Minus
             */

                $wp_customize->add_setting(
                    LILACBEAUTY_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                        'type' => 'option',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    new LilacBeauty_Customize_Control_Switch(
                        $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                            'type'    => 'wdt-switch',
                            'label'   => esc_html__( 'Enable Quantity Plus Minus', 'lilac-beauty'),
                            'section' => 'woocommerce-others-section',
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'lilac-beauty' ),
                                'off' => esc_attr__( 'No', 'lilac-beauty' )
                            )
                        )
                    )
                );

        }

    }

}


if( !function_exists('lilacbeauty_shop_customizer_others_quantity_plus_minus') ) {
	function lilacbeauty_shop_customizer_others_quantity_plus_minus() {
		return LilacBeauty_Shop_Customizer_Others_Quantity_Plus_Minus::instance();
	}
}

lilacbeauty_shop_customizer_others_quantity_plus_minus();