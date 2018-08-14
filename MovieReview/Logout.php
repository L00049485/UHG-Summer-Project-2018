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
    <script src="scripts/bootstrap.js"></script>
</head>
<body>

    <?php
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
    ?>
    <?php include("includes/header.php");?>
    <div id="content">

        <!-- Breadcrumbs -->
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
            </ul>
        </div>
        <div class="album py-5 bg-light">   
            <div class="container">
                <h2>You have successfully logged out.</h2><br /><br /><br />
            
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
