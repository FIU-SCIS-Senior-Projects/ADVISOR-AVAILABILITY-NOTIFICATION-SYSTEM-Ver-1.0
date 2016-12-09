<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//library used for pasword_hashing compatibility on php 5.3.7 and greater
require 'lib/password.php';

session_start();

$level = $_SESSION["access_level"];
$name = $_SESSION['id'];
require 'sqliConnect.php';
$con = get_sqli();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">


        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <title>Admin Page</title>
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/style.css">	

        <!-- beginning of the Menu -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <a class="navbar-brand" href="admin.php">FIU Advisor Administrator</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                 <!--   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>-->
                    <ul class="dropdown-menu message-dropdown">


                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i><?php echo $name; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                     <!--   <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i>Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>-->
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    </nav>

                    <div id="page-wrapper">
                        <!-- End of menu -->
                        </head>

                        <body>
                            <h1> <br>Advisor Availability System<br/></h1>
                            <?php



                            if (isset($_SESSION["access_level"]) && $_SESSION["access_level"] == 1) {




                                if (isset($_POST['formSubmit'])) {
                                    $name = $_POST['name'];

                                    $pwd = $_POST['pwd'];
                                    $firstname = $_POST['FirstName'];
                                    $lastname = $_POST['LastName'];
                                    $clearance = $_POST['clearance'];
                                    if ($name != '') {



                                        $varSelection = $_POST['formStatus'];
                                        $errorMessage = "";

                                        if (empty($varSelection)) {
                                            $errorMessage = "<li>You forgot to select add or remove!</li>";
                                        }

                                        if ($errorMessage != "") {
                                            echo("<p>There was an error with your Selection:</p>\n");
                                            echo("<ul>" . $errorMessage . "</ul>\n");
                                            exit();
                                        } else {
                                            // note that both methods can't be demonstrated at the same time
                                            // comment out the method you don't want to demonstrate
                                            // method 1: switch
                                            $redir = "admin.php";
                                            switch ($varSelection) {
                                                case "Remove": removeUser($name);
                                                    break;
                                                case "Add": addUser($name, $pwd, $firstname, $lastname, $clearance);
                                                    break;
                                                case "changePw": changePw($name, $pwd);
                                                    break;
                                                default: echo("Error!");
                                                    exit();
                                                    break;
                                            }
                                            echo " redirecting to: $redir ";

                                            header("Location: $redir");
                                            // end method 1



                                            exit();
                                        }
                                    }
                                }
                                //database connection class
//upade the database to show that the user is logged in.
                                $sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
                                $result = mysqli_query($con, $sql);
//$row = mysqli_fetch_array($result);




                                echo "<br>Hello $name, this is your admin page<br/><a href='logout.php'>Logout</a>";


                                //Display  registerd advisers
                                require 'fetchAdminTable.php';
                                /////////////////////////////////


                                echo "<br>Enter the Details of the account you want to manipulate.";
                                echo"<br>To remove only the ID counts but you still have to enter something on the other fields.";
                                echo"<br>To change password enter Id and the new password in the password field.";
                            } else {
                                header("Location:index.php?err=2");
                            }
                            ?>

                            <?php

