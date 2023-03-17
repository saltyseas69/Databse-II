<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <style>
        h1 {
            text-align: center;
        }
        nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Admin Page</h1>

<br><br>
<nav>
    <a href="/Databse-II/Admin/account.php">Account</a> |
    <a href="/Databse-II/Admin/meetings.php">Meetings</a>
</nav>

<br><br>
<section>
    <h3>Current Meetings</h3>
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

            echo "Meeting ID: $meetingId" . str_repeat('&nbsp;', 10) .
                "Meeting Name: $meetingName" . str_repeat('&nbsp;', 10) .
                "Date: $date" . str_repeat('&nbsp;', 10) .
                "Time Slot: $timeSlot" . str_repeat('&nbsp;', 10) .
                "Capacity: $capacity" . str_repeat('&nbsp;', 10) .
                "GroupID: $groupId" . str_repeat('&nbsp;', 10) .
                "Announcement: $announcement <br><br>";

        }
    } else {
        echo "<br>No meetings currently made<br>";
    }
    ?>
</section>

</body>
</html>