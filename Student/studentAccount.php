<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Account</title>
</head>
<body>

<h1>Student Account Homepage</h1>

<nav>
    <a href="./studentAccount.php">Home</a> |
    <a href="./selectGrade.php">Select Grade</a> |
    <a href="./studentJoinMeeting.php">Join</a> | 
    <a href="./studentMeetingViewer.php">Meeting Viewer</a> |
    <a href="../index.php">Logout</a>
</nav>

<section>
    <h3>Meetings</h3>
    <br>
    <?php
    $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
