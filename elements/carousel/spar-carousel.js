var sparOwl = ( function( $ ) {

    $(function(){
        $('.' + spar.carouselName + '.owl-carousel').owlCarousel({
            center: spar.owlOptions.center,
            loop: spar.owlOptions.loop,
            margin: spar.owlOptions.margin,
            nav: spar.owlOptions.nav,
            autoWidth: spar.owlOptions.autoWidth,
            autoplay: spar.owlOptions.autoplay,
            autoplayTimeout:spar.owlOptions.autoplayTimeout,
            autoplayHoverPause:spar.owlOptions.autoplayHoverPause,
            autoHeight: spar.owlOptions.autoHeight,
            responsive: spar.owlOptions.responsive
        });
    });

} )( jQuery );