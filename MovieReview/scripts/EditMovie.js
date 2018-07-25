//*************************************************************************************
//********************************Movie Editing****************************************
//*************************************************************************************
$(document).ready(function () {
    var movieId = getParameterByName('movieid');
    $.ajax({
        async: false,
        type: 'GET',
        url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/getMovieDetails.php?movieId=' + movieId,
        success: function (data) {
            populateFields(JSON.parse(data));
        }
    });
});

function populateFields(movieDetails) {

    var title = movieDetails[0].Title;
    var id = movieDetails[0].id;
    var releaseDate = movieDetails[0].ReleaseDate;
    var genre = movieDetails[0].Genre_ID;
    var trailer = movieDetails[0].Trailer;
    var actors = movieDetails[0].Actor_IDs;
    var description = movieDetails[0].Description;

    $('#txtMovieTitle').val(title);
    $('#txtReleaseDate').val(releaseDate);
    $('#txtDesc').val(description);
    $('#txtTrailer').val(trailer);
    $('#txtMovieId').val(id);
    $('#genre').val(genre).trigger('chosen:updated');

    //Actors
    var actorsAr = actors.split(',');
    $('#Actors').val(actorsAr).trigger('chosen:updated');

}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

$("#editForm").submit(function (e) {
    e.preventDefault();
    updateMovie();
});

function updateMovie() {
    var files = $('#images').fileinput('getFileStack');
    var imagesString = "";
    for (i = 0; i < files.length; ++i) {
        imagesString += 'images/posters/' + files[i].name + ',';
    }
    //remove the last comma
    imagesString = imagesString.substring(0, imagesString.length - 1);

    var datastring = $("#editForm").serialize();

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/moviereviewRepo/MovieReview/api/processUpdateMovie.php",
        data: datastring,
        dataType: "json",
        success: function (data) {
            // show when the button is clicked
            $.toast({
                heading: 'Movie updated',
                text: data,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'success'
            });

            var delay = 3000;
            $('#editForm').hide(1000);
            setTimeout(function () { window.location = "./default.php"; }, delay);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $.toast({
                heading: 'Update Failed',
                text: xhr.responseText,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error',
                hideAfter: false
            });
        }
    });    
}



//for picking up query string values - https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}