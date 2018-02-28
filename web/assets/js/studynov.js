$(window).on("load", function() {

    $(".popover")
        .popover({html:true});

    $('body').on('click', '.fc-button-group', function(){
        $('.popover').css('opacity', 0);
    })

});
