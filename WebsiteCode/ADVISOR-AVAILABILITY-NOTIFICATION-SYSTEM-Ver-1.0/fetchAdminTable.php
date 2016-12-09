<!-- This page is used to fethc alist of all registered users-->
<!DOCTYPE html>
<html>
    <head>  
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php
        require_once ('sqliConnect.php');

        $con = get_sqli();
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }
//selects all uses
//SELECT * FROM `login_details` ORDER BY `login_details`.`lastupdate` ASC 
        mysqli_select_db($con, "login");
        $sql = "SELECT id, status,FirstName,LastName,password,level,lastupdate FROM login_details ORDER BY `login_details`.`lastupdate` DESC";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
            print '<div class="row">'
                . '<div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>LastUpdate</th>
                                    </tr>
                                </thead>
                                </div>';

//        echo '<div class="scroll-table3">';
//        echo "<table>
//<tr>
//<th>ID</th>
//<th>First Name</th>
//<th>Last Name</th>
//<th>Status</th>
//<th>Level</th>
//<th>LastUpdate</th>
//</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "<td>" . $row['lastupdate'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
        mysqli_close($con);
        ?>
    </body>
</html>