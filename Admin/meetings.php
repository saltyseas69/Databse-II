<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Meetings</title>
</head>
<body>
<h1>Admin Meetings</h1>
<br>
<nav>
    <a href="./admin.php">Home</a> |
    <a href="./accountDetails.php">Account</a> |
    <a href="./meetings.php">Meetings</a> |
    <a href="./materials.php">Materials</a> |
    <a href="./ta.php">Teaching Assistant</a> |
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
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</div>

<br><br>
<div>
    <p>------------------------------------------------</p>
    <h3>Assign Student to Meeting</h3>
    <b>Enter Meeting ID and Student ID</b>

    <form action="" method="post">
        <label for="meetingID">Meeting ID: </label>
        <input type="text" id="meetingID" name="meetingID">
        <br><br>
        <label for="studentID">Student ID: </label>
        <input type="text" id="studentID" name="studentID">
        <br><br>
        <input type="submit" name="add" value="Add"/>
    </form>
</div>

<br><br>
<div>
    <p>------------------------------------------------</p>
    <h3>Verify Meetings</h3>
    <p>Meetings must meet attendance quota by Friday.  If attendance quota is not met, meetings are cancelled and notification
    sheet will be created.</p>

    <form action="" method="post">
        <label for="date">Current Date(yyyy-mm-dd): </label>
        <input type="text" id="verificationDate" name="verificationDate">
        <br><br>
        <input type="submit" name="verify" value="Verify">
    </form>
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

if(isset($_POST['verify'])) {
    $verificationDate = date_create($_POST['verificationDate']);

    $weekendDate = date_add($verificationDate, date_interval_create_from_date_string("2 days"));

    // Query DB for all meetings
    $verifyQuery = "select * from meetings";
    $verifyResult = mysqli_query($dbConnection, $verifyQuery);

    if (mysqli_num_rows($verifyResult) > 0) {
        while ($verifyRow = mysqli_fetch_assoc($verifyResult)) {
            $meetingDate = date_create($verifyRow['date']);

            // Check if meeting is within verification window, if so verify attendance
            if ($meetingDate < $weekendDate) {
                $verifyMeetingId = $verifyRow['meeting_id'];
                //Query enroll with meetingId to determine # of students in attendance
                $enrollQuery = "select count(*) as attendance from enroll where meeting_id = " . $verifyMeetingId;
                $enrollResult = mysqli_query($dbConnection, $enrollQuery);

                // Determine if attendance is < 3, if so remove meeting and create notification file
                $enrollRow = mysqli_fetch_assoc($enrollResult);
                if ($enrollRow['attendance'] < 3) {
                    // Grab userIds from Meeting
                    $userIdQuery = "select student_id from enroll where meeting_id = " . $verifyMeetingId;
                    $userIdResult = mysqli_query($dbConnection, $userIdQuery);
                    if (mysqli_num_rows($userIdResult) > 0) {
                        while ($userIdRow = mysqli_fetch_assoc($userIdResult)) {
                            $userId = $userIdRow['student_id'];

                            // Query Users for Name / email, concat to notification file
                            $notificationListQuery = "select * from users where id = " . $userId;
                            $notificationListResult = mysqli_query($dbConnection, $notificationListQuery);

                            if (mysqli_num_rows($notificationListResult) > 0) {
                                $notificationRow = mysqli_fetch_assoc($notificationListResult);
                                $fileName = "../Notifications/" . $verificationDate->format('y-m-d') . "_NotifyList.txt";

                                $myfile = fopen($fileName, "w");
                                $toNotify = "Name: " . $notificationRow['name'] . "    Email: " . $notificationRow['email'];
                                fwrite($myfile, $toNotify);
                                fclose($myfile);
                            } else {
                                echo "Unexpected error: student does not exist in users table";
                            }
                        }
                    } else {
                        echo "Unexpected error: No students ids associated with enrolled tuple.";
                    }
                }
                // Remove meeting
                $deleteQuery = "delete from enroll where meeting_id  = " . $verifyRow['meeting_id'];
                try {
                    $result = mysqli_query($dbConnection, $deleteQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
                $deleteQuery = "delete from meetings where meeting_id  = " . $verifyRow['meeting_id'];
                try {
                    $result = mysqli_query($dbConnection, $deleteQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
                echo "<br>Removed Meeting, affected Enroll and Meeting tables.<br>";
            }
        }
    } else {
        echo "No meetings within DB.";
    }
}

if(isset($_POST['add'])) {
    $meetingID = $_POST['meetingID'];
    $studentID = $_POST['studentID'];
    if (empty($meetingID)) {
        echo "<br><br>Input valid Meeting ID";
    } else {

        // Query meeting desired for its associate group
        $validateGradeQuery = 'select * from meetings where meeting_id = ' . $meetingID;
        try {
            $validationResults = mysqli_query($dbConnection, $validateGradeQuery);
        } catch (mysqli_sql_exception $e) {
            echo $e;
            die();
        }
        $meetingCheckForValidation = mysqli_fetch_assoc($validationResults);
        $groupIDToCheckForValidation =  $meetingCheckForValidation['group_id'];

        // Query associated group for its grade requirement
        $groupIDValidationQuery = 'select grade_req from groups where group_id = ' . $groupIDToCheckForValidation;
        try {
            $groupIDValidationResult = mysqli_query($dbConnection, $groupIDValidationQuery);
        } catch (mysqli_sql_exception $e) {
            echo $e;
            die();
        }

        $gradeReqRow = mysqli_fetch_assoc($groupIDValidationResult);
        $gradeReq = $gradeReqRow['grade_req'];

        // Query student for their grade
        $studentGradeQuery = 'select grade from students where student_id = ' . $studentID;
        try {
            $studentGradeResult = mysqli_query($dbConnection, $studentGradeQuery);
        } catch (Exception $e) {
            echo $e;
            die();
        }

        $studentGradeRow = mysqli_fetch_assoc($studentGradeResult);
        $studentGrade = $studentGradeRow['grade'];

        // Verify student can be added to meeting
        if ($gradeReq > $studentGrade) {
            echo "Student does not meet grade requirement";
        } else {
            $addQuery = 'insert into enroll values (' .
                $meetingID . ', '. $studentID .')';
            try {
                $result = mysqli_query($dbConnection, $addQuery);
            } catch (mysqli_sql_exception $e) {
                echo $e;
            } finally {
                if ($result) {
                    echo "<br><br>Student Added to meeting";
                }
            }
        }
    }
}

?>
</body>
</html>
