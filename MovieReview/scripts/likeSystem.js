//*************************************************************************************
//********************************Movie Likes******************************************
//*************************************************************************************

/*************************************************************************************************
**********Name:             TrackLike(movieId)
**********Author:           Kieran Quinn
**********Date Modified:    2018-08-18
**********Summary:          Takes a movie ID and sends it to the PHP script for adding to the db.
*************************************************************************************************/
function TrackLike(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        $.ajax({
            async: false,
            type: 'GET',
            url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/processLike.php?movieId=' + movieId,
            success: function (data) {
                if (data = "Like Successfully Added") {
                    var buttonId = "#" + movieId;
                    var numLikes = Number($(buttonId).attr('data-likes'));
                    var numLikesNew = numLikes + 1;

                    $(buttonId).addClass('btn-outline-success').removeClass('btn-outline-secondary');
                    document.getElementById(movieId).setAttribute("onclick", "javascript: trackUnLike(this.value);");
                    document.getElementById(movieId).setAttribute("Title", "You already like this movie");
                    $(buttonId).html("<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + numLikesNew);
                    $(buttonId).attr("data-likes", numLikesNew);

                    $(buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);

                    $.toast({
                        heading: 'Confirmed',
                        text: 'Movie Liked!',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'success'
                    });
                }
                else {
                    $.toast({
                        heading: 'Failed',
                        text: 'Error: ' + data,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error'
                    });
                }
            }
        });
    }
}

/*************************************************************************************************
**********Name:             TrackUnLike(movieId)
**********Author:           Kieran Quinn
**********Date Modified:    2018-08-18
**********Summary:          Takes a movie ID and sends it to the PHP script for removing from db.
*************************************************************************************************/
function TrackUnLike(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        $.ajax({
            async: false,
            type: 'GET',
            url: 'http://localhost:8080/moviereviewRepo/MovieReview/api/processUnLike.php?movieId=' + movieId,
            success: function (data) {
                if (data = "Like Successfully Removed") {
                    var buttonId = "#" + movieId;
                    var numLikes = Number($(buttonId).attr('data-likes'));
                    var numLikesNew = numLikes - 1;

                    $(buttonId).addClass('btn-outline-secondary').removeClass('btn-outline-success');
                    document.getElementById(movieId).setAttribute("onclick", "javascript: TrackLike(this.value);");
                    document.getElementById(movieId).setAttribute("Title", "Click here to like this movie");
                    $(buttonId).html("<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + numLikesNew);
                    $(buttonId).attr("data-likes", numLikesNew);

                    $(buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);

                    // show when the button is clicked
                    $.toast({
                        heading: 'Confirmed',
                        text: 'Movie Un-Liked!',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'warning'
                    });
                }
                else {
                    $.toast({
                        heading: 'Failed',
                        text: 'Error: ' + data,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error'
                    });
                }
            }
        });
    }
}
