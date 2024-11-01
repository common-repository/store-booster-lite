<?php 
/**
* Quick view products
*
*/


add_action('woocommerce_single_product_summary','store_booster_lite_quick_view_button',35);
add_action('woocommerce_shop_loop_item_title','store_booster_lite_quick_view_button',15);

if( ! function_exists('store_booster_lite_quick_view_button')):
	function store_booster_lite_quick_view_button(){
		$sb_settings 			 = new Store_Booster_Lite_Settings();
		$settings 				 = $sb_settings->get_sb_options();
		$sb_enable_pr_quick_view = $settings['sb_enable_pr_quick_view'];
		if( $sb_enable_pr_quick_view == 0 ){
			return;
		}

		global $product;
		$id = $product->get_id();
		?>
		<div class="sb-btn-quick-view">

		<a href="javascript:void(0)" class="sb-quick-view" data-id="<?php echo esc_attr($id);?>">
			<span class="dashicons dashicons-visibility"></span>
			<?php esc_html_e('Quick View','store-booster-lite'); ?>
		</a>
		</div>
		<?php 
	}
endif;



add_action('woocommerce_after_main_content','store_booster_lite_quick_view_box');
if( ! function_exists('store_booster_lite_quick_view_box')):
	function store_booster_lite_quick_view_box(){
		$sb_settings 			 = new Store_Booster_Lite_Settings();
		$settings 				 = $sb_settings->get_sb_options();
		$sb_enable_pr_quick_view = $settings['sb_enable_pr_quick_view'];
		if( $sb_enable_pr_quick_view == 0 ){
			return;
		}

		?>
		<div class="sb-quick-view-outer">
		<div class="sb-quick-view-overlay"></div>
		<?php store_booster_lite_loading_animation(); ?>
		<div class="sb-quick-view-wrapp"></div>
		</div>
		<?php
	}
endif;


add_action( 'wp_ajax_store_booster_lite_quick_view', 'store_booster_lite_quick_view' );
add_action( 'wp_ajax_nopriv_store_booster_lite_quick_view', 'store_booster_lite_quick_view' );
if(! function_exists('store_booster_lite_quick_view')):
	function store_booster_lite_quick_view(){

		ob_start();
		$post_id = absint(wp_unslash($_POST['post_id']));
		
		$args = array(
            'post_type' => 'product',
            'p' => absint($post_id),
        );
        $query = new WP_Query( $args );
        ?>
        
		<div class="sb-product-wrapper">
	        <?php 
	        if ( $query->have_posts() ) : 
	        	while ( $query->have_posts() ) : $query->the_post();
	        		?>
	        		<div class="sb-pr-title">
	        			<a href="<?php the_permalink();?>"><?php the_title();?></a>

	        			<div class="close-wrapp">
							<a href="javascript:void(0)">
							<span class="dashicons dashicons-no-alt"></span>
							</a>
						</div>

	        		</div>
	        		<div class="product-inner">
		        		<div class="quick-img-wrapp">
		        			<?php echo woocommerce_get_product_thumbnail('large'); ?>	
		        		</div>

		        		<div class="sb-quick-content-wrapp">
			        		<?php 
			        		woocommerce_template_single_rating();
			        		?>
			        		<div class="price-wrapp">
			        		<?php  woocommerce_template_single_price(); ?>
			        		<?php woocommerce_show_product_sale_flash(); ?>	
			        		</div>
			        		<?php 
			        		woocommerce_template_single_excerpt();
			        		woocommerce_template_single_add_to_cart();
			        		woocommerce_template_single_sharing();
			        		?>
		        		</div>
	        		</div>

	        		<?php 
	        	endwhile;
	        	wp_reset_postdata();
	        endif;

        echo '</div>';
		


		
		$sb_html = ob_get_contents();
        ob_get_clean();
        echo $sb_html;
        die();

	}
endif;


function store_booster_lite_loading_animation(){
	?>
	<div class="store-booster-anime"><div></div><div></div><div></div><div></div></div>
	<?php 
}