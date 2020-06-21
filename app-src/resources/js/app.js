require('./bootstrap');

jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
jQuery(document)
    .ajaxStart(function() {
        showLoadingScreen();
    })
    .ajaxStop(function() {
        hideLoadingScreen();
    });
