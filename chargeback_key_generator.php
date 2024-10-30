<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$filePath = str_replace('chargeback-for-woocommerce', 'woocommerce/includes/class-wc-auth.php', realpath(dirname(__FILE__)));
include_once($filePath);

class WC_CBCO_Chargeback_Key_Generator extends WC_Auth {
	function __construct() {
		parent::__construct();
	}

	public function cbco_generate_api_key() {
    $res = parent::create_keys("Chargeback", 1, "read_write");
    return $res;
  }
}

?>
