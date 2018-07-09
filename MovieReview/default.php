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
            <div class="container">
                <div class="row">
                <!-- Movie albums -->
                <?php
                    $server="localhost";
                    $dbuser="root";
                    $password="";
                    $link=mysqli_connect($server, $dbuser, $password);
                    mysqli_select_db($link, "moviereview");
                
                    $sql="SELECT 
                        movie_id,
                        title,
                        image,
                        releasedate
                        FROM movie order by releasedate";

                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {
                        $movieId=$row["movie_id"];
                        $title=$row["title"];
                        $image=$row["image"];
                        $releaseDate=$row["releasedate"];
                        $releaseDate=substr($releaseDate, 0,4);   

                        echo "<div class='col-md-2'>
                            <div class='card mb-2 box-shadow'>
                                <img class='card-img-top' src='$image' alt='Card image cap'>
                                <div class='card-body'>
                                    <p class='card-text'>$title ($releaseDate)</p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='btn-group'>
                                            <button type='button' class='btn btn-sm btn-outline-secondary' title='Like movie'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></button>
                                            <button type='button' class='btn btn-sm btn-outline-secondary'>Rate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        
                          
                    }
                }
                else
                {
                    echo "<h5>No results found</h5>";
                }
                mysqli_close($link);
                ?>


                
                    <!--<div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/CaptainAmerica.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Captain America: First Avenger</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/Thor.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Thor</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card mb-2 box-shadow">
                            <img class="card-img-top" src="images/Posters/AvengersInfinityWarPoster.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Avengers: Infinity War</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" title="Like movie"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>

                                        <button type="button" class="btn btn-sm btn-outline-secondary">Rate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
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
