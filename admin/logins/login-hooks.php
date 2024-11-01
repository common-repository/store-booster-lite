<?php
/**
* Related functions for login & signup module
*
*/






add_action('store_booster_lite_login_button_hook','store_booster_lite_login_button_hook');

function store_booster_lite_login_button_hook(){

$sb_settings 	= new Store_Booster_Lite_Settings();
$settings 		= $sb_settings->get_sb_options();

$sb_enable_login 		= $settings['sb_enable_login'];
$sb_login_btn_layouts 	= $settings['sb_login_btn_layouts'];


if( $sb_login_btn_layouts == 'one' ){ ?>
		<div class="sb-logins-wrapp">
			<div class="icon-wrapp">
				<a href="javascript:void(0)">
				<span class="dashicons dashicons-admin-users"></span>
				</a>
			</div>
			<div class="text-wrapp">
				<a href="javascript:void(0)">
				<span class="sm-text"><?php esc_html_e('Hello, Sign in','store-booster-lite'); ?> </span>
				<span class="lg-text"> <?php esc_html_e('My Account','store-booster-lite'); ?> </span>
				</a>
			</div>
		</div>

	<?php
	}elseif( $sb_login_btn_layouts == 'two' ){ ?>
		<div class="sb-logins-wrapp">
			<div class="text-wrapp">
				<a href="javascript:void(0)">
				<span class="lg-text"> <?php esc_html_e('Login/Register','store-booster-lite'); ?> </span>
				</a>
			</div>
		</div>
	<?php 
	}elseif( $sb_login_btn_layouts == 'three' ){ ?>
		<div class="sb-logins-wrapp">
			<div class="icon-wrapp">
				<a href="javascript:void(0)">
				<span class="dashicons dashicons-admin-users"></span>
				</a>
			</div>
			
		</div>
	<?php 
	}

}


/**
* Login & signup function
* used from WooCommerce 
* 
*/
add_action('store_booster_lite_woo_login_form','store_booster_lite_woo_login_form');
function store_booster_lite_woo_login_form(){

	$sb_settings 			= new Store_Booster_Lite_Settings();
	$settings 				= $sb_settings->get_sb_options();
	$sb_login_form_layouts 	= $settings['sb_login_form_layouts'];

	$class1 = '';
	if( $sb_login_form_layouts == 'two' ){
		$class1 = 'sb-col sb-col1';
	}
	

if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
<div class="sb-woo-login-outer layout-<?php esc_attr_e($sb_login_form_layouts);?>">
<div class="sb-login-bg-overlay"></div>
<div class="u-columns col2-set sb-customer-login" id="customer_login">
	<div class="close-form">
			<a href="javascript:void(0)">
				<span class="text"><?php esc_html_e('CLOSE','store-booster-lite'); ?> </span>
				<span class="dashicons dashicons-no-alt"></span>
			</a>
		</div>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
	
	<div class="sb-toogle-lr-wrapp">
		<div class="sb-item sb-item1 active" data-id="sb-item1">
			<span class="dashicons dashicons-unlock"></span>
			<a href="javascript:void(0)"><?php esc_html_e('Sign in'); ?></a>
		</div>

		<div class="sb-item sb-item1" data-id="sb-item2">
			<span class="dashicons dashicons-admin-users"></span>
			<a href="javascript:void(0)"><?php esc_html_e('Sign up'); ?></a>
		</div>
		
	</div>

	<div class="sb-toogle-form sb-toogle-login <?php esc_attr_e($class1);?> sb-item1 active">
		

<?php endif; ?>

		

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'store-booster-lite' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'store-booster-lite' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'store-booster-lite' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'store-booster-lite' ); ?>"><?php esc_html_e( 'Log in', 'store-booster-lite' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'store-booster-lite' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>


	<?php 

	$class2 = '';
	if( $sb_login_form_layouts == 'two' ){
		$class2 = 'sb-col sb-col2';
	}

	 ?>

	 

	<div class="sb-toogle-form sb-toogle-register <?php esc_attr_e($class2);?> sb-item2">

		

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'store-booster-lite' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'store-booster-lite' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'store-booster-lite' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'store-booster-lite' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'store-booster-lite' ); ?>"><?php esc_html_e( 'Register', 'store-booster-lite' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' );

}


/**
* Toggle button for register user form
*
*
*/
add_action('store_booster_lite_resister_toggle','store_booster_lite_resister_toggle');
function store_booster_lite_resister_toggle(){
	?>
		<div class="sb-register-toggle-warpp">
			<span><?php esc_html_e('Not a Member?','store-booster-lite'); ?> </span>
			<a href="#">
				<span><?php esc_html_e('Register','store-booster-lite'); ?></span>
			</a>
		</div>
	<?php 
}