(function($) {
    'use strict';
    
    $(document).ready(function () {
        $(".blocks-gallery-grid").addClass('owl-carousel');
        $(".owl-carousel").removeClass('blocks-gallery-grid');
        $(".owl-carousel").children('li').removeClass('blocks-gallery-item');
        
        $(".banner-slider .owl-carousel").owlCarousel({
            loop:false,
            margin: 0,
            nav: false,
            dots: true,
            items: 1,
            autoWidth: false
        });
       
        $(".home-slider-banner .wp-block-gallery").slick({
            dots: false,
            infinite: true,
            arrows: false,
        });

        
        $(".slider-section .owl-carousel").owlCarousel({
            loop:false,
            margin: 15,
            nav: false,
            dots: false,
            items: 1,
            autoWidth: true
        });
        $(".field_service .owl-carousel").owlCarousel({
            loop:false,
            nav: false,
            dots: false,
            items: 5,
            autoWidth: true
        });
        $(".field_service .slick-carousel").slick({
            dots: false,
            infinite: false,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            variableWidth: true
        });

        jQuery('.share-action').click(function(e) {
            e.preventDefault();
            // if(!checkClick){
            //     return;
            // }
            // checkClick = false
         
            // copyToClipboard(jQuery(this).attr('href'))
            // .then(function(){
            //     jQuery('.share-link .tooltip-text').addClass('active');
            //     setTimeout(function(){ 
            //         jQuery('.share-link .tooltip-text').removeClass('active');
            //         checkClick = true;
            //     }, 2000);
            // })
            // .catch(() => console.log('error'));
            
            window.appBridge.getLatitude();
            
            
        });
        jQuery('.overlay-black').on('click', function() {
            window.appBridge.getLongitude();
        });
        jQuery('.overlay-black').on('click', '.bottom-overlay', function(e) {
            e.stoppropagation();
        });

        $(".overlay-element .back-main").click(function(e) {
            e.preventDefault();
            $('.main-overlay, .overlay-element, .wpd_main_comm_form').removeClass('active');
            $('.overlay-element').removeClass('scroll-none');
          
        });
        $(".overlay-element-child .back-main").click(function(e) {
            e.preventDefault();
            $('.overlay-element-child').removeClass('active');
            $('.overlay-element').addClass('active');
        });
        $('.overlay-btn, .see-all').click(function(e) {
            e.preventDefault();
            $('.main-overlay, .overlay-element').addClass('active');
            $('.overlay-element .top-element h2').text($(this).data('title'));
            $('.overlay-element .data-wrap .results').html('');
            
          
        });
        $('.add-review .overlay-btn').click(function(e) {
            e.preventDefault();
            $('.wpd_main_comm_form, .wpd-form-foot, .overlay-submit-btn').addClass('active');
            $('.overlay-element').addClass('scroll-none');

        });

        $('.see-all').click(function(e) {
            e.preventDefault();
           
            var cloneE = $(this).prev().clone();
            $('.overlay-element .data-wrap .results').html(cloneE);
        });
        $('.cancel-btn').click(function(e) {
            e.preventDefault();
            $('.overlay-black').removeClass('active');
        });
        $(".popup-btn").on('click', function(e) {
            e.preventDefault();
            $(this).parent().removeClass('active');
            $(".popup-box").addClass('active');
        });
        $(".cancel-popup").on('click', function() {
            $(".popup-box").removeClass('active');
        });
       
        $('.call-overlay').click(function(e) {
            e.preventDefault();
            $('.overlay-black').addClass('active');
        });

       
       

        $('.overlay-element-child .data-wrap').on('click', '.post', function(e) {
            e.preventDefault();
           
            var box_data = $(this).data();
            var cloneE = $(this).clone();
          
            $('.overlay-element-child .data-wrap .results').html(cloneE);
            $('.overlay-element-child').addClass('active');
            $('.overlay-element').removeClass('active');
            $('.overlay-element-child .top-element h2').text(box_data['title']);
        });

        
        

        $('.home-overlay-btn').click(function(e) {
            e.preventDefault();
            $('.main-overlay, .overlay-element').addClass('active');
          
        });

        $('.single-beauty .wc_comm_submit').val('Add');
        $('.single-beauty .wc_comm_submit').prop('disabled', true);

        $('.single-beauty .wpd_comm_form ').change(function(e) {
            const form = jQuery(this);
            $('.wc_comm_submit').prop('disabled', true);
            $('.wc_comm_submit').removeClass('active');
            const dataInput = {
            };

            jQuery.each(form.serializeArray(), function(index, obj) {
                if (obj.name == 'interested_in') {
                    dataInput[obj.name].push(obj.value);
                } else {
                    dataInput[obj.name] = obj.value;
                }

            });
            if(dataInput['wc_comment'] && dataInput['beauty_rating']){
                $('.wc_comm_submit').prop('disabled', false);
                $('.wc_comm_submit').addClass('active');
            }
        });

        $('.single-beauty .wpd_comm_form textarea[name=wc_comment]').keyup(function(e) {
           
            $('.wc_comm_submit').prop('disabled', true);
            $('.wc_comm_submit').removeClass('active');
            if($(this).val() && $('.wpdiscuz-rating input[name=beauty_rating]:checked').val()){
                $('.wc_comm_submit').prop('disabled', false);
                $('.wc_comm_submit').addClass('active');
            }
        });
        jQuery('body').on('click', function() {
            jQuery('.custom-select2').addClass('select-hide');
            
        });
        jQuery('body').on('click', '.custom-select2', function(e) {
            e.stoppropagation();
        });
        

        $('.single-beauty .wc_comm_submit').click(function(e) {
            
            setTimeout(function(){ 
                $('html, body').animate({
                    scrollTop: $("section.review-section").offset().top
                }, 0);
                $('.main-overlay, .overlay-element, .wpd_main_comm_form, .wpd-form-foot, .overlay-submit-btn').removeClass('active');
                location.reload() 
            }, 1000);
        });
       
       

        /******************/
        var _reqAnimationSearch = window.requestAnimationFrame    ||
        window.mozRequestAnimationFrame     ||
        window.webkitRequestAnimationFrame  ||
        window.msRequestAnimationFrame      ||
        window.oRequestAnimationFrame       ;

        var _cancelAnimationFrameSearch = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

        var start;
        var myReq;
        var searchElement;
        var strSearch;


        function delayRequestAnimationFrameSearch( timestamp ) {
            if (!start) start = timestamp;
            
            var progress = timestamp - start;

            if (progress < 500) {
                // it's important to update the requestId each time you're calling requestAnimationFrame
                myReq = _reqAnimationSearch(delayRequestAnimationFrameSearch);
            }else{
                searchKey(strSearch,searchElement);
            }

        }

        function delaySetimeOutSearch(element) {
            clearTimeout(start);
            start = setTimeout(function(){
                searchKey(strSearch, searchElement);
            }, 500);
        }

        function searchKey(str, $results){
            searchElement.addClass('parent-loader');
            $.ajax({
                url: frontend_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'search_beauty',
                    input: str
                }
            }) 
            .done(function(response) {
                var result = '<p>Spa or Clinic not found</p>'

                if(!response.data.success){
                    $('.overlay-element .data-wrap .results').html(result);
                    return
                }
                var data = response.data.data;
                result = '';
                for (const key in data) {
                    const item = data[key];
                    result += `
                        <div class="post only-des">
                            <div class="des">
                                <h5><a class="box-title" href="${item.link}">${item.title}</a></h5>
                                <div class="excerpt">${item.address}</div>
                                <a class="arrow-link" href="${item.link}"></a>
                            </div>
                        </div>
                    `
                }

                $('.overlay-element .data-wrap .results').html(result);

            })
            .fail(function(jqXHR, textStatus) {
                alert('ERROR');
            })
            .always(function() {
                searchElement.removeClass('parent-loader');
            })
        }

        var $input = $('.search-input');
        $input.bind('keyup', function() {
           
            var key = $(this).val()
            searchElement = $(this).closest('.overlay-element').find('.data-wrap');

            if(key.length > 0 ){
                strSearch = `${key}`;

                if(_reqAnimationSearch){
                    start = null;
                    _cancelAnimationFrameSearch(myReq);
                    _reqAnimationSearch(delayRequestAnimationFrameSearch);
                }
                else{
                    delaySetimeOutSearch(strSearch, searchElement);
                }
                
                searchElement.fadeIn();
            }else{
                searchElement.fadeOut();
            }
        })

        
    });
})(jQuery);