require('./bootstrap');

$(document).ready(function () {
    window.Axios = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        timeout: 5000,
    });
    ( function( $ ) {
        $.fn.persianCalendar = function(extra) {
            return this.each( function( index, element ) {
                var id = jQuery(element).attr("id");
                new AMIB.persianCalendar( id, extra );
            } );
        };
    })( jQuery );
});
