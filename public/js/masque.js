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
});


$(document).ready(function () {
    $('.attente').find('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'get',
            sync: true,
            dataType: 'json',
            data: {
                query: $('input[name="query"]').val(),
                field: $('input[name="field"]:checked').val()
            },
            headers: {
                'X-CSRF-TOKEN': Semi.csrfToken
            },
            url: this.action,
            success: function (res) {
                displayResults(res);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});

function displayResults(res) {
    var str = '<div class="container"><div class="row"></div><div class="panel panel-primary"><div class="panel-heading"><h4>Resultats</h4></div><div class="panel-body">';
    for (var i in res) {
        var article = res[i];
        str +=  '<article>' +
                    '<h2><a href="#">'+ article.title + '</a></h2>' +
                        article.body +
                        '<p class="well">' + article.auteurs[0].name + '</p>' +
                '</article>';
    }

    str += '</div></div></div></div>';

    $('body').append(str);
}