var sparBootstrap = ( function( $ ) {

    $(function(){
        $('.carousel-inner' ).each(function(){
            $('img', this).addClass('d-block');
            $('img', this).addClass('w-100');
        });
    });

} )( jQuery );