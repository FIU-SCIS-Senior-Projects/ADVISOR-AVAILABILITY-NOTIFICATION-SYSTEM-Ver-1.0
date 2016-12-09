<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//database connection class
            require 'sqliConnect.php';
            session_start();
            $name = $_SESSION['id'];
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

        <title>Advisor Status Change Page</title>
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/style.css">	

        <!-- beginning of the Menu -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                
                <a class="navbar-brand" href="index.html">FIU Advisor</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                   <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>-->
                    <ul class="dropdown-menu message-dropdown">

                        
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $name; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                      <!--      <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
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
                
               <div class="nav navbar-nav side-nav">
                    <label>Statuses</label>
                        <br/>
                        <br/>
                        <br/>
                        
                        <a>Busy: With Student <br/></a>  
                      <a>RFA: Ready For Next Appointment<br/> </a>  
                      <a>RFW: Ready For Next Walk-in<br/> </a>  
                      <a>UA: Unavailable <br/></a>  
                      <a>OO: Out of Office <br/></a>  
                     
                    </nav>
                    

                    <div id="page-wrapper">
                        <!-- End of menu -->
    </head>

    <body>

        <div class="col-lg-12">
            <h1 class="page-header"> <br>Advisor Availability System<br/></h1>
            <ol class="breadcrumb">

            </ol>
        </div>
        <audio id="sound" src="nice-cut.mp3" preload="auto"></audio>

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-info-circle"></i>  <strong>Advisor Notification System 1.0</strong> <!--Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!-->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            </div>
            <?php
        if (isset($_POST['formSubmit'])) {
            $varCountry = $_POST['formStatus'];
            $errorMessage = "";

            if (empty($varCountry)) {
                $errorMessage = "<li>You forgot to select a Status!</li>";
            }

            if ($errorMessage != "") {
                echo("<p>There was an error with your Selection:</p>\n");
                echo("<ul>" . $errorMessage . "</ul>\n");
            } else {
                // note that both methods can't be demonstrated at the same time
                // comment out the method you don't want to demonstrate
                // method 1: switch
                $redir = "advisor.php";
                switch ($varCountry) {
                    case "RFA": setStatus('RFA');
                        break;
                    case "RFW": setStatus('RFW');
                        break;
                    case "OO": setStatus('OO');
                        break;
                    case "UA": setStatus('UA');
                        break;
                    case "Busy": setStatus('Busy');
                        break;
                    default: echo("Error!");
                        exit();
                        break;
                }
             //  echo " redirecting to: $redir ";
                    //refresh page to display change
             echo ' <meta http-equiv="refresh" content="0" > ';
                // end method 1
                // method 2: dynamic redirect
                //header("Location: " . $varCountry . ".html");
                // end method 2

                exit();
            }
        }
        ?>
        

            
            
               <?php
        
        if (isset($_SESSION["access_level"]) && $_SESSION["access_level"] == 0) {


//upade the database to show that the user is logged in.
            $sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
            $result = mysqli_query($con, $sql);




            // display a message and logout link
            echo " <center><br>Hello $name, this is your status page.<br/><a href='logout.php'>Logout</a>";
            //displays a change pw link 
            echo "<br/><a href='changeAdvisorPw.php'>Change Password</a>";
            echo '<br/><font color ="red">Remember to Change your Status when you finish with a student:</center></font.';

            //display status of advisor
           
            include 'advisorTable.php';
            
        } else {
            header("Location:index.php?err=2");
        }
        ?>

            
            

        </div>
        
    <center>  <div class="container-fluid">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                <label for='formStatus'></label>
                <select name="formStatus">
                    <option value="">Select a Status</option>
                    <option value="Busy">Busy:With Student</option>
                    <option value="RFA">RFA:Ready For App.</option>
                    <option value="RFW">RFW:Ready For Walk-In</option>
                    <option value="OO">OO:Out of Office</option>
                    <option value="UA">UA:Unavailable</option>

                </select> 
                <br>
                <br>
<!--                <center><input type="submit" name="formSubmit" value="Submit" /></center>-->
                <input class="btn btn-sm btn-primary btn-block" type="submit" name="formSubmit" value= "Submit" />

                <br/><center><font color ="red" size ="12">Remember to Logout Before Closing the Browser</font></center>

            </form>
        </div>
    </center>

        <?php

//sets the status to the parameter given
        function setStatus($status) {
         //session_start();
          //  require("sqliConnect.php");

            $con = get_sqli();
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
            If($status!='Busy')
            {
                 mysqli_select_db($con, "login_details");
            $name = $_SESSION['id'];
            $st = $status;
            $sql = "UPDATE  login_details SET student_name= 'No One', student_id = '0' WHERE id='$name'";
            $result = mysqli_query($con, $sql);
                
            }

            mysqli_select_db($con, "login_details");
            $name = $_SESSION['id'];
            $st = $status;
            $sql = "UPDATE  login_details SET Status= '$st' WHERE id='$name'";
            $result = mysqli_query($con, $sql);

                    

            //if the status is ready, force the table to update to signal front desk of a log in   
            If ($status == "RFA" || $status == "RFW") {
                $con = get_sqli();
                if (!$con) {
                    die('Could not connect: ' . mysqli_error($con));
                }

                mysqli_select_db($con, "msgs");
                $sql = "UPDATE  msgs SET msg= 'change' WHERE id='1'";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($con));
                    exit();
                }

                $con = get_sqli();
                if (!$con) {
                    die('Could not connect: ' . mysqli_error($con));
                }

                mysqli_select_db($con, "msgs");
                $sql = "UPDATE  msgs SET msg= '$st' WHERE id='1'";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    printf("Error: %s\n", mysqli_error($con));
                    exit();
                }
            }
             
        }
        ?>



        <script>

            myVar = setInterval(loadXMLDoc2, 5000);

     
       

 //function used to keep checking if the table has changed. 
 //if student logged is 1 then a function is called to set it to 0
function loadXMLDoc2() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $f = this.responseText;
      if ($f!=0)
      {
          setToZero();
         fetchStudntNme ();
         document.getElementById('sound').play(); 
         
        
      }
    }
  };
  xhttp.open("GET", "checkStudent.php", true);
  xhttp.send();
  

}
//set student sent to 0 in database to prevent the alert ot be called on loop
function setToZero()
{
     var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $f = this.responseText;
      if ($f!=0)
      {
          setToZero();
         fetchStudntNme ();
         document.getElementById('sound').play(); 
         
        
      }
    }
  };
  xhttp.open("GET", "setSendStudento0.php", true);
  xhttp.send();
  
    
}

//fietch the student being sent and display an alert
function fetchStudntNme ()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      name = this.responseText;
        alert(  name + " is on the way." );
        setToBusy();
     
    }
  };
  xhttp.open("GET", "getStudentName.php", true);
  xhttp.send();
}
//set the status of the advisor to busy
function setToBusy()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
    {
        //reload the page to display the new status
     location.reload(true);
     
        
    }
  };
  xhttp.open("GET", "setToBusy.php", true);
  xhttp.send();
}



        </script>
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
