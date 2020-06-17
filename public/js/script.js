$(document).ready(function() {
	$('.menu-toggle').click(function() {
		$(this).toggleClass('active');
		$('.menu-nav ').toggleClass('active-nav');
		$("body").toggleClass("over");
	});

	$('.toggle-btn').click(function() {
		$(this).toggleClass('act');
        $('.cat-items').toggleClass('act-its');
	});

	$(window).on('scroll', function() {
		if ($(window).scrollTop() > 50) {
			$('.full-menu').css({ 'background-color': '#212121' });
		} else {
			$('.full-menu').css({ 'background-color': 'transparent' });
		}
	});

    $(window).on("hashchange", function(){
        if(location.hash.slice(1)=="register"){
            $(".card").addClass("extend");
            $("#login").removeClass("selected");
            $("#register").addClass("selected");
        } else {
            $(".card").removeClass("extend");
            $("#login").addClass("selected");
            $("#register").removeClass("selected");
        }
    });
    $(window).trigger("hashchange");


    $('.dot').click(function() {
        var currentImage = $('.curry');
        var currentImageIndex = $('.curry').index();
        var nextImageIndex = currentImageIndex + 1;
        var nextImage = $('.img').eq(nextImageIndex);
        currentImage.removeClass('curry');
    });

    var timer = setInterval(function() {
        $('.next').trigger('click');
    }, 5000);

    $('.prev').click(function() {
        var currentImage = $('.curry');
        var currentImageIndex = $('.curry').index();
        var prevImageIndex = currentImageIndex - 1;
        var prevImage = $('.img').eq(prevImageIndex);
        currentImage.removeClass('curry');
        prevImage.addClass('curry');
        $('.dot').eq(prevImageIndex).addClass('active');
        $('.dot').eq(prevImageIndex).siblings().removeClass('active');
        clearInterval(timer);
        timer = setInterval(function() {
            $('.next').trigger('click');
        }, 5000);
    });

    $('.next').click(function() {
        var currentImage = $('.curry');
        var currentImageIndex = $('.curry').index();
        var nextImageIndex = currentImageIndex + 1;
        var nextImage = $('.img').eq(nextImageIndex);
        currentImage.removeClass('curry');
        clearInterval(timer);
        timer = setInterval(function() {
            $('.next').trigger('click');
        }, 5000);
        if (nextImageIndex == $('.img:last').index() + 1) {
            $('.img').eq(0).addClass('curry');
            $('.dot').eq(0).addClass('active');
            $('.dot').eq(0).siblings().removeClass('active');
        } else {
            nextImage.addClass('curry');
            $('.dot').eq(nextImageIndex).addClass('active');
            $('.dot').eq(nextImageIndex).siblings().removeClass('active');
        }
    });

    $('.dot').click(function() {
        var currentImage = $('.curry');
        var dotsIndex = $(this).index();
        var image = $('.img').eq(dotsIndex);
        currentImage.removeClass('curry');
        image.addClass('curry');
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        clearInterval(timer);
        timer = setInterval(function() {
            $('.next').trigger('click');
        }, 5000);
    });



    // $(".click-card").mouseenter(function(){
    //     $(this).children('.info').css("transform", "translateY(0px)");
    //     $(this).children('.info').siblings().css("transform", "translateY(100%)");
    // });
    // $(".click-card").mouseleave(function(){
    //     $(this).children('.info').css("transform", "translateY(100%)");
    //     $(this).children('.info').siblings().css("transform", "translateY(0px)");
    // });


    $(document).on('click', '.qty-plus', function () {
        $(this).prev().val(+$(this).prev().val() + 1);
    });
    $(document).on('click', '.qty-minus', function () {
        if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
    });



    $('#user_avatar').on('change', function () {

        var img_info = new FormData($('#form-img')[0])

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: location.origin + '/avatar',
            method: 'POST',
            data: img_info,
            processData: false,
            cache: false,
            contentType: false,
            success: function (data) {
                if (data){
                    $('#avatar').attr('src', location.origin + '/images/' + data);
                    console.log(data)
                }
            }
        })

    })

   $('#upload').on('click', function(){
       $('#user_avatar').click();
    });

    $('#carousel1').owlCarousel({
        margin: 15,
        pagination: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })


});
