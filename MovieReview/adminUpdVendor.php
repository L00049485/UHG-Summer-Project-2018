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
    <link href="styles/Glyphicon.css" rel="stylesheet" />
   
    <!-- noUISlider -->
    <link href="scripts/noUiSlider/nouislider.css" rel="stylesheet" />
    <script src="scripts/noUiSlider/nouislider.js"></script>
    <script src="scripts/noUiSlider/wNumb.js"></script>

    <!--Chosen-->
    <link href="scripts/Chosen/chosen.css" rel="stylesheet" />
    <script src="scripts/Chosen/chosen.jquery.js"></script>
    <script src="scripts/Chosen/chosen.proto.js"></script>

    <!--TinyMce-->
    <script src="scripts/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="scripts/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

    <!--Fileuploader-->
    <script src="scripts/Fileuploader/js/fileinput.js"></script>
    <link href="scripts/Fileuploader/css/fileinput.css" rel="stylesheet" />

    <script>
        $(document).ready(function () {
            
        });
    </script>

</head>
<body>
    <?php include("includes/header.html");?>

    <div id="content">   
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li>Update Vendor</li>
            </ul>
        </div>     
		<div class="row">
            <!-- Left column menu -->
            <?php include("includes/AdminMenu.html");?>

            <!-- Right column form -->
            <div class='col-lg-6'>
                <form action="processUpdVendor.php" method="post">
                    <br />
                    <h2>Update Vendor</h2>
                    <h6>
                        Basic Information
                    </h6>
                    <?php
                        $server="localhost";
	                    $dbuser="root";
	                    $password="";
	                    $link=mysqli_connect($server, $dbuser, $password);
	                    mysqli_select_db($link, "property");

                        $Id=$_GET["ID"];
                        $sql="SELECT * FROM vendor where vendorid = $Id";
                        $result=mysqli_query($link, $sql);
                        $row=mysqli_fetch_array($result);

                        $surname=$row["surname"];            
                        $firstname=$row["firstname"];
                        $address=$row["address1"];
                        $town=$row["town"];
                        $county=$row["county"];
                        $mobile=$row["mobile"];
                        $email=$row["email"];

                        echo "
                        <div class='row'>
                            <!-- Surname -->
                            <div class='col-sm-3'>                            
                                <label for='Surname' class='grey-text'>Surname</label>
                                <input type='text' id='txtSurname' name='txtSurname' class='form-control' value='$surname'>
                                <input type='text' id='txtID' name='txtID' class='form-control' value='$Id' style='display:none;'>
                            </div>

                            <!-- Surname -->
                            <div class='col-sm-3'>                            
                                <label for='Firstname' class='grey-text'>Firstname</label>
                                <input type='text' id='txtFirstname' name='txtFirstname' class='form-control' value='$firstname'>
                            </div>

                            <!-- Address -->
                            <div class='col-sm-3'>                            
                                <label for='Address' class='grey-text'>Address</label>
                                <input type='text' id='txtAddress' name='txtAddress' class='form-control' value='$address'>
                            </div>

                            <!-- Town -->
                            <div class='col-sm-3'>                            
                                <label for='Town' class='grey-text'>Town</label>
                                <input type='text' id='txtTownForm' name='txtTownForm' class='form-control' value='$town'>
                            </div>
                        
                        </div>
                        <br />
                        <div class='row'>
                            <!-- County -->
                            <div class='col-sm-3'>                            
                                <label for='County' class='grey-text'>County</label>
                                <input type='text' id='txtCountyForm' name='txtCountyForm' class='form-control' value='$county'>
                            </div>

                            <!-- Mobile -->
                            <div class='col-sm-3'>                            
                                <label for='Mobile' class='grey-text'>Mobile #</label>
                                <input type='text' id='txtMobile' name='txtMobile' class='form-control' value='$mobile'>
                            </div>

                            <!-- Email -->
                            <div class='col-sm-3'>                            
                                <label for='Email' class='grey-text'>Email</label>
                                <input type='text' id='txtEmail' name='txtEmail' class='form-control' value='$email'>
                            </div>
                        </div>";
                        mysqli_close($link);
                    ?>
                    <br />
                    <br />
                    <div class="row">
                        <div class='col-sm-4'>
                            <button type="submit" class="btn btn-secondary" id="btnSubmitUpdVendor">Submit</button>
                            <a href="adminVendors.php"><div class="btn btn-primary" id="btnCancel">Cancel</div></a>
                        </div>
                    </div>
                </form>
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
