<?php
   session_start();
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
   
</head>
<body>
    <?php include("includes/header.html");?>
    <br />
    <br />
    <br />
    <div id="content">
        
		<?php
			$server="localhost";
			$dbuser="root";
			$password="";
			$link=mysqli_connect($server,$dbuser,$password);
			mysqli_select_db($link, "property");

			if(isset($_POST['admin_name']) and isset($_POST['password'])) {
				$username=$_POST['admin_name'];
				$password=$_POST['password'];

				$query = "select * from administrator where adminname='$username' and password = '$password'";
                    
                $result=mysqli_query($link,$query) or die(mysqli_error($connection));
				$count=mysqli_num_rows($result);

				if($count == 1) {
					$_SESSION['username']=$username;
					header("Location:admin.php");
					exit;
				}
				else {
					$_SESSION['errors']=array('Your username or password was incorrect');
					header("Location:adminlogin.php");
				}
			}
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
