<!-- This page is used to fetch the whole table on logged in users-->
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

        $q = ( $_GET['q'] );
//$q ="SELECT id, status FROM login_details";
        $con = get_sqli();

        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con, "login");
        $sql = $q;
        $result = mysqli_query($con, $sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
        }
         print '<div class="row">'
                . '<div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>   
                                    </tr>
                                </thead>
                                </div>';

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($con);
        ?>
    </body>
</html>

