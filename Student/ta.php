<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Assistant Page</title>
</head>
<body>
<h1>Student Teacher Assistant Page</h1>

<nav>
    <a href="./studentMeetingViewer.php">Home</a> |
    <a href="./studentAccount.php">Account</a> |
    <a href="./selectGrade.php">Select Grade</a> |
    <a href="./studentJoinMeeting.php">Join</a> |
    <a href="./ta.php">Teacher Assistant</a> |
    <a href="../index.php">Logout</a>
</nav>

<br><br>
<h3>Create Material  |  Update Material  |  Delete Material</h3>
<br>
<section>
    <form action="" method="post">
        <label for="materialID">Material ID: </label>
        <input type="text" id="materialID" name="materialID">
        <br><br>
        <label for="meetingID">Meeting ID: </label>
        <input type="text" id="meetingID" name="meetingID">
        <br><br>
        <label for="title">Title: </label>
        <input type="text" id="title" name="title">
        <br><br>
        <label for="author">Author: </label>
        <input type="text" id="author" name="author">
        <br><br>
        <label for="type">Type: </label>
        <input type="text" id="type" name="type">
        <br><br>
        <label for="url">URL: </label>
        <input type="text" id="url" name="url">
        <br><br>
        <label for="notes">Notes: </label>
        <input type="text" id="notes" name="notes">
        <br><br>
        <label for="date">Assigned Date(yyyy-mm-dd): </label>
        <input type="text" id="date" name="date">
        <br><br>
        <input type="submit" name="create" value="Create">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
    </form>
</section>

<p><br><br><br></p>
<h3>Assigned Meetings</h3>
<p>--------------------------------------------<br></p>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

function verifyAssignmentAsTA($dbConnection) {
    $verificationQuery = 'select count(*) as verifyCount 
from assigned_assistants 
where student_id = ' . $_SESSION['sessionID'];

    try {
        $verificationResult = mysqli_query($dbConnection, $verificationQuery);
    } catch (mysqli_sql_exception $e) {
        echo $e;
        die();
    }

    return mysqli_fetch_assoc($verificationResult)['verifyCount'] > 0;
}

$query = 'select * from assigned_assistants where student_id = ' . $_SESSION['sessionID'];
$result = mysqli_query($dbConnection, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $meetingId = $row['meeting_id'];

        $meetingQuery = 'select * from meetings where meeting_id = ' . $meetingId;
        $meetingResult = mysqli_query($dbConnection, $meetingQuery);

        if (mysqli_num_rows($meetingResult) > 0) {

            while($row = mysqli_fetch_assoc($meetingResult)) {
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
    }
} else {
    echo "<br>Not assigned as a TA<br>";
}

if(isset($_POST['create'])) {
    $createMaterialId = $_POST['materialID'];
    $createMeetingId = $_POST['meetingID'];
    $createTitle = $_POST['title'];
    $createAuthor = $_POST['author'];
    $createType = $_POST['type'];
    $createUrl = $_POST['url'];
    $createNotes = $_POST['notes'];
    $createAssignedDate = $_POST['date'];

    if (verifyAssignmentAsTA($dbConnection)) {
        if (empty($createMaterialId) || empty($createMeetingId) || empty($createTitle) || empty($createAuthor) ||
            empty($createType) || empty($createUrl) || empty($createNotes) || empty($createAssignedDate)) {
            echo "<br><br>Data required in all fields";
        } else {
            $createQuery = 'insert into material values (' .
                $createMaterialId . ', ' .
                $createMeetingId . ', ' .
                '"' . $createTitle . '", ' .
                '"' . $createAuthor . '", ' .
                '"' . $createType . '", ' .
                '"' . $createUrl . '", ' .
                '"' . $createNotes . '", ' .
                'DATE "' . $createAssignedDate . '")';
            try {
                $result = mysqli_query($dbConnection, $createQuery);
            } catch (mysqli_sql_exception $e) {
                echo $e;
            }
        }
    } else {
        echo "Not assigned as TA.";
    }

}

if(isset($_POST['update'])) {
    $udpateMaterialId = $_POST['materialID'];
    $updateMeetingId = $_POST['meetingID'];
    $updateTitle = $_POST['title'];
    $updateAuthor = $_POST['author'];
    $updateType = $_POST['type'];
    $updateUrl = $_POST['url'];
    $updateNotes = $_POST['notes'];
    $updateAssignedDate = $_POST['date'];

    if (verifyAssignmentAsTA($dbConnection)) {
        if (empty($udpateMaterialId)) {
            echo "<br><br>Material ID required for updates";
        } else {
            if (empty($updateMeetingId) && empty($updateTitle) && empty($updateAuthor) && empty($updateType) && empty($updateUrl) &&
                empty($updateNotes) && empty($updateAssignedDate)) {
                echo "<br><br>Data required in at least one field";
            } else {
                if (!empty($updateMeetingId)) {
                    $updateQuery = 'update material set meeting_id = ' . $updateMeetingId . ' where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateTitle)) {
                    $updateQuery = 'update material set title = "' . $updateTitle . '" where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateAuthor)) {
                    $updateQuery = 'update material set author = "' . $updateAuthor . '" where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateType)) {
                    $updateQuery = 'update material set type = "' . $updateType . '" where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateUrl)) {
                    $updateQuery = 'update material set url = "' . $updateUrl . '" where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateNotes)) {
                    $updateQuery = 'update material set notes = "' . $updateNotes . '" where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
                if (!empty($updateAssignedDate)) {
                    $updateQuery = 'update material 
                                set assigned_date = DATE "' . $updateAssignedDate . '"
                                where material_id = ' . $udpateMaterialId;
                    try {
                        $result = mysqli_query($dbConnection, $updateQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo $e;
                    }
                }
            }
        }
    } else {
        echo 'Not assigned as TA';
    }
}

if(isset($_POST['delete'])) {
    $deleteMaterialId = $_POST['materialID'];

    if (verifyAssignmentAsTA($dbConnection)) {
        if (empty($deleteMaterialId)) {
            echo "<br><br>Material ID required";
        } else {
            $deleteQuery = "delete from material where material_id = " . $deleteMaterialId;
            try {
                $result = mysqli_query($dbConnection, $deleteQuery);
            } catch (mysqli_sql_exception $e) {
                echo $e;
            }
        }
    } else {
        echo "Not assigned as TA";
    }
}
?>

</body>
</html>
