<?php
    header('Content-type: application/json');
    header('X-XSS-Protection:0');
    session_start();
    if(isset($_SESSION['username'])) {
        $server="hostingmysql304.webapps.net";
        $dbuser="kqAdmin";
        $password="cl37kxQ1";
        $link=mysqli_connect($server,$dbuser,$password);
        mysqli_select_db($link, "moviereview");

        $postForm = $_POST;

        $movieId=$_POST["txtMovieId"];
        $movieTitle=$_POST["txtMovieTitle"];
        $releaseDate=$_POST["txtReleaseDate"];
        $genre=$_POST["genre"];
        $desc=$_POST["txtDesc"];
        $image=$_POST["txtImages"];
        $trailer=$_POST["txtTrailer"];
        $actors=$_POST["txtActors"];

        //Updates the movie and triggers the update of the actors
        function UpdateMovie($link, $movieId, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors) {
            $sql_update="call sp_UpdateMovie('$movieTitle', '$releaseDate', '$genre', '$desc', '$image', '$trailer', $movieId)";

            if(mysqli_query($link, $sql_update)) {
                insertActors($link, $movieId, $actors);
                echo json_encode("$movieTitle Successfully updated");
            }
            else {
                echo json_encode("Movie not updated. Error: ".mysqli_error());
            }
        }

        //Splits the comma seperated list of actors and inserts each one into the actor_movie table
        function insertActors($link, $movieId, $actors) {
            $actorsArray = explode(',', $actors);

            //Delete any existing movie_actor records for this movie before inserting the new records
            $sql_insert="call sp_ResetMovieActor($movieId)";

            foreach($actorsArray as $actor){
                $sql_insert="call sp_InsertMovieActor($movieId, $actor)";
                mysqli_query($link, $sql_insert);
            }
        }

        UpdateMovie($link, $movieId, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors);

        mysqli_close($link);
    }
    else {
        echo "You must login to update a movie";
    }

  