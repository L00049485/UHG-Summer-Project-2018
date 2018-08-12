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
                <li>Password Reset</li>
            </ul>
        </div>
        <div class="album py-5 bg-light"> 

            <div class="container">
                <h2>Member Password Reset</h2>
                <br />
                <div id="submitEmail">
                    <h3>Enter your email address:</h3>
                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="txtEmailAddress" name="txtEmailAddress" class="form-control" />
                        <label for="txtEmailAddress">Your email</label>
                    </div>

                    <input type="submit" id="btnPwdReset" class="btn btn-secondary my-2" value="Reset Password" />
                </div>
                <div id="submitNewPwd">
                    <h3>Verification code confirmed</h3>
                    <h4>Enter your new password:</h4>
                    <div class="row">

                        <!-- Password -->
                        <div class='col-sm-4'>
                            <label for="password" class="grey-text bold">Password:</label>
                            <input type="password" id="txtPassword" name="txtPassword" class="form-control" />
                        </div>

                        <!-- Password Confirm -->
                        <div class='col-sm-4'>
                            <label for="passwordCheck" class="grey-text bold">Confirm Password:</label>
                            <br />
                            <input type="password" id="txtPasswordCheck" class="form-control" />
                        </div>
                    </div>

                    <input type="submit" id="btnPwdResetReal" class="btn btn-secondary my-2" value="Reset Password" />
                </div>
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
<script src="scripts/jQuery-UI.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,500,600,700" rel="stylesheet" />
<script src="scripts/mdb.js"></script>
<!--Chosen-->
<link href="scripts/Chosen/chosen.css" rel="stylesheet" />
<script src="scripts/Chosen/chosen.jquery.js"></script>
<script src="scripts/Chosen/chosen.proto.js"></script>

<!--Custom JS functions-->
<script src="scripts/Custom.js"></script>
<script src="scripts/passwordResetSystem.js"></script>

<!-- Toast -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />
