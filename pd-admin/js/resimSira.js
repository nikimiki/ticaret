$(document).ready(function() {

    $("#resimFormu").validate({
        rules: {
            sira: {
                required: true,
                minlength: 1
            }
        },
        messages: {
            sira: {
                required: "Lütfen Sıra yazınız",
                minlength: "En az 1 karakter olması gerekiyor"
            }
        }
    });

});