<?php
session_start();
//$user = $_SESSION['loggedInUsername'];
$user=$_GET["id"];
//echo "<br>".$user."<br>";
/*
if (isset($user))
{

}
else
{
    // echo "".$_SESSION['name'];
    header('location:startPage.php');
}
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>VIEW POSTS</title>
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
<div class="container-fluid" style="background-color: darkviolet ;color: black">
    <div class="table table-responsive table-bordered" style="color: black">
        <table class="table" style="color: black">
            <thead>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>CATEGORY</th>
                <th>SUBCATEGORY</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>UPDATE</th>
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
                    $my_sql_query =
                        "
                        SELECT offerNumber,productImage,productName,productCategory,
                               productSubCategory,productDescription,productPrice
                        FROM saleproductoffers
                        INNER JOIN userinfo
                        WHERE saleproductoffers.userName = userinfo.userName
                        AND saleproductoffers.userName = '".$user."'
                        ";
                    $result = $mysqli_database_connection->query($my_sql_query);
                    if ($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            $offerNo = $row["offerNumber"];
                            echo "<tr>";
                            echo "<td>" . $row["offerNumber"] . "</td>";
                            echo "<td>" . $row["productName"] . "</td>";
                            echo "<td>" . $row["productCategory"] . "</td>";
                            echo "<td>" . $row["productSubCategory"] . "</td>";
                            echo "<td>" . $row["productDescription"] . "</td>";
                            echo "<td>" . $row["productPrice"] . "</td>";
                            $dynamic_location="updateOwnPosts.php?offerNumberSent=".$row["offerNumber"];
                            echo
                                "<td>".
                                " <a href=\" " . $dynamic_location . " \"> " .
                                "<button class='btn btn-primary'>".
                                "UPDATE" .
                                "</button>".
                                " </a> ".
                                "</td>";
                            echo "</tr>";
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