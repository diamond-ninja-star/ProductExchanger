<?php
//you must start session at the first line of coding page after php tag
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIGN IN</title>
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
<div class="container">
    <h2 align="center">SIGN IN TO OUR SITE</h2>
</div>
<br>
<!-- LOGIN -->
<div class="container" style="margin: 0 auto 0 auto ; text-align: center ; background-color: #1b6d85 ; ">
    <br>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userId">USERNAME : </label>
            <input type="text" placeholder="Enter username" class="form-control" id="userId" name="userInfoLoginField"
                   required>
        </div>
        <div class="form-group">
            <label for="pwd">PASSWORD : </label>
            <input type="password" placeholder="Enter password" class="form-control" id="pwd" name="passwordLoginField"
                   required>
        </div>

        <button type="submit" class="btn btn-success btn-lg" name="signinSIButton">SIGN IN</button>

        <button type="reset" class="btn btn-danger btn-lg" name="resetSIButton">RESET</button>
    </form>
    <br>
</div>
<br>
<div class="container">
    <h3 align="center">DON'T HAVE AN ACCOUNT ? CLICK <a href="signupPage.php" style="color: yellow ; ">HERE</a href="signupPage.php"> TO SIGN
        UP</h3>
</div>
<br>

<div class="container">
    <?php
    //session_start();
    //$flag=0;
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

        //check if input fields are empty
        //non-empty
        if (isset($_POST["signinSIButton"]))
        {
            $getUserInfo = $_POST["userInfoLoginField"];
            $getPassword = $_POST["passwordLoginField"];


            //$getHashedPassword = password_hash($getPassword);

            //write and save query result in a variable:
            $my_mysqli_query = " SELECT userName 
                                 FROM userinfo 
                                 WHERE userinfo.userName='" . $getUserInfo . "' 
                                 AND userinfo.passcode='" . $getPassword . "' ";
            //check if query is valid:
            //valid query
            if ($mysqli_database_connection->query($my_mysqli_query))
            {
                //echo "Query : ".$my_mysqli_query."<br>";
                //echo "Query valid"."<br>";

                //fetch query result
                $display_full_result = $mysqli_database_connection->query($my_mysqli_query);
                //check if result is null :
                //not null - row>0 - login successful
                if ($display_full_result->num_rows > 0)
                {
                    //$_SESSION['name']=$getUserInfo;
                    //$_SESSION['fg']=1;
                    //header("Location: sellOfferAll.php");
                    $user = $_POST['userInfoLoginField'];

                    $_SESSION['loggedInUsername']=$user;

                    //print_r($_SESSION);
                    //print_r($_GET);
                    //print_r($_POST);
                    //header("Location: sellOfferAll.php");
                    //echo redirect("./sellOfferAll.php");
                    //echo redirect("./FlatsInfo.php");

                    echo '<script type="text/javascript">
                            window.location = "sellOfferAll.php"
                          </script>';
                    /*
                    $dynamic_location="sellOfferAll.php?userNameSent=".$getUserInfo;
                    echo '<script type="text/javascript">
                            window.location = "'.$dynamic_location.'"
                          </script>';
                    */

                    //echo "LOGIN SUCCESSFUL" . "<br>";
                }
                //null - row = 0 - login failed
                else
                {
                    //echo "LOGIN FAILED" . "<br>";
                    echo "<div class=\"alert alert-danger alert-dismissible\">
                                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                   LOGIN FAILED   
                              </div>";
                }
            } //invalid query
            else
            {
                //echo "Query : ".$my_mysqli_query."<br>";
                //echo "Query invalid"."<br>";
                //echo "Error : ".$mysqli_database_connection->error."<br>";
            }
        }
        //empty
        else
        {
            //echo "input field empty"."<br>";
        }
    }
    ?>
</div>

</body>

</html>