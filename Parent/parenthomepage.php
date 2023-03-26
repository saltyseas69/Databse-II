<!DOCTYPE HTML>
<html>
    <head>
        <title>Parent Homepage</title>
    </head>

    <body>
        <h1>Avengers Parents Initiative</h1>

        <nav>
            <a href="./parenthomepage.php">Home</a> |
            <a href="./parentAccount.php">Account</a> |
            <a href="../index.php">Logout</a>
        </nav>
        
        <h4>Child Info</h4>
        
        <?php
            session_start();
            $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
            if (!$dbConnection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            //select the child of the parent that logged in
            $childof = "SELECT student_id FROM child_of WHERE parent_id = " . $_SESSION['sessionID'];
            //the variable defined in the last line is used to access the db
            $childof_result = $dbConnection->query($childof);
            //now fetch all the data while the rows are not empty
                while($row = $childof_result->fetch_assoc()){
                    $child_name = $row["student_id"];
                    echo "<br> Child ID: ". $row["student_id"];
                }
            
            //select the child name using the result of previous query
            $studentname = "SELECT * FROM users WHERE id = " . $child_name;
            $sname_result = $dbConnection->query($studentname);
                while($row = $sname_result->fetch_assoc()){
                    echo "<br> Child Name: ". $row["name"]. "<br>";
                }
        ?>

        <h3>Current Meetings</h3>
        
        <?php
            $current_meeting = "SELECT meeting_name\n" 
            . "FROM enroll, meetings\n" 
            . "WHERE student_id = ' $child_name . 'AND enroll.meeting_id = meetings.meeting_id";
            $result = $dbConnection->query($current_meeting);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> Meeting Name: ". $row["meeting_name"];
                }
            } 
            else{
                echo "0 results";
            }
        ?>

        <h3>Add Child to Meetings</h3>
        <b>Type in corresponding Meeting ID to add student to meeting</b>
        
        <form action="" method="post">
            <label for="meetingid">Meeting ID: </label>
            <input type="text" id="meetingid" name="meetingid">
            <input type="submit" name="add" value="Add"/>
        </form>

        <?php
        function redirect($url) {
            header('Location: '.$url);
        }
            $query = 'select * from meetings';
            $result = mysqli_query($dbConnection, $query);
        
            if (mysqli_num_rows($result) > 0) {
        
                while($row = mysqli_fetch_assoc($result)) {
                    $meetingID = $row['meeting_id'];
                    $meetingName = $row['meeting_name'];
                    $date = $row['date'];
                    $timeSlot = $row['time_slot_id'];
                    $capacity = $row['capacity'];
                    $groupId = $row['group_id'];
                    $announcement = $row['announcement'];
        
                    echo"Meeting ID : $meetingID<br>" .
                        "Meeting Name: $meetingName<br>" .
                        "Date: $date<br>" .
                        "Time Slot: $timeSlot<br>" .
                        "Capacity: $capacity<br>" .
                        "GroupID: $groupId<br>" .
                        "Announcement: $announcement <br>---------------------------------------------------------<br>";
                }
            }else{
                echo "0 results";
            }

            if(isset($_POST['add'])) {
                $meetingID = $_POST['meetingid'];
                if (empty($meetingID)) {
                    echo "<br><br>Input correct Meeting ID";
                } else {
                    $createQuery = 'insert into enroll values (' .
                        $meetingID . ', '. $child_name .')';
                        echo "<br><br>Student Added to meeting";
                    try {
                        $result = mysqli_query($dbConnection, $createQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    } finally {
                        if ($result) {
                            redirect("parenthomepage.php");
                        }
                    }
                }
            }
        ?>
    </body>
</html>