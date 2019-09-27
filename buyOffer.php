<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns: xmlns:>
<head>
    <title>BUY OFFERS</title>
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
<nav class="navbar navbar-inverse" style="color: white ;margin: 0 auto 0 auto">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span style="color: #2aabd2">Product</span><span style="color: coral">Exchanger</span></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">OFFERS : </a></li>
            <li><a href="sellOfferAll.php">SELL</a></li>
            <li class="active"><a href="buyOffer.php">BUY</a></li>
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
<div class="container" style="color:white">
    <h1 style="text-align: center">FILL IN THE FORM BELOW TO POST YOUR BUY OFFER :</h1>
</div>
<div class="container" style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; color: white ">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName">NAME : </label>
            <input type="text" placeholder="ENTER PRODUCT NAME" class="form-control" id="productName"
                   name="productNameField" minlength="1" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="price">PRICE : </label>
            <input type="text" placeholder="ENTER PRICE" class="form-control" id="price"
                   name="priceField" minlength="1" maxlength="10" required>
        </div>
        <div class="form-group">
            <label for="category">CATEGORY : </label>
            <input type="text" placeholder="ENTER CATEGORY" class="form-control" id="category"
                   name="categoryField" minlength="1" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="subCategory">SUB-CATEGORY : </label>
            <input type="text" placeholder="ENTER SUB-CATEGORY" class="form-control" id="subCategory"
                   name="subCategoryField" maxlength="50">
        </div>
        <div class="form-group">
            <label for="description">DESCRIPTION : </label>
            <textarea class="form-control" placeholder="ENTER DESCRIPTION" rows="10" id="description"
                      name="descriptionField" maxlength="255"></textarea>
        </div>
        <div class="form-group">
            <label for="productImage">PRODUCT IMAGE : </label>
            <input type="file" class="form-control" id="productImage" name="productImageField" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success btn-lg" name="postButton">
            <span class="glyphicon glyphicon-saved"></span> &nbsp; POST
        </button>
        <button type="reset" class="btn btn-danger btn-lg" name="resetButton">
            <span class="glyphicon glyphicon-refresh"></span> &nbsp; RESET
        </button>
    </form>
