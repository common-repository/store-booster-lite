<?php
/**
 * Plugin Name: Store Booster Lite
 * Plugin URI: https://wpoperation.com/plugins/store-booster-lite/
 * Description: This is powerful and useful addon for WooCommerce, this plugin adds some extra features to the WooCommerce which definitely will make your online life easier. This plugin is very useful tool for any ecommerce sites. It adds useful function to WooCommerce and helps to increase your revenue.
 * Version: 1.0.0
 * Author: WPoperation
 * Author URI:  https://wpoperation.com/
 * Text Domain: store-booster-lite
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */


if ( !defined( 'WPINC' ) ) {
    die();
}

define( 'STORE_BOOSTER_LITE_DATA', 'Store Booster Lite' ); ;
define( 'STORE_BOOSTER_LITE_VER', '1.0.0' );

define( 'STORE_BOOSTER_LITE_FILE', __FILE__ );
define( 'STORE_BOOSTER_LITE_BASENAME', plugin_basename( STORE_BOOSTER_LITE_FILE ) );
define( 'STORE_BOOSTER_LITE_PATH', plugin_dir_path( STORE_BOOSTER_LITE_FILE ) );
define( 'STORE_BOOSTER_LITE_URL', plugins_url( '/', STORE_BOOSTER_LITE_FILE ) );


