<?php

/**
 * WooCommerce - Single - Module - Upsell & Related - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Shop_Customizer_Single_Upsell_Related' ) ) {

    class LilacBeauty_Shop_Customizer_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function register( $wp_customize ) {

            /**************
             *  Upsell
             **************/

                /**
                * Option : Show Upsell Products
                */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control_Switch(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Upsell Products', 'lilac-beauty'),
                                'section' => 'woocommerce-single-page-upsell-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'lilac-beauty' ),
                                    'off' => esc_attr__( 'No', 'lilac-beauty' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Upsell Title
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-upsell-section',
                            'label'      => esc_html__( 'Upsell Title', 'lilac-beauty' )
                        )
                    );

                /**
                 * Option : Upsell Column
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new LilacBeauty_Customize_Control_Radio_Image(
                        $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Upsell Column', 'lilac-beauty'),
                            'section' => 'woocommerce-single-page-upsell-section',
                            'choices' => apply_filters( 'lilacbeauty_woo_upsell_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Upsell Limit
                */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Upsell Limit', 'lilac-beauty'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'lilac-beauty' ),
                                    2 => esc_html__( '2', 'lilac-beauty' ),
                                    3 => esc_html__( '3', 'lilac-beauty' ),
                                    4 => esc_html__( '4', 'lilac-beauty' ),
                                    5 => esc_html__( '5', 'lilac-beauty' ),
                                    6 => esc_html__( '6', 'lilac-beauty' ),
                                    7 => esc_html__( '7', 'lilac-beauty' ),
                                    8 => esc_html__( '8', 'lilac-beauty' ),
                                    9 => esc_html__( '9', 'lilac-beauty' ),
                                    10 => esc_html__( '10', 'lilac-beauty' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-upsell-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'lilac-beauty'),
                                'section'  => 'woocommerce-single-page-upsell-section',
                                'choices'  => lilacbeauty_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


            /**************
             *  Related
             **************/

                /**
                * Option : Show Related Products
                */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control_Switch(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-display]', array(
                                'type'    => 'wdt-switch',
                                'label'   => esc_html__( 'Show Related Products', 'lilac-beauty'),
                                'section' => 'woocommerce-single-page-related-section',
                                'choices' => array(
                                    'on'  => esc_attr__( 'Yes', 'lilac-beauty' ),
                                    'off' => esc_attr__( 'No', 'lilac-beauty' )
                                )
                            )
                        )
                    );

                /**
                 * Option : Related Title
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-title]', array(
                            'type'       => 'text',
                            'section'    => 'woocommerce-single-page-related-section',
                            'label'      => esc_html__( 'Related Title', 'lilac-beauty' )
                        )
                    );

                /**
                 * Option : Related Column
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control( new LilacBeauty_Customize_Control_Radio_Image(
                        $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-column]', array(
                            'type' => 'wdt-radio-image',
                            'label' => esc_html__( 'Related Column', 'lilac-beauty'),
                            'section' => 'woocommerce-single-page-related-section',
                            'choices' => apply_filters( 'lilacbeauty_woo_related_columns_options', array(
                                1 => array(
                                    'label' => esc_html__( 'One Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-column.png'
                                ),
                                2 => array(
                                    'label' => esc_html__( 'One Half Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-half-column.png'
                                ),
                                3 => array(
                                    'label' => esc_html__( 'One Third Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-third-column.png'
                                ),
                                4 => array(
                                    'label' => esc_html__( 'One Fourth Column', 'lilac-beauty' ),
                                    'path' => lilacbeauty_shop_single_module_upsell_related()->module_dir_url() . 'customizer/images/one-fourth-column.png'
                                )
                            ))
                        )
                    ));


                /**
                * Option : Related Limit
                */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-limit]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Related Limit', 'lilac-beauty'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => array (
                                    1 => esc_html__( '1', 'lilac-beauty' ),
                                    2 => esc_html__( '2', 'lilac-beauty' ),
                                    3 => esc_html__( '3', 'lilac-beauty' ),
                                    4 => esc_html__( '4', 'lilac-beauty' ),
                                    5 => esc_html__( '5', 'lilac-beauty' ),
                                    6 => esc_html__( '6', 'lilac-beauty' ),
                                    7 => esc_html__( '7', 'lilac-beauty' ),
                                    8 => esc_html__( '8', 'lilac-beauty' ),
                                    9 => esc_html__( '9', 'lilac-beauty' ),
                                    10 => esc_html__( '10', 'lilac-beauty' ),
                                )
                            )
                        )
                    );

                /**
                 * Option : Product Style Template
                 */
                    $wp_customize->add_setting(
                        LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                            'type' => 'option',
                            'sanitize_callback' => 'wp_filter_nohtml_kses'
                        )
                    );

                    $wp_customize->add_control(
                        new LilacBeauty_Customize_Control(
                            $wp_customize, LILACBEAUTY_CUSTOMISER_VAL . '[wdt-single-product-related-style-template]', array(
                                'type'     => 'select',
                                'label'    => esc_html__( 'Product Style Template', 'lilac-beauty'),
                                'section'  => 'woocommerce-single-page-related-section',
                                'choices'  => lilacbeauty_woo_listing_customizer_settings()->product_templates_list()
                            )
                        )
                    );


        }

    }

}


if( !function_exists('lilacbeauty_shop_customizer_single_upsell_related') ) {
	function lilacbeauty_shop_customizer_single_upsell_related() {
		return LilacBeauty_Shop_Customizer_Single_Upsell_Related::instance();
	}
}

lilacbeauty_shop_customizer_single_upsell_related();