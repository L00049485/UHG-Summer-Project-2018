<div id="searchBlock">
    <div class='row'>
        <!-- Town -->
        <div class='col-lg-4'>
            <select data-placeholder="Choose a town" class="simple-select" name="town" id="town">
                <option value=''></option>
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "property");

                    $sql="SELECT distinct town FROM property order by town";
                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {                                          
                            $town=$row["town"];
                            echo "<option value='$town'>$town</option>";
                        }
                    }
                    mysqli_close($link);
                ?>
            </select>
        </div>

        <!-- County -->
        <div class='col-lg-4'>
            <select data-placeholder="Choose a county" class="simple-select" name="county" id="county">
                <option value=''></option>
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "property");

                    $productid=$_GET["id"];
                    $sql="SELECT distinct county FROM property order by county";
                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {                                          
                            $county=$row["county"];
                            echo "<option value='$county'>$county</option>";
                        }
                    }
                    mysqli_close($link);
                ?>
            </select>
        </div>

        <!-- Bedrooms -->
        <div class='col-lg-4'>
            <select data-placeholder="# of Bedrooms" class="simple-select" name="bedrooms" id="bedrooms" >
                <option value=''></option>
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "property");

                    $productid=$_GET["id"];
                    $sql="SELECT distinct bedrooms FROM property order by bedrooms";
                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {                                          
                            $bedrooms=$row["bedrooms"];
                            echo "<option value='$bedrooms'>$bedrooms</option>";
                        }
                    }
                    mysqli_close($link);
                ?>
            </select>
        </div>
    </div>
    <br />
    <br />
    <div class='row'>

        <!-- Type -->
        <div class='col-lg-4'>
            <select data-placeholder="Type of Property" class="simple-select" name="type" id="type">
                <option value=''></option>
                <?php
                    $server="localhost";
	                $dbuser="root";
	                $password="";
	                $link=mysqli_connect($server, $dbuser, $password);
	                mysqli_select_db($link, "property");

                    $productid=$_GET["id"];
                    $sql="SELECT distinct categoryname FROM category order by categoryname";
                    $result=mysqli_query($link, $sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result)) {                                          
                            $category=$row["categoryname"];
                            echo "<option value='$category'>$category</option>";
                        }
                    }
                    mysqli_close($link);
                ?>
            </select>
        </div>

        <!-- Buy / Rent -->
        <div class='col-lg-4'>
            <select data-placeholder="Buy or Rent" class="simple-select" name="buyRent" id="buyRent">
                <option value=''></option>
                <option value='For Sale'>For Sale</option>
                <option value='For Rent'>For Rent</option>
            </select>
        </div>

        <!-- Max Price -->
        <div class='col-lg-4'>
            <div class='row'>
                <div class='col-sm-4'>Max Price: </div>
                <div class='col-sm-4'><div id='slider'></div></div>
                <div class='col-sm-4'><div id='slider-step-value'></div></div>
            </div>
        </div>
        
        <br />
        <br />
        <div class='row'>
        <!-- Search -->
            <div class='col-lg-6'>
                <div style="padding-left:15px;"><button type="submit" class="btn btn-secondary" id="btnSubmit">Search</button></div>
            </div>
        </div>
    </div>
</div>