
<?php
    $code=$_GET["code"];
    $password=$_GET["password"];

    //Checks the code that has been submitted to make sure it exists in the database,
    //but also that it has been created less than 15 minutes ago.
    function checkValidCode($code) {
        $server="localhost";
        $dbuser="root";
        $dbpassword="";
        $link=mysqli_connect($server,$dbuser,$dbpassword);
        mysqli_select_db($link, "moviereview");

        $sql_insert="call sp_ExistingCodeCheck('$code')";

        $result=mysqli_query($link, $sql_insert);
        if(mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_array($result)) {
                mysqli_close($link);
                return $row['EmailAddress'];
            }
        }
        else {
            mysqli_close($link);
            return '';
        }
    }

    function uploadNewPassword($password, $emailAddress) {
        $server="localhost";
        $dbuser="root";
        $dbpassword="";
        $link=mysqli_connect($server,$dbuser,$dbpassword);
        mysqli_select_db($link, "moviereview");

        $sql_update="call sp_UpdatePassword('$password', '$emailAddress')";
        $result=mysqli_query($link, $sql_update);

        if(mysqli_query($link, $sql_update)) {
            mysqli_close($link);
            return true;
        }
        else {
            mysqli_close($link);
            return false;
        }
    }

    $emailAddress = checkValidCode($code);
    $result=false;

    if($emailAddress != '')
        $result=uploadNewPassword($password, $emailAddress);
    else
        echo 'This verification code is not valid.';

    if($result)
        echo '1';
    else
        echo 'Error: Password not updated';
