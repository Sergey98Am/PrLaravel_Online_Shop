$(document).ready(function() {

    //Admin Accordeon
    $('.content').hide();
    $('.content').first().show();

    $('.title').click(function(event) {
        event.preventDefault();
        $('.icon').removeClass('ac');
        $('.content').slideUp();
        if (!$(this).next().is(':visible')) {
            $(this).next().slideDown();
            $(this).children().addClass('ac');
        }
    });
    //End Admin Accordeon
})

