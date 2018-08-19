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
                <li>New Member Registration</li>
            </ul>
        </div>
        <div class="album py-5 bg-light"> 
            <div class="container">
        
                <div class="album py-5 bg-light">
                <!-- Right column form -->
                    <form id="registrationForm">
                        <div class='col-lg-12'>
                            <h2>New Member Registration</h2>
                            <br />

                            <div class="row">
                                <!-- First Name -->
                                <div class='col-sm-2'>                            
                                    <label for="firstName" class="grey-text bold">First Name:</label>
                                    <input type="text" id="txtFirstName" name="txtFirstName" class="form-control" required>
                                </div>

                                <!-- Last Name -->
                                <div class='col-sm-2'>                            
                                    <label for="lastName" class="grey-text bold">Last Name:</label>
                                    <input type="text" id="txtLastName" name="txtLastName" class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class='col-sm-4'>                            
                                    <label for="email" class="grey-text bold">Email Address:</label>
                                    <input type="text" id="txtemailAddress" name="txtemailAddress" class="form-control" required>
                                </div>

                                <!-- DOB -->
                                <div class='col-sm-4'>                            
                                    <label for="dob" class="grey-text bold">Date of Birth:</label><br />
                                    <input type="date" name="txtDOB" class="form-control" required>
                                </div>
                            </div>
                            <br />
                            <hr />
                            <div class="row">

                                <!-- Phone No -->
                                <div class='col-sm-4'>                            
                                    <label for="phoneNo" class="grey-text bold">Phone No:</label>
                                    <input type="text" id="txtPhoneNo" name="txtPhoneNo" class="form-control" required>
                                </div>

                                <!-- Address 1 -->
                                <div class='col-sm-4'>                            
                                    <label for="Address1" class="grey-text bold">Address 1:</label><br />
                                    <input type="text" name="txtAddress1" class="form-control" >
                                </div>

                                <!-- Address 1 -->
                                <div class='col-sm-4'>                            
                                    <label for="Address2" class="grey-text bold">Address 2:</label><br />
                                    <input type="text" name="txtAddress2" class="form-control">
                                </div>
                            </div>
                            <br />

                            <div class="row">

                                <!-- City -->
                                <div class='col-sm-4'>                            
                                    <label for="city" class="grey-text bold">City:</label>
                                    <input type="text" id="txtCity" name="txtCity" class="form-control">
                                </div>

                                <!-- State -->
                                <div class='col-sm-4'>                            
                                    <label for="State" class="grey-text bold">State</label><br />
                                    <input type="text" name="txtState" class="form-control">
                                </div>

                                <!-- Country -->
                                <div class='col-sm-4'>                            
                                    <label for="Country" class="grey-text bold">Country:</label><br />
                                    <input type="text" name="txtCountry" class="form-control">
                                </div>
                            </div>
                            <br />
                            <hr />
                            <div class="row">

                                <!-- Password -->
                                <div class='col-sm-4'>                            
                                    <label for="password" class="grey-text bold">Password:</label>
                                    <input type="password" id="txtPassword" name="txtPassword" class="form-control" required>
                                </div>

                                <!-- Password Confirm -->
                                <div class='col-sm-4'>                            
                                    <label for="passwordCheck" class="grey-text bold">Confirm Password:</label><br />
                                    <input type="password" name="txtPasswordCheck" class="form-control" required>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class='col-sm-4'>
                                    <button type="submit" class="btn btn-primary" id="btnSubmitRegister">Submit</button>
                                    <a href="default.php"><div class="btn btn-secondary" id="btnCancel">Cancel</div></a>
                                </div>
                            </div>
                        </div>
                    </form>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<script src="scripts/registerSystem.js"></script>

<!-- Toastr -->
<script src="scripts/toast/jquery.toast.js"></script>
<link href="styles/jquery.toast.css" rel="stylesheet" />

<script>
    //Set up the multi-select for the actors
    $(document).ready(function () {
        $(".chosen-container").chosen({ no_results_text: "Oops, nothing found!", width: "300px" });
        $(".simple-select").chosen({ no_results_text: "Oops, nothing found!", width: "200px" });
    });
</script>