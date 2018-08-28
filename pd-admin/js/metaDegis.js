$(document).ready(function() {

    $("#metaFormu").validate({
        rules: {
            site_name: {
                required: true,
                minlength: 10
            },
            meta_description: {
                required: true,
                minlength: 10
            },
            meta_keywords: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            site_name: {
                required: "Lütfen Site Adını yazınız",
                minlength: "En az 10 karakter olması gerekiyor"
            },
            meta_description: {
                required: "Lütfen Site Açıklaması yazınız",
                minlength: "En az 10 karakter olması gerekiyor"
            },
            meta_keywords: {
                required: "Lütfen Site Kelimeleri yazınız",
                minlength: "En az 10 karakter olması gerekiyor"
            }
        }
    });

});