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
                <li>Viewing Request</li>
            </ul>
        </div>
        <div class="container">
            <h1>Viewing Request</h1>

            <p>Thanks for reaching out! We'll be in contact soon.</p>

            <?php
                $name=$_POST["txtName"];
                $email=$_POST["txtEmail"];
                $date=$_POST["txtDate"];
                $time=$_POST["txtTime"];
                $Id=$_POST["txtId"];
                $message = "Subject: Viewing Request <br />Property id: $Id <br />Name: $name <br />Email: $email<br />Date: $date<br />Time: $time";
                
                echo "<h3>Message that would have been sent:</h3><br /> $message";

                $to      = 'info@AxeProperty.ie';
                $subject = 'Viewing Request';
                $message = 'Property id: $Id <br />Name: $name <br />Email: $email<br />Date: $date<br />Time: $time';
                $headers = 'From: info@AxeProperty.ie' . "\r\n" .
                    'Reply-To: info@AxeProperty.ie' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                
                //mail($to, $subject, $message, $headers);
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
