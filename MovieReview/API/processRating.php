<?php
	header('Content-type: application/json');
    session_start();
    if(isset($_SESSION['username'])) {
        header('X-XSS-Protection:0');
        $server="localhost";
        $dbuser="root";
        $password="";
        $link=mysqli_connect($server,$dbuser,$password);
        mysqli_select_db($link, "moviereview");

        $postForm = $_POST;

        $movieTitle=$_POST["txtMovieTitle"];
        $movieId=$_POST["txtMovieId"];
        $comments=$_POST["txtComments"];
        $ratingStars=$_POST["txtRatingStars"];
        $memberId=$_SESSION['memberID'];

        $sql_insert="call sp_TrackRating($movieId, $memberId, '$comments', $ratingStars)";

        if(mysqli_query($link, $sql_insert)) {
            echo json_encode("$movieTitle Rated Successfully");
        }
        else {
            echo json_encode("Movie not rated. Error: ".mysqli_error());
        }

        mysqli_close($link);
    }
    else {
        echo "You must login to rate a movie";
    }
?>
                