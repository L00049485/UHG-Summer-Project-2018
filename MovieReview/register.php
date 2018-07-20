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
    
    <div class="container">
        <a href="#" data-toggle="modal" data-target="#login-modal">Login</a>

        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="loginmodal-container modal-content">
                    <h4>Login to Your Account</h4>
                    <br>
                    <form>
                        <!-- Material input email -->
                        <div class="md-form">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <input type="email" id="materialFormLoginEmailEx" name="admin_name" class="form-control">
                            <label for="materialFormLoginEmailEx">Your email</label>
                        </div>

                        <!-- Material input password -->
                        <div class="md-form">
                            <i class="fa fa-lock prefix grey-text"></i>
                            <input type="password" id="materialFormLoginPasswordEx" name="password" class="form-control">
                            <label for="materialFormLoginPasswordEx">Your password</label>
                        </div>

                        <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                    </form>

                    <div class="login-help">
                        <a href="#">Register</a> - <a href="#">Forgot Password</a>
                    </div>
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

<!-- Toastr -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

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