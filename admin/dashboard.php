<?php
/**
* Plugin Dashboard
*
* @package Store Booster
*/
?>
<div class="sb-admin sb-dashboard">
	<?php $this->get_setting_titles();?>


	<div class="inner-settings-wrapp">

		<div class="sb-setting-items">
			<div class="setting-item grid-two">
				<div class="setting-label">
					<label for="product-sticky-bar">
					<?php esc_html_e('Single Product Sticky Bar','store-booster-lite');?>
					<div class="setting-info"><?php esc_html_e('Display sticky bar on single product for adding to cart?','store-booster-lite'); ?></div>
					</label>
				</div>
				<div class="sb-switch">
					<input type="checkbox" id="product-sticky-bar"  name="sb_enable_pr_sticky_bar" <?php echo ($this->sb_get_settings['sb_enable_pr_sticky_bar']) == 1 ? 'checked' : '' ; ?> />
					<label for="product-sticky-bar"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
				</div>
			</div>
		</div>

		<?php //Product Quick View ?>
		<div class="sb-setting-items">
			<div class="setting-item grid-two">
				<div class="setting-label">
					<label for="product-quick-view">
					<?php esc_html_e('Product Quick View','store-booster-lite');?>
					<div class="setting-info"><?php esc_html_e('Add option to quick view the products?','store-booster-lite'); ?></div>
					</label>
				</div>
				<div class="sb-switch">
					<input type="checkbox" id="product-quick-view"  name="sb_enable_pr_quick_view" <?php echo ($this->sb_get_settings['sb_enable_pr_quick_view']) == 1 ? 'checked' : '' ; ?> />
					<label for="product-quick-view"><?php esc_html_e('Toggle','store-booster-lite'); ?></label>
				</div>
			</div>
		</div>


	</div>
</div>