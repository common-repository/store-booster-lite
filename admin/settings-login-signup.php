<?php
/**
* Settings related to product login & signup
*
*/
?>
<div class="sb-admin sb-login_signup">
	<?php $this->get_setting_titles('login_signup');?>



	<div class="inner-settings-help-wrapper">
<div class="inner-settings-wrapp">

	<div class="sb-setting-items">
		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="login-signup-enable">
				<?php esc_html_e('Login & Signup Module','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Enable or disable login or signup module.','store-booster-lite'); ?></div>
				</label>
			</div>
			<div class="sb-switch">
				<input type="checkbox" id="login-signup-enable"  name="sb_enable_login" <?php echo ($this->sb_get_settings['sb_enable_login']) == 1 ? 'checked' : '' ; ?> />
				<label for="login-signup-enable"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
			</div>
		</div>
	</div>	


	<div class="sb-setting-items">
	<div class="setting-item grid-two">
		<div class="setting-label">
			<?php esc_html_e('Button Layout','store-booster-lite'); ?>
		</div>
		<?php $sb_login_btn_layouts = $this->sb_get_settings['sb_login_btn_layouts']; ?>
		<div class="sb-select-wrapp">
			<select name="sb_login_btn_layouts" >
				<option value="one" <?php echo $sb_login_btn_layouts=='one' ? 'selected' : ''; ?> ><?php esc_html_e('Button With Texts','store-booster-lite'); ?></option>
				<option value="two" <?php echo $sb_login_btn_layouts=='two' ? 'selected' : ''; ?> ><?php esc_html_e('Text Only','store-booster-lite'); ?></option>
				<option value="three" <?php echo $sb_login_btn_layouts=='three' ? 'selected' : ''; ?> ><?php esc_html_e('Icon Only','store-booster-lite'); ?></option>
				
			</select>
		</div>
	</div>
	</div>


	<div class="sb-setting-items">
	<div class="setting-item grid-two">
		<div class="setting-label">
			<?php esc_html_e('Form Layout','store-booster-lite'); ?>
			<div class="setting-info"><?php esc_html_e('Choose layout for login & signup form.','store-booster-lite'); ?></div>
		</div>
		<?php $sb_login_form_layouts = $this->sb_get_settings['sb_login_form_layouts']; ?>
		<div class="sb-select-wrapp">
			<select name="sb_login_form_layouts" >
				<option value="one" <?php echo $sb_login_form_layouts=='one' ? 'selected' : ''; ?> ><?php esc_html_e('Layout One','store-booster-lite'); ?></option>
				<option value="two" <?php echo $sb_login_form_layouts=='two' ? 'selected' : ''; ?> ><?php esc_html_e('Layout Two','store-booster-lite'); ?></option>
				
			</select>
		</div>
	</div>
	</div>
	

	

</div><!-- .inner-settings-wrapp -->

	<?php //help wrapper ?>
	<div class="inner-settings-help">
		<h3><span class="dashicons dashicons-megaphone"></span>
		<?php esc_html_e('How To Display Login & Signup','store-booster-lite'); ?>
		</h3>
		<div class="help-box">
			
				<div class="steps-wrapp">
					<div class="step-one"> <b>Method 1:</b> Go to Appearance >> Menus </div>
					<span>Add <b>Poduct Search Bar</b> to your menu items.</span>
				</div>

				<div class="steps-wrapp">
					<div class="step-two"> <b>Method 2:</b> Shortcode </div>
					<span>Add shortcode<code>[sb-login-form]</code> to desired place.</span>
				</div>

				<div class="steps-wrapp">
					<div class="step-two"> <b>OR</b> you can add shortcode inside your theme:</div>
					<span>
						<?php  
						$code = '<?php echo do_shortcode([sb-login-form]); ?>';
						highlight_string($code);//(no escaping needed) This is for displaying information to user on plugin dashboard.
						?>
					</span>
				</div>
		</div>
	</div>


</div>


</div>