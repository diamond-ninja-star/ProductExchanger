<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>POSTERS PROFILE</title>
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

<body background="assets/images/startPageBackground.png" style="color: white ; background-color: #2aabd2 ; ">
<!-- ONLINE -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- OFFLINE -->
<script src="assets/bootstrap/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

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
<div class="container" style="text-align: center ; background-color: mediumblue ">
    <h1 style="text-align: center">PROFILE DETAILS : </h1>
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
        $getUserName = $_GET["userNameSent"];//session theke nite hobey
        $my_sql_query = " SELECT *
                        FROM userinfo 
                        WHERE userName='" . $getUserName . "' ";

        $result = $mysqli_database_connection->query($my_sql_query);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                //echo "<label>" . "PROFILE PICTURE" . "</label>" . "<br>";
                echo "<div class=\"container-fluid\" >";
                echo "<img  class=\"center-block img-responsive img-rounded\"
                            src=\"uploadedImages/$row[profilePicture]\" alt=\"no image\">" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<br>";
                echo "<label style=\"color: #00ff00\">" . "USERNAME : " . "</label>" . "<br>";
                echo "$row[userName]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "FULL NAME : " . "</label>" . "<br>";
                echo "$row[firstName]" . " " . "$row[lastName]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "PHONE NUMEBR : " . "</label>" . "<br>";
                echo "$row[phoneNumber]<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "EMAIL : " . "</label>" . "<br>";
                echo "$row[email]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "PLACE : " . "</label>" . "<br>";
                echo "$row[placeWithoutDivision]" . "<br>";
                echo "</div>";
                echo "<div class=\"container-fluid\" style=\"background-color: black\">";
                echo "<label style=\"color: #00ff00\">" . "DIVISION : " . "</label>" . "<br>";
                echo "$row[division]" . "<br>";
                echo "<br>";
                echo "</div>";
            }
        }
    }
    ?>
</div>


</body>

</html>