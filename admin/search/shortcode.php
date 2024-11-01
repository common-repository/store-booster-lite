<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Store_Booster_Lite_Search_Shortcode {

	public function __construct() {

		add_shortcode( 'sb-search-form', array( __CLASS__, 'addBody' ) );

	}

	/**
	 * Register Woo Ajax Search shortcode
	 *
	 * @param array $atts bool show_details_box
	 */
	public static function addBody( $atts ) {

		

		$searchArgs = shortcode_atts( array(
			'class'          => '',
			'layout'         => 'one',
		), $atts, 'sb-search-form' );

		$searchArgs['class'] .= empty( $search_args['class'] ) ? 'woocommerce' : ' woocommerce';

		$args = apply_filters( 'dgwt/wcas/shortcode/args', $searchArgs );

		return self::getForm( $args );
	}

	/**
	 * Display search form
	 *
	 * @param array args
	 *
	 * @return string
	 */

	public static function getForm( $args ) {

		

		ob_start();
		$filename = apply_filters( 'dgwt/wcas/form/partial_path', STORE_BOOSTER_LITE_PATH . 'admin/search/search-form.php' );
		if ( file_exists( $filename ) ) {
			include $filename;

			if ( function_exists( 'opcache_invalidate' ) ) {
				@opcache_invalidate( $filename, true );
			}
		}
		$html = ob_get_clean();

		return apply_filters( 'sb_search_form_html', $html, $args );
	}

}
new Store_Booster_Lite_Search_Shortcode();