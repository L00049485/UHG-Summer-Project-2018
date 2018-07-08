<!DOCTYPE html>
<html>
<head>
    <title>Movie Review</title>
    <meta charset="utf-8" />

    <!-- Scripts -->
    <script src="scripts/jQuery_3.3.1.js"></script>
    <script src="scripts/bootstrap.js"></script>

    <script>
        $(document).ready(function () {
            $("#btnSubmitAddMovie").click(function () {
                var files = $('#images').fileinput('getFileStack');
                var imagesString = "";
                for (i = 0; i < files.length; ++i) {
                    imagesString += 'images/houses/' + files[i].name + ',';
                }

                //remove the last comma
                imagesString = imagesString.substring(0, imagesString.length - 1);

                //send the text to a hidden text box to be picked up by the php
                $('#txtImages').val(imagesString);
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    <strong>Movie Review</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Movie Review</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </section>
        <div class="album py-5 bg-light">
        <!-- Right column form -->
            <form action="processAddMovie.php" method="post">
                <div class='col-lg-12'>
                    <br />
                    <h2>Add Movie</h2>
                    <h6>
                        Basic Information
                    </h6>

                    <div class="row">

                        <!-- Movie Title -->
                        <div class='col-sm-3'>                            
                            <label for="Movie Title" class="grey-text">Movie Title</label>
                            <input type="text" id="txtMovieTitle" name="txtMovieTitle" class="form-control">
                        </div>

                        <!-- Release Date -->
                        <div class='col-sm-3'>                            
                            <label for="Release Date" class="grey-text">Release Date:</label>
                            <input type="date" name="txtReleaseDate">
                        </div>
                    </div>
                    <br />
                    <br />
                    <h6>
                        Descriptive Information
                    </h6>
                    <br />
                    <div class="row">

                        <!-- Genre -->
                        <div class='col-sm-3'>                            
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
                    </div> 
                    <br />
                    <br />

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
                            <button type="submit" class="btn btn-secondary" id="btnSubmitAddMovie">Submit</button>
                            <a href="admin.php"><div class="btn btn-primary" id="btnCancel">Cancel</div></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

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