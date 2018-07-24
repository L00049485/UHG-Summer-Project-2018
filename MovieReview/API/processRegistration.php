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

    <div class="album py-5 bg-light">
        <div class="container">
            <?php

                $firstName=$_POST["txtFirstName"];
                $lastName=$_POST["txtLastName"];
                $dob=$_POST["txtDOB"];
                $email=$_POST["txtemailAddress"];
                $phoneNo=$_POST["txtPhoneNo"];
                $address1=$_POST["txtAddress1"];
                $address2=$_POST["txtAddress2"];
                $city=$_POST["txtCity"];
                $state=$_POST["txtState"];
                $country=$_POST["txtCountry"];
                $password=$_POST["txtPassword"];

                $existingMember = checkExistingMember($email);
                if(!$existingMember)
                    createMember($firstName, $lastName, $dob, $email, $phoneNo, $address1, $address2, $city, $state, $country, $password);
                else
                    echo "<br /><h3>$email is already registered as a user.</h3>";
                
                function checkExistingMember($email) {
                    $server="localhost";
                    $dbuser="root";
                    $dbpassword="";
                    $link=mysqli_connect($server,$dbuser,$dbpassword);
                    mysqli_select_db($link, "moviereview");
                    
                    $sql_insert="call sp_ExistingMemberCheck('$email')";
                    $result=mysqli_query($link, $sql_insert);
                        if(mysqli_num_rows($result) > 0) {                          
                            while($row=mysqli_fetch_array($result)) {   
                            }
                            mysqli_close($link);
                            return true;                  
                        }     
                        else {
                            mysqli_close($link);
                            return false;
                        }
                }   

                function createMember($firstName, $lastName, $dob, $email, $phoneNo, $address1, $address2, $city, $state, $country, $password) {            
                    $server="localhost";
                    $dbuser="root";
                    $dbpassword="";
                    $link=mysqli_connect($server,$dbuser,$dbpassword);
                    mysqli_select_db($link, "moviereview");
                    $sql_insert="call sp_CreateNewMember('$address1', '$address2', '$city', '$country', '$dob', '$email', '$firstName', '$lastName', '$password', '$phoneNo', '$state')";      

                    if(mysqli_query($link, $sql_insert)) {
                        echo "<br /><h3>You have been successfully registered.</h3>";
                        echo "Click <a href='Default.php'>here </a>to return to Home page.";
                    }
                    else {
                        echo "<br /><h3>Something went wrong!</h3> Error description: " . mysqli_error($link);
                        echo "<a href='default.php'>Return to Home page</a>";
                    }
                    mysqli_close($link);
                }                
            ?>
                
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
