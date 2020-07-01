require('./bootstrap');

$(document).ready(function () {
    window.Axios = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        timeout: 5000,
    });
});
