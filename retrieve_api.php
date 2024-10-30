<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
function cbco_handle_api_key() {
	$key_maker = new WC_CBCO_Chargeback_Key_Generator();
	$key_data = $key_maker->cbco_generate_api_key();
  $plugin_dir = plugin_dir_url( __FILE__);
	// TODO: FIX_THIS the keys should not be transferred as plain text.
	// Maybe send back a public encryption key from the disputer and use it to encrypt the keys
  // echo $_GET['_disputer_auth_token'];
	// echo $_POST['_disputer_auth_token'];
  $url = cbco_chargeback_host() . '/auth_tokens/connect?_cb_auth_token=' . $_REQUEST[_cb_auth_token] . '&username=' . $key_data['consumer_key'] . '&password=' . $key_data['consumer_secret'] . '&name=WooCommerce&url=' . cbco_woo_host();
  echo "<meta http-equiv='refresh' content='5; URL=$url'>";
  include "connect.php";
}
function cbco_woo_host() {
  return site_url();
}
function cbco_chargeback_host() {
  $cbHost = 'https://app.chargeback.com';
	return $cbHost;
}

function scheme() {
    $scheme = $_SERVER['REQUEST_SCHEME'];
    if (!isset($scheme)) {
        if  (isset($_SERVER['HTTPS'])) {
            $scheme = ($_SERVER['HTTPS'] == 'off') ? 'http' : 'https';
        } else {
            $scheme = 'https';
        }
    }
    return $scheme;
}

function return_url(){
    $cbHost = cbco_chargeback_host();
    $scheme = scheme();
    $return_url = $scheme . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $cbHost . "/auth_tokens/new?location=login&url=$return_url";
}

function cbco_cb_key_set() {
    global $wpdb;
    $key = $wpdb->get_row( $wpdb->prepare( "
      SELECT key_id, description
      FROM {$wpdb->prefix}woocommerce_api_keys
      WHERE description like %s
    ", '%' . $wpdb->esc_like('Chargeback - API Read/Write') . '%'));
    if($key){
      return true;
    }
  }
