<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Meetings</title>
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
        .column {
            float: left;
            width: 33.33%;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<h1>Admin Meetings</h1>
<br>
<nav>
    <a href="./admin.php">Home</a> |
    <a href="./accountDetails.php">Account</a> |
    <a href="./meetings.php">Meetings</a> |
    <a href="../index.php">Logout</a>
</nav>

<br><br>
<div class="row">
    <div class="column">
        <form action="" method="post">
            <label for="id">Meeting Id: </label>
            <input type="text" id="id" name="id">
            <br><br>
            <label for="name">Meeting Name: </label>
            <input type="text" id="name" name="name">
            <br><br>
            <label for="date">Meeting Date(yyyy-mm-dd): </label>
            <input type="text" id="date" name="date">
            <br><br>
            <label for="timeSlotId">Time Slot ID: </label>
            <input type="text" id="timeSlotId" name="timeSlotId">
            <br><br>
            <label for="capacity">Capacity: </label>
            <input type="text" id="capacity" name="capacity">
            <br><br>
            <label for="groupId">Group ID: </label>
            <input type="text" id="groupId" name="groupId">
            <br><br>
            <label for="announcement">Announcement: </label>
            <input type="text" id="announcement" name="announcement">
            <br><br>
            <input type="submit" name="create" value="Create">
        </form>
    </div>
    <div class="column">
        <form action="" method="post">
            <label for="id">Meeting Id: </label>
            <input type="text" id="id" name="id">
            <br><br>
            <label for="name">Meeting Name: </label>
            <input type="text" id="name" name="name">
            <br><br>
            <label for="date">Meeting Date(yyyy-mm-dd): </label>
            <input type="text" id="date" name="date">
            <br><br>
            <label for="timeSlotId">Time Slot ID: </label>
            <input type="text" id="timeSlotId" name="timeSlotId">
            <br><br>
            <label for="capacity">Capacity: </label>
            <input type="text" id="capacity" name="capacity">
            <br><br>
            <label for="groupId">Group ID: </label>
            <input type="text" id="groupId" name="groupId">
            <br><br>
            <label for="announcement">Announcement: </label>
            <input type="text" id="announcement" name="announcement">
            <br><br>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
    <div class="column">
        <form action="" method="post">
            <label for="id">Meeting Id: </label>
            <input type="text" id="id" name="id">
            <br><br>
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</div>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['create'])) {
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

if(isset($_POST['update'])) {
    $meetingId = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $timeSlotId = $_POST['timeSlotId'];
    $capacity = $_POST['capacity'];
    $groupId = $_POST['groupId'];
    $announcement = $_POST['announcement'];

    if (empty($meetingId)) {
        echo "Meeting ID required";
    } else {
        if (empty($name) && empty($date) && empty($timeSlotId) && empty($capacity) && empty($groupId) &&
            empty($announcement)) {
            echo "<br><br>Data required in at least one field";
        } else {
            if (!empty($name)) {
                $updateQuery = 'update meetings set meeting_name = "' . $name . '" where meeting_id = ' . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
            if (!empty($date)) {
                $updateQuery = 'update meetings set date = ' . $date . ' where meeting_id = ' . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
            if (!empty($timeSlotId)) {
                $updateQuery = 'update meetings set time_slot_id = ' . $timeSlotId . ' where meeting_id = ' . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
            if (!empty($capacity)) {
                $updateQuery = 'update meetings set capacity = ' . $capacity . ' where meeting_id = ' . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
            if (!empty($groupId)) {
                $updateQuery = "update meetings set group_id = " . $groupId . " where meeting_id = " . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
            if (!empty($announcement)) {
                $updateQuery = 'update meetings set announcement = "' . $announcement . '" where meeting_id = ' . $meetingId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                } finally {
                    if ($result) {
                        echo "<br><br>Meeting updated";
                    }
                }
            }
        }
    }
}

if(isset($_POST['delete'])) {
    $meetingId = $_POST['id'];

    if (empty($meetingId)) {
        echo "<br><br>Data required";
    } else {
        $createQuery = "delete from meetings where meeting_id = " . $meetingId;
        try {
            $result = mysqli_query($dbConnection, $createQuery);
        } catch (mysqli_sql_exception $e) {
            echo $e;
        } finally {
            if ($result) {
                echo "<br><br>Meeting Deleted";
            }
        }
    }
}

?>
</body>
</html>