</div>
<div class="container">
    <?php
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
        die("Error connecting to MySQL server." . $mysqli_database_connection->connect_error);
    } //connection established
    else
    {
        if (isset($_POST["postButton"]))
        {
            if (isset($_POST["productNameField"]) && isset($_POST["priceField"]) && isset($_POST["categoryField"]))
            {
                $getUserName = "abdullah"; //session diye replace korte hobe

                $getProductName = $_POST["productNameField"];
                $getPrice = $_POST["priceField"];
                $getCategory = $_POST["categoryField"];
                $getSubCategory = $_POST["subCategoryField"];
                $getDescription = $_POST["descriptionField"];
                $getProductImage = $_FILES["productImageField"]["name"];
                $getCurrentTime = date("H:i:s");
                $getCurrentDate = date('Y-m-d');


                echo "<br>" . $getProductName . "<br>";
                echo "<br>" . $getPrice . "<br>";
                echo "<br>" . $getCategory . "<br>";
                echo "<br>" . $getSubCategory . "<br>";
                echo "<br>" . $getDescription . "<br>";
                echo "<br>" . $getProductImage . "<br>";
                echo "<br>" . $getCurrentTime . "<br>";
                echo "<br>" . $getCurrentDate . "<br>";


                if ($getProductImage != NULL)
                {
                    //file name
                    $fileName = $_FILES['productImageField']['name'];
                    //temporary directory
                    $fileTemporaryDirectory = $_FILES['productImageField']['tmp_name'];
                    //file size
                    $fileSize = $_FILES['productImageField']['size'];
                    //echo "<br>" . $fileName . "<br>" . $fileTemporaryDirectory . "<br>" . $fileSize . "<br>";
                    //upload directory
                    $fileUploadDirectory = 'uploadedImages/';
                    //current file extension
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension
                    //valid file (image) extensions
                    $validExtensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                    //rename uploaded image
                    $fileRename = rand(1000, 1000000) . "." . $fileExtension;
                    //echo "<br>" . "passed : $fileRename" . "<br>";
                    //if current extension is any of valid extension in array
                    if (in_array($fileExtension, $validExtensions))
                    {
                        //file size < 5MB
                        if ($fileSize < 5000000)
                        {
                            move_uploaded_file($fileTemporaryDirectory, $fileUploadDirectory . $fileRename);
                            //echo "<br>" . "done" . "<br>";

                            //write and save query in a variable:
                            $my_mysqli_query =" INSERT INTO saleproductoffers(offerNumber,productImage,productName,
                                                                              productDescription,productPrice,
                                                                              productUploadDate,productUploadTime,
                                                                              productCategory,productSubCategory,username)
                                  VALUES (NULL, '" . $fileRename . "', '" . $getProductName . "',
                                                  '" . $getDescription . "', '" . $getPrice . "', '" . $getCurrentDate . "',
                                                   '" . $getCurrentTime . "', '" . $getCategory . "', '" . $getSubCategory . "',
                                                    '" . $getUserName . "')";


                            //check if query is valid:
                            //valid query
                            if ($mysqli_database_connection->query($my_mysqli_query))
                            {
                                //echo "QUERY : " . $my_mysqli_query . "<br>";
                                //echo "QUERY VALID" . "<br>";
                                //echo "INSERT OPERATION SUCCESSFUL" . "<br>";
                            } //invalid query
                            else
                            {
                                //echo "QUERY : " . $my_mysqli_query . "<br>";
                                //echo "QUERY INVALID" . "<br>";
                                //echo "ERROR : " . $mysqli_database_connection->error . "<br>";
                                //echo "INSERT OPERATION FAILED" . "<br>";
                                echo "<div class=\"alert alert-danger alert-dismissible\">
                                                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                \"QUERY : \" . $my_mysqli_query . \"<br>\";      
                                                              </div>";
                                echo "<div class=\"alert alert-danger alert-dismissible\">
                                                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                \"QUERY INVALID\" . \"<br>\";    
                                                              </div>";
                                echo "<div class=\"alert alert-danger alert-dismissible\">
                                                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                \"ERROR : \" . $mysqli_database_connection->error . \"<br>\"    
                                                              </div>";
                                echo "<div class=\"alert alert-danger alert-dismissible\">
                                                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                \"INSERT OPERATION FAILED\" . \"<br>\"    
                                                              </div>";
                            }
                        } //error : file size >= 5MB
                        else
                        {
                            //$errorMessage = "SORRY, YOUR FILE IS GREATER THAN 5MB.";
                            //echo "<br>" . $errorMessage . "<br>";
                            echo "<div class=\"alert alert-danger alert-dismissible\">
                                                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                <strong>ERROR : </strong> SORRY, YOUR FILE IS GREATER THAN 5MB.
                                                          </div>";
                        }
                    } // error : extension invalid
                    else
                    {
                        //$errorMessage = "SORRY, ONLY JPG, JPEG, PNG & GIF FILES ARE ALLOWED.";
                        //echo "<br>" . $errorMessage . "<br>";
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                <strong>ERROR : </strong> SORRY, ONLY JPG, JPEG, PNG & GIF FILES ARE ALLOWED.
                                                      </div>";
                    }
                } //no profile picture
                else
                {
                    //write and save query in a variable:
                    $my_mysqli_query =" INSERT INTO saleproductoffers(offerNumber,productImage,productName,
                                                                              productDescription,productPrice,
                                                                              productUploadDate,productUploadTime,
                                                                              productCategory,productSubCategory,username)
                                  VALUES (NULL, '" . $getProductImage . "', '" . $getProductName . "',
                                                  '" . $getDescription . "', '" . $getPrice . "', '" . $getCurrentDate . "',
                                                   '" . $getCurrentTime . "', '" . $getCategory . "', '" . $getSubCategory . "',
                                                    '" . $getUserName . "')";

                    //check if query is valid:
                    //valid query
                    if ($mysqli_database_connection->query($my_mysqli_query))
                    {
                        //echo "QUERY : " . $my_mysqli_query . "<br>";
                        //echo "QUERY VALID" . "<br>";
                        //echo "INSERT OPERATION SUCCESSFUL" . "<br>";
                    } //invalid query
                    else
                    {
                        //echo "QUERY : " . $my_mysqli_query . "<br>";
                        //echo "QUERY INVALID" . "<br>";
                        //echo "ERROR : " . $mysqli_database_connection->error . "<br>";
                        //echo "INSERT OPERATION FAILED" . "<br>";
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                          \"QUERY : \" . $my_mysqli_query . \"<br>\";      
                                                      </div>";
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                          \"QUERY INVALID\" . \"<br>\";    
                                                      </div>";
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                          \"ERROR : \" . $mysqli_database_connection->error . \"<br>\"    
                                                      </div>";
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                          \"INSERT OPERATION FAILED\" . \"<br>\"    
                                                      </div>";
                    }
                }
            }
        }
    }
    ?>
</div>
</body>
</html>
