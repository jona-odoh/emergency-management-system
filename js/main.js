//====================Circle bar===================
document.addEventListener('DOMContentLoaded', function () {
    "use strict";
    ToxProgress.create();
    ToxProgress.animate();
});

$(document).ready(function () {
    "use strict";
    //==================load page===============
    setTimeout(function() {
        jQuery('.load-page').hide();
    }, 500);

    //-----------------Sticky memu-----------------
    $(".sticky-menu").sticky({topSpacing:0});

    //=====================light gallery============
    lightGallery(document.getElementById('lightgallery1'));
    lightGallery(document.getElementById('lightgallery2'));
    lightGallery(document.getElementById('lightgallery3'));
    lightGallery(document.getElementById('lightgallery4'));
    lightGallery(document.getElementById('lightgallery5'));
    lightGallery(document.getElementById('lightgallery6'));
    //--------------------short code hover--------------------
    $('.hover-element').on({
        mouseenter: function () {
            $('.show-hover-shortcodes').fadeIn();
        },
        mouseleave: function () {
            $('.show-hover-shortcodes').hide();
        }
    });
    $('.show-hover-shortcodes').on({
        mouseenter: function () {
            $(this).show();
        },
        mouseleave: function () {
            $(this).fadeOut();
        }
    });

    //--------------------FORM SEARCH HEADER--------------------
    $('.uni-search-appointment').on('click', function (e) {
        if($(e.target).is('li.un-btn-search , li.un-btn-search i')){
            $('.uni-form-search-header .box-search-header').slideToggle();
        }
    });

    //----------------BACK TOP TOP-----------------------------
    $('footer').append('<div id="toTop"><div class="btn btn-totop"><i class="fa fa-angle-double-up" aria-hidden="true"></i></div></div>');
    $(window).on('scroll', function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on('click', function (e) {
        if($(e.target).is('.btn-totop')){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }
        if($(e.target).is('.btn-totop i')){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }
    });

    //-----------------menu mobile---------------------
    $('.mobile-menu-container .menu-mobile-nav').on('click', function (e) {
        if($(e.target).is('.icon-bar i')){
            $('#cssmenu').slideToggle();
            $('#cssmenu ul').slideToggle();
            $('#cssmenu ul ul').hide();
        }
    });
    $('.uni-icons-close'). on('click', function (e) {
        if($(e.target).is('i')){
            $('#cssmenu').hide( 500);
            $('#cssmenu ul').hide(500);
        }
    });

    (function($) {

        $.fn.menumaker = function(options) {

            var cssmenu = $(this), settings = $.extend({
                title: "Menu",
                format: "dropdown",
                sticky: false
            }, options);

            return this.each(function() {

                cssmenu.find('li ul').parent().addClass('has-sub');

                var multiTg = function() {
                    cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                    cssmenu.find('.submenu-button').on('click', function() {
                        $(this).toggleClass('submenu-opened');
                        $(this).toggleClass('active');
                        if ($(this).siblings('ul').hasClass('open')) {
                            $(this).siblings('ul').removeClass('open').slideToggle();
                        }
                        else {
                            $(this).siblings('ul').addClass('open').slideToggle();
                        }
                    });
                };

                if (settings.format === 'multitoggle') multiTg();
                else cssmenu.addClass('dropdown');

                if (settings.sticky === true) cssmenu.css('position', 'fixed');

                var resizeFix = function() {
                    if ($( window ).width() > 768) {
                        cssmenu.find('ul').show();
                    }

                    if ($(window).width() <= 768) {
                        cssmenu.find('ul').hide().removeClass('open');
                    }
                };
                resizeFix();
                return $(window).on('resize', resizeFix);

            });
        };
    })(jQuery);

    (function($){
        $(document).ready(function() {
            $("#cssmenu").menumaker({
                title: "",
                format: "multitoggle"
            });

            $("#cssmenu").prepend("<div id='menu-line'></div>");

            var foundActive = false, activeElement, linePosition = 0, menuLine = $("#cssmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

            $("#cssmenu > ul > li").each(function() {
                if ($(this).hasClass('active')) {
                    activeElement = $(this);
                    foundActive = true;
                }
            });

            if (foundActive === false) {
                activeElement = $("#cssmenu > ul > li").first();
            }

            defaultWidth = lineWidth = activeElement.width();

            // defaultPosition = linePosition = activeElement.position().left;

            menuLine.css("width", lineWidth);
            menuLine.css("left", linePosition);

            $("#cssmenu > ul > li").on('mouseenter', function () {
                    activeElement = $(this);
                    lineWidth = activeElement.width();
                    linePosition = activeElement.position().left;
                    menuLine.css("width", lineWidth);
                    menuLine.css("left", linePosition);
                },
                function() {
                    menuLine.css("left", defaultPosition);
                    menuLine.css("width", defaultWidth);
                });
        });
    })(jQuery);

    //-----------------------PROCESS BAR---------------------------
    $('.uni-processbar-thick .progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
    );

    //-----------------------process-bar OUR CAUSES---------------------
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
    });

    $( window ).scroll(function() {
        $(".progress-bar").each(function(){
            var each_bar_width = $(this).attr('aria-valuenow');
            $(this).width(each_bar_width + '%');
        });
    });

    //-----------------------------ACORDION---------------------------
    $('.accordion-default .accordion .accordion-toggle').on('click', function (e) {
        if($(e.target).is('.accordion-toggle, .accordion-icosn, img , h4')){
            $(this).next().slideToggle('600');
            $(".accordion-content").not($(this).next()).slideUp('600');
            $(this).toggleClass('active').siblings().removeClass('active');
        }
    });

    //-------------------------COUNT ABOUT----------------------------
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    //----------------------FILTER PRICE-----------------------
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 17000,
            values: [ 2000, 15000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    } );

    //-----------------replace image single product----------------
    jQuery('.flexslider .product-slide .img-small img').on('click', function(e) {
        if($(e.target).is('img')){
            var value2 = jQuery(this).attr("data-filter2");
            console.log(value2);

            jQuery('.flexslider .product-slide .img-small img').addClass('none');
            jQuery('.filter2').not("."+value2).removeClass('active');
            jQuery('.filter2').filter("."+value2).addClass('active');
        }

    });

    $('.flexslider .product-slide .img-small').on('click', function (e) {
        if($(e.target).is('img')){
            $('.img-small').removeClass('active');
            $(this).addClass('active');
        }
    });

    //------------------------checkout-----------------------------
    $('.woocommerce-info').on('click', function (e) {
        if($(e.target).is('.click-here-to-login')){
            $('.vk-form-woo-login').slideToggle();
            return false;
        }
        if($(e.target).is('.click-here-entry-code')){
            $('.vk-check-coupon').slideToggle();
            return false;
        }
    });
    $('.vk-checkout-billing-left').on('click', function (e) {
        if($(e.target).is('.checkbox-create-account')){
            $('.checkbox-create-account-form').slideToggle();
        }
    });

    //==================MediaPlayer==================
    var mediaElements = document.querySelectorAll('video, audio');

    for (var i = 0, total = mediaElements.length; i < total; i++) {
        var features = ['prevtrack', 'playpause', 'nexttrack', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward',
            'markers', 'volume', 'playlist', 'loop', 'shuffle', 'contextmenu'];
        // To demonstrate the use of Chromecast with audio
        if (mediaElements[i].tagName === 'AUDIO') {
            features.push('chromecast');
        }
        new MediaElementPlayer(mediaElements[i], {
            // This is needed to make Jump Forward to work correctly
            pluginPath: 'https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.5/',
            shimScriptAccess: 'always',
            autoRewind: false,
            features: features,
            currentMessage: 'Now playing:'
        });
    }

    //=====================Gallery image==============
    jQuery(document).ready(function () {
        $('.uni-blog-grid-body .uni-blog-grid-left .grid').masonry({
            itemSelector: '.grid-item'
        });
    });

    //=============Calendar=============
    moment.locale('tr');
    var date = new Date();
    var bugun = moment(date).format("DD/MM/YYYY");

    var date_input1=$('input[name="date1"]'); //our date input has the name "date"
    var date_input2=$('input[name="date2"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
        container: container,
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'tr'
    };
    date_input1.val(bugun);
    date_input1.datepicker(options).on('focus', function(date_input){
    });
    date_input2.val(bugun);
    date_input2.datepicker(options).on('focus', function(date_input){
    });


    date_input1.change(function () {
        var deger = $(this).val();
    });
    date_input2.change(function () {
        var deger = $(this).val();
    });


    $('.date-check-in').on('click', function(e){
        if($(e.target).is('#ti-calendar1')){
            date_input1.trigger('focus');
        }
    });

    //------------------------------OWL CAROUSE----------------------
    if(! $.isFunction('owlCarousel')){
        $('.uni-owl-one-item').owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            nav:true,
            navText:[],
            dots:true,
            responsive:{
                0:{
                    items:1
                }
            }
        });
        $('.uni-owl-two-item').owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            nav:true,
            navText:[],
            dots:true,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2
                }
            }
        });
        $('.uni-owl-three-item').owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            nav:true,
            navText:[],
            dots:true,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:3
                }
            }
        });
        $('.uni-owl-four-item').owlCarousel({
            loop:true,
            margin:30,
            responsiveClass:true,
            nav:true,
            navText:[],
            dots:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                992:{
                    items:4
                }
            }
        });
    }
});