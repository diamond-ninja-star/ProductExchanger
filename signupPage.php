<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIGN UP</title>
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
<br>
<div class="container">
    <h2 align="center">FILL IN THE FORM BELOW TO GET INSTANT ACCESS</h2>
</div>
<div class="container" style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; color: white ">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userName">USERNAME : </label>
            <input type="text" placeholder="Enter username" class="form-control" id="userName"
                   name="userNameField" minlength="1" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="firstName">FIRST NAME : </label>
            <input type="text" placeholder="Enter first name" class="form-control" id="firstName"
                   name="firstNameField" minlength="1" maxlength="25" required>
        </div>
        <div class="form-group">
            <label for="lastName">LAST NAME : </label>
            <input type="text" placeholder="Enter last name" class="form-control" id="lastName"
                   name="lastNameField" minlength="1" maxlength="25" required>
        </div>
        <div class="form-group">
            <label for="phoneNumber">PHONE NUMBER : (WITHOUT '+' SIGN) </label>
            <input type="text" placeholder="Enter phone number" class="form-control" id="phoneNumber"
                   name="phoneNumberField" minlength="1" maxlength="15" required>
        </div>
        <div class="form-group">
            <label for="email">EMAIL ADDRESS : </label>
            <input type="email" placeholder="Enter email address" class="form-control" id="email"
                   name="emailField" maxlength="100">
        </div>
        <div class="form-group">
            <label for="password">PASSWORD : </label>
            <input type="password" placeholder="Enter password" class="form-control" id="password"
                   name="passwordField" minlength="1" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="repeatPassword">REPEAT PASSWORD : </label>
            <input type="password" placeholder="Repeat password" class="form-control" id="repeatPassword"
                   name="repeatPasswordField" minlength="1" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="place">PLACE (WITHOUT DIVISION) : </label>
            <input type="text" placeholder="Enter place/area (without division)" class="form-control" id="place"
                   name="placeField" minlength="1" maxlength="25" required>
        </div>
        <div class="form-group">
            <label for="division">DIVISION : </label>
            <input type="text" placeholder="Enter division" class="form-control" id="division"
                   name="divisionField" minlength="1" maxlength="25" required>
        </div>
        <div class="form-group">
            <label for="profilePicture">PROFILE PICTURE : </label>
            <input type="file" class="form-control" id="profilePicture" name="profilePictureField" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success btn-lg" name="signUpButton">
            <span class="glyphicon glyphicon-saved"></span> &nbsp; SIGN UP
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
    }
    //connection established
    else
    {
        if (isset($_POST["signUpButton"]))
        {
            if (
                isset($_POST["userNameField"]) && isset($_POST["firstNameField"]) &&
                isset($_POST["lastNameField"]) && isset($_POST["phoneNumberField"]) &&
                isset($_POST["passwordField"]) && isset($_POST["repeatPasswordField"]) &&
                isset($_POST["placeField"]) && isset($_POST["divisionField"])
            )
            {
                $getUserName = $_POST["userNameField"];
                $getFirstName = $_POST["firstNameField"];
                $getLastName = $_POST["lastNameField"];
                $getPhoneNumber = $_POST["phoneNumberField"];
                $getEmail = $_POST["emailField"];
                $getPassword = $_POST["passwordField"];
                $getRepeatPassword = $_POST["repeatPasswordField"];
                $getPlace = $_POST["placeField"];
                $getDivision = $_POST["divisionField"];
                $getProfilePicture = $_FILES["profilePictureField"]["name"];
                $emailFlag = 1;

                //echo "<br>" . $getUserName . "<br>";
                //echo "<br>" . $getFirstName . "<br>";
                //echo "<br>" . $getLastName . "<br>";
                //echo "<br>" . $getPhoneNumber . "<br>";
                //echo "<br>" . $getEmail . "<br>";
                //echo "<br>" . $getPassword . "<br>";
                //echo "<br>" . $getRepeatPassword . "<br>";
                //echo "<br>" . $getPlace . "<br>";
                //echo "<br>" . $getDivision . "<br>";
                //echo "<br>" . $getProfilePicture . "<br>";

                //email
                if ($getEmail != NULL)
                {
                    //query
                    $duplicate_email_query = "SELECT userinfo.email
                                         FROM userinfo
                                         WHERE email='" . $getEmail . "'";
                    //fetch query result
                    $display_full_result_email = $mysqli_database_connection->query($duplicate_email_query);
                    //if column exists , its duplicate .
                    if ($display_full_result_email->num_rows > 0)
                    {
                        echo "<div class=\"alert alert-danger alert-dismissible\">
                                 <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>ERROR : </strong> DUPLICATE EMAIL EXISTS
                              </div>";
                        $emailFlag = 0;
                    }
                }
                //check if password is same both times
                //don't match
                if ($getPassword !== $getRepeatPassword)
                {
                    echo "<div class=\"alert alert-danger alert-dismissible\">
                             <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>ERROR : </strong> PASSWORD DIDN'T MATCH
                          </div>";
                }
                //no duplicate entry
                else
                {
                    //username
                    if ($getUserName != NULL)
                    {
                        //query
                        $duplicate_username_query = "SELECT userinfo.username
                                             FROM userinfo
                                             WHERE userName='" . $getUserName . "' ";
                        //fetch query result
                        $display_full_result_username = $mysqli_database_connection->query($duplicate_username_query);
                        //if column exists , its duplicate .
                        if ($display_full_result_username->num_rows > 0)
                        {
                            echo "<div class=\"alert alert-danger alert-dismissible\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>ERROR : </strong> DUPLICATE USERNAME EXISTS
                                  </div>";
                        }
                        else
                        {
                            //phone number
                            if ($getPhoneNumber != NULL)
                            {
                                //query
                                $duplicate_phone_number_query = "SELECT userinfo.phoneNumber
                                                 FROM userinfo
                                                 WHERE phoneNumber='" . $getPhoneNumber . "' ";
                                //fetch query result
                                $display_full_result_phone_number = $mysqli_database_connection->query($duplicate_phone_number_query);
                                //if column exists , its duplicate .
                                if ($display_full_result_phone_number->num_rows > 0)
                                {
                                    echo "<div class=\"alert alert-danger alert-dismissible\">
                                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                            <strong>ERROR : </strong> DUPLICATE PHONE NUMBER EXISTS
                                          </div>";
                                }
                                else
                                {
                                    //email - if no duplicate
                                    if ($emailFlag == 1)
                                    {
                                        //profile picture exists
                                        if ($getProfilePicture != NULL)
                                        {
                                            //file name
                                            $fileName = $_FILES['profilePictureField']['name'];
                                            //temporary directory
                                            $fileTemporaryDirectory = $_FILES['profilePictureField']['tmp_name'];
                                            //file size
                                            $fileSize = $_FILES['profilePictureField']['size'];
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
                                                    $my_mysqli_query = "INSERT INTO userInfo (userNumber, userName, passcode,
                                                          firstName, lastName, phoneNumber,
                                                           email, placeWithoutDivision, division,
                                                           profilePicture)
                                  VALUES (NULL, '" . $getUserName . "', '" . $getPassword . "',
                                                  '" . $getFirstName . "', '" . $getLastName . "', '" . $getPhoneNumber . "',
                                                   '" . $getEmail . "', '" . $getPlace . "', '" . $getDivision . "',
                                                    '" . $fileRename . "')";

                                                    //check if query is valid:
                                                    //valid query
                                                    if ($mysqli_database_connection->query($my_mysqli_query))
                                                    {
                                                        //echo "QUERY : " . $my_mysqli_query . "<br>";
                                                        //echo "QUERY VALID" . "<br>";
                                                        //echo "INSERT OPERATION SUCCESSFUL" . "<br>";
                                                    }
                                                    //invalid query
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
                                                //error : file size >= 5MB
                                                else
                                                {
                                                    //$errorMessage = "SORRY, YOUR FILE IS GREATER THAN 5MB.";
                                                    //echo "<br>" . $errorMessage . "<br>";
                                                    echo "<div class=\"alert alert-danger alert-dismissible\">
                                                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                <strong>ERROR : </strong> SORRY, YOUR FILE IS GREATER THAN 5MB.
                                                          </div>";
                                                }
                                            }
                                            // error : extension invalid
                                            else
                                            {
                                                //$errorMessage = "SORRY, ONLY JPG, JPEG, PNG & GIF FILES ARE ALLOWED.";
                                                //echo "<br>" . $errorMessage . "<br>";
                                                echo "<div class=\"alert alert-danger alert-dismissible\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                                                <strong>ERROR : </strong> SORRY, ONLY JPG, JPEG, PNG & GIF FILES ARE ALLOWED.
                                                      </div>";
                                            }
                                        }
                                        //no profile picture
                                        else
                                        {
                                            //write and save query in a variable:
                                            $my_mysqli_query =
                                            "
                                            INSERT INTO userInfo (userNumber, userName, passcode,
                                                          firstName, lastName, phoneNumber,
                                                           email, placeWithoutDivision, division,
                                                           profilePicture)
                                             VALUES (
                                             NULL,
                                             '" . $getUserName . "',
                                             '" . $getPassword . "',
                                                  '" . $getFirstName . "',
                                                  '" . $getLastName . "',
                                                  '" . $getPhoneNumber . "',
                                                   '" . $getEmail . "',
                                                   '" . $getPlace . "',
                                                   '" . $getDivision . "',
                                                   '')
                                            ";
                                            
                                            $result = $mysqli_database_connection->query($my_mysqli_query);
                                            
                                            //save it to session

                                            $_SESSION['loggedInUsername']=$getUserName;
                                            
                                            //debug 
                                            
                                            //print_r($_SESSION);
                                            //print_r($_GET);
                                            //print_r($_POST);
                                            //header("Location: sellOfferAll.php");
                                            //echo redirect("./sellOfferAll.php");
                                            
                                            //goto next page - javascript

                                            echo '<script type="text/javascript">
                                                    window.location = "sellOfferAll.php"
                                                  </script>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
</div>
</body>
</html>