$(document).ready(function() {
    $(".clsBtn-mbl").on('click', function() {
        $(".mblMenu").removeClass('openMenu');
    });
    $(".mblMenu-icon").on('click', function() {
        $(".mblMenu").addClass('openMenu');
    });
    $(".mblLine").on('click', function(e) {
        var deselect = false;

        if($(this).hasClass('active')) deselect = true;

        $(".mblLine").removeClass('active');
        $(".mblLineTotal").css('display', 'none');
        var openMenu = $(this).data('href');

        if(! deselect) {
            $(this).addClass('active');
            $(openMenu).toggle();
        }
    });
});