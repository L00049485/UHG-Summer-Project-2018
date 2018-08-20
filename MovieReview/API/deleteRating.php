<?php
    //**********************************************************************************
    //**********************************************************************************
    //**********************************************************************************
    //Author: Kieran Quinn
    //Date: 06-Aug-2018
    //Description: Deletes a rating if the user is logged in.
    //**********************************************************************************

    header('Content-type: application/json');
    header('X-XSS-Protection:0');
    session_start();
    if(isset($_SESSION['username'])) {
        $server="hostingmysql304.webapps.net";
        $dbuser="kqAdmin";
        $password="cl37kxQ1";
        $link=mysqli_connect($server,$dbuser,$password);
        mysqli_select_db($link, "moviereview");

        $ratingId=$_GET["ratingId"];

        $sql_delete="call sp_DeleteRating($ratingId)";

        if(mysqli_query($link, $sql_delete)) {
            echo '1';
        }
        else {
            echo "Movie not rated. Error: " . mysqli_error($link);
        }
    }
    else
        echo 'You are not logged on.';