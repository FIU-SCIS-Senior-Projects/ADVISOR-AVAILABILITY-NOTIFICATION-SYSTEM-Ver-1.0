<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>FIU Advisor</title>

        <!--CSS STYLE SHEETS COURTESY OF BOOTSTRAP-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/signin.css" rel="stylesheet">

    </head>	
    <body background = "Images/Eng.jpg">

        <?php
        session_start();
        include 'lib/password.php';

        if (isset($_POST['submit'])) {
            //connect to the db
            include 'sqliConnect.php';
            $con = get_sqli();
            mysqli_select_db($con, "login");

            $name = $_POST['name'];
            $pwd = $_POST['pwd'];




            //if a name and password were inputted do the followin
            if ($name != '' && $pwd != '') {
                //check to see if the name and pasword match the database with lvl 0 clearance
                $sql = "select password from login_details where id='" . $name . "' and level = 0";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $hashedpPw = $row['password'];


                //if yes proceed to the advisor page 
                if (password_verify($pwd, $hashedpPw)) {


//update session values
                    $_SESSION['id'] = "$name";
                    $_SESSION['access_level'] = 0;
                    header("Location:advisor.php");

                    //check to see if the name and pasword match the database with lvl 1 clearance
                } else {

                    $sql = "select password from login_details where id='" . $name . "' and level = 1";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $hashedpPw = $row['password'];


                    //if yes proceed to the advisor page 
                    if (password_verify($pwd, $hashedpPw)) {
//update session values
                        $_SESSION['id'] = "$name";
                        $_SESSION['access_level'] = 1;
                        header("Location:admin.php");
                    }
                    //check to see if the name and pasword match the database with lvl 2 clearance
                    else {
                        $sql = "select password from login_details where id='" . $name . "' and level = 2";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $hashedpPw = $row['password'];


                        //if yes proceed to the advisor page 
                        if (password_verify($pwd, $hashedpPw)) {

                            $_SESSION['id'] = "$name";
                            $_SESSION['access_level'] = 2;
                            header("Location:desk.php");
                        } else {
                            $sql = "select password from login_details where id='" . $name . "' and level = 3";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);
                            $hashedpPw = $row['password'];
                            if (password_verify($pwd, $hashedpPw)) {

                                $_SESSION['id'] = "$name";
                                $_SESSION['access_level'] = 3;
                                header("Location:display.php");
                            } else {
                                $sql = "select password from login_details where id='" . $name . "' and level = 4";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_array($result);
                                $hashedpPw = $row['password'];
                                if (password_verify($pwd, $hashedpPw)) {

                                    $_SESSION['id'] = "$name";
                                    $_SESSION['access_level'] = 4;
                                    header("Location:StudentSignIn.php");
                                } else {


                                    echo'<center>You entered an incorrect username or password</center>';
                                }
                            }
                        }
                    }
                }
            } else {
                echo'Enter username and password';
            }
        }
        print <<<_HTML_
	 <div class = "container">
          
                    <form class = "form-signin" method="POST" action="{$_SERVER['PHP_SELF']}">
                   <center> <h1 class="form-signin-heading">Welcome to the FIU Advisor Availability System!</h1></center>
                        </br>
                        </br>
                        </br>
                        <label for='username' class="sr-only">User Name</label>
                        <input type='text' class="form-control" name='name' size= "32"
                            placeholder="User Name" required="autofocus"/>

                        <br>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" class = "form-control" name="pwd" size= "32" 		
                               placeholder = "Password" required>

                        <input type='submit' name='submit' value='Submit'class="btn btn-lg btn-primary btn-block"/>
                        <br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        
                        <div>
                            <b><h4>Please note that passwords are <b>case-sensitive!<h4></b>
			<br>
   
                        </div>
                        

                    </form>  
                    </div>
                       
                        
	
_HTML_;
        ?>
    </body>
</html>