jQuery(document).ready(function ($) {



	//plugin setting menu links function
    $('.menu-wrapp ul li:first-child').addClass('active');
	$('body').on('click','.menu-wrapp ul li',function(){
		var uID = $(this).attr('data-id');
        if( (uID == 'sb-filter') || (uID == 'sb-cart') ){
             sb_pro_warn();
        }
		$('.menu-wrapp ul li').removeClass('active');
		$(this).addClass('active');

		$('.setting-display-wrapper .sb-admin').hide();
		$('.setting-display-wrapper .'+uID).show();

	});


	// Save Button reacting on any changes
    var footerSaveBtn = $('.sb-save-btn');
    $('#wpop-sb-form-values input, #wpop-sb-form-values textarea, #wpop-sb-form-values select').on('change', function() {
        footerSaveBtn.addClass('save-now');
        $('.save-notice').slideDown();


    });



	// Saving Data With Ajax Request
    $('form#wpop-sb-form-values').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'sb_save_settings_with_ajax',
                fields: $('form#wpop-sb-form-values').serialize(),
                security: sbAdm.security
            },
            success: function(response) {
                swal({
                    type: 'success',
                    title: 'Settings Saved!',
                    showConfirmButton: false,
                    timer: 2000,
                });
                footerSaveBtn.removeClass('save-now');
                $('.save-notice').slideUp();
            },
            error: function() {
                swal(
                    'Oops...',
                    'Something went wrong!',
                    'error'
                );
            }
        });
    });


    //product search layout change function
    $('body').on('change','.sb-admin.sb-search .sb-select-wrapp select', function(){
        var currentVal = $(this).val();
        if( (currentVal == 'three') || currentVal == 'four' ){
            $('.sb-search-btn-text').slideUp();
        }else{
            $('.sb-search-btn-text').slideDown();
        }
    });


    $('.product-fake-value.hide').hide();
    $('body').on('click','#product-fake-value-switch', function(){
        $('.product-fake-value').slideToggle();
    });


    function sb_pro_warn(){
        swal({
                type: 'error',
                title: 'Available In Premium Version!',
                showConfirmButton: false,
                timer: 2000,
                });
            return;
    }
    //sticky search pro feature
    $('body').on('click','#sb_search_sticky', function(){
         sb_pro_warn();
    });


});