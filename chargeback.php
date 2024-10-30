<?php
/*
Plugin Name: Chargeback For WooCommerce
Plugin URI:  https://www.chargeback.com
Description: A plugin for integrating Chargeback functionality with WooCommerce
Version:     0.1.8
Author:      Chargeback
Author URI:  https://www.chargeback.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	include 'chargeback_for_woocommerce.php';
	WC_CBCO_Chargeback::init();
  register_activation_hook(__FILE__, 'cbco_activate_notice_set');
}

function cbco_activate_notice_set(){
  set_transient('activate_notice_cbwoo', true, 30);
}
