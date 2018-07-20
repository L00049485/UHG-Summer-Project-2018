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
                        <!-- If the user is logged in, display the logout link, and vice versa -->
                        <?php
                            if(isset($_SESSION['username']))
                                echo "<li><a href='Logout.php' class='text-white'>Logout</a></li>";
                            else
                                echo "<li><a href='#' class='text-white' data-toggle='modal' data-target='#login-modal'>Login</a></li>";
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="default.php" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Movie Review</strong>
            </a>
            <?php
                if(isset($_SESSION['username']))
                {
                    $server="localhost";
                    $dbuser="root";
                    $password="";
                    $link=mysqli_connect($server, $dbuser, $password);
                    mysqli_select_db($link, "moviereview");
                    $memberId = $_SESSION['memberID'];
                    $sql="SELECT 
	                    FirstName,
                        LastName
                        FROM member WHERE Member_Id = $memberId";
                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {
                            $firstName=$row["FirstName"];
                            $lastName=$row["LastName"];
                        }   
                
                        echo "<p class='text-white'>Welcome back $firstName!</p>";
                    }
                    mysqli_close($link);

                    echo "<script type='text/javascript'>
                              $(document).ready(function () {
                                  displayLoginToast();
                              });
                         </script>";
                }                    
            ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<section class="jumbotron text-center">
    <div class="containerHeader" id="driverTest">
        <h1 class="jumbotron-heading">Movie Review</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
        <p>
            <?php
                if(isset($_SESSION['username']))
                    echo "<a href='logout.php' class='btn btn-primary my-2'>Logout</a>";
                else {
                    echo "<a href='Register.php' class='btn btn-primary my-2'>Register</a>";
                    echo "  <a href='#' class='btn btn-secondary my-2' data-toggle='modal' data-target='#login-modal'>Login</a>";
                }
            ?>
        </p>
    </div>
</section>
<?php include("includes/loginModal.html");?>