
<?php
    session_start();
    if(isset($_SESSION['username'])) {
        header('X-XSS-Protection:0');
        $server="localhost";
        $dbuser="root";
        $password="";
        $link=mysqli_connect($server,$dbuser,$password);
        mysqli_select_db($link, "moviereview");
        $movieId=$_GET["movieId"];
        $memberId=$_SESSION['memberID'];

        $sql_delete="call sp_TrackUnLike($movieId, $memberId)";

        if(mysqli_query($link, $sql_delete)) {
            echo "Like Successfully Removed";
        }

        mysqli_close($link);
    }
    else {
        echo "You must login to Unlike a movie";
    }
?>
                