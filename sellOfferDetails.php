<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns: xmlns:>
<head>
    <title>DETAILED OFFER</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ONLINE -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- OFFLINE -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/ico" href="assets/images/faviconLogoMain2.1.ico"/>
</head>
<body style="background-color:#2aabd2 ">

<!-- Navigation -->
<div class="container-fluid">
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
                <li>
                    <a href="viewOwnPosts.php">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span>POSTS</button>
                    </a>
                </li>
                <li>
                    <a href="viewOwnProfile.php">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>PROFILE</button>
                    </a>
                </li>
                <li>
                    <a href="startPage.php">
                        <?php
                        session_unset();
                        ?>
                        <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-user">

                        </span>
                            SIGN OUT
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container" style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; color: white ">
    <h1 style="text-align: center ; ">PRODUCT DETAILS : </h1>
    <?php
    //darkblue
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
		//echo("<br>".$_SESSION['loggedInUsername']."<br>");
        $getTest=$_GET["offerNum"];
        $getOfferNumber = $getTest;//session theke nite hobey
        $my_sql_query = "SELECT *
                         FROM saleproductoffers
                         INNER JOIN userinfo
                         WHERE saleproductoffers.userName=userinfo.userName
                         AND saleproductoffers.offerNumber='" . $getOfferNumber . "'";

        $result = $mysqli_database_connection->query($my_sql_query);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<div class=\"container-fluid\" >";
                echo "<img  class=\"center-block img-rounded img-responsive\"
                            src=\"uploadedImages/$row[productImage]\" alt=\"no image\">" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style= \"background-color: black\" >";
                echo "<br>";
                echo "<label style=\"color: #00ff00\">" . "NAME : " . "</label>" . "<br>";
                echo "$row[productName]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "PRICE : " . "</label>" . "<br>";
                echo "$row[productPrice]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "CATEGORY : " . "</label>" . "<br>";
                echo "$row[productCategory]<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "SUB CATEGORY : " . "</label>" . "<br>";
                echo "$row[productSubCategory]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "DESCRIPTION : " . "</label>" . "<br>";
                $newDescription = nl2br("$row[productDescription]");
                echo "$newDescription" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "OFFER NUMBER : " . "</label>" . "<br>";
                echo "$row[offerNumber]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "TIME : " . "</label>" . "<br>";
                echo "$row[productUploadTime]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "DATE (YEAR-MONTH-DATE) : " . "</label>" . "<br>";
                //$dateDirectString = $row[productUploadDate];
                //$dateFormattedString = date("d-m-Y",$dateDirectString);
                //echo "$dateFormattedString" . "<br>";
                echo "$row[productUploadDate]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "PLACE : " . "</label>" . "<br>";
                echo "$row[placeWithoutDivision]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "DIVISION : " . "</label>" . "<br>";
                echo "$row[division]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "POSTED BY : " . "</label>" . "<br>";
                $dynamic_location="viewPostersProfile.php?userNameSent="."$row[userName]";
                echo " <a href=\" " . $dynamic_location . " \"> " .
                        "$row[userName]" .
                     " </a> " .
                     " <br> ";
                echo "<br>";
                echo "</div>";
            }
        }
    }
    ?>
</div>

</body>
</html>
