<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>
</head>
<body>
    <?php include("includes/header.html");?>
    <div id="content">
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li>Movie Details</li>
            </ul>
        </div>

        <div class="container">
            
            <form action="processViewRequest.php" method="post">
                
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "moviereview");

                    $movieId=$_GET["movieId"];
                    $sql="SELECT * FROM movie where Movie_ID = $movieId";
                    $result=mysqli_query($link, $sql);
                    $row=mysqli_fetch_array($result);

                    $movieId=$row["Movie_ID"];
                    $title=$row["Title"];
                    $releaseDate=$row["ReleaseDate"];
                    $genreId=$row["Genre_ID"];
                    $description=$row["Description"];
                    $image=$row["Image"];
                    $trailer=$row["Trailer"];
                    //$actors=$row["actors"];

                    echo "<h2>Movie Details</h2>
                        <br />
                        <div class='row'>";


                    echo "
                    <input type='text' id='txtId' name='txtId' class='hiddenFields' value='$movieId'>
                    <div class='col-sm-8'>
                        
                        <img id='main' class='img-fluid detailsImg' src='$image' align='Left' />
                        <h3>Synopsis</h3>
                        <p>$description</p>
                    </div>

                    <div class='col-sm-4'>
                        <div id='rightColumn'>
                            <h3>$title</h3>
                            <br />
                            <h4>Released: </h4>$releaseDate
                            <br /><br />";
                            
                    $sql="call sp_GetMovieActors($movieId)";
                    $result=mysqli_query($link, $sql);
                    
                    echo "<h4>Starring</h4>";
                            
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {   
                            $actor=$row["Actor_Name"];
                            echo "$actor <br />";
                        }
                    }             
                            
                    echo "<br />
                            
                            <br />
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h3>Trailer</h3>
                                    $trailer
                                </div>
                            </div>
                            <br /><br />";

                            mysqli_close($link);
                        ?>
                        
                    </div>
                </div>
            </div>
            </form>
        </div>
        <br />
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
