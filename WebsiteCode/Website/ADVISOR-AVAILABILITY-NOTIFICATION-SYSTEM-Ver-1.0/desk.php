
<?php
//calls the sqliConnect to be used here
require_once 'sqliConnect.php';
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

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- beginning of the Menu -->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <a class="navbar-brand" href="">Front Desk</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                   
                    <ul class="dropdown-menu message-dropdown">


                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i><?php echo $name; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                       
                       
                        <li class="divider"></li>
                        <li>
                            <a href='logout.php'><i class="fa fa-fw fa-power-off"></i> Log Out</a>
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
                      <a>Waiting for Accept: Waiting for advisor to accept the notification<br/></a>
                    </nav>

                    <div id="page-wrapper">
                        <!-- End of menu -->


                        </head>
                        <body>
                        <br/>
                        <br/>
                        <br/>
                        <style>
                            .deskTitle {
                                color: black;
                            }
                        </style>

                          <h1 class="deskTitle">Welcome to the Front Desk</h1>

                        <!--SOUNd FILE loaded into the page to be played later--->
                        <audio id="sound" src="nice-cut.mp3" preload="auto"></audio> 

                        <?php
                        if (isset($_SESSION["access_level"]) && $_SESSION["access_level"] == 2) {

                            if (!$con) {
                                die('Could not connect: ' . mysqli_error($con));
                            }
                            //set desk to logged in
                            mysqli_select_db($con, "login_details");
                            $sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
                            $result = mysqli_query($con, $sql);
                            if (!$result) {
                                printf("Error: %s\n", mysqli_error($con));
                                exit();
                            }

                        } else {
                            header("Location:index.php?err=2");
                        }
                        ?>

                        <?php
                        //displays the table for walk_ins a
//                        echo ' <br/><br/>If you dont see an  advisor in the drop down menu (refresh the page)';

                        include 'walk_inHandle.php';
                        //displays the table for appointments

                        include 'apointment_handle.php';
                        ?>



                        <script>
                            //refresh the show advisors function
                            myVar = setInterval(showUsers, 1000);

                            //function to call the fetchTable.php page
                            function showUsers() {

                                if (window.XMLHttpRequest) {
                                    // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp = new XMLHttpRequest();
                                } else {
                                    // code for IE6, IE5
                                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                xmlhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("txtHint").innerHTML = this.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "fetchTable.php?", true);
                                xmlhttp.send();

                            }

                        </script>


                        <script>
                            //loadXMLdoc and loadXMldoc2 are both used to determine if a table gets updated and makes a sound.
                            vars = setTimeout(loadXMLDoc, 100);
                            //function used to load the initial time stamp of the table  
                            function loadXMLDoc() {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {

                                        $v = this.responseText;

                                    }
                                };
                                xhttp.open("GET", "queryDB.php", true);
                                xhttp.send();
                            }


                            //repeat the time stamp request to determin if the database updated


                            myVar = setInterval(loadXMLDoc2, 3000);


                            //function used to keep checking if the table has changed.   
                            function loadXMLDoc2() {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {

                                        $f = this.responseText;
                                        if ($f != $v)
                                        {
                                            $v = $f;
                                            document.getElementById('sound').play();
                                        }
                                    }
                                };
                                xhttp.open("GET", "queryDB.php", true);
                                xhttp.send();
                            }



                        </script>

                        <script>
                            // used ot count the initial numberr of walk in students
                            vars = setTimeout(walkinRowCount, 100);
                            //function used to load the initial time stamp of the table  
                            function walkinRowCount() {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {

                                        $g = this.responseText;

                                    }
                                };
                                xhttp.open("GET", "rowCountWalk-in.php", true);
                                xhttp.send();
                            }


                            //repeat the time stamp request to determin if the database updated


                            myVar = setInterval(walkinRowCount2, 3000);


                            //function used to keep checking if the table has changed.   
                            function walkinRowCount2() {
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {

                                        $x = this.responseText;
                                        if ($x != $g)
                                        {
                                            $g = $x;

                                            location.reload(true);
                                        }
                                    }
                                };
                                xhttp.open("GET", "RowCountWalk-in.php", true);
                                xhttp.send();
                            }



                        </script>



                        <br>
                        <!--Display the table here    -->
                        
                        <h2>Status Table for Logged-in Advisors</h2>
                       
                        <div   id="txtHint"><b>Status Will be displayed here.</b></div>

                        </body>
                        </html>






