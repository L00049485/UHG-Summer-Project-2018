<!DOCTYPE html>
<html>
<head>
    <title>Axe Property</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <script src="scripts/Custom.js"></script>

    <!-- Styles -->
    <link href="styles/mdb.css" rel="stylesheet" />
    <link href="styles/bootstrap.css" rel="stylesheet" />
    <link href="styles/StyleSheet.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,500,600,700" rel="stylesheet">

    <!-- noUISlider -->
    <link href="scripts/noUiSlider/nouislider.css" rel="stylesheet" />
    <script src="scripts/noUiSlider/nouislider.js"></script>
    <script src="scripts/noUiSlider/wNumb.js"></script>

    <!--Chosen-->
    <link href="scripts/Chosen/chosen.css" rel="stylesheet" />
    <script src="scripts/Chosen/chosen.jquery.js"></script>
    <script src="scripts/Chosen/chosen.proto.js"></script>
</head>
<body>
    <?php include("includes/header.html");?>
    <br />
    <br />
    <br />
    <div id="content">
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li><a href="property.php">Property</a></li>
                <li>Property Details</li>
            </ul>
        </div>
        <br />
        
        <div class="container">
            <h2>Property Details</h2>
            <br />
            <form action="processViewRequest.php" method="post">
    
                <div class="row">
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "property");

                    $propId=$_GET["id"];
                    $sql="SELECT * FROM property where propertyid = $propId";
                    $result=mysqli_query($link, $sql);
                    $row=mysqli_fetch_array($result);

                    $propId=$row["propertyid"];
                    $address=$row["address1"];
                    $town=$row["town"];
                    $county=$row["county"];
                    $mapLink=$row["mapLink"];
                    $price=number_format($row["price"]);
                    $bedrooms=$row["bedrooms"];
                    $bathrooms=$row["bathrooms"];
                    $shortdesc=$row["shortdescription"];
                    $longdesc=$row["longdescription"];
                    $image=$row["image"];
                    $status=$row["status"];
                    $size=$row["size"];
                    $images = explode(',', $image);

                    echo "
                    <input type='text' id='txtId' name='txtId' class='hiddenFields' value='$propId'>
                    <div class='col-sm-8'>
                        <div id='mainImage'>
                            <img id='main' class='img-fluid' src='$images[0]' />
                            <div class='row'>
                                <div class='col-sm-3'>
                                    <a href='$images[0]' onclick='swap(this); return false;'><img class='img-thumbnail' src='$images[0]' /></a>
                                </div>
                                <div class='col-sm-3'>
                                    <a href='$images[1]' onclick='swap(this); return false;'><img class='img-thumbnail ' src='$images[1]' /></a>
                                </div>
                                <div class='col-sm-3'>
                                    <a href='$images[2]' onclick='swap(this); return false;'><img class='img-thumbnail ' src='$images[2]' /></a>
                                </div>
                                <div class='col-sm-3'>
                                    <a href='$images[3]' onclick='swap(this); return false;'><img class='img-thumbnail ' src='$images[3]' /></a>
                                </div>
                            </div>
                        </div>
                        <br />
                    
                        <h2>Description</h2>
                        <p>$longdesc</p>
                    </div>

                    <div class='col-sm-4'>
                        <div id='rightColumn'>
                            <h3>$address, $town</h3>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div id='priceDetails'><i class='fa fa-euro' aria-hidden='true'></i> $price</div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-2'>
                                    <i class='fa fa-bathtub' aria-hidden='true'></i> $bathrooms
                                </div>
                                <div class='col-sm-2'>
                                    <i class='fa fa-bed' aria-hidden='true'></i> $bedrooms
                                </div>
                                <div class='col-sm-6'>
                                    <i class='fa fa-cube' aria-hidden='true'></i> $size sq/ft
                                </div>
                            </div>
                        
                            <br />
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <p class='blueText'>$bedrooms Bedroom House / <span class='yellowText'>$status</span></p>";
                                    include('includes/RequestViewingModal.html');
                            echo "</div>
                            </div>
                            <br />
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h4>Location</h4>
                                    $mapLink
                                </div>
                            </div>
                            <br /><br />";

                            mysqli_close($link);
                        ?>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div id="featured">
                                    <h4>Featured Properties</h4>
                                    <div class="row">
                                        <!--Card-->
                                        <?php   
                                            $server="localhost";
	                                        $dbuser="root";
	                                        $password="";
	                                        $link=mysqli_connect($server, $dbuser, $password);
	                                        mysqli_select_db($link, "property");

                                            $sql="SELECT * FROM property where status = 'For Sale' and featured = 'Y' limit 2";
                                            $result=mysqli_query($link, $sql);
                                            $cardCount = 0;
                                            $imageCount = 0;
                                            if(mysqli_num_rows($result) > 0)
                                            {
                                                while($row=mysqli_fetch_array($result)) {
                                                    $propId=$row["propertyid"];
                                                    $town=$row["town"];
                                                    $county=$row["county"];
                                                    $price=number_format($row["price"]);
                                                    $bedrooms=$row["bedrooms"];
                                                    $shortdesc=$row["shortdescription"];
                                                    $image=$row["image"];
                                                    $status=$row["status"];
                                                    $cardCount = $cardCount + 1;
                                                    $imageCount = 0;
                                                    $images = explode(',', $image);
                                    
                                                    echo "<div class='col-lg-6'>
                                                            <div class='card'>";

                                                    foreach ($images as $_images) {
                                                        $imageCount = $imageCount + 1;
                                                        if ($imageCount == 1) {
                                                            echo "
                                                            <div><a href='propertyDetails.php?id=$propId'><img class='d-block w-100' src='$_images'></a>
                                                            </div>";                                                  
                                                        } 

                                                        //Limit number of images to 1 
                                                        if ($imageCount == 1) {
                                                            break;
                                                        }                                         
                                                    }
                                                            
                                                    echo "
                                                        <div class='card-bodySml'>
                                                            <div class='propDetails3'> 
                                                                <div class='row'>
                                                                    <div class='col-sm-12'>
                                                                        <i class='fa fa-location-arrow' aria-hidden='true'></i> $town, $county
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='propDetails4'>
                                                                <div class='row'>
                                                                    <div class='col-sm-12'>
                                                                        <i class='fa fa-euro' aria-hidden='true'></i> $price
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                }
                                            }
                                            mysqli_close($link);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
	</div>
    <br />
    <br />
    <br />
    <br />
    <?php include("includes/footer.html");?>

    <script src="scripts/mdb.js"></script>
</body>
</html>
