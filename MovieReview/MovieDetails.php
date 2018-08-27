<?php
   session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <script src="scripts/jQuery-UI.js"></script>
    
    <!--2 links to the jquery-ui, the first is for offline situations-->
    <link href="styles/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
</head>
<body>
    <?php include("includes/header.php");?>
    <div id="content">

        <!-- Breadcrumbs -->
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li>Movie Details</li>
            </ul>
        </div>

        <div class="container">                
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "moviereview");

                    $movieId=$_GET["movieId"];
                    $memberId=0;
                    if(isset($_SESSION['username'])) {
                        $memberId=$_SESSION['memberID'];
                    }
                    
                    $sql="call sp_GetMovieDetails($movieId, $memberId)";
                    $result=mysqli_query($link, $sql);
                    $row=mysqli_fetch_array($result);
                    
                    $movieId=$row["Movie_ID"];
                    $title=$row["Title"];
                    $releaseDate=$row["ReleaseDate"];
                    $genreId=$row["Genre_ID"];
                    $description=$row["Description"];
                    $image=$row["Image"];
                    $trailer=$row["Trailer"];
                    $genre=$row["Genre"];
                    $LikeID=$row["Like_ID"];
                    $RatingID=$row["Rating_ID"];
                    $boxOffice=$row["BoxOffice"];
                    $numLikes=$row["num_likes"];
                    $numRatings=$row["num_ratings"];
                    $avgRating=$row["avgStars"];
                    //Add a space seperator between actor names
                    $actors=str_replace(",",", ",$row["Actors"]);

                    echo "<h2>Movie Details</h2>
                        <br />
                        <div class='row'>";


                    echo "
                    <input type='text' id='txtId' name='txtId' class='hiddenFields' value='$movieId'>
                    <div class='col-sm-8'>
                        
                        <img id='main' class='img-fluid detailsImg' src='$image' align='Left' />
                        <h4>Synopsis</h4>
                        <p>$description</p>
                    </div>

                    <div class='col-sm-4'>
                        <div id='rightColumn'>
                            <h6>$title (<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> <span id='NumLikes'>$numLikes</span>)</h6>
                            <div class='rating-set'>";
                                if($avgRating < 1) {
                                    echo "<i class='fa fa-star' aria-hidden='true' title='Movie not rated yet'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='Movie not rated yet'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='Movie not rated yet'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='Movie not rated yet'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='Movie not rated yet'></i>";
                                } 
                                else if ($avgRating < 2) {
                                    echo "<i class='fa fa-star gold' aria-hidden='true' title='1/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>";
                                } 
                                else if ($avgRating < 3) {
                                    echo "<i class='fa fa-star gold' aria-hidden='true' title='2/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='2/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>";
                                } 
                                else if ($avgRating < 4) {
                                    echo "<i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='3/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='3/5 stars'></i>";
                                } 
                                else if ($avgRating < 5) {
                                    echo "<i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                            <i class='fa fa-star' aria-hidden='true' title='4/5 stars'></i>";
                                } 
                                else if ($avgRating < 6) {
                                    echo "<i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                            <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>";
                                } 
                            echo "</div><br />";
                    
                    //*****************Like Button*****************
                    //If user is logged in, show rate and like buttons
                    if($memberId > 0 && $LikeID == null) {
                        echo "<button type='button' class='btn btn-lg btn-outline-secondary' id='$movieId' title='Click here to like this movie' onclick='TrackLike(this.value)' value='$movieId' data-likes='$numLikes'><i class='fa fa-thumbs-o-up' aria-hidden='true'> $numLikes</i></button>";
                    }
                    //User has logged in and has already liked this movie
                    else if($memberId > 0 && $LikeID != null) {
                        echo "<button type='button' class='btn btn-lg btn-outline-success' id='$movieId' title='You already like this movie' onclick='TrackUnLike(this.value)' value='$movieId'data-likes='$numLikes'><i class='fa fa-thumbs-o-up' aria-hidden='true'> $numLikes</i></button>";
                    }
                    //*****************END Like Button*****************
                    
                    //*****************Rating Button*****************
                    //User is logged in and hasnt previously rated this movie
                    if($memberId > 0 && $RatingID == null) {
                        echo "<button type='button' class='btn btn-lg btn-outline-secondary rateBtn' onclick='RateMovie(this.value)' id='movieID$movieId' title='Click here to rate this movie' value='$movieId'>Rate</button>";
                    }
                    else if($memberId > 0 && $RatingID != null) {
                        echo "<button type='button' class='btn btn-lg btn-outline-success rateBtn' onclick='RateMovie()' id='movieID$movieId' value='$movieId' title='You already rated this movie'>Rate</button>";
                    }
                    //*****************END Rating Button*****************
                    
                    
                    echo "<br /><br /><h7>Released: </h7>$releaseDate
                            <br /><br />
                            <h7>Genre: </h7>$genre
                            <br /><br />
                            <h7>Starring</h7> $actors<br /><br />
                            <h7>Box Office: </h7>$"; echo number_format($boxOffice);
                            
                    
                            
                    echo "<br />
                            <br />
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h7>Trailer</h7>
                                    $trailer
                                </div>
                            </div>
                            <br /><br />";

                            mysqli_close($link);
                ?>
                        
                    </div>
                </div>
            </div>

        <hr />
        <h2>All reviews</h2>
        <!--Ratings-->
        <table class="table" id="reviewsTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Stars</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date Added</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $server="localhost";
                $dbuser="root";
                $password="";
                $link=mysqli_connect($server, $dbuser, $password);
                mysqli_select_db($link, "moviereview");

                $sql="call sp_GetRatings($movieId)";
                $result=mysqli_query($link, $sql);

                $rowID = 0;

                if(mysqli_num_rows($result) > 0)
                {
                    while($row=mysqli_fetch_array($result)) {
                        $title=$row["Title"];
                        $ratingStars=$row["RatingStars"];
                        $comments=$row["Comments"];
                        $dateAdded=date('Y-m-d', strtotime($row["DateAdded"]));
                        $releaseDate=$row["ReleaseDate"];
                        $boxOffice=$row["BoxOffice"];
                        $genre=$row["Genre"];
                        $ratingId=$row["Rating_ID"];
                        $rowID = $rowID + 1;
                        //"; echo number_format($boxOffice);

                        echo "<tr id='ratingRow$ratingId'><th scope='row'>$rowID</th>";
                        echo "<td>$title</td>";
                        echo "<td>";
                        if($ratingStars == 1) {
                            echo "<i class='fa fa-star gold' aria-hidden='true' title='1/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='1/5 stars'></i>";
                        } 
                        else if ($ratingStars == 2) {
                            echo "<i class='fa fa-star gold' aria-hidden='true' title='2/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='2/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='2/5 stars'></i>";
                        } 
                        else if ($ratingStars == 3) {
                            echo "<i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='3/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='3/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='3/5 stars'></i>";
                        } 
                        else if ($ratingStars == 4) {
                            echo "<i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='4/5 stars'></i>
                                <i class='fa fa-star' aria-hidden='true' title='4/5 stars'></i>";
                        } 
                        else if ($ratingStars == 5) {
                            echo "<i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>
                                <i class='fa fa-star gold' aria-hidden='true' title='5/5 stars'></i>";
                        } 
                        echo "</td>";
                        echo "<td>$comments</td>";
                        echo "<td>$dateAdded</td>";
                        echo "</tr>";
                    }
                }
                mysqli_close($link);
                ?>

            </tbody>
        </table>
        </div>
        <br />
    </div>
    <?php include("includes/footer.html");?>
    <div style="display:none;">
        <?php include("includes/movieRating.html");?>
    </div>
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
<script src="scripts/likeSystem.js"></script>
<script src="scripts/ratingSystem.js"></script>

<!-- Toast -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />
