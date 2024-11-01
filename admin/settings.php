<?php


if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly



class Store_Booster_Lite_Settings{

	public $sb_settings;
	public $sb_get_settings;


	public function __construct(){

		add_action( 'admin_menu', array( $this, 'register_menu' ) );

		add_action( 'wp_ajax_sb_save_settings_with_ajax', array( $this, 'sb_save_settings_with_ajax' ) );//save settings
		
	}

	

	/**
	 * Create an admin menu.
	 * @param
	 * @return void
	 * @since 1.0.0
	 */
	public function register_menu() {

		add_menu_page(
			esc_html__('Store Booster Lite','store-booster-lite'),
			esc_html__('Store Booster Lite','store-booster-lite'),
			'manage_options',
			'store-booster-lite',
			array( $this, 'admin_settings_page' ),
			plugins_url( '/', __FILE__ ).'assets/img/boost.png',
			30
		);

	}

	public function admin_settings_page(){

		echo '<div class="sb-settings-wrapper">';
			$this->setting_items(); 
			$this->settings_display_box();
		echo '</div>';

	}

	/**
	* Menu Items for settings
	*/
	public function setting_items(){

		?>
		<div class="menu-wrapp">

			<div class="plugin-info">
				<img src="<?php echo esc_url(STORE_BOOSTER_LITE_URL.'/admin/assets/img/bl-boost.png')?>">
				<h2 class="pl-name"><?php echo STORE_BOOSTER_LITE_DATA; ?></h2>
				<div class="pl-ver"><?php echo esc_html__('Version:','store-booster-lite') .STORE_BOOSTER_LITE_VER?></div>
			</div>

			<ul>
				<?php 
				$settings = $this->setting_menu_texts();
				
				foreach($settings as $key => $val ){
					
					echo '<li data-id="sb-'.esc_attr($key).'">';
						echo '<div class="menu-item"><span class="dashicons '.esc_attr($val['icon']).'"></span>'.esc_html($val['name']).'</div>';
						echo '<span class="menu-info">'.esc_html($val['info']).'</span>';
					echo '</li>';

				}?>
			
				
			</ul>
		</div>
		<?php 
	}

	/**
	* Arry needed for plugin setting menu  informations
	*
	*/
	public function setting_menu_texts(){

		$settings = array(

			'dashboard' => array(
				'name' => esc_html__('Dashboard','store-booster-lite'),
				'icon' => 'dashicons-admin-home',
				'info' => esc_html__('Get help, & plugin general informations','store-booster-lite'),

			),

			'search' => array(
				'name' => esc_html__('Search','store-booster-lite'),
				'icon' => 'dashicons-search',
				'info' => esc_html__('Manage product search related settings','store-booster-lite'),
			),

			'counters' => array(
				'name' => esc_html__('Counters','store-booster-lite'),
				'icon' => 'dashicons-visibility',
				'info' => esc_html__('Manage product sales & view count','store-booster-lite'),
			),

			

			'login_signup' => array(
				'name' => esc_html__('Login & Signup','store-booster-lite'),
				'icon' => 'dashicons-admin-users',
				'info' => esc_html__('Manage login & signup to your store','store-booster-lite'),
			),

			'cart' => array(
				'name' => esc_html__('Cart','store-booster-lite'),
				'icon' => 'dashicons-cart',
				'info' => esc_html__('Boosters for WooCommerce cart','store-booster-lite'),
			),
			'filter' => array(
				'name' => esc_html__('Filter','store-booster-lite'),
				'icon' => 'dashicons-filter',
				'info' => esc_html__('Options to manager product filters','store-booster-lite'),
			),


			

			
		);

		return $settings;
	}

	/**
	* Get setting headers
	*
	* @see setting_menu_texts() -- for setting id
	*/
	public function get_setting_titles( $setting_id = 'dashboard' ){
		$settings = $this->setting_menu_texts();
		
		echo '<div class="setting-title">';
		echo '<span class="dashicons '.esc_attr($settings[$setting_id]['icon']).'"></span>';
		echo '<h3>'.esc_html($settings[$setting_id]['name']).'</h3>';
		echo '</div>';
		
		
	}

	public function get_sb_options(){
			
			$this->sb_get_settings = get_option('sb_save_settings',$this->default_values());
			
			if(empty($this->sb_get_settings)){
		   		update_option( 'sb_save_settings', $this->default_values() );
		    }
		    $sb_new_settings = array_diff_key( $this->default_values(), $this->sb_get_settings );
		    if( ! empty( $sb_new_settings ) ) {
		   		$sb_updated_settings = array_merge( $this->sb_get_settings, $sb_new_settings );
		   		update_option( 'sb_save_settings', $sb_updated_settings );
		    }
		    $this->sb_get_settings = get_option( 'sb_save_settings', $this->default_values() );

		    return $this->sb_get_settings;

	}

