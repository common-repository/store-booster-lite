<?php
/*
* Additional features for single product page
*
*
*
*/
add_action('woocommerce_after_single_product','sb_single_product_sales_bar');
if( ! function_exists('sb_single_product_sales_bar')):
	function sb_single_product_sales_bar(){
		global $product;

		$sb_settings 			 = new Store_Booster_Lite_Settings();
		$settings 				 = $sb_settings->get_sb_options();
		$sb_enable_pr_sticky_bar = $settings['sb_enable_pr_sticky_bar'];

		if( $sb_enable_pr_sticky_bar == 0 ){
			return;
		}

		wp_print_styles( array( 'store-booster-single-sticky' ) );
		?>
		<div class="sb-single-product-sales-bar">
			<div class="sb-container">
			<div class="left-wrapp">
				<div class="img-wrapp">
					<?php echo woocommerce_get_product_thumbnail('thumb');  ?> 
				</div>
				<?php woocommerce_template_single_title(); ?>

				
			</div>
			<div class="right-wrapp">
				<?php 
				  	woocommerce_template_single_price();
					woocommerce_template_single_add_to_cart();
				 ?>
				
			</div>
			</div>
		</div>
		<?php
	}
endif;