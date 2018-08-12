<!-- Check that the user came here from the login screen -->
<?php
    session_start();

    if(!isset($_SESSION['username']))
        header("Location:default.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>

</head>
<body>
    <?php include("includes/header.php");?>
    <div id="content">

        <!-- Breadcrumbs -->
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li>Edit Movie</li>
            </ul>
        </div>

        <div class="container">      
            <div class="album py-5 bg-light">
            <!-- Right column form -->
                <form id="editForm">
                    <div class='col-lg-12'>
                        <br />
                        <h2 id="title">Update Movie</h2>
                        <h6>
                            Basic Information
                        </h6>

                        <div class="row">
                            <!-- Movie ID -->
                            <div class='col-sm-2'>                            
                                <label for="txtMovieId" class="grey-text bold bold">Movie ID</label>
                                <input type="text" id="txtMovieId" name="txtMovieId" class="form-control">
                            </div>

                            <!-- Movie Title -->
                            <div class='col-sm-4'>                            
                                <label for="txtMovieTitle" class="grey-text bold">Movie Title</label>
                                <input type="text" id="txtMovieTitle" name="txtMovieTitle" class="form-control">
                            </div>

                            <!-- Release Date -->
                            <div class='col-sm-3'>                            
                                <label for="Release Date" class="grey-text bold">Release Date:</label><br />
                                <input type="date" name="txtReleaseDate" id="txtReleaseDate" class="form-control">
                            </div>

                            <!-- Box Office -->
                            <div class='col-sm-3'>                            
                                <label for="Release Date" class="grey-text bold">Box Office:</label><br />
                                <input type="text" name="txtBoxOffice" id="txtBoxOffice" class="form-control">
                            </div>
                        </div>
                        <br />
                        <br />
                        <h6>
                            Descriptive Information
                        </h6>
                        <div class="row">
                            <!-- Genre -->
                            <div class='col-sm-3'>                            
                                <label for="Type" class="grey-text bold">Genre</label><br />
                                <select data-placeholder="Genre" class="simple-select" name="genre" id="genre">
                                    <?php
                                        $server="localhost";
	                                    $dbuser="root";
	                                    $password="";
	                                    $link=mysqli_connect($server, $dbuser, $password);
	                                    mysqli_select_db($link, "moviereview");

                                        $sql="SELECT genre_ID, genre FROM genre order by genre";
                                        $result=mysqli_query($link, $sql);

                                        if(mysqli_num_rows($result) > 0)
                                        {
                                            while($row=mysqli_fetch_array($result)) {                                          
                                                $id=$row["genre_ID"];
                                                $genre=$row["genre"];
                                                echo "<option value='$id'>$genre</option>";
                                            }
                                        }
                                        mysqli_close($link);
                                    ?>
                                </select>
                            </div>

                            <!-- Trailer -->
                            <div class='col-sm-5'>                            
                                <label for="Trailer" class="grey-text bold">Trailer:</label><br />
                                <input type="text" name="txtTrailer" id="txtTrailer" class="form-control">
                            </div>

                            <!-- Actors -->
                            <div class='col-sm-4'>                            
                                <label for="Type" class="grey-text bold">Actors</label><br />
                                <select data-placeholder="Select actors" class="chosen-container chosen-container-multi" name="Actors" id="Actors" multiple="multiple">
                                    <?php
                                        $server="localhost";
	                                    $dbuser="root";
	                                    $password="";
	                                    $link=mysqli_connect($server, $dbuser, $password);
	                                    mysqli_select_db($link, "moviereview");

                                        $sql="SELECT actor_ID, actor_name FROM actor order by actor_name limit 100000";
                                        $result=mysqli_query($link, $sql);

                                        if(mysqli_num_rows($result) > 0)
                                        {
                                            while($row=mysqli_fetch_array($result)) {                                          
                                                $id=$row["actor_ID"];
                                                $actor=$row["actor_name"];
                                                echo "<option value='$id'>$actor</option>";
                                            }
                                        }
                                        mysqli_close($link);
                                    ?>
                                </select>
                                <input type="text" id="txtActors" name="txtActors" class="form-control" style="display:none" >
                            </div>
                        </div> 

                        <div class="row">

                            <!-- Description -->
                            <div class='col-sm-12'>                            
                                <label for="Description" class="grey-text bold">Description</label>
                                <textarea id="txtDesc" name="txtDesc" class="form-control" rows="3"></textarea>
                            </div>

                        </div>

                        <br />

                        <div class="row">

                            <!-- Image -->
                            <div class='col-sm-12'>                            
                                <label for="Images" class="grey-text bold">Images</label><br />
                                    <input id="images" name="input-b3[]" type="file" class="file" multiple 
                                        data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                                <input type="text" id="txtImages" name="txtImages" class="form-control" >
                            </div>

                        </div>

                        <br />

                        <div class="row">
                            <div class='col-sm-4'>
                                <button type="submit" class="btn btn-secondary" id="btnSubmitUpdateMovie">Submit</button>
                                <a href="./default.php"><div class="btn btn-primary" id="btnCancel">Cancel</div></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("includes/footer.html");?>
</body>
</html>

<!-- Styles -->
<link href="styles/mdb.css" rel="stylesheet" />
<link href="styles/bootstrap.css" rel="stylesheet" />
<link href="styles/StyleSheet.css" rel="stylesheet" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,500,600,700" rel="stylesheet">
<script src="scripts/mdb.js"></script>

<!--Chosen-->
<link href="scripts/Chosen/chosen.css" rel="stylesheet" />
<script src="scripts/Chosen/chosen.jquery.js"></script>
<script src="scripts/Chosen/chosen.proto.js"></script>

<!--Fileuploader-->
<script src="scripts/Fileuploader/js/fileinput.js"></script>
<link href="scripts/Fileuploader/css/fileinput.css" rel="stylesheet" />
<!--TinyMce-->
<script src="scripts/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="scripts/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="scripts/Custom.js"></script>


<!-- Toastr -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

<!--Custom JS functions-->
<script src="scripts/Custom.js"></script>
<script src="scripts/EditMovie.js"></script>

<!-- Driver -->
<link href="styles/Driver.min.css" rel="stylesheet" />
<script src="scripts/Driver/Driver.min.js"></script>

<script>

    //Set up the multi-select for the actors
    $(document).ready(function () {
        $(".chosen-container").chosen({ no_results_text: "Oops, nothing found!", width: "300px" });
        $(".simple-select").chosen({ no_results_text: "Oops, nothing found!", width: "200px" });
    });

</script>