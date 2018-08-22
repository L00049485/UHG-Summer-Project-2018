<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-secondary">About Us</h4>
                    <p class="text-muted">This website is designed to be minimalistic and display only vital information. No ads, no plugs, just movies and ratings. The top 100 grossing movies of all time are pre-loaded, more will be added over time.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-secondary">Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">
                            <i class='fa fa-twitter' aria-hidden='true'></i> Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">
                            <i class='fa fa-facebook-square' aria-hidden='true'></i> Follow on Facebook</a></li>
                        <li><a href="#" class="text-white">
                            <i class='fa fa-envelope' aria-hidden='true'></i> Email us</a></li>
                        <!-- If the user is logged in, display the logout link, and vice versa -->
                        <?php
                            if(isset($_SESSION['username'])) {
                                echo "<li><i class='fa fa-cog text-white' aria-hidden='true'></i><a href='Member.php' class='text-white'> My Details</a></li>";
                                echo "<li><i class='fa fa-sign-out text-white' aria-hidden='true'></i><a href='Logout.php' class='text-white'> Logout</a></li>";
                            }
                            else {
                                echo "<li><i class='fa fa-sign-in text-white' aria-hidden='true'></i><a href='#' class='text-white' data-toggle='modal' data-target='#login-modal'> Login</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="default.php" class="navbar-brand d-flex align-items-center">
                <strong>
                    <i class="fa fa-film fa-10x pageIcon"></i> 
                    Movie Review
                </strong>
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

                        echo "<p class='text-white' id='welcomeLabel'>Welcome back $firstName!</p>";
                    }
                    mysqli_close($link);

                    //Only show the logged in popup once
                    if($_SESSION['loginMessage']=='Not Shown') {
                        echo "<script type='text/javascript'>
                              $(document).ready(function () {
                                  DisplayLoginToast();
                              });
                         </script>";

                        $_SESSION['loginMessage']='Shown';
                    }
                }
                else
                {
                    if(isset($_SESSION['errors']))
                    {
                        $error = $_SESSION['errors'];
                        echo "<script type='text/javascript'>
                              $(document).ready(function () {
                                  DisplayLoginErrorToast('$error');
                              });
                         </script>";
                        unset($_SESSION["errors"]);
                    }
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
        <h1 class="jumbotron-heading">
        <i class="fa fa-film fa-10x pageIcon"></i> Movie Review</h1>
        <p class="lead text-muted">Simple, short movie reviews. Quick and easy to register. </p>
        <p>
            <?php
                if(isset($_SESSION['username'])) {
                    echo "<a href='member.php' class='btn btn-secondary my-2' id='btnMyDetails'>My Details</a>   ";
                    echo "<a href='logout.php' class='btn btn-primary my-2' id='btnLogout'>Logout</a>";
                }
                else {
                    echo "<a href='Register.php' class='btn btn-primary my-2' id='btnRegister'>Register</a>";
                    echo "  <a href='#' class='btn btn-secondary my-2' data-toggle='modal' data-target='#login-modal' id='btnLogin'>Login</a>";
                }
            ?>
        </p>
    </div>
</section>
<?php include("includes/loginModal.html");?>
