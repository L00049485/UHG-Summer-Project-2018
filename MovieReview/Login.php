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
    <?php include("includes/header.php");?>
    <div class="container">
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li>Admin</li>
            </ul>
        </div> 
        <div class="row">
            <div class='col-lg-6'>
                <h2>Welcome!</h2>
                <p>Only authorized staff can access the following areas. <br />Please enter your credentials to the right.</p>
            </div>
            <div class='col-lg-4'>
                <!-- Material form login -->

                <?php
                    if(isset($SESSION["errors"])) {
                        echo "<div class='form-errors'>";
                        foreach($_SESSION['errors'] as $error)
                        {
                            echo "<p>";
                            echo $error;
                            echo "</p>";
                        }
                        echo "</div>";
                    }    
                    
                    unset($_SESSION['errors']);
                ?>

                <form action="login_action.php" method="post">
                    <p class="h4 text-center mb-4">Sign in</p>

                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="materialFormLoginEmailEx" name="admin_name" class="form-control">
                        <label for="materialFormLoginEmailEx">Your email</label>
                    </div>

                    <!-- Material input password -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="materialFormLoginPasswordEx" name="password" class="form-control">
                        <label for="materialFormLoginPasswordEx">Your password</label>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-secondary" type="submit">Login</button>
                    </div>
                </form>
                <!-- Material form login -->
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
