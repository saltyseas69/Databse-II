<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Homepage</title>
</head>
<body>

<h1>Student Meeting Viewer</h1>

<nav>
    <a href="./studentMeetingViewer.php">Home</a> |
    <a href="./studentAccount.php">Account</a> |
    <a href="./selectGrade.php">Select Grade</a> |
    <a href="./studentJoinMeeting.php">Join</a> | 
    <a href="../index.php">Logout</a>
</nav>
<br>
<h2>Current Meetings with Roster</h2>
<?php
    session_start();
    $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }
            //find all current meetings this student is in
            $current_meeting = "SELECT meeting_name 
            FROM enroll, meetings 
            WHERE student_id = $_SESSION[sessionID] AND enroll.meeting_id = meetings.meeting_id";

            //find the student id of every other student in the same meetings as logged in user
            $current_roster = "SELECT student_id
            FROM enroll
            GROUP BY meeting_id";

            //use previous student ids to get user name and emails
            $other_students = "SELECT name, email
            FROM users, students
            WHERE id.users = student_id.student";


            $meet_result = $dbConnection->query($current_meeting);
            $rost_result = $dbConnection->query($current_roster);
            if ($meet_result->num_rows > 0) {
                // output data of each row
                while($row = $meet_result->fetch_assoc()) {
                    // echo "<br> Meeting Name: ". $row["meeting_name"];
                }
            } 
            else{
                echo "0 results";
            }
            echo "<br>";
            if ($rost_result->num_rows > 0){
                while($row = $rost_result->fetch_assoc()){
                    echo "<br> Roster: ". $row["student_id"];
                }
            }


?>
<section>
    <h2>All Meetings and Groups</h2>

    <?php
    $query = 'select * from meetings';
    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
            $meetingId = $row['meeting_id'];
            $meetingName = $row['meeting_name'];
            $date = $row['date'];
            $timeSlot = $row['time_slot_id'];
            $capacity = $row['capacity'];
            $groupId = $row['group_id'];
            $announcement = $row['announcement'];

            echo "Meeting ID: $meetingId<br>" .
                "Meeting Name: $meetingName<br>" .
                "Date: $date<br>" .
                "Time Slot: $timeSlot<br>" .
                "Capacity: $capacity<br>" .
                "GroupID: $groupId<br>" .
                "Announcement: $announcement <br>---------------------------------------------------------<br>";

        }
    } else {
        echo "<br>No meetings currently made<br>";
    }
    ?>

    <h3>Groups</h3>
    <br>
    <?php
    $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = 'select * from groups';
    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
            $groupId = $row['group_id'];
            $groupName = $row['name'];
            $description = $row['description'];
            $gradeReq = $row['grade_req'];

            echo "Group ID: $groupId<br>" .
                "Group Name: $groupName<br>" .
                "Description: $description<br>" .
                "Grade Requirement: $gradeReq<br>---------------------------------------------------------<br>";
        }
    } else {
        echo "<br>No meetings currently made<br>";
    }
    ?>
</section>
</body>
</html>