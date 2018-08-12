
<?php
	header('Content-type: application/json');
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

    //Searches the database for the members email address. Returns true or false indicating whether it exists or not.
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
			echo json_encode("$email Successfully Registered");
        }
        else {
			echo json_encode("Registration failed. Error: ".mysqli_error());
        }
        mysqli_close($link);
    }

    $existingMember = checkExistingMember($email);

    if(!$existingMember)
        createMember($firstName, $lastName, $dob, $email, $phoneNo, $address1, $address2, $city, $state, $country, $password);
    else
        echo "$email is already registered as a user.";

?>
