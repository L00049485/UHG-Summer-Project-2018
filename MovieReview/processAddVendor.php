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
                <li><a href="admin.php">Admin</a></li>
                <li>Add Vendor</li>
            </ul>
        </div>
        <?php
            header('X-XSS-Protection:0');
            $server="localhost";
            $dbuser="root";
            $password="";
            $link=mysqli_connect($server,$dbuser,$password);
            mysqli_select_db($link, "property");

            $surname=$_POST["txtSurname"];
            $firstname=$_POST["txtFirstname"];
            $address=$_POST["txtAddress"];
            $town=$_POST["txtTownForm"];
            $county=$_POST["txtCountyForm"];
            $mobile=$_POST["txtMobile"];
            $email=$_POST["txtEmail"];

            $sql_insert="INSERT INTO vendor(
            surname, firstname, address1, town, county, mobile, email) VALUES (
            '$surname', '$firstname', '$address', '$town', '$county', '$mobile', '$email')";

            //echo $sql_insert;

            if(mysqli_query($link, $sql_insert)) {
                $propId = $link->insert_id;
                echo "<br /><h3>Vendor Successfully Added</h3>";
                echo "Click <a href='adminVendors.php'>here </a>to return to Admin page.";
                }
                else {
                echo "<br /><h3>Something went wrong!</h3>";
                echo "<a href='admin.php'>Return to Admin page</a>";
            }

            mysqli_close($link);
        ?>

    </div>
    <br />
    <br />
    <br />
    <br />
    <?php include("includes/footer.html");?>

    <script src="scripts/mdb.js"></script>
</body>
</html>
