jQuery(document).ready(function ($) {


	/**
      * AJAX Product Search
      *
      */
      ajaxProductSearch();

       function ajaxProductSearch(){

        //close AJAX search results on clicking outside of the search results
        var searchField = $('.sb-search-wrapper form.sb-woocommerce-product-search input[type="search"]');
        $(document).on('click', function(event){
            var searchWrapper = $('.sb-search-wrapper form.sb-woocommerce-product-search .search-content');
            if ( !searchField.is(event.target) && searchField.has(event.target).length === 0 )
            {
                 if ( !searchWrapper.is(event.target) && searchWrapper.has(event.target).length === 0 ) 
                 {
                    $('.sb-search-wrapper form.sb-woocommerce-product-search .search-res-wrap').remove();
                    $('.sb-search-wrapper form.sb-woocommerce-product-search .search-content').hide();
                }
                
            }
        });

          $('.sb-search-wrapper form.sb-woocommerce-product-search input[type="search"]').on('keyup',function(){

              
                var advSrchContent = $('.sb-search-wrapper form.sb-woocommerce-product-search .search-content');
                advSrchContent.html('');//for advanced product search
                

                var searVal = $(this).val();
                if( searVal.length >= 3 ){
                    advSrchContent.show();//for advanced product search
                    
                    var keyword = $(this).val();

                  //check if advanced product search  exists
                  if ($('.sb-select-products')[0]) {
                      var searchCat = $('.sb-select-products').val();
                      $('.sb-select-products').on('change',function (){
                         searchCat = $(this).val();
                      });
                  }
                  
                  $('.sb-search-wrapper form img.loader').show();

                  $.ajax({
                      url : sb_val.ajaxurl,
                      data:{
                            action : 'sb_product_search_ajax',
                            key: keyword,
                            cat: searchCat
                          }, 
                      type:'post',
                      success: function(res){    
                              $('.sb-search-wrapper form img.loader').hide();
                              advSrchContent.html(res);//search result for advanced product search
                              //$('.product-search .search-content').html(res);//search result for advanced product search
                              
                              
                          }
                  });
                }
              
          });
      }//ajax search end


      $('body').on('click','.sb-search-wrapper button.sb-search-icon,.sb-search-wrapper button.searchsubmit.sb-srch', function(e){
        e.preventDefault();
        $('.sb-search-wrapper.sticky').toggleClass('active');
      });

      $('body').on('click','.sb-logins-wrapp, .sb-woo-login-outer .close-form a', function(){
        $('.sb-woo-login-outer').toggleClass('active');
      });

      $('body').on('click','.sb-toogle-lr-wrapp .sb-item', function(){
        $('.sb-toogle-lr-wrapp .sb-item').removeClass('active');
        $(this).toggleClass('active');
        var activeClass = $(this).attr('data-id');
        
        $('.sb-toogle-form').removeClass('active');
        $('.sb-toogle-form.'+activeClass).toggleClass('active');
        
      });


      //Single product sitcky bar
      $('.sb-single-product-sales-bar').fadeOut();
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.sb-single-product-sales-bar').fadeIn();
        } else {
            $('.sb-single-product-sales-bar').fadeOut();
        }
      });


      /**
      * Quick View
      */
      $('body').on('click','.sb-quick-view-outer .close-wrapp a', function(){
        $('.sb-quick-view-wrapp').html('');
        $('.sb-quick-view-outer').removeClass('active');
      });

      $('body').on('click','.sb-quick-view', function(){

        var post_id = $(this).attr('data-id');
         $('.sb-quick-view-wrapp').html('');
         $('.sb-quick-view-outer').toggleClass('active');

        $.ajax({
              url : sb_val.ajaxurl,
              
              data:{
                      action : 'store_booster_lite_quick_view',
                      post_id:  post_id
                      
                  },
              type:'post',
               success: function(res){                                        
                      
                      $('.sb-quick-view-wrapp').append(res);
                      
                  }
          });


      });

      

});