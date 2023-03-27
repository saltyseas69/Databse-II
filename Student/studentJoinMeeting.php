<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Join Meeting</title>
</head>
<body>

<h1>Student Join Meetings</h1>

<nav>
    <a href="./studentAccount.php">Home</a> |
    <a href="./selectGrade.php">Select Grade</a> |
    <a href="./studentJoinMeeting.php">Join</a> | 
    <a href="./studentMeetingViewer.php">Meeting Viewer</a> |
    <a href="../index.php">Logout</a>
</nav>

<h2>Join Meeting:</h2>

<section>
    <br><br>
    <form action="" method="post">

        <label for="group">Select Meeting to Join: </label>
        <form action="" method="post">
        <input type="text" id="meeting" name="meeting">
        <br><br>
        <input type="submit" name="join" value="Join">
        <br><br>
    </form>
</section>

<section>
    <br><br>
    <form action="" method="post">

        <label for="group">Select Meeting to Delete: </label>
        <form action="" method="post">
        <input type="text" id="meeting" name="meeting">
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <br><br>
    </form>
</section>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = 'select * from meetings';
            $result = mysqli_query($dbConnection, $query);
        
            if (mysqli_num_rows($result) > 0) {
        
                while($row = mysqli_fetch_assoc($result)) {
                    $meetingID = $row['meeting_id'];
                    $date = $row['date'];
                    $time = $row['time_slot_id'];
                    $capacity = $row['capacity'];
                    $groupID = $row['group_id'];
                    $announcement = $row['announcement'];
        
                    echo"Meeting ID : $meetingID<br>" .
                        "Date: $date<br>" .
                        "Time: $time<br>" .
                        "Capacity: $capacity<br>" .
                        "Group ID: $group_id<br>" .
                        "Announcement: $announcement<br>" .
                        "<br>---------------------------------------------------------<br>";
                }
            }else{
                echo "0 results";
            }
?>
