<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

include "chargeback_key_generator.php";
include "retrieve_api.php";

class WC_CBCO_Chargeback {
	public static function init() {
        add_action('admin_menu', __CLASS__ . '::add_settings');
        add_action('admin_notices', __CLASS__ . '::cb_admin_notices');
        add_action('admin_enqueue_scripts',  __CLASS__ . '::cbco_cb_scripts');
        add_filter('plugin_action_links', __CLASS__ . '::add_settings_link', 10, 2);
	}

  public static function cb_admin_notices() {
      if (get_transient('activate_notice_cbwoo') && is_plugin_active("woocommerce-chargeback/chargeback.php")) {
          echo "<div class='notice notice-success is-dismissible'><p>Chargeback is almost connected. To finish, <a href='admin.php?page=woocommerce-chargeback'>Connect your Chargeback Account</a>.</p></div>";
      }
  }

  public static function cbco_cb_scripts() {
      $plugin_dir = plugin_dir_url( __FILE__);
      wp_enqueue_style( 'cbco_cb_stylesheet', $plugin_dir . "assets/cb_style.css" );
      wp_enqueue_script( 'cbco_cb_js_re', $plugin_dir . "assets/cb_refresh.js", array(), '1.0.0', true );
  }

  public static function add_settings_link($links, $file) {
      static $this_plugin;
      $this_plugin = "woocommerce-chargeback/chargeback.php";
      if ($file == $this_plugin){
        $settings_link = '<a href="admin.php?page=woocommerce-chargeback">'.__("Settings", "chargeback").'</a>';
          array_unshift($links, $settings_link);
      }
      return $links;
  }

  public static function add_settings() {
		add_options_page(
			'Chargeback',
			'Chargebacks',
			'manage_options',
			'woocommerce-chargeback',
			__CLASS__ . '::get_settings'
		);
	}

	public static function get_settings() {
    $plugin_dir = plugin_dir_url( __FILE__);
		?>
		<h1>Chargeback Settings</h1>
		<?php

    if (cbco_cb_key_set() && !isset($_REQUEST['cb_return_status'])){
      //Key is setup in woocommerce
      include "connected.php";
    } else	if (!isset($_REQUEST['_cb_auth_token'])) {
      //CB not authed yet
        $return_url = return_url();
        echo "<a class='button-primary' href='$return_url' target='_blank' onclick='cbDelayRedirectToModule();' alt='Authenticate With Chargeback' />NEXT STEP: CONNECT CHARGEBACK </a>";
      include "activate.php";
		} else if (!isset($_REQUEST['cb_return_status'])) {
      cbco_handle_api_key();
		} else {
			if ($_REQUEST['cb_return_status'] == 'success') {
				$url = cbco_chargeback_host() . '/connections?partner=true';
				echo "<meta http-equiv='refresh' content='5; URL=$url'>";
        include "connect.php";
			} else {
				echo "<p>Something went wrong updating your API key. Please try again in a few minutes or contact <a href='https://chargeback.com/contact/' target='_blank'>Chargeback Support</a>.</p>";
			}
		}
	}
}
