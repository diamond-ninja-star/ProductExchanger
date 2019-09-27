<?php
session_start();
//$user = $_SESSION['loggedInUsername'];
$getOfferNumberSent = $_GET['offerNumberSent'];
$getProductImage="";
$getProductName = "";
$getProductCategory = "";
$getProductSubCategory = "";
$getProductDescription = "";
$getProductPrice = "";
//echo "<br>".$user."<br>";
//echo "<br>".$getOfferNumberSent."<br>";
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
    $result = $mysqli_database_connection->query
    (
        "SELECT productImage,productName,productCategory,
                               productSubCategory,productDescription,productPrice
                        FROM saleproductoffers
                        INNER JOIN userinfo
                        WHERE saleproductoffers.userName = userinfo.userName
                        AND saleproductoffers.offerNumber = '" . $getOfferNumberSent . "'
                        "
    );
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $getProductImage = $row["productImage"];
            $getProductName = $row["productName"];
            $getProductCategory = $row["productCategory"];
            $getProductSubCategory = $row["productSubCategory"];
            $getProductDescription = $row["productDescription"];
            $getProductPrice = $row["productPrice"];
            //echo $getProductPrice;
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>UPDATE POSTS</title>
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

    <div class="container"
         style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; color: white ">
        <h3>EDIT DATA BELOW TO UPDATE : </h3>
        <br>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">IMAGE: </label>
                <input type="file" class="form-control" id="image" name="imageField" accept="image/*"
                        ">
            </div>
            <div class="form-group">
                <label for="name">NAME : </label>
                <input type="text" placeholder="ENTER PRODUCT NAME" class="form-control" id="name"
                       name="nameField" minlength="1" maxlength="50"
                       value=" <?php echo $getProductName; ?> " required>
            </div>
            <div class="form-group">
                <label for="category">CATEGORY : </label>
                <input type="text" placeholder="ENTER PRODUCT CATEGORY" class="form-control" id="lastNamecategory"
                       name="categoryField" minlength="1" maxlength="50"
                       value=" <?php echo $getProductCategory; ?> " required>
            </div>
            <div class="form-group">
                <label for="subCategory">SUBCATEGORY : </label>
                <input type="text" class="form-control" placeholder="ENTER PRODUCT SUBCATEGORY" id="subCategory"
                       name="subCategoryField" maxlength="50"
                       value=" <?php echo $getProductSubCategory; ?> " >
            </div>
            <div class="form-group">
                <label for="description">DESCRIPTION : </label>
                <textarea class="form-control" rows="10" id="description"
                          name="descriptionField" maxlength="255" required>
                    <?php echo $getProductDescription; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="price">PRICE : </label>
                <input type="text" placeholder="ENTER PRODUCT PRICE" class="form-control" id="price"
                       name="priceField" minlength="1" maxlength="10"
                       value=" <?php echo $getProductPrice; ?> " required>
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="updateButton">
                <span class="glyphicon glyphicon-pencil"></span> &nbsp; UPDATE
            </button>
            <button type="reset" class="btn btn-danger btn-lg" name="resetButton">
                <span class="glyphicon glyphicon-refresh"></span> &nbsp; RESET
            </button>
            <button type="submit" class="btn btn-primary btn-lg" name="deleteButton">
                <span class="glyphicon glyphicon-remove-sign"></span> &nbsp; DELETE
            </button>
        </form>
    </div>

    </body>

    </html>

<?php

//echo $getProductName."<br>".$getProductCategory."<br>".$getProductSubCategory."<br>"
//.$getProductDescription."<br>".$getProductPrice."<br>";
    /*
    $getImage = $_FILES["imageField"]["name"];
    $getProductName = $_POST["nameField"];
    $getProductCategory = $_POST["categoryField"];
    $getProductSubCategory = $_POST["subCategoryField"];
    $getProductDescription = $_POST["descriptionField"];
    $getProductPrice = $_POST["priceField"];
    */
    if (isset($_POST["deleteButton"]))
    {
        $my_sqli_query =
            "DELETE FROM saleproductoffers
         WHERE offerNumber='" . $getOfferNumberSent . "';
        ";
        $result = $mysqli_database_connection->query($my_sqli_query);
        echo '<script type="text/javascript">
                            window.location = "viewOwnPosts.php"
                          </script>';
    }
    elseif (isset($_POST["updateButton"]))
    {
        if ($_FILES['imageField']['name']!=NULL)
        {
            //name
            $data = $_FILES['imageField']['name'];
            //tmp name
            $dataTemp = $_FILES['imageField']['tmp_name'];
            //file size
            $dataSize = $_FILES['imageField']['size'];
            //echo "<br>" . $fileName . "<br>" . $fileTemporaryDirectory . "<br>" . $fileSize . "<br>";
            //upload directory
            $dataUploadDirectory = 'uploadedImages/';
            //current file extension
            $dataExtension = strtolower(pathinfo($data, PATHINFO_EXTENSION)); // get image extension
            //valid file (image) extensions
            $validExtensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            //rename uploaded image
            $dataRename = rand(1000, 1000000) . "." . $dataExtension;
            //echo "<br>" . "passed : $fileRename" . "<br>";
            //if current extension is any of valid extension in array
            if (in_array($dataExtension, $validExtensions))
            {
                //file size < 5MB
                if ($dataSize < 5000000)
                {
                    move_uploaded_file($dataTemp, $dataUploadDirectory . $dataRename);
                    //echo "<br>" . "done" . "<br>";
                    //write and save query in a variable:
                    $result = $mysqli_database_connection->query
                    (
                        "UPDATE saleproductoffers
                        SET productImage= '$dataRename'
                        WHERE offerNumber='$getOfferNumberSent';
                        "
                    );
                }
            }
        }
        if ($_POST["nameField"]!=NULL)
        {
            $data = $_POST["nameField"];
            $result = $mysqli_database_connection->query
            (
                "UPDATE saleproductoffers
                SET productName= '$data'
                WHERE offerNumber='$getOfferNumberSent';
                "
            );
        }
        if (($_POST["categoryField"]!=NULL))
        {
            $data = $_POST["categoryField"];
            $result = $mysqli_database_connection->query
            (
                    "UPDATE saleproductoffers
                    SET productCategory= '$data'
                    WHERE offerNumber='$getOfferNumberSent';
                    "
            );
        }
        if ($_POST["subCategoryField"]!=NULL)
        {
            $data = $_POST["subCategoryField"];
            $result = $mysqli_database_connection->query
            (
                "UPDATE saleproductoffers
                     SET productSubCategory= '$data'
                     WHERE offerNumber='$getOfferNumberSent';
                    "
            );
        }

        if ($_POST["descriptionField"] != NULL)
        {
            $data = $_POST["descriptionField"];
            $result = $mysqli_database_connection->query
            (
                "UPDATE saleproductoffers
                     SET productDescription= '$data'
                     WHERE offerNumber='$getOfferNumberSent';
                    "
            );
        }

        if ($_POST["priceField"] != NULL)
        {
            $data = $_POST["priceField"];
            //echo  "$data";
            $result = $mysqli_database_connection->query(
                "UPDATE saleproductoffers
                     SET productPrice= '$data'
                     WHERE offerNumber='$getOfferNumberSent';
             "
            );
        }
        echo '<script type="text/javascript">
                            window.location = "viewOwnPosts.php"
                          </script>';
    }
}

?>