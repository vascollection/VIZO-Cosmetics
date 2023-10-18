<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package LilacBeauty WordPress theme
 */

function lilacbeauty_tgmpa_plugins_register() {

	// Get array of recommended plugins.
	$plugins_list = array(
        array(
            'name'               => esc_html__('LilacBeauty Plus', 'lilac-beauty'),
            'slug'               => 'lilac-beauty-plus',
            'source'             => LILACBEAUTY_MODULE_DIR . '/plugins/lilac-beauty-plus.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('LilacBeauty Pro', 'lilac-beauty'),
            'slug'               => 'lilac-beauty-pro',
            'source'             => LILACBEAUTY_MODULE_DIR . '/plugins/lilac-beauty-pro.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'lilac-beauty'),
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'lilac-beauty'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => LILACBEAUTY_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('WooCommerce', 'lilac-beauty'),
            'slug'     => 'woocommerce',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('LilacBeauty Shop', 'lilac-beauty'),
            'slug'               => 'lilac-beauty-shop',
            'source'             => LILACBEAUTY_MODULE_DIR . '/plugins/lilac-beauty-shop.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Quick View', 'lilac-beauty'),
            'slug'     => 'yith-woocommerce-quick-view',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Wishlist', 'lilac-beauty'),
            'slug'     => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Compare', 'lilac-beauty'),
            'slug'     => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'lilac-beauty'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Unyson', 'lilac-beauty'),
            'slug'     => 'unyson',
            'required' => true,
        )
	);

	$plugins = apply_filters('lilacbeauty_required_plugins_list', $plugins_list);

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'lilacbeauty_theme',
		'domain'       => 'lilac-beauty',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'lilacbeauty_tgmpa_plugins_register' );