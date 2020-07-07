require('./bootstrap');

$(document).ready(function () {
    window.Axios = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        timeout: 5000,
    });

    window.toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('.persian-numbers').persiaNumber();

    $('[data-toggle="tooltip"]').tooltip();
});
