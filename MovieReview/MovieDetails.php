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
            <h2>Movie Details</h2>
            <br />
            <form action="processViewRequest.php" method="post">
    
                <div class="row">
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

                    echo "
                    <input type='text' id='txtId' name='txtId' class='hiddenFields' value='$movieId'>
                    <div class='col-sm-8'>
                        <div id='mainImage'>
                            <img id='main' class='img-fluid' src='$image' />
                        </div>
                        <br />
                    
                        <h2>Synopsis</h2>
                        <p>$description</p>
                    </div>

                    <div class='col-sm-4'>
                        <div id='rightColumn'>
                            <h3>$title</h3>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div id='priceDetails'>Released: $releaseDate</div>
                                </div>
                            </div>
                        
                            <br />
                            
                            <br />
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h4>Trailer</h4>
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
