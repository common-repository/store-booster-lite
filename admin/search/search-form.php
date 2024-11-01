<?php
/*
* Search form
*
*/
//use Store_Booster\Store_Booster_Lite_Settings;
wp_print_styles( array( 'store-booster-frontend','dashicons' ) ); 

$sb_settings 	= new Store_Booster_Lite_Settings();
$settings 		= $sb_settings->get_sb_options();


$sb_search_layouts 		= $settings['sb_search_layouts'];
$sb_search_placeholder 	= $settings['sb_search_placeholder'];
$sb_search_btn_layouts 	= $settings['sb_search_btn_layouts'];
$sb_search_btn_txt 		= $settings['sb_search_btn_txt'];
$sb_search_sticky 		= '';



/**
* Search button layout type
*
*/
if ( ! function_exists('sb_search_button_type')):
function sb_search_button_type(){

	$sb_settings 	= new Store_Booster_Lite_Settings();
	$settings 		= $sb_settings->get_sb_options();

	$sb_search_btn_layouts 	= $settings['sb_search_btn_layouts'];
	$sb_search_btn_txt 		= $settings['sb_search_btn_txt'];
	?>
	<?php if( $sb_search_btn_txt && ($sb_search_btn_layouts == 'type-button') ){ ?>
	<button class="searchsubmit sb-srch" type="submit"><?php echo esc_html($sb_search_btn_txt); ?></button>
	<?php } ?>

	<?php if( ($sb_search_btn_layouts == 'type-icon') ){ ?>
	<button class="sb-search-icon"><span class="dashicons dashicons-search"></span></button>
	<?php } ?>
	<?php
}
endif;


if( $settings['sb_enable_search'] == 0 ){
	return;
}

if( $sb_search_layouts == 'one' ):
?>
<div class="sb-search-wrapper layout-<?php echo esc_attr($sb_search_layouts.' '.$sb_search_sticky.' '.$sb_search_btn_layouts)?>">
	<form role="search" method="get" class="sb-woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<img src="<?php echo esc_url(STORE_BOOSTER_LITE_URL.'/views/assets/img/loading.gif')?>" style="display: none;" class="loader">
	<input type="search" id="woocommerce-product-search-field" class="search-field op-srch" placeholder="<?php echo esc_attr( $sb_search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>

	<?php sb_search_button_type(); ?>

	<div class="search-content" style="display: none;"></div>
	<input type="hidden" name="post_type" value="product" />
	</form>
	
</div>

<?php endif; ?>

<?php
/**
* Advanced Product search
*
*/
if( $sb_search_layouts == 'two' ):
?>
<div class="sb-advance-product-search-wrapper sb-search-wrapper layout-<?php echo esc_attr($sb_search_layouts.' '.$sb_search_sticky.' '.$sb_search_btn_layouts)?>">

    <div class="advance-product-search">
        <form role="search" method="get" class="sb-woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_url(STORE_BOOSTER_LITE_URL.'/views/assets/img/loading.gif')?>" style="display: none;" class="loader">
        <input type="search" id="woocommerce-product-search-field" class="search-field op-srch" placeholder="<?php echo esc_attr( $sb_search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
        <?php
            $woo_terms = get_terms( array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'parent'     => 0,
            ) );
            if (  ! empty( $woo_terms ) && ! is_wp_error( $woo_terms ) ) {
                $select_cat = ( isset( $_GET['product_category'] ) ) ? absint( $_GET['product_category'] ) : '' ;
        ?>
                <select class="sb-select-products op-srch" name="product_category">
                    <option value=""><?php esc_html_e( 'All Categories', 'store-booster-lite' ); ?></option>
                    <?php foreach ( $woo_terms as $cat ) { ?>
                        <option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php selected( $select_cat, $cat->term_id ); ?> ><?php echo esc_html( $cat->name ); ?></option>
                    <?php } ?>
                </select>
        <?php } ?>

            <?php sb_search_button_type(); ?>
            <div class="search-content" style="display: none;"></div>
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>

</div>

<?php endif;
