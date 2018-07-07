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
    <link href="scripts/Chosen/chosen.css" rel="stylesheet" />
    <script src="scripts/Chosen/chosen.jquery.js"></script>
    <script src="scripts/Chosen/chosen.proto.js"></script>

    <!--TinyMce-->
    <script src="scripts/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="scripts/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

    <!--Fileuploader-->
    <script src="scripts/Fileuploader/js/fileinput.js"></script>
    <link href="scripts/Fileuploader/css/fileinput.css" rel="stylesheet" />

    <script>
        $(document).ready(function () {
            $("#btnSubmitAddProp").click(function () {
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
    <?php include("includes/header.html");?>

    <div id="content">  
        <div id="header-bread">
            <ul class="breadcrumbs">
                <li><a href="default.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li>Add Property</li>
            </ul>
        </div>      
		<div class="row">
            <!-- Left column menu -->
            <?php include("includes/AdminMenu.html");?>

            <!-- Right column form -->
            <form action="processAddProp.php" method="post">
                <div class='col-lg-12'>
                    <br />
                    <h2>Add Property</h2>
                    <h6>
                        Basic Information
                    </h6>

                    <div class="row">

                        <!-- Property Address -->
                        <div class='col-sm-3'>                            
                            <label for="Property Address" class="grey-text">Property Address</label>
                            <input type="text" id="txtpropAddress" name="txtpropAddress" class="form-control">
                        </div>

                        <!-- Featured -->
                        <div class='col-sm-3'>                            
                            <label for="Featured" class="grey-text">Featured</label>
                            <select data-placeholder="Featured" class="simple-select" name="featured" id="featured">
                                <option value=''></option>
                                <option value='Y'>Yes</option>
                                <option value='N'>No</option>
                            </select>
                        </div>

                        <!-- Town -->
                        <div class='col-sm-3'>                            
                            <label for="Town" class="grey-text">Town</label>
                            <input type="text" id="txtTownForm" name="txtTownForm" class="form-control">
                        </div>

                        <!-- County -->
                        <div class='col-sm-3'>                            
                            <label for="County" class="grey-text">County</label>
                            <input type="text" id="txtCountyForm" name="txtCountyForm" class="form-control">
                        </div>

                    </div>
                    <br />
                    <div class="row">

                        <!-- Price -->
                        <div class='col-sm-3'>                            
                            <label for="Price" class="grey-text">Price</label>
                            <input type="text" id="txtPrice" name="txtPrice" class="form-control">
                        </div>

                        <!-- Status -->
                        <div class='col-sm-3'>                            
                            <label for="Town" class="grey-text">Property Status</label><br />
                            <select data-placeholder="Property Status" class="simple-select" name="status" id="status">
                                <option value=''></option>
                                <option value='For Sale'>For Sale</option>
                                <option value='For Rent'>For Rent</option>
                                <option value='Unavailable'>Unavailable</option>
                            </select>
                        </div>

                        <!-- Map Link -->
                        <div class='col-sm-3'>                            
                            <label for="Map Link" class="grey-text">Map Link</label>
                            <input type="text" id="txtMapLink" name="txtMapLink" class="form-control">
                        </div>

                        <!-- Vendor -->
                        <div class='col-sm-3'>                            
                            <label for="vendor" class="grey-text">Vendor</label><br />
                            <select data-placeholder="Choose a vendor" class="simple-select" name="vendor" id="vendor">
                                <option value=''></option>
                                <?php
                                    $server="localhost";
	                                $dbuser="root";
	                                $password="";
	                                $link=mysqli_connect($server, $dbuser, $password);
	                                mysqli_select_db($link, "property");

                                    $productid=$_GET["id"];
                                    $sql="SELECT vendorid, firstname, surname FROM vendor order by firstname";
                                    $result=mysqli_query($link, $sql);

                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        while($row=mysqli_fetch_array($result)) {                                          
                                            $id=$row["vendorid"];
                                            $firstname=$row["firstname"];
                                            $surname=$row["surname"];
                                            echo "<option value='$id'>$firstname $surname</option>";
                                        }
                                    }
                                    mysqli_close($link);
                                ?>
                            </select>
                        </div>
                    </div>
                    <br />
                    <br />
                    <h6>
                        Descriptive Information
                    </h6>
                    <br />
                    <div class="row">

                        <!-- Bedrooms -->
                        <div class='col-sm-3'>                            
                            <label for="Bedrooms" class="grey-text"># of Bedrooms</label><br />
                            <select data-placeholder="# of Bedrooms" class="simple-select" name="bedrooms" id="bedrooms">
                                <option value=''></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                            </select>
                        </div>

                        <!-- Bathrooms -->
                        <div class='col-sm-3'>                            
                            <label for="Bathrooms" class="grey-text"># of Bathrooms</label><br />
                            <select data-placeholder="# of Bathrooms" class="simple-select" name="bathrooms" id="bathrooms">
                                <option value=''></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                            </select>
                        </div>

                        <!-- Property Type -->
                        <div class='col-sm-3'>                            
                            <label for="Type" class="grey-text">Property Type</label><br />
                            <select data-placeholder="Property Type" class="simple-select" name="type" id="type">
                                <option value=''></option>
                                <option value='2'>Commercial</option>
                                <option value='1'>Residential</option>
                                <option value='3'>Site</option>
                            </select>
                        </div>

                        <!-- Size -->
                        <div class='col-sm-3'>                            
                            <label for="Size" class="grey-text">Size (sqft)</label>
                            <input type="text" id="txtSize" name="txtSize" class="form-control">
                        </div>
                    </div> 

                    <br />

                    <div class="row">

                        <!-- Short Description -->
                        <div class='col-sm-12'>                            
                            <label for="Short Description" class="grey-text">Short Description</label>
                            <textarea id="txtShortDesc" name="txtShortDesc" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <br />

                    <div class="row">

                        <!-- Long Description -->
                        <div class='col-sm-12'>                            
                            <label for="Long Description" class="grey-text">Long Description</label>
                            <textarea id="txtLongDesc" name="txtLongDesc" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <br />

                    <div class="row">

                        <!-- Images -->
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
                            <button type="submit" class="btn btn-secondary" id="btnSubmitAddProp">Submit</button>
                            <a href="admin.php"><div class="btn btn-primary" id="btnCancel">Cancel</div></a>
                        </div>
                    </div>
                </div>
            </form>
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
