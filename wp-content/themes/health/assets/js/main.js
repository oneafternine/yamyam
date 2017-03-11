jQuery(function($){

    // Animated scrolling buttons
    $('.scrollto').click(function() {
        var elementClicked = $(this).attr("href");
        var destination = $(elementClicked).offset().top;
        $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, 500 );
        return false;
    });

    // Email Masking
    var mailto = function(link)
    {
        link = $(link);
        var email = link.text();
        email = email.replace(/__AT__/gi, '@');
        email = email.replace(/__DOT__/gi, '.');
        link.attr('href', 'mailto:'+email);
        link.text(email);
    };
    $('a.mailto').each(function() { mailto(this);});

    // Mobile Menu Trigger
    $('.menu-trigger, .close-menu a').on('click', function(event){
        $('body').toggleClass('no-scroll');
        $('.mobile-menu-container').toggleClass('active');
        event.preventDefault();
    });



});
