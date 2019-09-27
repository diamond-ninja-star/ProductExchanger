<?php
    session_start();
    $sessionedUN=$_SESSION["loggedInUsername"];
    //$anchorUN=$_GET["un"];
?>
<!DOCTYPE html>
<html lang="en" xmlns: xmlns:>
<head>
    <title>SELL OFFERS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ONLINE -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- OFFLINE -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/ico" href="assets/images/faviconLogoMain2.1.ico"/>
    <style>
        #result tr:nth-child(even)
        {
            background-color:#dddddd;
        }
    </style>
</head>
<body   style="background-color:#2aabd2 ">

<!-- ONLINE -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- OFFLINE -->
<script src="assets/bootstrap/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>


<!-- Navigation -->
<nav class="navbar navbar-inverse" style="color: white ;margin: 0 auto 0 auto">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span style="color: #2aabd2">Product</span><span style="color: coral">Exchanger</span></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">OFFERS : </a></li>
            <li class="active"><a href="sellOfferAll.php">SELL</a></li>
            <li><a href="buyOffer.php">BUY</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="active">
                <a href="#">
                    <button class="btn btn-success disabled">
                        WELCOME
                        <span>
                            <?php echo $sessionedUN;?>
                        </span>
                    </button>
                </a>
            </li>
            <li>
                <?php
                $variable_profile="viewOwnPosts.php?id=".$sessionedUN;
                echo "<a href=\"$variable_profile\">";
                echo "<button class=\"btn btn-primary\">";
                echo "<span class=\"glyphicon glyphicon-th-list\">";
                echo "</span>";
                echo "POSTS";
                echo "</button>";
                echo "</a>"
                ?>
            </li>
            <li>
                <?php
                $variable_profile="viewOwnProfile.php?id=".$sessionedUN;
                echo "<a href=\"$variable_profile\">";
                echo "<button class=\"btn btn-primary\">";
                echo "<span class=\"glyphicon glyphicon-user\">";
                echo "</span>";
                echo "PROFILE";
                echo "</button>";
                echo "</a>"
                ?>
            </li>
            <li>
                <a href="startPage.php">
                    <?php
                    session_unset();
                    $check = session_status();
                    if($check==PHP_SESSION_ACTIVE)
                    {
                        session_destroy();
                    }
                    ?>
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove-sign">

                        </span>
                        SIGN OUT
                    </button>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid" style="color: white ;background-color: darkblue;text-align: center">
    <br>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category">CATEGORY : </label>
            <input type="text" placeholder="ENTER PRODUCT CATEGORY" class="form-control" id="category"
                   name="categoryField" maxlength="50">
        </div>
        <div class="form-group">
            <label for="subCategory">SUB-CATEGORY : </label>
            <input type="text" placeholder="ENTER PRODUCT SUB-CATEGORY" class="form-control" id="subCategory"
                   name="subCategoryField" maxlength="50">
        </div>
        <div class="form-group">
            <label for="place">PLACE : </label>
            <input type="text" placeholder="ENTER PLACE" class="form-control" id="place"
                   name="placeField" maxlength="50">
        </div>
        <div class="form-group">
            <label for="division">DIVISION : </label>
            <input type="text" placeholder="ENTER DIVISION" class="form-control" id="division"
                   name="divisionField" maxlength="15">
        </div>
        <div class="form-group">
            <label for="productName">PRODUCT NAME : </label>
            <input type="text" placeholder="ENTER DIVISION" class="form-control" id="productName"
                   name="productNameField" maxlength="50" required>
        </div>
        <button type="submit" class="btn btn-success btn-lg" name="searchButton">
            <span class="glyphicon glyphicon-search"></span> &nbsp; SEARCH
        </button>
        <button type="reset" class="btn btn-danger btn-lg" name="resetButton">
            <span class="glyphicon glyphicon-refresh"></span> &nbsp; RESET
        </button>
    </form>
    <br>
</div>

