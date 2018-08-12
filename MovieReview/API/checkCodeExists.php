
<?php
    //**********************************************************************************
    //**********************************************************************************
    //**********************************************************************************
    //Author: Kieran Quinn
    //Date: 06-Aug-2018
    //Description: Takes a validation code and checks that it is present in the database
    //but also that the code is less than 15 minutes old.
    //**********************************************************************************
    $code=$_GET["code"];

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
            }
            mysqli_close($link);
            return true;
        }
        else {
            mysqli_close($link);
            return false;
        }
    }

    $existingCode = checkValidCode($code);

    if($existingCode)
        echo 1;
    else
        echo 0;
