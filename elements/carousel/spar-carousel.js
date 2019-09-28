var sparOwl = ( function( $ ) {

    $(function(){
        $('.' + spar.carouselName + '.owl-carousel').owlCarousel({
            center: spar.owlOptions.center,
            loop: spar.owlOptions.loop,
            margin: spar.owlOptions.margin,
            nav: spar.owlOptions.nav,
            autoplay: spar.owlOptions.autoplay,
            autoplayTimeout:spar.owlOptions.autoplayTimeout,
            autoplayHoverPause:spar.owlOptions.autoplayHoverPause,
            autoHeight: spar.owlOptions.autoHeight,
            autoHeightClass: spar.owlOptions.autoHeightClass,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });
    });

} )( jQuery );