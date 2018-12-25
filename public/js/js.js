/**
 * handle counter
 */
//  (function () {
//     'use strict';
//     $.fn.handleCounter = function (options) {
//         var $input,
//         $btnMinus,
//         $btnPlugs,
//         minimum,
//         maximize,
//         writable,
//         onChange,
//         onMinimum,
//         onMaximize;
//         var $handleCounter = this
//         $btnMinus = $handleCounter.find('.counter-minus')
//         $input = $handleCounter.find('input.quarity')
//         $btnPlugs = $handleCounter.find('.counter-plus')
//         var defaultOpts = {
//             writable: true,
//             minimum: 1,
//             maximize: null,
//             onChange: function(){},
//             onMinimum: function(){},
//             onMaximize: function(){}
//         }
//         var settings = $.extend({}, defaultOpts, options)
//         minimum = settings.minimum
//         maximize = settings.maximize
//         writable = settings.writable
//         onChange = settings.onChange
//         onMinimum = settings.onMinimum
//         onMaximize = settings.onMaximize
//         if (!$.isNumeric(minimum)) {
//             minimum = defaultOpts.minimum
//         }
//         if (!$.isNumeric(maximize)) {
//             maximize = defaultOpts.maximize
//         }
//         var inputVal = $input.val()
//         if (isNaN(parseInt(inputVal))) {
//             inputVal = $input.val(0).val()
//         }
//         if (!writable) {
//             $input.prop('disabled', true)
//         }

//         changeVal(inputVal)
//         $input.val(inputVal)
//         $btnMinus.click(function () {
//             var num = parseInt($input.val())
//             if (num > minimum) {
//                 $input.val(num - 1)
//                 changeVal(num - 1)
//             }
//         })
//         $btnPlugs.click(function () {
//             var num = parseInt($input.val())
//             if (maximize==null||num < maximize) {
//                 $input.val(num + 1)
//                 changeVal(num + 1)
//             }
//         })
//         var keyUpTime
//         $input.keyup(function () {
//             clearTimeout(keyUpTime)
//             keyUpTime = setTimeout(function() {
//                 var num = $input.val()
//                 if (num == ''){
//                     num = minimum
//                     $input.val(minimum)
//                 }
//                 var reg = new RegExp("^[\\d]*$")
//                 if (isNaN(parseInt(num)) || !reg.test(num)) {
//                     $input.val($input.data('num'))
//                     changeVal($input.data('num'))
//                 } else if (num < minimum) {
//                     $input.val(minimum)
//                     changeVal(minimum)
//                 }else if (maximize!=null&&num > maximize) {
//                     $input.val(maximize)
//                     changeVal(maximize)
//                 } else {
//                     changeVal(num)
//                 }
//             },300)
//         })
//         $input.focus(function () {
//             var num = $input.val()
//             if (num == 0) $input.select()
//         })

//         function changeVal(num) {
//             $input.data('num', num)
//             $btnMinus.prop('disabled', false)
//             $btnPlugs.prop('disabled', false)
//             if (num <= minimum) {
//                 $btnMinus.prop('disabled', true)
//                 onMinimum.call(this, num)
//             } else if (maximize!=null&&num >= maximize) {
//                 $btnPlugs.prop('disabled', true)
//                 onMaximize.call(this, num)
//             }
//             onChange.call(this, num)
//         }
//         return $handleCounter
//     };
// })(jQuery)






