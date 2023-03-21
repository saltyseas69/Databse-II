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

<br>
<nav>
    <a href="./admin.php">Home</a> |
    <a href="./accountDetails.php">Account</a> |
    <a href="./meetings.php">Meetings</a> |
    <a href="../index.php">Logout</a>
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
</section>

</body>
</html>