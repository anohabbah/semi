/**
 * Created by MOYA on 16/05/2017.
 */

//fonction pour masquer la page d'accueil
$(document).ready(function () {
    $('.essai').on('keyup', function () {
        $('#search').val($('.essai').val());
        $('.mi').addClass('moya');
        $('.attente').show();
        document.getElementById("search").focus();
    });

    $('#search').on('keyup', function (e) {
        doAjaxQuery();
    });

    function doAjaxQuery() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            async: true,
            url: Semi.url,
            data: {
                _token: Semi.csrfToken,
                query: $('#search').val()
            },
            success: function (response) {

            },
            error: function (error) {

            }
        });
    }
});

