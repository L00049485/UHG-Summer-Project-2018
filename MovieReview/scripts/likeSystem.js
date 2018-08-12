//*************************************************************************************
//********************************Movie Likes******************************************
//*************************************************************************************

function trackLike(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var buttonId = "#" + movieId;
                var numLikes = Number($(buttonId).attr('data-likes'));
                var numLikesNew = numLikes + 1;

                $(buttonId).addClass('btn-outline-success').removeClass('btn-outline-secondary');
                document.getElementById(movieId).setAttribute("onclick", "javascript: trackUnLike(this.value);");
                document.getElementById(movieId).setAttribute("Title", "You already like this movie");
                $(buttonId).html("<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + numLikesNew);
                $(buttonId).attr("data-likes", numLikesNew);

                $(buttonId).fadeIn(1000).fadeOut(1000).fadeIn(1000);

                // show when the button is clicked
                $.toast({
                    heading: 'Confirmed',
                    text: 'Movie Liked!',
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'success'
                });
            }
        };
        xmlhttp.open("GET", "api/processLike.php?movieId=" + movieId, true);
        xmlhttp.send();
    }
}
function trackUnLike(movieId) {
    if (movieId == null) {
        $("#login-modal").modal();
    }
    else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var buttonId = "#" + movieId;
                var numLikes = Number($(buttonId).attr('data-likes'));
                var numLikesNew = numLikes - 1;

                $(buttonId).addClass('btn-outline-secondary').removeClass('btn-outline-success');
                document.getElementById(movieId).setAttribute("onclick", "javascript: trackLike(this.value);");
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
        };
        xmlhttp.open("GET", "api/processUnLike.php?movieId=" + movieId, true);
        xmlhttp.send();
    }
}