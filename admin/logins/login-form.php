<?php 
/**
* Template file to display login & signup to frontend
*
*
*/

wp_print_styles( array( 'store-booster-frontend','dashicons','store-booster-responsive' ) );

$sb_settings 	= new Store_Booster_Lite_Settings();
$settings 		= $sb_settings->get_sb_options();

$sb_enable_login 		= $settings['sb_enable_login'];

if( $sb_enable_login ){
	update_option('woocommerce_enable_myaccount_registration','yes');
}else{
	update_option('woocommerce_enable_myaccount_registration','no');
}


do_action('store_booster_lite_login_button_hook');

do_action('store_booster_lite_woo_login_form');



