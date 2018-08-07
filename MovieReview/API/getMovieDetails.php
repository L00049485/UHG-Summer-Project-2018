<?php
    $server="localhost";
    $dbuser="root";
    $password="";
    $link=mysqli_connect($server, $dbuser, $password);
    mysqli_select_db($link, "moviereview");
    $return_arr = array();
    $movieId=$_GET["movieId"];

    $sql="call sp_GetMovieDetails($movieId, 0)";

    $result=mysqli_query($link, $sql);
    if (!$result) 
        die('Invalid query: ' . mysql_error());

    while ($row = mysqli_fetch_array($result)) {
        $row_array['id'] = $row['Movie_ID'];
        $row_array['Title'] = $row['Title'];
        $row_array['ReleaseDate'] = $row['ReleaseDate'];
        $row_array['Genre'] = $row['Genre'];
        $row_array['Genre_ID'] = $row['Genre_ID'];
        $row_array['Description'] = $row['Description'];
        $row_array['Image'] = $row['Image'];
        $row_array['Trailer'] = $row['Trailer'];
        $row_array['Actors'] = $row['Actors'];
        $row_array['Actor_IDs'] = $row['Actor_IDs'];
        $row_array['BoxOffice'] = $row['BoxOffice'];

        array_push($return_arr,$row_array);
    }

    $jsonNew = json_encode(utf8ize($return_arr));

    echo $jsonNew;

    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
?>
