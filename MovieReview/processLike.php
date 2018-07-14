
<?php
    header('X-XSS-Protection:0');
    $server="localhost";
    $dbuser="root";
    $password="";
    $link=mysqli_connect($server,$dbuser,$password);
    mysqli_select_db($link, "moviereview");
    $movieId=$_GET["movieId"];

    $sql_insert="call sp_TrackLike($movieId)";

    if(mysqli_query($link, $sql_insert)) {
        echo "Like Successfully Added";
    }
    else {
        echo "Something went wrong!";
    }

    mysqli_close($link);
?>
                