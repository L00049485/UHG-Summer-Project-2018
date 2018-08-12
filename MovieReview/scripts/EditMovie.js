//*************************************************************************************
//********************************Movie Editing****************************************
//This script is for both adding new movies and updating existing movies. If a 
//*************************************************************************************
$(document).ready(function () {
    var movieId = getParameterByName('movieid');

    //No movieId indicates that a new movie should be created
    if (movieId == null) {
        $('#title').html("Add New Movie");
        $('#txtMovieId').attr('disabled', true);
        $('#editForm').attr('id', 'addForm');
        $("#addForm").submit(function (e) {
            e.preventDefault();
            addMovie();
        });
    }
    else {
        $.ajax({
            async: false,
            type: 'GET',
            url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/getMovieDetails.php?movieId=' + movieId,
            success: function (data) {
                populateFields(JSON.parse(data));
            }
        });

        $("#editForm").submit(function (e) {
            e.preventDefault();
            updateMovie();            
        });
    }

    //When the submit button is clicked, add the actors and images to a txt box to be picked up
    $("#btnSubmitUpdateMovie").click(function () {
        var files = $('#images').fileinput('getFileStack');
        var actors = $('#Actors').val();
        var imagesString = "";
        for (i = 0; i < files.length; ++i) {
            imagesString += 'images/posters/' + files[i].name + ',';
        }

        //remove the last comma
        imagesString = imagesString.substring(0, imagesString.length - 1);

        //send the text to a hidden text box to be picked up by the php
        $('#txtImages').val(imagesString);

        //Send the list of actors to a hidden text box to be picked up by the php
        $('#txtActors').val(actors);
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
    var boxOffice = movieDetails[0].BoxOffice;

    $('#txtMovieTitle').val(title);
    $('#txtReleaseDate').val(releaseDate);
    $('#txtDesc').val(description);
    $('#txtTrailer').val(trailer);
    $('#txtMovieId').val(id);
    $('#genre').val(genre).trigger('chosen:updated');
    $('#txtBoxOffice').val(boxOffice);

    //Actors
    var actorsAr = (actors != null) ? actors.split(',') : null;
    $('#Actors').val(actorsAr).trigger('chosen:updated');

}

function updateMovie() {
    var files = $('#images').fileinput('getFileStack');
    var imagesString = "";
    for (i = 0; i < files.length; ++i) {
        imagesString += 'images/posters/' + files[i].name + ',';
    }
    //remove the last comma
    imagesString = imagesString.substring(0, imagesString.length - 1);

    //Make the tinyMCE plugin save the content of the text field
    tinyMCE.triggerSave();

    var datastring = $("#editForm").serialize();

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/moviereviewRepo/MovieReview/api/processUpdateMovie.php",
        data: datastring,
        dataType: "json",
        async: false,
        success: function (data) {
            // show when the button is clicked
            $.toast({
                heading: 'Movie updated',
                text: data,
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'success',
                hideAfter: false
            });

            var delay = 3000;
            //$('#editForm').hide(1000);
            //setTimeout(function () { window.location = "./default.php"; }, delay);
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

function addMovie() {
    var files = $('#images').fileinput('getFileStack');
    var imagesString = "";
    for (i = 0; i < files.length; ++i) {
        imagesString += 'images/posters/' + files[i].name + ',';
    }
    //remove the last comma
    imagesString = imagesString.substring(0, imagesString.length - 1);

    //Make the tinyMCE plugin save the content of the text field
    tinyMCE.triggerSave();

    var datastring = $("#addForm").serialize();

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/moviereviewRepo/MovieReview/api/processAddMovie.php",
        data: datastring,
        dataType: "json",
        async: false,
        success: function (data) {
            if (data.indexOf('Error') < 0) {
                //If the movie was successfully added
                $.toast({
                    heading: 'Movie Added',
                    text: data + ' Returning to home page in 3 seconds.',
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'success',
                    hideAfter: false
                });
                var delay = 3000;
                setTimeout(function () { window.location = "./default.php"; }, delay);
            }
            //If there was an error when trying to add the movie
            else {
                $.toast({
                    heading: 'Update Failed',
                    text: data,
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'error',
                    hideAfter: false
                });
            }            
        },
        //If there was an error when connecting to the script
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