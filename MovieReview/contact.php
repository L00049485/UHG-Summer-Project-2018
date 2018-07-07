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
                <li>Contact</li>
            </ul>
        </div>
        <div class="container">
		    <h1>Contact Us</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2577.689479430592!2d-7.738888684100475!3d54.95080998034647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x485f94ccc66283ef%3A0xda7a696def7847!2sUpper+Main+St%2C+Letterkenny%2C+Co.+Donegal%2C+Ireland!5e1!3m2!1sen!2suk!4v1522955968193" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            <br /><br />
            <hr />
            <form action="processContact.php" method="post">
                <div class="row">
                    <!-- Your name -->
                    <div class='col-sm-3'>                            
                        <label for="Your Name" class="grey-text">Your Name</label>
                        <input type="text" id="txtName" name="txtName" class="form-control">
                    </div>
                    <!-- Your email -->
                    <div class='col-sm-3'>                            
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
