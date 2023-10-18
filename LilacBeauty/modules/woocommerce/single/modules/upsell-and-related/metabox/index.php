<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'LilacBeauty_Shop_Metabox_Single_Upsell_Related' ) ) {
    class LilacBeauty_Shop_Metabox_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

			add_filter( 'lilacbeauty_shop_product_custom_settings', array( $this, 'lilacbeauty_shop_product_custom_settings' ), 10 );

		}

        function lilacbeauty_shop_product_custom_settings( $options ) {

			$ct_dependency      = array ();
			$upsell_dependency  = array ( 'show-upsell', '==', 'true');
			$related_dependency = array ( 'show-related', '==', 'true');
			if( function_exists('lilacbeauty_shop_single_module_custom_template') ) {
				$ct_dependency['dependency'] 	= array ( 'product-template', '!=', 'custom-template');
				$upsell_dependency 				= array ( 'product-template|show-upsell', '!=|==', 'custom-template|true');
				$related_dependency 			= array ( 'product-template|show-related', '!=|==', 'custom-template|true');
			}

			$product_options = array (

				array_merge (
					array(
						'id'         => 'show-upsell',
						'type'       => 'select',
						'title'      => esc_html__('Show Upsell Products', 'lilac-beauty'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-upsell' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
							'true'         => esc_html__( 'Show', 'lilac-beauty'),
							null           => esc_html__( 'Hide', 'lilac-beauty'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'upsell-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Column', 'lilac-beauty'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
						1              => esc_html__( 'One Column', 'lilac-beauty' ),
						2              => esc_html__( 'Two Columns', 'lilac-beauty' ),
						3              => esc_html__( 'Three Columns', 'lilac-beauty' ),
						4              => esc_html__( 'Four Columns', 'lilac-beauty' ),
					),
					'dependency' => $upsell_dependency
				),

				array(
					'id'         => 'upsell-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Limit', 'lilac-beauty'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
						1              => esc_html__( 'One', 'lilac-beauty' ),
						2              => esc_html__( 'Two', 'lilac-beauty' ),
						3              => esc_html__( 'Three', 'lilac-beauty' ),
						4              => esc_html__( 'Four', 'lilac-beauty' ),
						5              => esc_html__( 'Five', 'lilac-beauty' ),
						6              => esc_html__( 'Six', 'lilac-beauty' ),
						7              => esc_html__( 'Seven', 'lilac-beauty' ),
						8              => esc_html__( 'Eight', 'lilac-beauty' ),
						9              => esc_html__( 'Nine', 'lilac-beauty' ),
						10              => esc_html__( 'Ten', 'lilac-beauty' ),
					),
					'dependency' => $upsell_dependency
				),

				array_merge (
					array(
						'id'         => 'show-related',
						'type'       => 'select',
						'title'      => esc_html__('Show Related Products', 'lilac-beauty'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-related' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
							'true'         => esc_html__( 'Show', 'lilac-beauty'),
							null           => esc_html__( 'Hide', 'lilac-beauty'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'related-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Column', 'lilac-beauty'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
						2              => esc_html__( 'Two Columns', 'lilac-beauty' ),
						3              => esc_html__( 'Three Columns', 'lilac-beauty' ),
						4              => esc_html__( 'Four Columns', 'lilac-beauty' ),
					),
					'dependency' => $related_dependency
				),

				array(
					'id'         => 'related-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Limit', 'lilac-beauty'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'lilac-beauty' ),
						1              => esc_html__( 'One', 'lilac-beauty' ),
						2              => esc_html__( 'Two', 'lilac-beauty' ),
						3              => esc_html__( 'Three', 'lilac-beauty' ),
						4              => esc_html__( 'Four', 'lilac-beauty' ),
						5              => esc_html__( 'Five', 'lilac-beauty' ),
						6              => esc_html__( 'Six', 'lilac-beauty' ),
						7              => esc_html__( 'Seven', 'lilac-beauty' ),
						8              => esc_html__( 'Eight', 'lilac-beauty' ),
						9              => esc_html__( 'Nine', 'lilac-beauty' ),
						10              => esc_html__( 'Ten', 'lilac-beauty' ),
					),
					'dependency' => $related_dependency
				)

			);

			$options = array_merge( $options, $product_options );

			return $options;

		}

    }
}

LilacBeauty_Shop_Metabox_Single_Upsell_Related::instance();