//sets the status to the parameter given
                            function addUser($name, $pwd, $firstname, $lastname, $clearance) {
                                //require 'lib/password.php';
                               // session_start();
                                //hash the password for security reasons
                                $pw = password_hash($pwd, PASSWORD_DEFAULT);
                                $nm = $name;
                                $fn = $firstname;
                                $ln = $lastname;
                                $clnce = $clearance;
                                //connect to the database
                                if ($fn != '' && $ln != '' && $pwd != '') {
                                  //  require ("sqliConnect.php");
                                    $con2 = get_sqli();

                                    if (!$con2) {
                                        die('Could not connect: ' . mysqli_error($con2));
                                    }
                                    mysqli_select_db($con2, "login");
                                    $sql = "INSERT INTO login_details (id, FirstName,Lastname, password, level, logged, Status) VALUES ('" . $nm . "','$firstname','$lastname','" . $pw . "','.$clnce.','0','')";
                                    $result = mysqli_query($con2, $sql);

                                    $row = mysqli_fetch_array($result);
                                }
                            }

                            function removeUser($name) {
                                $adminId = $_SESSION['id'];
                                if ($adminId != $name) {
                                    session_start();
                                    $nm = $name;

                               //     require ("sqliConnect.php");
                                    $con2 = get_sqli();

                                    if (!$con2) {
                                        die('Could not connect: ' . mysqli_error($con2));
                                    }
//remove an adviser

                                    mysqli_select_db($con2, "login");
                                    $sql = "DELETE FROM login_details WHERE id='" . $nm . "'  ";
                                    $result = mysqli_query($con2, $sql);

                                    $row = mysqli_fetch_array($result);
                                }
                            }

                            function changePw($name, $pwd) {
                                // require 'lib/password.php';
                                session_start();

                                $nm = $name;
                                //add hash for pw
                                $pw = password_hash($pwd, PASSWORD_DEFAULT);

                             //   require ("sqliConnect.php");
                                $con2 = get_sqli();

                                if (!$con2) {
                                    die('Could not connect: ' . mysqli_error($con2));
                                }

//update pw
                                mysqli_select_db($con2, "login");
                                $sql = "UPDATE `login_details` SET `password` = '$pw' WHERE `login_details`.`id` = '$nm';  ";
                                $result = mysqli_query($con2, $sql);
                            }
                            ?>
                            <div class="form">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                                    <div class="top-row">
                                        <div class="field-wrap">
                                            <label>
                                                First Name<span class="req">*</span>
                                            </label>
                                            <input type="text" name="FirstName" required autocomplete="off" />
                                        </div>

                                        <div class="field-wrap">
                                            <label>
                                                Last Name<span class="req">*</span>
                                            </label>
                                            <input type="text" name="LastName" required autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="field-wrap">
                                        <label>
                                            User ID<span class="req">*</span>
                                        </label>
                                        <input type="text" name="name" required autocomplete="off"/>
                                    </div>

                                    <div class="field-wrap">
                                        <label>
                                            Set A Password<span class="req">*</span>
                                        </label>
                                        <input type="password" name='pwd' required autocomplete="off"/>

                                    </div>

                                    <div class="field-wrap">
                                        <label>
                                            User Type<span class="req"></span>
                                        </label>

                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="field-wrap">


                                        <span class="custom-dropdown custom-dropdown--white">
                                            <select class="custom-dropdown__select custom-dropdown__select--white" name="clearance">
                                                <option value="0">Advisor</option> 
                                                <option value="1">Administrator</option>
                                                <option value="2">Front Desk</option>                                 
                                            </select>
                                        </span>

                                    </div>
     
                                    <div class="field-wrap">
                                        <label for='formStatus'>Add, Remove or Change Password to the Account:</label>

                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="field-wrap">

                                        <br>
                                        <span class="custom-dropdown custom-dropdown--white">
                                            <select class="custom-dropdown__select custom-dropdown__select--white" name="formStatus">
                                                <option value="">Select an Option</option>
                                                <option value="Remove">Remove</option>
                                                <option value="Add">Add</option>
                                                <option value="changePw">Change PW</option>
                                            </select> 
                                        </span>


                                    </div>
                                    <input type="submit" name="formSubmit" value="Submit" class="button button-block" />
                                </form>
                            </div>

                            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

                            <script src="js/index.js"></script>
                            <!-- jQuery -->
                            <script src="js/jquery.js"></script>

                            <!-- Bootstrap Core JavaScript -->
                            <script src="js/bootstrap.min.js"></script>

                            <!-- Morris Charts JavaScript -->
                            <script src="js/plugins/morris/raphael.min.js"></script>
                            <script src="js/plugins/morris/morris.min.js"></script>
                            <script src="js/plugins/morris/morris-data.js"></script>



                        </body>
                        </html>
