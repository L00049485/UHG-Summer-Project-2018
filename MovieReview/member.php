<?php
    session_start();
    if(!isset($_SESSION['username']))
        header("Location:default.php");
?>

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
    <?php include("includes/header.php");?>
    
    <div class="container">
        <!-- If the member is an administrator, display additional menu items -->
        <?php

            $isAdmin=$_SESSION['isAdmin'];

            if($isAdmin == 1)
            {
                echo "<h2>Admin functions</h2><br />";
                echo "<a href='AdminEdit.php' class='btn btn-primary' id='btnAddMovie'>Add a new movie</a>  ";        
                echo "<button type='submit' class='btn btn-primary' id='btnMakeUserAdmin'>Make user Admin</button>  ";
                
                echo "<br /><br /><hr />";
            }
        ?>


        <h2>Your details</h2>

        <br />
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

            $sql="call sp_GetMemberDetails($memberId)";
            $result=mysqli_query($link, $sql);
            $row=mysqli_fetch_array($result);

            $firstName=$row["Firstname"];
            $lastName=$row["Lastname"];
            $dob=$row["DOB"];
            $emailAddress=$row["EmailAddress"];
            $phoneNo=$row["PhoneNo"];
            $address1=$row["Address1"];
            $address2=$row["Address2"];
            $city=$row["City"];
            $state=$row["State"];
            $country=$row["Country"];

            echo "<div class='row'> ";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>First Name: </span>$firstName <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Last Name: </span>$lastName <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>DOB: </span>$dob <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Email Address: </span>$emailAddress <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Phone No: </span>$phoneNo <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Address 1: </span>$address1 <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Address 2: </span>$address2 <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>City: </span>$city <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>State: </span>$state <br /><br />";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo "<span class='bold'>Country: </span>$country <br /><br />";
            echo "</div>";

            echo "</div>";

            mysqli_close($link);
        ?>
        <br />
        <hr />
        <br />
        <h2>Your reviews</h2>
        <!--Ratings-->
        <table class="table" id="reviewsTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Stars</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date Added</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Box Office</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
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

                    $sql="call sp_GetMemberRatings($memberId)";
                    $result=mysqli_query($link, $sql);

                    $rowID = 0;

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {
                            $title=$row["Title"];
                            $ratingStars=$row["RatingStars"];
                            $comments=$row["Comments"];
                            $dateAdded=$row["DateAdded"];
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
                            echo "<td>$releaseDate</td>";
                            echo "<td>$"; echo number_format($boxOffice);
                            echo "</td>";
                            echo "<td>$genre</td>";
                            echo "<td><button type='button' class='btn btn-sm btn-outline-primary' id='$ratingId' title='Click here to delete this rating' onclick='deleteRating(this.value, this.id)' value='$ratingId'>Delete</button></td>";
                            echo "</tr>";
                        }
                    }
                    mysqli_close($link);
                ?>
            </tbody>
        </table>
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
<!-- Toast -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

<!--Custom JS functions-->
<script src="scripts/Custom.js"></script>
<script src="scripts/ratingSystem.js"></script>