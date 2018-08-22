
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

    function CheckValidCode($code) {
        $server="hostingmysql304.webapps.net";
        $dbuser="kqAdmin";
        $dbpassword="cl37kxQ1";
        $link=mysqli_connect($server,$dbuser,$dbpassword);
        mysqli_select_db($link, "moviereview");

        $sql_insert="call sp_ExistingCodeCheck('$code')";
        $result=mysqli_query($link, $sql_insert);
        if(mysqli_num_rows($result) > 0) {
            mysqli_close($link);
            return true;
        }
        else {
            mysqli_close($link);
            return false;
        }
    }

    $existingCode = CheckValidCode($code);

	//Return 1 if the code is valid, 0 if it is not
    if($existingCode)
        echo 1;
    else
        echo 0;
