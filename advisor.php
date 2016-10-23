<html>
<head>
	<title>Advisor Status Change Page</title>
<!-- define some style elements-->
<style>
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
</head>

<body>
<?php
	if(isset($_POST['formSubmit'])) 
	{
		$varCountry = $_POST['formStatus'];
		$errorMessage = "";
		
		if(empty($varCountry)) 
		{
			$errorMessage = "<li>You forgot to select a Status!</li>";
		}
		
		if($errorMessage != "") 
		{
			echo("<p>There was an error with your Selection:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
		else 
		{
			// note that both methods can't be demonstrated at the same time
			// comment out the method you don't want to demonstrate

			// method 1: switch
			$redir = "advisor.php";
			switch($varCountry)
			{
				case "Ready": setStatus('Ready'); break;
				case "Busy": setStatus('Busy'); break;
				default: echo("Error!"); exit(); break;
			}
			echo " redirecting to: $redir ";
			
			 header("Location: $redir");
			// end method 1
			
			// method 2: dynamic redirect
			//header("Location: " . $varCountry . ".html");
			// end method 2

			exit();
		}
	}
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='formStatus'>Select your Status</label><br>
	<select name="formStatus">
		<option value="">Select a Status</option>
		<option value="Ready">Ready</option>
		<option value="Busy">Busy</option>
		
	</select> 
	<input type="submit" name="formSubmit" value="Submit" />


<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==0)
    
    {
//database connection class
require("db.php");
$name = $_SESSION['id'];

//upade the database to show that the user is logged in.
$db = get_db();
$sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
 $db->query($sql);

//creates  a table to display the sql query results
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Status</th><th></th></tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

//execute query to display the status of the current advisor
  $db = get_db();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT id, status FROM login_details WHERE id ='$name'" );
    $stmt->execute();


//populates the table with the results

     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	        echo $v;
    }
 
 
 
 
 // display a message and logout button
 echo " <br>Hello $name, This is your status page<br/><a href='logout.php'>Logout</a>";
 
 
 
 
 //display status of user
 
 
 
}
else{
 header("Location:index.php?err=2");
 }
?>

<?php
//sets the status to the parameter given
function setStatus( $status)
{
    session_start();
    require("sqliConnect.php");
    $con = get_sqli();
    $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
    
    mysqli_select_db($con,"login_details");
    $name = $_SESSION['id'];
    $st = $status;
    $sql = "UPDATE  login_details SET Status= '$st' WHERE id='$name'";
$result = mysqli_query($con,$sql);



  //if the status is ready, force the table to update to signal ronst desk of a log in   
 If ($status=="Ready")
 {
 $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"msgs");
$sql="UPDATE  msgs SET msg= 'change' WHERE id='1'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

$con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"msgs");
$sql="UPDATE  msgs SET msg= 'Ready' WHERE id='1'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}



 }
    
}


?>
</form>

</body>
</html>
