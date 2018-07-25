//*************************************************************************************
//********************************Movie Rating*****************************************
//*************************************************************************************

//Global variables
//when the user clicks one of the stars for the rating, the value is stored
var ratingStars = 0;
function starRatings(rating) {
    ratingStars = rating;
}

//Listener for when the rating submit button is clicked
$(document).ready(function () {
    $("#btnRatingSubmit").click(function (e) {
        e.preventDefault();
        var movieId = $(this).val();

        //send the movieID and number of stars to a hidden text field
        $('#txtRatingStars').val(ratingStars);
        $('#txtMovieId').val(movieId);
        submitRating(movieId);
    });
});

//Triggers when the "Rate" button is click for a particular movie
function rateMovie(movieId) {
    if (movieId == null) {
        $.toast({
            heading: 'Movie rated',
            text: "You have previously rated this movie",
            showHideTransition: 'slide',
            position: 'bottom-right',
            icon: 'info',
            hideAfter: 5000
        });
    }
    else {
        //Use the movieID to get additional details for this particular movie
        var movieDetails;
        $("#ratingDiv").dialog({ modal: true }).dialog('open').dialog("option", "width", 800);

        $.ajax({
            async: false,
            type: 'GET',
            url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/getMovieDetails.php?movieId=' + movieId,
            success: function (data) {
                openRateModal(JSON.parse(data));
            }
        });
    }
}
function openRateModal(movieDetails) {

    //Set variables for the various required fields
    var title = movieDetails[0].Title;
    var id = movieDetails[0].id;
    var ReleaseDate = movieDetails[0].ReleaseDate;
    var Genre = movieDetails[0].Genre;
    var Image = movieDetails[0].Image;
    var Trailer = movieDetails[0].Trailer;
    var BoxOffice = parseInt(movieDetails[0].BoxOffice);

    //Reset all fields from prior ratings
    $('#ratingImage').attr('src', Image);
    $('#btnRatingSubmit').attr('value', id);
    $('#movieTitle').html(title);
    $('#txtMovieTitle').val(title);
    $('#txtComments').val('');
    $('.ratingBtns').prop('checked', false);

    //TODO: Remove below, for debugging only
    $.toast({
        heading: 'Success',
        text: title + '<br />' + ReleaseDate + '<br />' + Genre + '<br />' + Image + '<br />$' + BoxOffice.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"),
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'success'
    });
}

function submitRating(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        var datastring = $("#ratingForm").serialize();
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/moviereviewRepo/MovieReview/api/processRating.php",
            data: datastring,
            dataType: "json",
            success: function (data) {
                // show when the button is clicked
                $.toast({
                    heading: 'Movie rated',
                    text: data,
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'success',
                    hideAfter: 5000
                });
                var buttonId = "movieId" + movieId;

                $("#ratingDiv").dialog('close');
                $(buttonId).addClass('btn-outline-success rateBtn').removeClass('btn-outline-secondary rateBtn');
                document.getElementById(movieId).setAttribute("Title", "You already rated this movie");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.toast({
                    heading: 'Rating Failed',
                    text: xhr.responseText,
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'error',
                    hideAfter: false
                });
            }
        });
    }
}
//*************************************************************************************
