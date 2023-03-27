<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TA Page</title>
</head>
<body>
<h1>Teaching Assistant Home Page</h1>
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
<div>
    <h3>Assign / Remove TA</h3>
    <p>------------------------------------------------<br></p>
    <form action="" method="post">
        <label for="studentID">Student ID: </label>
        <input type="text" id="studentID" name="studentID">
        <br><br>
        <label for="meetingID">Meeting ID: </label>
        <input type="text" id="meetingID" name="meetingID">
        <br><br>
        <input type="submit" name="assign" value="Assign">
        <input type="submit" name="remove" value="Remove">
    </form>
    <p><br><br>---------------------------------------------------------<br><br><br></p>

    <h3>Current Assigned TA's</h3>
    <p>------------------------------------------------<br></p>
<?php
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$currentTAQuery = 'select * from assigned_assistants';
$currentTAResult = mysqli_query($dbConnection, $currentTAQuery);

if (mysqli_num_rows($currentTAResult) > 0) {
    while ($row = mysqli_fetch_assoc($currentTAResult)) {
        $student_id = $row['student_id'];
        $meeting_id = $row['meeting_id'];

        echo "Student ID: $student_id" .
            "<br>Meeting ID: $meeting_id" .
            "<br>-------------------------------------------<br>";
    }
} else {
    echo "No current TA's assigned.";
}

if (isset($_POST['assign'])) {
    $studentID = $_POST['studentID'];
    $meetingID = $_POST['meetingID'];

    if (empty($studentID) || empty($meetingID)) {
        echo "All data fields required to be filled";
    } else {
        // Validate that the student is not enrolled in the class, or a TA already
        $studentValidationQuery = 'select count(*) as studentCount from enroll 
                                where student_id = ' . $studentID . ' and meeting_id = ' . $meetingID;
        echo '<br>' . $studentValidationQuery;
        $studentValidationResult = mysqli_query($dbConnection, $studentValidationQuery);
        $studentRow = mysqli_fetch_assoc($studentValidationResult);
        echo '<br>' . $studentRow['studentCount'];
        if ($studentRow['studentCount'] != 0) {
            echo '<br><br>Student is enrolled in class, unable to add.';
        } else {
            $studentValidationQuery = 'select count(*) as studentCount from assigned_assistants where student_id = ' . $studentID;
            $studentValidationResult = mysqli_query($dbConnection, $studentValidationQuery);

            $studentRow = mysqli_fetch_assoc($studentValidationResult);
            if ($studentRow['studentCount'] != 0) {
                echo '<br><br>Student is already a TA, unable to add.';
            } else {
                $assignmentQuery = 'insert into assigned_assistants values (' .
                    $studentID . ', ' .
                    $meetingID .')';
            }
            try {
                mysqli_query($dbConnection, $assignmentQuery);
            } catch (mysqli_sql_exception $e) {
                echo $e;
                die();
            }
        }
    }
}
if (isset($_POST['remove'])) {
    $studentID = $_POST['studentID'];
    $meetingID = $_POST['meetingID'];

    if (empty($studentID) && empty($meetingID)) {
        echo "At least one data field required";
    } else {
        if (!empty($studentID) || (!empty($studentID) && !empty($meetingID))) {
            $removalQuery = 'delete from assigned_assistants where student_id = ' . $studentID;
            try {
                mysqli_query($dbConnection, $removalQuery);
            } catch (mysqli_sql_exception $e){
                echo $e;
                die();
            }
            echo '<br>Successfully removed TA.<br>';
        }
    }
}
?>

</div>

</body>
</html>