if ( !class_exists( 'Store_Booster_Lite' ) ):

	class Store_Booster_Lite {

		/**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;


         /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @access public
         * @return object
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

		/**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {

            // Load translation files
            add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
            add_action( 'wp_head', array($this, 'init'));
            

            add_action('wp_enqueue_scripts', array($this,'sb_load_styles') ); //load styles for frontend
            add_action('wp_enqueue_scripts',array ($this, 'sb_load_scripts') ); //loas scripts for frontend
            add_action('admin_enqueue_scripts', array($this,'sb_load_admin_scripts') );

            //ajax search
            add_action('wp_ajax_sb_product_search_ajax', array($this,'sb_product_search_ajax') );
            add_action( 'wp_ajax_nopriv_sb_product_search_ajax', array($this, 'sb_product_search_ajax') );

            add_filter( 'body_class', array($this,'store_booster_lite_woo_class') );

            $this->include();
           
            
        }


		/**
         * Loads the translation files.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function load_plugin_textdomain() {

            load_plugin_textdomain( 'store-booster-lite', false, basename( dirname( __FILE__ ) ) . '/languages' );
        }


        /**
        * Require files for the plugin
        */
        public function init(){
            
          require_once STORE_BOOSTER_LITE_PATH .'admin/counters/product-counter-functions.php';
          
          require_once STORE_BOOSTER_LITE_PATH .'admin/sb-functions/single-product.php';
        

        }




        public function include(){

            require_once STORE_BOOSTER_LITE_PATH .'admin/settings.php';

            require_once STORE_BOOSTER_LITE_PATH .'admin/search/shortcode.php';
            require_once STORE_BOOSTER_LITE_PATH .'admin/search/embed-menu.php';

            require_once STORE_BOOSTER_LITE_PATH .'admin/logins/login-hooks.php';
            require_once STORE_BOOSTER_LITE_PATH .'admin/logins/shortcode.php';

            require_once STORE_BOOSTER_LITE_PATH .'admin/sb-functions/quick-view.php';
        }

       

        /**
        * Enqueue styles for frontend
        */
        function sb_load_styles() {

            $view_assets = STORE_BOOSTER_LITE_URL.'/views/assets/';

           wp_register_style( 'store-booster-frontend', $view_assets . 'css/style.css', array(), STORE_BOOSTER_LITE_VER );
           wp_register_style( 'store-booster-responsive', $view_assets . 'css/responsive.css', array(), STORE_BOOSTER_LITE_VER );
           wp_register_style( 'store-booster-single-sticky', $view_assets . 'css/single-sticky.css', array(), STORE_BOOSTER_LITE_VER );

        }


        /**
        * Enqueue scripts for frontend
        */
        function sb_load_scripts() {

            $view_assets = STORE_BOOSTER_LITE_URL.'/views/assets/';
            wp_register_script( 'store-booster-frontend', $view_assets . 'js/sb-frontend.js', array( 'jquery' ), STORE_BOOSTER_LITE_VER, true );

            $localize_options =  array(
                'ajaxurl'       => admin_url( 'admin-ajax.php')
                );

            wp_localize_script( 'store-booster-frontend', 'sb_val', $localize_options  );
            wp_enqueue_script( 'store-booster-frontend' );

        }

       

        /**
        * enque scripts for backend
        *
        */
        function sb_load_admin_scripts() {

        	$adm_assets = STORE_BOOSTER_LITE_URL.'/admin/assets/';

          if( isset( $_GET['page'] ) && $_GET['page'] == 'store-booster-lite' ) {

          	wp_enqueue_style( 'store-booster-admin', $adm_assets . 'css/style.css', array(), STORE_BOOSTER_LITE_VER );
            wp_enqueue_style( 'sweetalert2', $adm_assets . 'css/sweetalert2.min.css', array(), STORE_BOOSTER_LITE_VER );

          	wp_enqueue_script( 'sweetalert2', $adm_assets . 'js/sweetalert2.min.js', array( 'jquery' ), STORE_BOOSTER_LITE_VER, true );
          	wp_register_script( 'store-booster-admin', $adm_assets . 'js/sb-admin.js', array( 'jquery' ), STORE_BOOSTER_LITE_VER, true );

            $localize_args = array(
                'security'  => wp_create_nonce('store-booster-lite')
            );
            wp_localize_script( 'store-booster-admin', 'sbAdm', $localize_args  );
            wp_enqueue_script( 'store-booster-admin' );


          }

        }



       

         /**
    * Ajax Search function
    *
    */
    function sb_product_search_ajax(){

       
        ob_start();

        $key = sanitize_text_field($_POST['key']);
        $cat = sanitize_text_field($_POST['cat']);
        
        if( $cat == '0' || empty($cat) ){
            
            $args = array(
                    's'                 => esc_html($key),
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'orderby'           => 'title', 
                    'order'             => 'ASC' 
            );

        }else{
            
            $args = array(
                's'                 => esc_html($key),
                'post_type'         => 'product',
                'post_status'       => 'publish',
                'orderby'           => 'title', 
                'order'             => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => esc_html($cat)
                    )
                ) 
            );  

        }
                
        $the_query = new WP_Query( $args);
        ?>
          <div class="search-res-wrap">   
            <?php
            if( $the_query->have_posts() ){
                
                while( $the_query->have_posts() ): $the_query->the_post(); 

                    ?>
                    
                        <div class="search-content-wrap">
                           
                            <div class="cont-search-wrap">
                                <div class="title">
                                    <a href="<?php the_permalink()?>">
                                        <?php 
                                        $title = get_the_title();
                                        $str =  str_ireplace($key,"<strong>".$key."</strong>",$title);
                                        echo wp_kses_post($str);
                                        ?>
                                    </a>
                                </div>
                                <div class="price">
                                    <?php woocommerce_template_single_price(); ?>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                            </div>
                        </div>
                        
                    
                    <?php
                    endwhile;
                    }else{ ?>
                        <div class="no-match">
                            <?php esc_html_e('No Match Found','store-booster-lite'); ?>
                        </div>
                    <?php 
                    }
                    wp_reset_postdata(); ?>
            </div>
        <?php             
        $ajax_html = ob_get_contents();
        ob_get_clean();
        echo ''.$ajax_html; //Escaping of all variables already done above
        die();
    }
    /**
    * Modify body classes
    *
    */
    
    function store_booster_lite_woo_class($class){

      $class[] = 'woocommerce';

      return $class;

    }

   




    }
endif;

if ( !function_exists( 'store_booster_lite_init' ) ) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function store_booster_lite_init() {
        return Store_Booster_Lite::get_instance();
    }

}

store_booster_lite_init();