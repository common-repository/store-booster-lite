<?php

/**
* Function to display product sales counter
*
*/
function store_booster_lite_product_sales_count() {

	global $product;

	$sb_settings 				= new Store_Booster_Lite_Settings();
	$settings 					= $sb_settings->get_sb_options();
	$sb_enable_pr_fke_sales 	= $settings['sb_enable_pr_fke_sales'];
	$sb_enable_pr_fke_value 	= $settings['sb_enable_pr_fke_value'];

	

	$real_units_sold = get_post_meta( $product->get_id(), 'total_sales', true );	


	if( $sb_enable_pr_fke_sales ){
		$units_sold = $sb_enable_pr_fke_value;
	}elseif( $real_units_sold > 0  ){
		$units_sold =  $real_units_sold;
	}else{
		$units_sold = $real_units_sold;
	}

  	

  	if( $units_sold < 2 ){
  	echo '<div class="sb-product-counter">' . sprintf( __( '<span>%s</span> item sold', 'store-booster-lite' ), absint($units_sold) ) . '</div>';	
  }else{
  	echo '<div class="sb-product-counter">' . sprintf( __( '<span>%s</span> items sold', 'store-booster-lite' ), absint($units_sold) ) . '</div>';
  }
  	
}
 

$sb_settings 				= new Store_Booster_Lite_Settings();
$settings 					= $sb_settings->get_sb_options();
$sb_enable_pr_sales_ctr 	= $settings['sb_enable_pr_sales_ctr'];
$sb_enable_pr_sales_ctr_ar 	= $settings['sb_enable_pr_sales_ctr_ar'];

if( $sb_enable_pr_sales_ctr ){
	add_action( 'woocommerce_single_product_summary',  'store_booster_lite_product_sales_count', 8 );	
}

if( $sb_enable_pr_sales_ctr_ar ){
add_action( 'woocommerce_shop_loop_item_title',  'store_booster_lite_product_sales_count', 11 );	
}

