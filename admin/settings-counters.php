<?php
/**
* Settings related to product counters
*
*/
?>
<div class="sb-admin sb-counters">
	<?php $this->get_setting_titles('counters');?>

<div class="inner-settings-help-wrapper">
<div class="inner-settings-wrapp">

	<div class="sb-setting-items">
		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="product-sales-switch">
				<?php esc_html_e('Single Product Sales Counter','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Display product sales counter on product pages','store-booster-lite'); ?></div>
				</label>
			</div>
			<div class="sb-switch">
				<input type="checkbox" id="product-sales-switch"  name="sb_enable_pr_sales_ctr" <?php echo ($this->sb_get_settings['sb_enable_pr_sales_ctr']) == 1 ? 'checked' : '' ; ?> />
				<label for="product-sales-switch"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
			</div>
		</div>
	
	
		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="product-sales-switch-archive">
				<?php esc_html_e('Archive Product Sales Counter','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Display product sales counter on archive pages','store-booster-lite'); ?></div>
				</label>
			</div>
			<div class="sb-switch">
				<input type="checkbox" id="product-sales-switch-archive"  name="sb_enable_pr_sales_ctr_ar" <?php echo ($this->sb_get_settings['sb_enable_pr_sales_ctr_ar']) == 1 ? 'checked' : '' ; ?> />
				<label for="product-sales-switch-archive"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
			</div>
		</div>
	</div>

	<?php //Counter Start Value(Fake Value) product sales option ?>
	<div class="sb-setting-items">

		<div class="setting-item grid-two">
			<div class="setting-label">
				<label for="product-fake-value-switch">
				<?php esc_html_e('Display Custom Values','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Show custom values for sales on products','store-booster-lite'); ?></div>
				</label>
			</div>
			<div class="sb-switch">
				<input type="checkbox" id="product-fake-value-switch"  name="sb_enable_pr_fke_sales" <?php echo ($this->sb_get_settings['sb_enable_pr_fke_sales']) == 1 ? 'checked' : '' ; ?> />
				<label for="product-fake-value-switch"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
			</div>
		</div>

		<div class="setting-item grid-two product-fake-value <?php echo ($this->sb_get_settings['sb_enable_pr_fke_sales']) != 1 ? 'hide' : '' ; ?>">
			<div class="setting-label">
				<label for="product-fake-value">
				<?php esc_html_e('Default Counter Value','store-booster-lite');?>
				<div class="setting-info"><?php esc_html_e('Enter counter value to start from','store-booster-lite'); ?></div>
				</label>
			</div>
			
			<input type="text" id="product-fake-value"  name="sb_enable_pr_fke_value" value="<?php echo $this->sb_get_settings['sb_enable_pr_fke_value']?>" />
				
		</div>

	</div>	

</div><!-- .inner-settings-wrapp -->

	<?php //help wrapper ?>
	<div class="inner-settings-help">
		<h3><span class="dashicons dashicons-megaphone"></span>
		<?php esc_html_e('Premium Feature','store-booster-lite'); ?>
		</h3>
		<div class="help-box">
			
				<div class="steps-wrapp">
					<div class="step-one"> <?php esc_html_e('You can also add product counter values individually from each product page in premium version','store-booster-lite'); ?></div>
				</div>

				

				
		</div>
	</div>


</div>



</div>