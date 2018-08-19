<?php
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>

    <!--2 links to the jquery-ui, the first is for offline situations-->
    <link href="styles/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

    <script src="scripts/bootstrap.js"></script>

</head>
<body>
    <?php include("includes/header.php");?>
    <div id="content">

        <!-- Breadcrumbs -->
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
            </ul>
        </div>
        <div class="album py-5 bg-light">   

        <div class="container">
            <!--*****************Search Function*****************-->
            <div class="row">   
                <div class='col-sm-5'>
                    <input type="text" id="txtSearch" name="txtSearch" class="form-control-searchbar" placeholder="Search term...">
                    
                </div>
                <div class='col-sm-7'>
                    <h4>Sort By: </h4>
                        <fieldset id="sortOptions">
                            <input type="radio" id="btnAlpha" name="sortOptions"> Alphabetical   |   </input>
                            <input type="radio" id="btnBoxOffice" name="sortOptions"> Box Office   |   </input>
							<input type="radio" id="btnLikes" name="sortOptions"> Likes   |   </input>
                            <input type="radio" id="btnRating" name="sortOptions"> Rating   |   </input>                           
                            <input type="radio" id="btnReleaseDate" name="sortOptions"> Release Date </input>
                        </fieldset>
                </div>
            </div>
            <hr />
            <!--*****************Seach Function*****************-->
            
            <div class="row" id="movieRow">
            <!-- Movie albums -->
            <?php
                $server="localhost";
                $dbuser="root";
                $password="";
                $link=mysqli_connect($server, $dbuser, $password);
                mysqli_select_db($link, "moviereview");
                $memberId=0;
                if(isset($_SESSION['username'])) {
                    $memberId=$_SESSION['memberID'];
                }
                $sql="call sp_GetInitialMovieInfo($memberId)";

                $result=mysqli_query($link, $sql);
                $elementID = 0;

                if(mysqli_num_rows($result) > 0)
                {
                    while($row=mysqli_fetch_array($result)) {
                    $movieId=$row["movie_id"];
                    $title=$row["title"];
                    $image=$row["image"];
                    $releaseDate=$row["releasedate"];
                    $LikeID=$row["Like_ID"];
                    $RatingID=$row["Rating_ID"];
                    $isAdmin=$row["IsAdmin"];
                    $boxOffice=$row["BoxOffice"];
                    $avgRating=$row["avgStars"];
                    $actors=$row["MovieActors"];
                    $genre=$row["Genre"];
                    $numLikes=$row["num_likes"];
                    $numRatings=$row["num_ratings"];
                    $releaseDateYear=substr($releaseDate, 0,4);
                    $elementID = $elementID + 1;

                    echo "<div class='col-md-3 movieCards' data-boxOffice=$boxOffice data-releaseDate='$releaseDate' data-title='$title' data-rating='$avgRating' data-likes='$numLikes'>
                        <div class='card mb-3 box-shadow' id='movieCard$elementID'>
                        <a href='MovieDetails.php?movieId=$movieId'><img class='card-img-top' src='$image' alt='Card image cap'></a>
                        <div class='card-body'>
                        <p class='card-text'><strong>$title</strong> <span class='text-secondary'>($releaseDateYear)</span></p>
                        <div class='d-flex justify-content-between align-items-center'>
                        <div class='btn-group' id='movieBtnGroup$elementID'>";
                    
                    //Hidden field for the actors names and movie genre - used for searches
                    echo "<p class='hiddenFields'>$actors - $genre</p>";

                    //***********************************************
                    //Check if the user is logged in or not. If they are, display like and rating buttons differently
                    //***********************************************
        
                    //*****************Like Button*****************
                    //User is logged in and hasnt previously liked this movie
                    if($memberId > 0 && $LikeID == null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary' id='$movieId' title='Click here to like this movie' onclick='TrackLike(this.value)' value='$movieId' data-likes='$numLikes'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i> $numLikes</button>";
                    }
                    //User has logged in and has already liked this movie
                    else if($memberId > 0 && $LikeID != null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-success' id='$movieId' title='You already like this movie' onclick='TrackUnLike(this.value)' value='$movieId'  data-likes='$numLikes'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i> $numLikes</button>";
                    }
                    //User has not logged in
                    else {
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary' title='You must login' onclick='TrackLike()' id='$movieId' data-likes='$numLikes'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i> $numLikes</button>
                            <button type='button' class='btn btn-sm btn-outline-secondary rateBtn' onclick='rateMovie(1)' id='movieID$movieId' value='$movieId'>Rate</button> ";
                    }
                    //*****************END Like Button*****************


                    //*****************Rating Button*****************
                    //User is logged in and hasnt previously rated this movie
                    if($memberId > 0 && $RatingID == null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary rateBtn' onclick='rateMovie(this.value)' id='movieID$movieId' value='$movieId'>Rate</button>";
                    }
                    else if($memberId > 0 && $RatingID != null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-success rateBtn' onclick='rateMovie()' id='movieID$movieId' value='$movieId' title='You already rated this movie'>Rate</button>";
                    }

                    //*****************END Rating Button*****************

					//*****************Edit Button*****************
                    //User is logged in and is admin
                    if($isAdmin > 0) {
						echo "<button type='button' class='btn btn-sm btn-outline-info' onclick='EditMovie(this.value)' value='$movieId'>Edit</button>";
					}
                        echo "</div>";
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
                        echo "<br />";     
                        
                        echo "</div></div> </div></div>";
                    
                }
            }
            else
            {
                echo "<h5>No results found</h5>";
            }
            mysqli_close($link);
				?>
            </div>
        </div>
        </div>
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
<script src="scripts/jQuery-UI.js"></script>
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
<script src="scripts/searchAndSort.js" type="text/javascript"></script>

<!-- Toast -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

<!-- Driver -->
<link href="styles/Driver.min.css" rel="stylesheet" />
<script src="scripts/Driver/Driver.min.js"></script>