<div class="container-fluid" style="background-color: darkviolet ;">
    <div class="table table-responsive table-bordered">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>PLACE</th>
                <th>DIVISION</th>
                <th>TIME</th>
                <th>DATE</th>
                <th>PRICE</th>
            </tr>
            </thead>



            <tbody id="result">
                <br>
            <?php
            //check if it name is printed correctly
            //echo $_SESSION['sendSessionUsername'];
            //Declare (and assign) connection parameters (variables)
            $server_name = "localhost";
            $user_name = "root";
            $password = "";
            $database_name = "project0";
            //Create connection
            $mysqli_database_connection = new mysqli($server_name, $user_name, $password, $database_name);
            //Check connection
            //connection failed
            if ($mysqli_database_connection->connect_error)
            {
                die("ERROR CONNECTING TO MySQL SERVER." . $mysqli_database_connection->connect_error);
            }
            //connection established
            else
            {
				$userNameget = $sessionedUN;
				$_SESSION['loggedInUsername']=$sessionedUN;
				//echo("<br>".$userNameget."<br>");
				//implement search
                if(isset($_POST["searchButton"]))
                {
                    $getCategory = $_POST["categoryField"];
                    $getSubCategory = $_POST["subCategoryField"];
                    $getPlace = $_POST["placeField"];
                    $getDivision = $_POST["divisionField"];
                    $getProductName = $_POST["productNameField"];
                    $my_sql_query = "";
                    // category = 0 + subCategory = 0 + place =  0 + division =  0
                    if($getCategory=="" && $getSubCategory =="" && $getPlace=="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                               "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice 
                                FROM saleproductoffers 
                                INNER JOIN userinfo 
                                WHERE saleproductoffers.userName=userinfo.userName 
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 0 + place =  0 + division =  0
                    if($getCategory!="" && $getSubCategory =="" && $getPlace=="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 1 + place =  0 + division =  0
                    elseif($getCategory=="" && $getSubCategory !="" && $getPlace=="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productSubCategory LIKE '$getSubCategory'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 0 + place =  1 + division =  0
                    elseif($getCategory=="" && $getSubCategory =="" && $getPlace!="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 0 + place =  0 + division =  1
                    elseif($getCategory=="" && $getSubCategory =="" && $getPlace=="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 0 + place =  1 + division =  1
                    elseif($getCategory=="" && $getSubCategory =="" && $getPlace!="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 1 + place =  0 + division =  1
                    elseif($getCategory=="" && $getSubCategory !="" && $getPlace=="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productSubCategory LIKE '$getSubCategory'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 1 + place =  1 + division =  0
                    elseif($getCategory=="" && $getSubCategory !="" && $getPlace!="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productSubCategory LIKE '$getSubCategory'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 0 + place =  0 + division =  1
                    elseif($getCategory!="" && $getSubCategory =="" && $getPlace=="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 0 + place =  1 + division =  0
                    elseif($getCategory!="" && $getSubCategory =="" && $getPlace!="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 1 + place =  0 + division =  0
                    elseif($getCategory!="" && $getSubCategory !="" && $getPlace=="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND productSubCategory LIKE '$getSubCategory'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 0 + subCategory = 1 + place =  1 + division =  1
                    elseif($getCategory=="" && $getSubCategory !="" && $getPlace!="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productSubCategory LIKE '$getSubCategory'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 0 + place =  1 + division =  1
                    elseif($getCategory!="" && $getSubCategory =="" && $getPlace!="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 1 + place =  0 + division =  1
                    elseif($getCategory!="" && $getSubCategory !="" && $getPlace=="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND productSubCategory LIKE '$getSubCategory'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 1 + place =  1 + division =  0
                    elseif($getCategory!="" && $getSubCategory !="" && $getPlace!="" && $getDivision=="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND productSubCategory LIKE '$getSubCategory'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    // category = 1 + subCategory = 1 + place =  1 + division =  1
                    elseif($getCategory!="" && $getSubCategory !="" && $getPlace!="" && $getDivision!="" && $getProductName!="")
                    {
                        $my_sql_query =
                            "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice
                                FROM saleproductoffers
                                INNER JOIN userinfo
                                WHERE saleproductoffers.userName=userinfo.userName
                                AND productCategory LIKE '%$getCategory%'
                                AND productSubCategory LIKE '$getSubCategory'
                                AND placeWithoutDivision LIKE '%$getPlace%'
                                AND division LIKE '%$getDivision%'
                                AND productName LIKE '%$getProductName%'
                                ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    }
                    $result = $mysqli_database_connection->query($my_sql_query);
                    if ($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            $offerNo = $row["offerNumber"];
                            echo "<tr>";
                            echo "<td>" . $row["offerNumber"] . "</td>";
                            echo "<td>" . "<a href='sellOfferDetails.php?offerNum=" . "$offerNo" . ">" . "<button class=''>" . $row["productName"] . "</button>" . "</a>" . "</td>";
                            echo "<td>" . $row["placeWithoutDivision"] . "</td>";
                            echo "<td>" . $row["division"] . "</td>";
                            echo "<td>" . $row["productUploadTime"] . "</td>";
                            echo "<td>" . $row["productUploadDate"] . "</td>";
                            echo "<td>" . $row["productPrice"] . "</td>";
                            echo "</tr>";
                        }
                    }
                }
                else
                {
                    $my_sql_query = "SELECT offerNumber,productName,placeWithoutDivision,division,productUploadTime,DATE_FORMAT(productUploadDate,'%d/%m/%Y') AS productUploadDate,productPrice 
                        FROM saleproductoffers 
                        INNER JOIN userinfo 
                        WHERE saleproductoffers.userName=userinfo.userName 
                        ORDER BY  productUploadDate DESC , productUploadTime DESC , offerNumber DESC ";
                    $result = $mysqli_database_connection->query($my_sql_query);
                    if ($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            $offerNo = $row["offerNumber"];
                            echo "<tr>";
                            echo "<td>" . $row["offerNumber"] . "</td>";
                            echo "<td>" . "<a href='sellOfferDetails.php?offerNum=" . "$offerNo" . ">" . "<button class=''>" . $row["productName"] . "</button>" . "</a>" . "</td>";
                            echo "<td>" . $row["placeWithoutDivision"] . "</td>";
                            echo "<td>" . $row["division"] . "</td>";
                            echo "<td>" . $row["productUploadTime"] . "</td>";
                            echo "<td>" . $row["productUploadDate"] . "</td>";
                            echo "<td>" . $row["productPrice"] . "</td>";
                            echo "</tr>";
                        }
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
