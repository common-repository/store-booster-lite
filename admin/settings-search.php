<?php
/**
* Settings related to product search
*
*/
?>
<div class="sb-admin sb-search">
	<?php $this->get_setting_titles('search');?>
<div class="inner-settings-help-wrapper">
	<div class="inner-settings-wrapp">
	<div class="sb-setting-items">
		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="switch">
				<?php esc_html_e('Enable Search','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Enable product search modules','store-booster-lite'); ?></div>
				</label>
			</div>
			<div class="sb-switch">
				<input type="checkbox" id="switch"  name="sb_enable_search" <?php echo ($this->sb_get_settings['sb_enable_search']) == 1 ? 'checked' : '' ; ?> />
				<label for="switch"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
			</div>
		</div>
	</div>	


	<div class="sb-setting-items">

		<div class="setting-item grid-two">
			<div class="setting-label">
				<?php esc_html_e('Search Layout','store-booster-lite'); ?>
			</div>
			<?php $sb_search_layouts = $this->sb_get_settings['sb_search_layouts']; ?>
			<div class="sb-select-wrapp">
				<select name="sb_search_layouts" >
					<option value="one" <?php echo $sb_search_layouts=='one' ? 'selected' : ''; ?> ><?php esc_html_e('Normal Search','store-booster-lite'); ?></option>
					<option value="two" <?php echo $sb_search_layouts=='two' ? 'selected' : ''; ?> ><?php esc_html_e('Advanced Search','store-booster-lite'); ?></option>
					
				</select>
			</div>
		</div>

		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="sb_search_sticky">
				<?php esc_html_e('Sticky Search','store-booster-lite'); ?>
				</label>
				<div class="setting-info"><?php esc_html_e('Make product search fixed to the page','store-booster-lite'); ?></div>
			</div>

			<input class="single" type="checkbox" id="sb_search_sticky"  name="sb_search_sticky" />
			
		</div>

		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="sb_search_placeholder">
				<?php esc_html_e('Search Placeholder','store-booster-lite'); ?>
				</label>
			</div>

			<input type="text" name="sb_search_placeholder"  id="sb_search_placeholder" value="<?php esc_attr_e($this->sb_get_settings['sb_search_placeholder'])?>">
		</div>

		<?php //search button layout ?>
		<div class="setting-item sb-search-btn-text grid-two">
			<div class="setting-label">
				<label for="sb_search_btn_txt">
				<?php esc_html_e('Search Button Text','store-booster-lite'); ?>
				</label>
				<div class="setting-info"><?php esc_html_e('Leave blank to hide the button','store-booster-lite');?></div>
			</div>

			<input type="text" name="sb_search_btn_txt" id="sb_search_btn_txt" value="<?php esc_attr_e($this->sb_get_settings['sb_search_btn_txt'])?>">
		</div>

		<?php //search button layout ?>
		<div class="setting-item grid-two">
			<div class="setting-label">
				<?php esc_html_e('Search Button Layout','store-booster-lite'); ?>
			</div>
			<?php $sb_search_btn_layouts = $this->sb_get_settings['sb_search_btn_layouts']; ?>
			<div class="sb-select-wrapp">
				<select name="sb_search_btn_layouts" >
					<option value="type-button" <?php echo $sb_search_btn_layouts=='type-button' ? 'selected' : ''; ?> ><?php esc_html_e('Button','store-booster-lite'); ?></option>
					<option value="type-icon" <?php echo $sb_search_btn_layouts=='type-icon' ? 'selected' : ''; ?> ><?php esc_html_e('Icon','store-booster-lite'); ?></option>
					
				</select>
			</div>
		</div>

	</div>
<?php $off = 'off';
	if($off == 'on'): ?>	
	<div class="sb-setting-items">

		<div class="setting-item grid-two">
			<div class="setting-label">
				<?php esc_html_e('Search Match Case','store-booster-lite'); ?>
			</div>
			
			<?php $sb_search_match  = $this->sb_get_settings['sb_search_match']; ?>
			<div class="sb-select-wrapp">
				<select name="sb_search_match" >
					<option value="all" <?php echo $sb_search_match =='all' ? 'selected' : ''; ?> ><?php esc_html_e('Description & Title','store-booster-lite'); ?></option>
					<option value="pt" <?php echo $sb_search_match =='pt' ? 'selected' : ''; ?> ><?php esc_html_e('Only Product Titles','store-booster-lite'); ?></option>
					
				</select>
			</div>
		</div>

	</div>
<?php endif; ?>

	</div><!-- .inner-settings-wrapp -->

	<?php //help wrapper ?>
	<div class="inner-settings-help">
		<h3><span class="dashicons dashicons-megaphone"></span>
		<?php esc_html_e('How To Display Search','store-booster-lite'); ?>
		</h3>
		<div class="help-box">
			
				<div class="steps-wrapp">
					<div class="step-one"> <b>Method 1:</b> Go to Appearance >> Menus </div>
					<span>Add <b>Poduct Search Bar</b> to your menu items.</span>
				</div>

				<div class="steps-wrapp">
					<div class="step-two"> <b>Method 2:</b> Shortcode </div>
					<span>Add shortcode<code>[sb-search-form]</code> to desired place.</span>
				</div>

				<div class="steps-wrapp">
					<div class="step-two"> <b>OR</b> you can add shortcode inside your theme:</div>
					<span>
						<?php  
						$code = "<?php echo do_shortcode('[sb-search-form]'); ?>"; 
						highlight_string($code); //(no escaping needed) This is for displaying information to user on plugin dashboard.
						?>
					</span>
				</div>
		</div>
	</div>

</div>


</div>