$(document).ready(function(){
	$('body').append('<div id="toTop"></div>');
	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	}); 
	$('#toTop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
	$('body').append('<div id="toDown"></div>');
	var long = $(window).scrollTop();
	$('#toDown').click(function(){
		var vitri = $(window).scrollTop();
		long = long + $('body').height();
		if ((vitri >= (long-$('body').height())) && (vitri <= long )) {
			$("html, body").stop().animate({ scrollTop: long }, 600);
			return false;
		} else {
			long =  vitri;
			long = long + $('body').height();
			$("html, body").stop().animate({ scrollTop: long }, 600);
			return false;
		}
	});
	// body...
	$(window).scroll(function() {
		if ($(window).scrollTop() > 400) 
		{
			$('.navbar-scroll').addClass('navbar-scroll-fixed');

		}
		else 
		{
			$('.navbar-scroll').removeClass('navbar-scroll-fixed');
		}
		if ($(window).scrollTop() > 500) 
		{
			
			$('.connect').addClass('fixed-connect');
		}
		else 
		{
			
			$('.connect').removeClass('fixed-connect');
		}
        // if ($(window).scrollTop() > 250) {
        //     $('.button-show-menu').addClass('button-show-menu-fixed');
        // }
        // else {
        //     $('.button-show-menu').removeClass('button-show-menu-fixed');
        // }
    });
	$(document).on('ready', function() {
		$(".center1").slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 3,
			slidesToScroll: 10
		});
		$(".center2").slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 1,
			slidesToScroll: 3
		});
	});
	$("#chocolates").click(function(){
        $("#cls").show();
        $("#haba").hide();
        $("#baco").hide();
        $("#seaspe").hide();
        $("#giset").hide();
        $('#chocolates').addClass('active');
        $('#handmade-bar').removeClass('active');
        $('#baking-cooking').removeClass('active');
        $('#season-specialties').removeClass('active');
        $('#gift-sets').removeClass('active');
    });
    $("#handmade-bar").click(function(){
    	$("#cls").hide();
        $("#haba").show();
        $("#baco").hide();
        $("#seaspe").hide();
        $("#giset").hide();
        $('#chocolates').removeClass('active');
        $('#handmade-bar').addClass('active');
        $('#baking-cooking').removeClass('active');
        $('#season-specialties').removeClass('active');
        $('#gift-sets').removeClass('active');
        $("#haba").css("display", "flex");
    });
    $("#baking-cooking").click(function(){
    	$("#cls").hide();
        $("#haba").hide();
        $("#baco").show();
        $("#seaspe").hide();
        $("#giset").hide();
        $('#chocolates').removeClass('active');
        $('#handmade-bar').removeClass('active');
        $('#baking-cooking').addClass('active');
        $('#season-specialties').removeClass('active');
        $('#gift-sets').removeClass('active');
        $("#baco").css("display", "flex");
    });
    $("#season-specialties").click(function(){
    	$("#cls").hide();
        $("#haba").hide();
        $("#baco").hide();
        $("#seaspe").show();
        $("#giset").hide();
        $('#chocolates').removeClass('active');
        $('#handmade-bar').removeClass('active');
        $('#baking-cooking').removeClass('active');
        $('#season-specialties').addClass('active');
        $('#gift-sets').removeClass('active');
        $("#seaspe").css("display", "flex");
    });
    $("#gift-sets").click(function(){
    	$("#cls").hide();
        $("#haba").hide();
        $("#baco").hide();
        $("#seaspe").hide();
        $("#giset").show();
        $('#chocolates').removeClass('active');
        $('#handmade-bar').removeClass('active');
        $('#baking-cooking').removeClass('active');
        $('#season-specialties').removeClass('active');
        $('#gift-sets').addClass('active');
        $("#giset").css("display", "flex");
    });

    $(window).on('resize', function(){
        var win = $(this);
        if (win.width() > 514) { 

            $('.shop-menu').css("display", 'inherit');

        }
    });





    $('.log-in').click(function() {
    	$('.log-forgot').show();
    	$('.log').show();
    	$('.forgot').hide();
    	$('.create-acc').hide();
    });
    $('.forgot-pass').click(function() {
    	$('.log-forgot').show();
    	$('.log').hide();
    	$('.forgot').show();
    	$('.create-acc').hide();
    });
    $('.creat-acc').click(function() {
    	$('.log-forgot').hide();
    	$('.create-acc').show();
    });

    //Products
  //   $('.cd-trigger,.bg-detail-item,span.close-add').click(function(event) {
 	// 	/* Act on the event */
 	// 	$('.detail-item').toggleClass('appear-detail-item');
 	// 	$('.bg-detail-item').toggleClass('appear-bg-detail-item');
 	// });
    $('.check-button').click(function() {
        $('.no-check-box').slideToggle();
        $('.check-box').slideToggle();
    });
    $('.payment-2 .check-box-payment').click(function () {
        $('.payment-2 .no-check-box').slideToggle();
        $('.payment-2 .check-box').slideToggle();
        $('.payment-2 .no-check').slideToggle();
    });
    $('.edit-acc').click(function() {
        $('#change-infor').slideDown();
        $('#change-pass').slideUp();
        $('#acc-infor').slideUp();
    });
    $('.edit-pass').click(function() {
        $('#change-pass').slideDown();
        $('#change-infor').slideUp();
        $('#acc-infor').slideUp();
    });
    $('.next-1').click(function() {
        $('.shipping-1').slideUp();
        $('.payment-2').slideDown();
        $('.edit-1').slideDown();
        $('.title-1').removeClass('active');
        $('.title-3').removeClass('active');
        $('.title-2').addClass('active');
    });
    $('.next-2').click(function() {
        $('.shipping-1').slideUp();
        $('.payment-2').slideUp();
        $('.preview-3').slideDown();
        $('.edit-1').slideDown();
        $('.edit-2').slideDown();
        $('.title-1').removeClass('active');
        $('.title-2').removeClass('active');
        $('.title-3').addClass('active');
    });
    $('.edit-1').click(function() {
        $('.shipping-1').slideDown();
        $('.payment-2').slideUp();
        $('.preview-3').slideUp();;
        $('.edit-2').slideUp();
        $('.edit-1').slideUp();
        $('.title-3').removeClass('active');
        $('.title-2').removeClass('active');
        $('.title-1').addClass('active');
    });
    $('.edit-2').click(function() {
        $('.shipping-1').slideUp();
        $('.payment-2').slideDown();
        $('.preview-3').slideUp();
        $('.edit-2').slideUp();
        $('.edit-1').slideDown();
        $('.title-1').removeClass('active');
        $('.title-3').removeClass('active');
        $('.title-2').addClass('active');
    });
    $('.show-menu-shop').click(function() {
        $('.shop-menu').slideToggle();
    });
    $('span.favorite').click(function() {
        $('.bg-favorite span').fadeIn().delay(1000).fadeOut();
    }); 

















});
