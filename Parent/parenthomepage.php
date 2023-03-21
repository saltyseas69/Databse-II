<!DOCTYPE HTML>
<html>
    <head>
        <title>Parent Homepage</title>
            <style>
                h1 {
                    text-align: center;
                }
                section {
                    text-align: center;
                }
                label {
                    display: inline-block;
                    width: 12%;
                    text-align: right;
                }
            </style>
    </head>

    <body>
        <h1>Avengers Parents Initiative</h1>
        <?php
            session_start();
            $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
            if (!$dbConnection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "select * from users where id = " . $_SESSION['sessionID'];
            $result = mysqli_query($dbConnection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $currID = $row['id'];
                    $currEmail = $row['email'];
                    $currPassword = $row['password'];
                    $currName = $row['name'];
                    $currPhone = $row['phone'];

                    echo "ID: $currID<br>" .
                        "Email: $currEmail<br>" .
                        "Password: $currPassword<br>" .
                        "Name: $currName<br>" .
                        "Phone: $currPhone<br>";
                }
            } else {
                echo "Unexpected Error: Cannot retrieve account information";
            }
        ?>
        
        <h4>Child Info</h4>
        
        <?php
            
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
            . "WHERE student_id = 7 AND enroll.meeting_id = meetings.meeting_id";
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
        
        <form method="post">
        <input type="submit" name="add" value="Add"/>
        </form>

        <?php
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
                $meetingId = $_POST['id'];
                $name = $_POST['name'];
                $date = $_POST['date'];
                $timeSlotId = $_POST['timeSlotId'];
                $capacity = $_POST['capacity'];
                $groupId = $_POST['groupId'];
                $announcement = $_POST['announcement'];
            
                if (empty($meetingId) || empty($name) || empty($date) || empty($timeSlotId) || empty($capacity) || empty($groupId) ||
                    empty($announcement)) {
                    echo "<br><br>Data required in all fields";
                } else {
                    $createQuery = 'insert into meetings values (' .
                        $meetingId . ', ' .
                        '"' . $name . '", ' .
                        '"' . $date . '", ' .
                        $timeSlotId . ', ' .
                        $capacity . ', ' .
                        $groupId . ', ' .
                        '"' . $announcement . '")';
                    try {
                        $result = mysqli_query($dbConnection, $createQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    } finally {
                        if ($result) {
                            echo "<br><br>Meeting created";
                        }
                    }
                }
            }
        ?>
    </body>
</html>