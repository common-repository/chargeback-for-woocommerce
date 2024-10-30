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
  <div class="chargeback_plugin_left chargeback_plugin_right_copy">
    <h2>Getting started is easy</h2>
    <p>Follow these steps to get up and running today.</p>
    <ol>
      <li> Connect your WooCommerce Store</li>
      <li> Connect your payment gateways and merchant accounts</li>
      <li> Review the <a href="https://chargebackhelp.zendesk.com/hc/en-us" target="new">getting started guide and support docs</a></li>
      <li> Book some <a href="https://chargeback.com/app-training" target="new">free training</a> with our team</li>
    </ol>
	<div class='button button_chargeback'><a href="<?php echo $return_url; ?>" target="_blank" onclick="cbDelayRedirectToModule();">Login or Create Your Chargeback Account</a></div>
  </div>
  <div class="chargeback_plugin_left chargeback_plugin_wbg">
    <img src="<?php echo $plugin_dir; ?>/images/chargeback_overview_wp.png" class='chargeback_plugin_cbdemo'>
    <p>Connect your account with the Chargeback App to link data.</p>
  </div>
  <div class='chargeback_plugin_clearfix'></div>
</div>
