<?php
    session_start();
	$server="localhost";
	$dbuser="root";
	$password="";
	$link=mysqli_connect($server,$dbuser,$password);
	mysqli_select_db($link, "moviereview");

	if(isset($_POST['admin_name']) and isset($_POST['password'])) {
		$username=$_POST['admin_name'];
		$password=$_POST['password'];

		$query = "select * from member where EmailAddress='$username' and Password = '$password'";
                    
        $result=mysqli_query($link,$query) or die(mysqli_error($connection));
		$count=mysqli_num_rows($result);
        while($row=mysqli_fetch_array($result)) {
            $memberId=$row["Member_ID"];
        }
    

		if($count == 1) {
			$_SESSION['username']=$username;
            $_SESSION['memberID']=$memberId;
            
            $memberIdNew=$_SESSION['memberID'];

			echo "Successful Login";
            header("Location:http://localhost:8080/moviereviewRepo/MovieReview/default.php");
			exit;
		}
		else {
			$_SESSION['errors']=array('Your username or password was incorrect');
            unset($_SESSION["username"]);
            unset($_SESSION["password"]);
			echo "Failed Login";
            //header("Location:http://localhost:8080/moviereviewRepo/MovieReview/adminlogin.php");
		}
	}
?>