//*************************************************************************************
//********************************Movie Rating*****************************************
//*************************************************************************************

//Global variables
//when the user clicks one of the stars for the rating, the value is stored
var ratingStars = 0;
function starRatings(rating) {
    ratingStars = rating;
}

//Triggers when the "Rate" button is click for a particular movie
function RateMovie(movieId) {
    if (movieId == 1) {
        $("#login-modal").modal();
    }
    else if (movieId == null) {        
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
            url: 'api/getMovieDetails.php?movieId=' + movieId,
            success: function (data) {
                openRateModal(JSON.parse(data));
            }
        });
    }
}

//Listener for when the rating submit button is clicked
$(document).ready(function () {
    $("#btnRatingSubmit").click(function (e) {
        e.preventDefault();
        var movieId = $(this).val();

        //send the movieID and number of stars to a hidden text field
        $('#txtRatingStars').val(ratingStars);
        $('#txtMovieId').val(movieId);
        if (ratingStars == 0) {
            $.toast({
                heading: 'Error',
                text: "You must select a star rating to proceed.",
                showHideTransition: 'slide',
                position: 'bottom-right',
                icon: 'error'
            });
        }
        else
            SubmitRating(movieId);
    });
});

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

/*************************************************************************************************
**********Name:             SubmitRating(movieId)
**********Author:           Kieran Quinn
**********Date Modified:    2018-08-16
**********Summary:          Takes a movie ID and sends it to the PHP script for adding to the db.
                            Also changes the css class of the rate button and onclick event.
*************************************************************************************************/
function SubmitRating(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        var datastring = $("#ratingForm").serialize();
        $.ajax({
            type: "POST",
            url: "api/processRating.php",
            data: datastring,
            dataType: "json",
            success: function (data) {
                if (data.indexOf('Error') < 1) {
                    $.toast({
                        heading: 'Movie rated',
                        text: data,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'success',
                        hideAfter: 5000
                    });
                    var buttonId = "movieID" + movieId;

                    $("#ratingDiv").dialog('close');
                    $("#" + buttonId).addClass('btn-outline-success').removeClass('btn-outline-secondary');
                    $("#" + buttonId).attr("Title", "You already rated this movie");
                    $("#" + buttonId).attr("onclick", "javascript: RateMovie();");

                    $("#" + buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);
                }
                else {
                    $.toast({
                        heading: 'Rating Failed',
                        text: data,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error',
                        hideAfter: false
                    });
                }
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

//When the user clicks the delete button next to any rating, it triggers this function
function deleteRating(ratingId, buttonId) {
    if (confirm('Are you sure you want to delete this rating?')) {
        $.ajax({
            async: false,
            type: 'GET',
            url: "api/deleteRating.php?ratingId=" + ratingId,
            success: function (data) {
                if (data == 1) {
                    $.toast({
                        heading: 'Success',
                        text: "Rating deleted",
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'success'
                    });
                    //Hide the row from the page when deleted
                    $("#ratingRow" + buttonId).hide();
                }
                else {
                    $.toast({
                        heading: 'Failed',
                        text: data,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error',
                        hideAfter: false
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.toast({
                    heading: 'Failed',
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

//This function handles the rating comments text field. The field is limited to 2000 characters
function countChar(val) {
    var maxChars = 201;
    var len = val.value.length;
    if (len >= 201) {
        val.value = val.value.substring(0, 201);
    } else {
        $('#txtChars').text(len + " / 200 characters used");
    }
};
//*************************************************************************************
