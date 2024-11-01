(function ($) {

				function sbModifyMenuLabels($menuItem) {

					var $menuItems = $('#menu-to-edit .menu-item-title');
					
					if ($menuItems.length > 0) {

						$menuItems.each(function () {
							if ($(this).text() === 'sb_search_box') {

								var $menuItem = $(this).closest('.menu-item');

								$menuItem.find('.menu-item-title').text('Product Search bar');
								$menuItem.find('.item-type').text('Search bar');
								$menuItem.find('.menu-item-settings .edit-menu-item-title').closest('label').hide();
								$menuItem.find('.field-url').hide();


								if ($menuItem.find('.sb-admin-menu-item-desc').length == 0) {
									$menuItem.find('.menu-item-settings').prepend('<div class="dgwt-wcas-admin-menu-item-desc sb-admin-menu-item-desc"><img class="" src="'+sbAdmin.icon+'" width="32" height="32" /><span>Product search bar will be displayed here.</span></div>');
								}
							}
							//Modify login menu texts
							if ($(this).text() === 'sb_login_box') {

								var $menuItem = $(this).closest('.menu-item');

								$menuItem.find('.menu-item-title').text('Login/Signup');
								$menuItem.find('.item-type').text('Login/signup');
								$menuItem.find('.menu-item-settings .edit-menu-item-title').closest('label').hide();
								$menuItem.find('.field-url').hide();


								if ($menuItem.find('.sb-admin-menu-item-desc').length == 0) {
									$menuItem.find('.menu-item-settings').prepend('<div class="dgwt-wcas-admin-menu-item-desc sb-admin-menu-item-desc"><img class="" src="'+sbAdmin.icon+'" width="32" height="32" /><span>Login & Signup will be displayed here.</span></div>');
								}
							}

						});
					}
				}

				$(document).ready(function () {
					
					sbModifyMenuLabels();

				});

				$(document).ajaxComplete(function (event, request, settings) {

					if (
						typeof settings != 'undefined'
						&& typeof settings.data == 'string'
						&& settings.data.indexOf('action=add-menu-item') !== -1
						&& settings.data.indexOf('sb_search_box') !== -1
					) {
						sbModifyMenuLabels();

						setTimeout(function () {
							sbModifyMenuLabels();
						}, 500)

					}

					//for login & signup
					if (
						typeof settings != 'undefined'
						&& typeof settings.data == 'string'
						&& settings.data.indexOf('action=add-menu-item') !== -1
						&& settings.data.indexOf('sb_login_box') !== -1
					) {
						sbModifyMenuLabels();

						setTimeout(function () {
							sbModifyMenuLabels();
						}, 500)

					}

				});

			}(jQuery));