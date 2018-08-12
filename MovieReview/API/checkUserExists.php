
<?php
    //**********************************************************************************
    //**********************************************************************************
    //**********************************************************************************
    //Author: Kieran Quinn
    //Date: 06-Aug-2018
    //Description: Takes an email address and checks that it is present in the database
    //**********************************************************************************
    $email=$_GET["emailAddress"];

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

    $existingMember = checkExistingMember($email);

    if($existingMember)
        echo 1;
    else
        echo 0;
