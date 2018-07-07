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
                <li>Testimonials</li>
            </ul>
        </div>
		<div class="container">
            <h2>Testimonials</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Author</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php
                        $server="localhost";
                        $dbuser="root";
                        $password="";
                        $link=mysqli_connect($server, $dbuser, $password);
                        mysqli_select_db($link, "property");

                        $sql="SELECT * FROM comment where status='planned'";
                        $result=mysqli_query($link, $sql);
                        $cardCount = 0;
                        $imageCount = 0;
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row=mysqli_fetch_array($result)) {
                                $cmtId=$row["id"];
                                $title=$row["title"];            
                                $content=$row["content"];
                                $author=$row["author_name"];
                                $email=$row["author_email"];
                                $created=$row["created_at"];
                                $status=$row["status"];
                                        
                                echo "
                                <tr>
                                    <td>$title</td>
                                    <td>$content</td>
                                    <td>$author</td>
                                    <td>$created</td>
                                </tr>";
                            }
                        }
                        mysqli_close($link);
                    ?>
                            
                </tbody>
            </table>


            <!-- Leave a testimonial -->
            <br />
            <hr />
            <h3>If you would like to leave a testimonial please do so below</h3>
            <br />
            <form action="processTestimonial.php" method="post">
                <div class="row">

                    <!-- Your title -->
                    <div class='col-sm-4'>                            
                        <label for="Title" class="grey-text">Testimonial Title</label>
                        <input type="text" id="txtTitle" name="txtTitle" class="form-control">
                    </div>

                    <!-- Your name -->
                    <div class='col-sm-4'>                            
                        <label for="Your Name" class="grey-text">Your Name</label>
                        <input type="text" id="txtName" name="txtName" class="form-control">
                    </div>

                    <!-- Your email -->
                    <div class='col-sm-4'>                            
                        <label for="Your Email" class="grey-text">Your Email</label>
                        <input type="email" id="txtEmail" name="txtEmail" class="form-control">
                    </div>

                </div>
                <br />
                <div class="row">
                    <!-- Your comment -->
                    <div class='col-sm-12'>
                        <label for="Your Comment" class="grey-text">Your Comment</label>
                        <textarea id="txtComment" name="txtComment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class='col-sm-4'>
                        <button type="submit" class="btn btn-secondary" id="btnSubmitComment">Submit</button>
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
