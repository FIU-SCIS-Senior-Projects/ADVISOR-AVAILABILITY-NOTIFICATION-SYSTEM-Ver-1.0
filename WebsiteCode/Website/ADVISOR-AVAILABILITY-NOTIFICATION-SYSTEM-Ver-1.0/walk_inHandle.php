
<html>
    <head>

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <?php
        //This page handles the walk in queue
        //include 'sqliConnect.php';
// connect to the database udinh sqli
        $con = get_sqli();
// get results from database

        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }
//select whole list of students from walk_in
        mysqli_select_db($con, "login");
        $sql = "SELECT * FROM walk_in";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
        mysqli_close($con);
//Table to dispaly qeueu of students
        print '<div class="row">'
                . '<div class="col-lg-12">
                        <h2>Walk-in Queue</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Advisor Student wants to see</th>
                                        <th>P ID</th>
                                        <th>Select Advisor to notify on send</th>
                                        <th>Send Student</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                </div>';





//create a table of students by displaying all the data from result and adding a button
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Advisor'] . "</td>";
            echo "<td>" . $row['pid'] . "</td>";
            // echo '<form action="delete.php?id2=' . $row['id'] . '" method="post">';
            // drop down menu for selecting advisor as a form submission
            // used to name each submit button with the id from walk_in
            $formId = $row['id'];

            echo "<td>";
            //create a form to submit the sleected advisor and the selected student to be removed from the queue
            echo '<form action="delete.php?id=' . $row['id'] . '" method="post">';

            //another query used to retreive the list of advisors  to pupulate the drop down menu
            //create a drop down menu with advisors resulting from the queue
            echo '<select name="formStatus">';

            $con = get_sqli();
            mysqli_select_db($con, "login");
            $sql = "SELECT * FROM login_details WHERE level = 0 AND logged = 1";
            $result2 = mysqli_query($con, $sql);

            if (!$result2) {
                printf("Error: %s\n", mysqli_error($con));
                exit();
            }


            //loops through all advisors for drop down menu creation
            while ($row2 = mysqli_fetch_array($result2)) {
                $id = $row2['id'];
                echo '<option value="' . $id . '">' . $id . '</option>';
            }
            echo'<option selected="selected"></option>';

            echo '</select>';

            echo '<td><input class="btn btn-sm btn-primary btn-block" type="submit" name="formSubmit" value= "Send" /><td>';
            echo '</form>';
//echo '<td><input type="submit" name="formSubmit" value=  /><td>';
//echo '<td><a href="delete.php?id=' . $row['id'] . '&advisor='. "lol" .'">Send</a></td>';
            echo '<a href="deleteRow.php?id=' . $row['id'] . '&table=walk_in">Delete</a>';
            echo "</tr>";
        }
// close table>
        echo "</table>";
        echo "</div>"
        ?>
        <!--link to add a new walk_in student-->
       <p><a href="new.php">Add a new Walk In</a></p>
    </body>