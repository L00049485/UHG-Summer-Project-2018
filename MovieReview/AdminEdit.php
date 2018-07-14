﻿<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>


    <script>
        $(document).ready(function () {
            $("#btnSubmitUpdateMovie").click(function () {
                var files = $('#images').fileinput('getFileStack');
                var actors = $('#Actors').val();
                var imagesString = "";
                for (i = 0; i < files.length; ++i) {
                    imagesString += 'images/posters/' + files[i].name + ',';
                }

                //remove the last comma
                imagesString = imagesString.substring(0, imagesString.length - 1);

                //send the text to a hidden text box to be picked up by the php
                $('#txtImages').val(imagesString);

                //Send the list of actors to a hidden text box to be picked up by the php
                $('#txtActors').val(actors);
            });
        });
    </script>
</head>
<body>
    <?php include("includes/header.html");?>
    <div class="container">
    <div class="album py-5 bg-light">
        <!-- Right column form -->
            <form action="processUpdateMovie.php" method="post">
                <div class='col-lg-12'>
                    <br />
                    <h2>Update Movie</h2>
                    <h6>
                        Basic Information
                    </h6>

                    <div class="row">
                        <!-- Movie ID -->
                        <div class='col-sm-4'>                            
                            <label for="Movie Title" class="grey-text">Movie ID</label>
                            <input type="text" id="txtMovieId" name="txtMovieId" class="form-control">
                        </div>

                        <!-- Movie Title -->
                        <div class='col-sm-4'>                            
                            <label for="Movie Title" class="grey-text">Movie Title</label>
                            <input type="text" id="txtMovieTitle" name="txtMovieTitle" class="form-control">
                        </div>

                        <!-- Release Date -->
                        <div class='col-sm-4'>                            
                            <label for="Release Date" class="grey-text">Release Date:</label><br />
                            <input type="date" name="txtReleaseDate" id="txtReleaseDate" class="form-control">
                        </div>
                    </div>
                    <br />
                    <br />
                    <h6>
                        Descriptive Information
                    </h6>
                    <div class="row">
                        <!-- Genre -->
                        <div class='col-sm-4'>                            
                            <label for="Type" class="grey-text">Genre</label><br />
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
                        <div class='col-sm-4'>                            
                            <label for="Trailer" class="grey-text">Trailer:</label><br />
                            <input type="text" name="txtTrailer" id="txtTrailer" class="form-control">
                        </div>

                        <!-- Actors -->
                        <div class='col-sm-4'>                            
                            <label for="Type" class="grey-text">Actors</label><br />
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
                            <label for="Description" class="grey-text">Description</label>
                            <textarea id="txtDesc" name="txtDesc" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <br />

                    <div class="row">

                        <!-- Image -->
                        <div class='col-sm-12'>                            
                            <label for="Images" class="grey-text">Images</label><br />
                                <input id="images" name="input-b3[]" type="file" class="file" multiple 
                                    data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                            <input type="text" id="txtImages" name="txtImages" class="form-control" >
                        </div>

                    </div>

                    <br />

                    <div class="row">
                        <div class='col-sm-4'>
                            <button type="submit" class="btn btn-secondary" id="btnSubmitUpdateMovie">Submit</button>
                            <a href="admin.php"><div class="btn btn-primary" id="btnCancel">Cancel</div></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="hiddenFields">
        <?php
            $server="localhost";
	        $dbuser="root";
	        $password="";
	        $link=mysqli_connect($server, $dbuser, $password);
	        mysqli_select_db($link, "moviereview");

            $movieId=$_GET["movieid"];
            $sql="call sp_getMovieEditDetails($movieId)";
            $result=mysqli_query($link, $sql);
            $row=mysqli_fetch_array($result);

            $movieId=$row["Movie_ID"];
            $title=$row["Title"];
            $releaseDate=$row["ReleaseDate"];
            $genreId=$row["Genre_ID"];
            $description=$row["Description"];
            $image=$row["Image"];
            $trailer=$row["Trailer"];
            $actors=$row["actors"];
                
            
            echo "<input id='txtMovieIdHidden' type='text' value='$movieId' />";
            echo "<input id='txtTitleHidden' type='text' value='$title' />";
            echo "<input id='txtReleaseDateHidden' type='text' value='$releaseDate' />";
            echo "<input id='txtGenreIdHidden' type='text' value='$genreId' />";
            echo "<input id='txtDescriptionHidden' type='text' value='$description' />";
            echo "<input id='txtImageHidden' type='text' value='$image' />";
            echo "<input id='txtTrailerHidden' type='text' value='$trailer' />";
            echo "<input id='txtActorsHidden' type='text' value='$actors' />";
        
            mysqli_close($link);
        ?>
        
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

<!--Custom JS functions-->
<script src="scripts/Custom.js"></script>
<script src="scripts/EditMovie.js"></script>

<script>

    //Set up the multi-select for the actors
    $(document).ready(function () {
        $(".chosen-container").chosen({ no_results_text: "Oops, nothing found!", width: "300px" });
        $(".simple-select").chosen({ no_results_text: "Oops, nothing found!", width: "200px" });
    });

</script>