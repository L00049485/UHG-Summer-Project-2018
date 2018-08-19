<?php
    header('Content-type: application/json');
    header('X-XSS-Protection:0');
    session_start();
    if(isset($_SESSION['username'])) {
       

        $postForm = $_POST;

        $movieTitle=$_POST["txtMovieTitle"];
        $releaseDate=$_POST["txtReleaseDate"];
        $genre=$_POST["genre"];
        $desc=$_POST["txtDesc"];
        $image=$_POST["txtImages"];
        $trailer=$_POST["txtTrailer"];
        $actors=$_POST["txtActors"];
        $boxOffice=$_POST["txtBoxOffice"];
        $movieId=0;


        //Updates the movie and triggers the update of the actors
        function AddMovie($boxOffice, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors) {
            $server="localhost";
            $dbuser="root";
            $password="";
            $link=mysqli_connect($server,$dbuser,$password);
            mysqli_select_db($link, "moviereview");
    
            $sql_update="call sp_AddMovie($boxOffice, '$desc', $genre, '$image', '$releaseDate', '$movieTitle', '$trailer');";
            $result=mysqli_query($link, $sql_update);
            if(mysqli_num_rows($result) > 0)
            {
                while($row=mysqli_fetch_array($result)) {
                    $movieId=$row["movieId"];
                
                    insertActors($link, $movieId, $actors);

                    echo json_encode("$movieTitle Successfully added.  ");
                }
            }
            else {
                echo json_encode("Movie not added $movieTitle. Error: ".mysqli_error($link));
            }
            
        }

        //Splits the comma seperated list of actors and inserts each one into the actor_movie table
        function insertActors($link, $movieId, $actors) {
            $server="localhost";
            $dbuser="root";
            $password="";
            $link=mysqli_connect($server,$dbuser,$password);
            mysqli_select_db($link, "moviereview");
            $actorsArray = explode(',', $actors);
            
            //Delete any existing movie_actor records for this movie before inserting the new records
            $sql_insert="call sp_ResetMovieActor($movieId)";

            foreach($actorsArray as $actor){
                $sql_insert="call sp_InsertMovieActor($movieId, $actor)";
                if(!mysqli_query($link, $sql_insert))
                {
                    echo json_encode("Actor insert errors: ".mysqli_error($link));
                }
            }

            mysqli_close($link);
        }

        AddMovie($boxOffice, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors);
    }
    else {
        echo "You must login to add a movie";
    }

  