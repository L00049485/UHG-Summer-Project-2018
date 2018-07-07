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
            <?php
                header('X-XSS-Protection:0');
                $server="localhost";
                $dbuser="root";
                $password="";
                $link=mysqli_connect($server,$dbuser,$password);
                mysqli_select_db($link, "property");

                $title=$_POST["txtTitle"];
                $name=$_POST["txtName"];
                $email=$_POST["txtEmail"];
                $comment=$_POST["txtComment"];
                $date = date('Y-m-d H:i:s');

                $sql_insert= "INSERT INTO comment(
                title, content, author_name, author_email, created_at, status) VALUES (
                '$title', '$comment', '$name', '$email', '$date', 'pending')";

               

                if(mysqli_query($link, $sql_insert)) {
                    echo "<br /><h3>Comment Successfully Added</h3>";
                    echo "Click <a href='testimonials.php'>here </a>to return to the Testimonials page.";
                    }
                    else {
                    echo "<br /><h3>Something went wrong!</h3>";
                    echo "<a href='testimonials.php'>Return to Admin page</a>";
                }

                mysqli_close($link);
            ?> 

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
