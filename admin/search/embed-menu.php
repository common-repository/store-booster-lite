<?php
/**
* Embed product search via WordPress menus
*
*/
if ( !class_exists('Store_Booster_Lite_Custom_Nav')) {
    class Store_Booster_Lite_Custom_Nav {

    	const SEARCH_PLACEHOLDER 			= 'sb_search_box';
    	const LOGIN_PLACEHOLDER 			= 'sb_login_box';
    	

    	public function __construct(){

    		if ( is_admin() ) {
	    		add_action( 'admin_head-nav-menus.php', array( $this, 'add_nav_menu_meta_boxes' ) );
	    		add_action( 'admin_footer', array( $this, 'menu_scripts' ) );
    		} else {

			add_filter( 'walker_nav_menu_start_el', array( $this, 'processMenuItem' ), 50, 2 );
			add_filter( 'megamenu_walker_nav_menu_start_el', array( $this, 'processMenuItem' ), 50, 2 );

			}

    	}

    	/**
		 * Modifies the menu item display on frontend.
		 *
		 * @param string $itemOutput
		 *
		 * @return string
		 */
		public function processMenuItem( $itemOutput ) {

			if (
				! empty( $itemOutput )
				&& is_string( $itemOutput )
				&& strpos( $itemOutput, self::SEARCH_PLACEHOLDER ) !== false
			) {
				$itemOutput = do_shortcode( '[sb-search-form]' );
			}

			//process login form output
			if(
				! empty( $itemOutput )
				&& is_string( $itemOutput )
				&& strpos( $itemOutput, self::LOGIN_PLACEHOLDER ) !== false
			){
				$itemOutput = do_shortcode( '[sb-login-form]' );
			}


			return $itemOutput;
		}

    	/**
		 * Check if nav-menus screen is active
		 *
		 */
		private function is_nav_active() {
			$isNav  = false;
			$screen = get_current_screen();

			if ( ! empty( $screen->id ) && ( $screen->id === 'nav-menus' ) ) {
				$isNav = true;
			}

			return $isNav;
		}

        public function add_nav_menu_meta_boxes() {
        	add_meta_box(
        		'sb_nav_link',
        		__('Store Booster'),
        		array( $this, 'nav_menu_link'),
        		'nav-menus',
        		'side',
        		'low'
        	);
        }
        
        public function nav_menu_link() { ?>
        	<div id="posttype-wl-login" class="posttypediv">
        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
        				<li>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php esc_html_e('Product Search Bar','store-booster-lite'); ?>
        					</label>

        					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom"/>
							<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="sb_search_box">
							<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]"/>

        				</li>
        				<?php $this->sb_login_menu(); ?>
        				
        			</ul>
        		</div>
        		<p class="button-controls">
        			<span class="list-controls">
        				<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all"><?php esc_html_e('Select All','store-booster-lite'); ?></a>
        			</span>
        			<span class="add-to-menu">
        				<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','store-booster-lite')?>" name="add-post-type-menu-item" id="submit-posttype-wl-login">
        				<span class="spinner"></span>
        			</span>
        		</p>
        	</div>



        <?php }

        public function sb_login_menu(){ ?>
        	
			<li>
				<label class="menu-item-title">
					<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php esc_html_e('Login/Signup','store-booster-lite'); ?>
				</label>

				<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom"/>
				<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="sb_login_box">
				<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]"/>

			</li>
        			
		<?php
        }


      

        

        public function menu_scripts() {

		if ( ! $this->is_nav_active() ) {
			return;
		}
		$adm_assets = STORE_BOOSTER_LITE_URL.'/admin/assets/';

		wp_enqueue_script( 'sb-admin-menu', $adm_assets . 'js/sb-admin-menus.js', array( 'jquery' ), STORE_BOOSTER_LITE_VER, true );
		$args = [
			'icon' => $adm_assets.'/img/bl-boost.png'
		];
		wp_localize_script('sb-admin-menu', 'sbAdmin', $args );

		}



    }
}

new Store_Booster_Lite_Custom_Nav();