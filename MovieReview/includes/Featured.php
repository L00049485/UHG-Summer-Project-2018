<div class="container">
    <h2>Featured Properties</h2>
    <div class="row">
        <!--Card-->
        <?php
        $server="localhost";
        $dbuser="root";
        $password="";
        $link=mysqli_connect($server, $dbuser, $password);
        mysqli_select_db($link, "property");

        $sql="SELECT * FROM property where status = 'For Sale' and featured = 'Y' limit 3";
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
                $bathrooms=$row["bathrooms"];
                $shortdesc=$row["shortdescription"];
                $image=$row["image"];
                $status=$row["status"];
                $cardCount = $cardCount + 1;
                $imageCount = 0;
                $images = explode(',', $image);

                echo "
                <div class='col-lg-4'>
                    <div class='card'>";

                    echo "
                    <div id='featProp$cardCount' class='carousel slide' data-ride='carousel'>
                        <ol class='carousel-indicators'>
                            <li data-target='#featProp$cardCount' data-slide-to='0' class='active'></li>
                            <li data-target='#featProp$cardCount' data-slide-to='1'></li>
                            <li data-target='#featProp$cardCount' data-slide-to='2'></li>
                        </ol>
                        <div class='carousel-inner'>";

                            //For each image in the database, for that property, generate the carousel item.
                            //NOTE: First item must have 'active' class
                            foreach ($images as $_images) {
                                $imageCount = $imageCount + 1;;
                                if ($imageCount == 1) {
                                    echo "<div class='carousel-item active'> ";
                                } 
                                else {
                                    echo "<div class='carousel-item'>";
                                }

                                echo "<a href='propertyDetails.php?id=$propId'><img class='d-block w-100' src='$_images'></a></div>";

                                //Limit number of images to 3
                                if ($imageCount == 3) {
                                break;
                                }
                            }

                            echo "
                        </div>
                        <a class='carousel-control-prev' href='#featProp$cardCount' role='button' data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                        </a>
                        <a class='carousel-control-next' href='#featProp$cardCount' role='button' data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </div>

                    <div class='card-body'>
                        <h4 class='card-title'>$status</h4>

                        <p class='card-text'>$shortdesc</p>
                        <div class='propDetails1'>
                            <div class='row'>
                                <div class='col-sm-8'>
                                    <i class='fa fa-location-arrow' aria-hidden='true'></i> $town, $county
                                </div>
                                <div class='col-sm-4'>
                                    <i class='fa fa-euro' aria-hidden='true'></i> $price
                                </div>
                            </div>
                        </div>
                        <div class='propDetails2'>
                            <div class='row'>
                                <div class='col-sm-4'>
                                    <i class='fa fa-bathtub' aria-hidden='true'></i> $bathrooms
                                </div>
                                <div class='col-sm-4'>
                                    <i class='fa fa-bed' aria-hidden='true'></i> $bedrooms
                                </div>
                                <div class='col-sm-4'>
                                    <i class='fa fa-cube' aria-hidden='true'></i> 2000sft
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