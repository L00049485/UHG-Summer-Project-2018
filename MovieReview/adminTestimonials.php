<!-- Check that the user came here from the login screen -->
<?php
   session_start();

    if(!isset($_SESSION['username']))
        header("Location:adminlogin.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Axe Property</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <script src="scripts/Custom.js"></script>

    <!-- Styles -->
    <link href="styles/mdb.css" rel="stylesheet" />
    <link href="styles/bootstrap.css" rel="stylesheet" />
    <link href="styles/StyleSheet.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,500,600,700" rel="stylesheet">    
    <link href="styles/Glyphicon.css" rel="stylesheet" />
   
    <!-- noUISlider -->
    <link href="scripts/noUiSlider/nouislider.css" rel="stylesheet" />
    <script src="scripts/noUiSlider/nouislider.js"></script>
    <script src="scripts/noUiSlider/wNumb.js"></script>

    <!--Chosen-->
    <script src="scripts/Chosen/chosen.jquery.js"></script>
    <script src="scripts/Chosen/chosen.proto.js"></script>
    <link href="scripts/Chosen/chosen.css" rel="stylesheet" />

    <!--TinyMce-->
    <script src="scripts/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="scripts/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

    <!--Fileuploader-->
    <script src="scripts/Fileuploader/js/fileinput.js"></script>
    <link href="scripts/Fileuploader/css/fileinput.css" rel="stylesheet" />

    <script>

        $(document).ready(function () {
            $(".btnRelease").click(function () {
                var url = "http://localhost/axeproperty/processRelTest.php?ID=" + this.id;
                window.location.href = url;
            });
            $(".btnDelete").click(function () {
                var url = "http://localhost/axeproperty/processDelTest.php?ID=" + this.id;
                if (confirm('Are you sure you want to delete this comment?')) {
                    window.location.href = url;
                }
            });
        });
    </script>

</head>
<body>
    <?php include("includes/header.html");?>

    <div id="content">  
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li>Testimonials</li>
            </ul>
        </div>      
		<div class="row">
            <!-- Left column menu -->
            <?php include("includes/AdminMenu.html");?>

            <!-- Right column form -->
            <div class='col-sm-9'>
                <br />
                <h2>Manage Testimonials</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created</th>
                            <th scope="col">Status</th>
                            <th scope="col">Release</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $server="localhost";
                            $dbuser="root";
                            $password="";
                            $link=mysqli_connect($server, $dbuser, $password);
                            mysqli_select_db($link, "property");

                            $sql="SELECT * FROM comment";
                            $result=mysqli_query($link, $sql);
                            $cardCount = 0;
                            $imageCount = 0;
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row=mysqli_fetch_array($result)) {
                                    $cmtId=$row["id"];
                                    $title=$row["title"];            
                                    $content=$row["content"];
                                    $author=$row["author_name"];
                                    $email=$row["author_email"];
                                    $created=$row["created_at"];
                                    $status=$row["status"];
                                        
                                    echo "
                                    <tr>
                                        <td>$title</td>
                                        <td>$content</td>
                                        <td>$author</td>
                                        <td>$email</td>
                                        <td>$created</td>
                                        <td>$status</td>
                                        <td><button type='submit' class='btn btn-secondary btnRelease' id='$cmtId'>Release</button></td>
                                        <td><button type='submit' class='btn btn-secondary btnDelete' id='$cmtId'>Delete</button></td>
                                    </tr>";
                                }
                            }
                            mysqli_close($link);
                        ?>
                            
                    </tbody>
                </table>

                <br />
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <?php include("includes/footer.html");?>

    <script src="scripts/mdb.js"></script>
</body>
</html>
