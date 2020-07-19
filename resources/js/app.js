require('./bootstrap');

$(document).ready(function () {
    let serverAddress = document.head.querySelector('meta[name="server-address"]');
    window.Axios = axios.create({
        baseURL: serverAddress.content + '/api',
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
