﻿<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>
</head>
<body>
    <?php include("includes/header.php");?>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php
                header('X-XSS-Protection:0');
                $server="localhost";
                $dbuser="root";
                $password="";
                $link=mysqli_connect($server,$dbuser,$password);
                mysqli_select_db($link, "moviereview");

                $firstName=$_POST["txtFirstName"];
                $lastName=$_POST["txtLastName"];
                $dob=$_POST["txtDOB"];
                $email=$_POST["txtEmailAddress"];
                $phoneNo=$_POST["txtPhoneNo"];
                $address1=$_POST["txtAddress1"];
                $address2=$_POST["txtAddress2"];
                $city=$_POST["txtCity"];
                $state=$_POST["txtState"];
                $country=$_POST["txtCountry"];
                $password=$_POST["txtPassword"];

                createMember($link, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors);

                function createMember($link, $movieTitle, $releaseDate, $genre, $desc, $image, $trailer, $actors) {
                    //$sql_insert="INSERT INTO movie(
                    //Title, ReleaseDate, Genre_ID, Description, Image, Trailer) VALUES (
                    //'$movieTitle', '$releaseDate', '$genre', '$desc', '$image', '$trailer')";

                    $sql_insert="call sp_InsertMovie('$movieTitle', '$releaseDate', '$genre', '$desc', '$image', '$trailer')";

                    //echo $sql_insert;

                    if(mysqli_query($link, $sql_insert)) {
                        $movieId = $link->insert_id;
                        insertActors($link, $movieId, $actors);
                        echo "<br /><h3>Movie Successfully Added</h3>";
                        echo "Click <a href='AdminAdd.php'>here </a>to return to Admin page, or <a href='movieDetails.php?id=$movieId' target='_blank'>here </a>to preview the new movie.";
                    }
                    else {
                        echo "<br /><h3>Something went wrong!</h3>";
                        echo "<a href='adminadd.php'>Return to Admin page</a>";
                    }
                }
                


                //Splits the comma seperated list of actors and inserts each one into the actor_movie table
                function insertActors($link, $movieId, $actors) {
                    $actorsArray = explode(',', $actors);
                    foreach($actorsArray as $actor){
                        
                        $sql_insert="call sp_InsertMovieActor($movieId, $actor)";
                        echo $sql_insert;
                        mysqli_query($link, $sql_insert);
                    }
                }

                mysqli_close($link);
            ?>
                
        </div>
    </div>
    <?php include("includes/footer.html");?>
</body>
</html>

<!-- Styles -->
<link href="styles/mdb.css" rel="stylesheet" />
<link href="styles/bootstrap.css" rel="stylesheet" />
<link href="styles/StyleSheet.css" rel="stylesheet" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,500,600,700" rel="stylesheet">
<script src="scripts/mdb.js"></script>
<!--Chosen-->
<link href="scripts/Chosen/chosen.css" rel="stylesheet" />
<script src="scripts/Chosen/chosen.jquery.js"></script>
<script src="scripts/Chosen/chosen.proto.js"></script>

<!--Custom JS functions-->
<script src="scripts/Custom.js"></script>