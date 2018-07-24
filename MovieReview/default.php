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
    <script src="scripts/jQuery-UI.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
    <script src="scripts/bootstrap.js"></script>

</head>
<body>
    <?php include("includes/header.php");?>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
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
                $sql="SELECT 
	                m.movie_id,
	                title,
                    image,
                    releasedate,
                    l.Like_ID
                 FROM `movie` as m left outer join `likes` as l  on 
	                m.Movie_ID = l.Movie_ID AND
                    l.Member_ID = $memberId order by releasedate desc";

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
                    $releaseDate=substr($releaseDate, 0,4);   
                    $elementID = $elementID + 1;

                    echo "<div class='col-md-3'>
                        <div class='card mb-3 box-shadow' id='movieCard$elementID'>
                            <a href='MovieDetails.php?movieId=$movieId'><img class='card-img-top' src='$image' alt='Card image cap'></a>
                            <div class='card-body'>
                                <p class='card-text'>$title ($releaseDate)</p>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group' id='movieBtnGroup$elementID'>";
                    
                    //***********************************************
                    //Check if the user is logged in or not.
                    //***********************************************
                    //User is logged in and hasnt previously liked this movie
                    if($memberId > 0 && $LikeID == null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary' id='$movieId' title='Click here to like this movie' onclick='trackLike(this.value)' value='$movieId'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>"; 
                    }
                    //User has logged in and has already liked this movie
                    else if($memberId > 0 && $LikeID != null) {
                        echo "<button type='button' class='btn btn-sm btn-outline-success' id='$movieId' title='You already like this movie' onclick='trackUnLike(this.value)' value='$movieId' ><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>"; 
                    }
                    //User has not logged in
                    else {                        
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary' title='You must login' onclick='trackLike()'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>";      
                    }                                                                          
                    
                    //Rating Button
                    if($memberId > 0) {
                        echo "<button type='button' class='btn btn-sm btn-outline-secondary rateBtn' onclick='rateMovie(this.value)' id='movieID$movieId' value='$movieId'>Rate</button>                      
                                        <a href='AdminEdit.php?movieid=$movieId'><div class='btn btn-sm btn-outline-secondary' >Edit</div></a>";
                    }
                                    echo "</div>
                                </div>
                            </div>
                        </div>
                    </div>";
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
    <?php include("includes/footer.html");?>

    <div id="ratingDiv">
        <div class='col-sm-4'>
            <img class='img-fluid detailsImg' src='' align='Left' id="ratingImage" />
        </div>    
        <div class='col-sm-12'>
            <h3 id="movieTitle"></h3>
            Your overall rating:
            <div class="rating">
                <input name="myrating" type="radio" value="5" class="ratingBtns" onclick='starRatings(this.value)'/><span>☆</span>
                <input name="myrating" type="radio" value="4" class="ratingBtns" onclick='starRatings(this.value)'/><span>☆</span>
                <input name="myrating" type="radio" value="3" class="ratingBtns" onclick='starRatings(this.value)'/><span>☆</span>
                <input name="myrating" type="radio" value="2" class="ratingBtns" onclick='starRatings(this.value)'/><span>☆</span>
                <input name="myrating" type="radio" value="1" class="ratingBtns" onclick='starRatings(this.value)'/><span>☆</span>                              
            </div>
            <br />
            Your comments:
            <br />
            <textarea rows="4" cols="40" name="txtComments" id="txtComments"></textarea>
            <button type='button' class='btn btn-primary' onclick='submitRating(this.value)' value='' id="btnRatingSubmit">Submit</button>
        </div>
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

<!-- Toastr -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

<!-- Driver -->
<link href="styles/Driver.min.css" rel="stylesheet" />
<script src="scripts/Driver/Driver.min.js"></script>


