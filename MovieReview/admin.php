<!-- Check that the user came here from the login screen -->
<?php
   session_start();

    if(!isset($_SESSION['username']))
        header("Location:adminlogin.php");
?>

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

    <div id="content"> 
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li>Admin</li>              
            </ul>
        </div>      
        
        

		<div class="row">
            <?php include("includes/AdminMenu.html");?>
            <div class='col-sm-4'>
                <br />
                <h2>Administration</h2>
                <p>
                    Use this section of the website to make changes to the information stored in the database.
                </p>
            </div>
            <div class='col-sm-5'>
                <br />
                <img src="images/PropManagement.png" class='img-fluid' />
            </div>
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
