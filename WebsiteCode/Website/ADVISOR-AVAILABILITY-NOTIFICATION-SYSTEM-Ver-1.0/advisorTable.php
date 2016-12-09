<!-- This page is used to fetch the whole table of logged in advisors-->
<!DOCTYPE html>
<html>
    <head>  
        <style>
            table {

                width: 400px;
                border-collapse: collapse;
                text-align: left;


            }

            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }

            th {text-align: center;}
        </style>
    </head>
    <body>

        <?php
        require_once ('sqliConnect.php');
        $name = $_SESSION['id'];

        $con = get_sqli();
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }
//selects all logged in users in ascend oder
//SELECT * FROM `login_details` ORDER BY `login_details`.`lastupdate` DESC 
        mysqli_select_db($con, "login");
        $sql = "SELECT id, status,student_name,student_id FROM login_details WHERE id ='$name'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
echo "<center><table>
<tr>
<th>Adivsor UserName</th>
<th>Status</th>
<th>Attending:</th>
<th>Student ID</th>
</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['student_id'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($con);
        ?>
    </body>
</html>