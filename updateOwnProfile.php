<?php
session_start();
$myUN = $_GET["unSent"];
$getUserNumber = "";
$getPasscode = "";
$getFirstName = "";
$getLastName = "";
$getPhoneNumber = "";
$getEmail = "";
$getPlaceWithoutDivision = "";
$getDivision = "";
$getProfilePicture = "";

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
        "SELECT userNumber,passcode,firstName,lastName,
          phoneNumber,email,placeWithoutDivision,division,profilePicture
         FROM userinfo
         WHERE userName = '$myUN'
         "
    );
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $getUserNumber = $row["userNumber"];
            $getPasscode = $row["passcode"];
            $getFirstName = $row["firstName"];
            $getLastName = $row["lastName"];
            $getPhoneNumber = $row["phoneNumber"];
            $getEmail = $row["email"];
            $getPlaceWithoutDivision = $row["placeWithoutDivision"];
            $getDivision = $row["division"];
            $getProfilePicture = $row["profilePicture"];
        }
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>UPDATE PROFILE</title>
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

    <div class="container">
        <h2 align="center">EDIT THE FORM BELOW TO UPDATE PROFILE</h2>
    </div>
    <div class="container"
         style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; color: white ">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstName">FIRST NAME : </label>
                <input type="text" placeholder="Enter first name" class="form-control" id="firstName"
                       name="firstNameField" minlength="1" maxlength="25"
                       value=" <?php echo $getFirstName; ?> " required>
            </div>
            <div class="form-group">
                <label for="lastName">LAST NAME : </label>
                <input type="text" placeholder="Enter last name" class="form-control" id="lastName"
                       name="lastNameField" minlength="1" maxlength="25"
                       value=" <?php echo $getLastName; ?> " required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">PHONE NUMBER : (WITHOUT '+' SIGN) </label>
                <input type="text" placeholder="Enter phone number" class="form-control" id="phoneNumber"
                       name="phoneNumberField" minlength="1" maxlength="15"
                       value=" <?php echo $getPhoneNumber; ?> " required>
            </div>
            <div class="form-group">
                <label for="email">EMAIL ADDRESS : </label>
                <input type="email" placeholder="Enter email address" class="form-control" id="email"
                       name="emailField" maxlength="100"
                       value=" <?php echo $getEmail; ?> ">
            </div>
            <div class="form-group">
                <label for="password">PASSWORD : </label>
                <input type="password" placeholder="Enter password" class="form-control" id="password"
                       name="passwordField" minlength="1" maxlength="100"
                       value=" <?php echo $getPasscode; ?> " required>
            </div>
            <div class="form-group">
                <label for="place">PLACE (WITHOUT DIVISION) : </label>
                <input type="text" placeholder="Enter place/area (without division)" class="form-control" id="place"
                       name="placeField" minlength="1" maxlength="25"
                       value=" <?php echo $getPlaceWithoutDivision; ?> " required>
            </div>
            <div class="form-group">
                <label for="division">DIVISION : </label>
                <input type="text" placeholder="Enter division" class="form-control" id="division"
                       name="divisionField" minlength="1" maxlength="25"
                       value=" <?php echo $getDivision; ?> " required>
            </div>
            <div class="form-group">
                <label for="profilePicture">PROFILE PICTURE : </label>
                <input type="file" class="form-control" id="profilePicture" name="profilePictureField" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success btn-lg" name="updateButton">
                <span class="glyphicon glyphicon-pencil"></span> &nbsp; UPDATE
            </button>
            <button type="reset" class="btn btn-danger btn-lg" name="resetButton">
                <span class="glyphicon glyphicon-refresh"></span> &nbsp; RESET
            </button>
        </form>
    </div>
    </body>
    </html>

<?php

//echo $getProductName."<br>".$getProductCategory."<br>".$getProductSubCategory."<br>"
//.$getProductDescription."<br>".$getProductPrice."<br>";
/*
$getImage = $_FILES["profilePictureField"]["name"];
$getProductName = $_POST["nameField"];
$getProductCategory = $_POST["categoryField"];
$getProductSubCategory = $_POST["subCategoryField"];
$getProductDescription = $_POST["descriptionField"];
$getProductPrice = $_POST["priceField"];
*/

if (isset($_POST["updateButton"]))
{
    if ($_POST["firstNameField"] != NULL)
    {
        //name
        $data = $_POST["firstNameField"];
        $result = $mysqli_database_connection->query
        (
            "UPDATE userinfo
                SET firstName= '$data'
                WHERE username='$myUN';
                "
        );
    }
    if ($_POST["lastNameField"] != NULL)
    {
        $data = $_POST["lastNameField"];
        $result = $mysqli_database_connection->query
        (
            "UPDATE userinfo
                SET lastName= '$data'
                WHERE username='$myUN';
                "
        );
    }
    if ($_POST["phoneNumberField"] != NULL)
    {
        $data = $_POST["phoneNumberField"];
        $result = $mysqli_database_connection->query
        (
            "UPDATE userinfo
                    SET phoneNumber= '$data'
                    WHERE username='$myUN';
                    "
        );
    }
    if ($_POST["emailField"] != NULL)
    {
        $data = $_POST["emailField"];
        $result = $mysqli_database_connection->query
        (
            "UPDATE userinfo
                     SET email= '$data'
                     WHERE username='$myUN';
                    "
        );
    }

    if ($_POST["passwordField"] != NULL)
    {
        $data = $_POST["passwordField"];
        $result = $mysqli_database_connection->query
        (
            "UPDATE userinfo
                     SET passcode= '$data'
                     WHERE username='$myUN';
                    "
        );
    }

    if ($_POST["placeField"] != NULL)
    {
        $data = $_POST["placeField"];
        //echo  "$data";
        $result = $mysqli_database_connection->query(
            "UPDATE userinfo
                     SET placeWithoutDivision= '$data'
                     WHERE username='$myUN';
             "
        );
    }

    if ($_POST["divisionField"] != NULL)
    {
        $data = $_POST["divisionField"];
        //echo  "$data";
        $result = $mysqli_database_connection->query(
            "UPDATE userinfo
                     SET division= '$data'
                     WHERE username='$myUN';
             "
        );
    }

    if ($_FILES["profilePictureField"]["name"] != NULL)
    {
        //name
        $data = $_FILES['profilePictureField']['name'];
        //tmp name
        $dataTemp = $_FILES['profilePictureField']['tmp_name'];
        //file size
        $dataSize = $_FILES['profilePictureField']['size'];
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
                    "UPDATE userinfo
                        SET profilePicture= '$dataRename'
                        WHERE userName='$myUN';
                        "
                );
            }
        }
        echo '<script type="text/javascript">
                            window.location = "viewOwnProfile.php"
                          </script>';
    }

}
?>