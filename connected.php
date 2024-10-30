<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class='chargeback_plugin_header_container'>
  <img src="<?php echo $plugin_dir; ?>/images/2016-horizontal-400px.png" class='chargeback_plugin_logo'>
  <span class="chargeback_plugin_header"> | Simplified Dispute Resolution for WooCommerce Stores </span>
</div>
<div>
  <div class="chargeback_plugin_left chargeback_plugin_wbg">
    <img src="<?php echo $plugin_dir; ?>/images/Woo-Flip-Connected.gif" class='chargeback_plugin_cbdemo'>
    <p>Your store is connected to the Chargeback App</p>
    <p>Remember to connect your payment gateway and merchant account.</p>
	<p>To manage disputes or remove this connection login to the <a href="<?php echo cbco_chargeback_host();?>/dashboard" target="_blank">Chargeback App.</p>

    <div>
      <div class='columns'>
        <div class='column'><a href="<?php echo admin_url('admin.php?page=wc-settings&tab=api&section=keys');?>">DISCONNECT</a></div>
        <div class='column'><a href="<?php echo cbco_chargeback_host();?>/connections" target="_blank" class="chargeback_plugin_button">View Dashboard</a></div>
      </div>
    </div>

  </div>
  <div class='chargeback_plugin_clearfix'></div>
</div>
