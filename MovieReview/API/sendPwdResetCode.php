
<?php
    $email=$_GET["emailAddress"];

    //****************************************************
    //Generate a random 25 character alpanumeric code
    //to add to the database for this email address
    //https://stackoverflow.com/questions/48124/generating-pseudorandom-alpha-numeric-strings
    //****************************************************

    //This is a list of all allowable characters
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 25; $i++) {
        $string .= $characters[mt_rand(0, $max)];
    }
    //****************************************************
    //****************************************************

    //Upload the code to the database
    header('X-XSS-Protection:0');
    $server="localhost";
    $dbuser="root";
    $password="";
    $link=mysqli_connect($server,$dbuser,$password);
    mysqli_select_db($link, "moviereview");

    $sql_insert="call sp_TrackPwdCode('$email', '$string')";

    if(mysqli_query($link, $sql_insert)) {
        //echo "Code Successfully Added";
        sendEmail($string, $email);
    }

    mysqli_close($link);

    function sendEmail($string, $emailAddress) {
        // the message
        $msg = "You have requested to reset your password.\nClick the link below to proceed: \n\n http://localhost:8080/moviereviewRepo/MovieReview/PasswordReset.php?code=" + $string;

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($emailAddress,"Movie Review - Password Reset",$msg);

        echo "Email Sent to: http://localhost:8080/moviereviewRepo/MovieReview/PasswordReset.php?code=$string";
    }