	public function settings_display_box(){
		?>
		<div class="setting-display-wrapper">
			<div class="save-notice" style="display: none;">
				<?php esc_html_e('Settings have changed, you should save them!','store-booster-lite'); ?>
			</div>
			<form action="" method="post" id="wpop-sb-form-values" name="sb_settings">

			<?php

			$this->sb_get_settings = get_option('sb_save_settings',$this->default_values());
			
			if(empty($this->sb_get_settings)){
		   		update_option( 'sb_save_settings', $this->default_values() );
		    }
		    $sb_new_settings = array_diff_key( $this->default_values(), $this->sb_get_settings );
		    if( ! empty( $sb_new_settings ) ) {
		   		$sb_updated_settings = array_merge( $this->sb_get_settings, $sb_new_settings );
		   		update_option( 'sb_save_settings', $sb_updated_settings );
		    }
		    $this->sb_get_settings = get_option( 'sb_save_settings', $this->default_values() );

		   
		    //include required plugin setting files
			$files = array(
				'dashboard',
				'settings-search',
				'settings-counters',
				'settings-login-signup',
				
			);
			foreach( $files as $file ){

				$path = STORE_BOOSTER_LITE_PATH.'admin/' . $file . '.php';
	            if( file_exists( $path ) ) {
	                require_once $path;
	            }
			}
			?>
			
			<input type="submit" value="Save settings" class="button button-primary sb-save-btn"/>
			</form>		
		</div>
		<?php 
	}

	


	//plugin default values
	public function default_values(){

		$default_settings = array(

			'sb_enable_search' 			=> 0,
			'sb_search_layouts' 		=> 'one',
			'sb_search_placeholder' 	=> esc_html__('Search Products','store-booster-lite'),
			'sb_search_btn_txt' 		=> esc_html__('Search','store-booster-lite'),
			'sb_search_btn_layouts' 	=> 'type-button',
			'sb_enable_pr_sales_ctr' 	=> 0,
			'sb_enable_pr_sales_ctr_ar' => 0,
			'sb_enable_pr_fke_sales' 	=> 0,
			'sb_enable_pr_fke_value' 	=> 0,
			'sb_enable_login' 			=> 0,
			'sb_login_btn_layouts' 		=> 'one',
			'sb_login_form_layouts' 	=> 'one',
			'sb_enable_pr_sticky_bar' 	=> 0,
			'sb_enable_pr_quick_view' 	=> 0,
		  
		);

		return $default_settings;
	}
	

	//save settings to db
	public function sb_save_settings_with_ajax(){
		
		check_ajax_referer('store-booster-lite','security');

		parse_str( $_POST['fields'], $settings );
		

		$this->sb_settings = array(

			'sb_enable_search' 				=> (int) isset($settings['sb_enable_search']) ? 1 : 0,
			'sb_search_layouts' 			=> sanitize_text_field($settings['sb_search_layouts']),
			'sb_search_placeholder' 		=> sanitize_text_field($settings['sb_search_placeholder']),
			'sb_search_btn_txt' 			=> sanitize_text_field($settings['sb_search_btn_txt']),
			'sb_search_btn_layouts' 		=> sanitize_text_field($settings['sb_search_btn_layouts']),
			'sb_enable_pr_sales_ctr' 		=> (int) isset($settings['sb_enable_pr_sales_ctr']) ? 1 : 0,
			'sb_enable_pr_sales_ctr_ar' 	=> (int) isset($settings['sb_enable_pr_sales_ctr_ar']) ? 1 : 0,
			'sb_enable_pr_fke_sales' 		=> (int) isset($settings['sb_enable_pr_fke_sales']) ? 1 : 0,
			'sb_enable_pr_fke_value' 		=> sanitize_text_field($settings['sb_enable_pr_fke_value']),
			'sb_enable_login' 				=> (int) isset($settings['sb_enable_login']) ? 1 : 0,
			'sb_login_btn_layouts' 			=> sanitize_text_field($settings['sb_login_btn_layouts']),
			'sb_login_form_layouts' 		=> sanitize_text_field($settings['sb_login_form_layouts']),
			'sb_enable_pr_sticky_bar' 		=> (int) isset($settings['sb_enable_pr_sticky_bar']) ? 1 : 0,
			'sb_enable_pr_quick_view' 		=> (int) isset($settings['sb_enable_pr_quick_view']) ? 1 : 0,
		);

		
		if( isset($_POST['fields'])  ) {
			update_option( 'sb_save_settings', $this->sb_settings );
		}

		return true;
		die();
 	}






}
new Store_Booster_Lite_Settings();