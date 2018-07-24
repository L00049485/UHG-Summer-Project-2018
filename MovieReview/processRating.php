<?php
    session_start();
    if(isset($_SESSION['username'])) {
        header('X-XSS-Protection:0');
        $server="localhost";
        $dbuser="root";
        $password="";
        $link=mysqli_connect($server,$dbuser,$password);
        mysqli_select_db($link, "moviereview");
        $movieId=$_GET["movieId"];
        $comments=$_GET["comments"];
        $ratingStars=$_GET["ratingStars"];
        $memberId=$_SESSION['memberID'];

        $sql_insert="call sp_TrackRating($movieId, $memberId, '$comments', $ratingStars)";
        
        if(mysqli_query($link, $sql_insert)) {
            echo "Rating Successfully Added";
            //echo $sql_insert;
        }
        else {
            echo "Something went wrong!";
        }

        mysqli_close($link);
    }
    else {
        echo "You must login to rate a movie";
    }
?>
                