<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>

    <script>
        function trackLike(movieId) {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xmlhttp.open("GET", "processLike.php?movieId=" + movieId, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <?php include("includes/header.html");?>

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
                
                $sql="SELECT 
                    movie_id,
                    title,
                    image,
                    releasedate
                    FROM movie order by releasedate desc";

                $result=mysqli_query($link, $sql);

                if(mysqli_num_rows($result) > 0)
                {
                    while($row=mysqli_fetch_array($result)) {
                    $movieId=$row["movie_id"];
                    $title=$row["title"];
                    $image=$row["image"];
                    $releaseDate=$row["releasedate"];
                    $releaseDate=substr($releaseDate, 0,4);   

                    echo "<div class='col-md-3'>
                        <div class='card mb-3 box-shadow'>
                            <a href='MovieDetails.php?movieId=$movieId'><img class='card-img-top' src='$image' alt='Card image cap'></a>
                            <div class='card-body'>
                                <p class='card-text'>$title ($releaseDate)</p>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-outline-secondary' title='Like movie' onclick='trackLike(this.value)' value='$movieId'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>
                                        <button type='button' class='btn btn-sm btn-outline-secondary'>Rate</button>
                                        <a href='AdminEdit.php?movieid=$movieId'><div class='btn btn-sm btn-outline-secondary' >Edit</div></a>
                                    </div>
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
