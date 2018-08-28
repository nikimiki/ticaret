$(document).ready(function() {
    $(".down-icon").on('click', function(e) {
        var deselect = false;

        if($(this).hasClass('active')) deselect = true;

        $(".down-icon").removeClass('active');
        $(".cnt-frmInf").css('display', 'none');
        var openFrm = $(this).data('href');

        if(! deselect) {
            $(this).addClass('active');
            $(openFrm).toggle();
        }
    });
});