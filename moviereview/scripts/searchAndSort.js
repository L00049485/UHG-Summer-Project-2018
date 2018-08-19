//*************************************************************************************
//**********************Handlers for searching and sorting*****************************
//*************************************************************************************
$(document).ready(function(){
    $("#txtSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".container .col-md-3").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
  });
  $('#btnReleaseDate').attr('checked', 'checked');
});


$('#btnAlpha').on('click', function () {
    var $divs = $(".movieCards");
    $divs.sort(function (a, b) {
        var contentA = $(a).attr('data-title');
        var contentB = $(b).attr('data-title');
        return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
    });
    $("#movieRow").html($divs);
});

$('#btnBoxOffice').on('click', function () {
    var $divs = $(".movieCards");
    $divs.sort(function (a, b) {
        var contentA =parseInt( $(a).attr('data-boxoffice'));
        var contentB =parseInt( $(b).attr('data-boxoffice'));
        return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
    });
    $("#movieRow").html($divs);
});

$('#btnRating').on('click', function () {
    var $divs = $(".movieCards");
    $divs.sort(function (a, b) {
        var contentA = $(a).attr('data-rating');
        var contentB = $(b).attr('data-rating');
        return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
    });
    $("#movieRow").html($divs);
});

$('#btnLikes').on('click', function () {
    var $divs = $(".movieCards");
    $divs.sort(function (a, b) {
        var contentA = $(a).attr('data-likes');
        var contentB = $(b).attr('data-likes');
        return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
    });
    $("#movieRow").html($divs);
});

$('#btnReleaseDate').on('click', function () {
    var $divs = $(".movieCards");
    $divs.sort(function (a, b) {
        var contentA = $(a).attr('data-releaseDate');
        var contentB = $(b).attr('data-releaseDate');
        return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
    });
    $("#movieRow").html($divs);
});

//*************************************************************************************
