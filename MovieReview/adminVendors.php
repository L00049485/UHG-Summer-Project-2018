<?php
   session_start();
?>
<!-- Check that the user came here from the login screen -->
<?php
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
    <script src="scripts/Chosen/chosen.jquery.js"></script>
    <script src="scripts/Chosen/chosen.proto.js"></script>
    <link href="scripts/Chosen/chosen.css" rel="stylesheet" />

    <!--TinyMce-->
    <script src="scripts/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="scripts/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

    <!--Fileuploader-->
    <script src="scripts/Fileuploader/js/fileinput.js"></script>
    <link href="scripts/Fileuploader/css/fileinput.css" rel="stylesheet" />

    <script>

        $(document).ready(function () {
            $(".btnEdit").click(function () {
                var url = "http://localhost/axeproperty/adminUpdVendor.php?ID=" + this.id;
                window.location.href = url;
            });
            $(".btnDelete").click(function () {
                var url = "http://localhost/axeproperty/processDelVendor.php?ID=" + this.id;
                if (confirm('Are you sure you want to delete this vendor?')) {
                    window.location.href = url;
                }
            });
            $("#btnAddNew").click(function () {
                var url = "http://localhost/axeproperty/adminAddVendor.php";
                window.location.href = url;
            });
            
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
                <li>Vendors</li>
            </ul>
        </div>       
		<div class="row">
            <!-- Left column menu -->
            <?php include("includes/AdminMenu.html");?>

            <!-- Right column form -->
            <div class='col-sm-9'>
                <br />
                <h2>Manage Vendors</h2>
                <button type='submit' class='btn btn-secondary' id='btnAddNew'>Add new vendor</button>
                <br /><br />
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Surname</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Town</th>
                            <th scope="col">County</th>
                            <th scope="col">Mobile #</th>
                            <th scope="col">Email</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $server="localhost";
                            $dbuser="root";
                            $password="";
                            $link=mysqli_connect($server, $dbuser, $password);
                            mysqli_select_db($link, "property");

                            $sql="SELECT * FROM vendor";
                            $result=mysqli_query($link, $sql);
                            $cardCount = 0;
                            $imageCount = 0;
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row=mysqli_fetch_array($result)) {
                                    $id=$row["vendorid"];
                                    $surname=$row["surname"];            
                                    $firstname=$row["firstname"];
                                    $address=$row["address1"];
                                    $town=$row["town"];
                                    $county=$row["county"];
                                    $mobile=$row["mobile"];
                                    $email=$row["email"];
                                        
                                    echo "
                                    <tr>
                                        <td>$surname</td>
                                        <td>$firstname</td>                                        
                                        <td>$address</td>
                                        <td>$town</td>
                                        <td>$county</td>
                                        <td>$mobile</td>
                                        <td>$email</td>
                                        <td><button type='submit' class='btn btn-secondary btnEdit' id='$id'>Edit</button></td>
                                        <td><button type='submit' class='btn btn-secondary btnDelete' id='$id'>Delete</button></td>
                                    </tr>";
                                }
                            }
                            mysqli_close($link);
                        ?>
                            
                    </tbody>
                </table>
                
                <br />
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
