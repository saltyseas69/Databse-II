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
    <a href="./studentMeetingViewer.php">Home</a> |
    <a href="./studentAccount.php">Account</a> |
    <a href="./selectGrade.php">Select Grade</a> |
    <a href="./studentJoinMeeting.php">Meeting Dashboard</a> |
    <a href="./ta.php">Teacher Assistant</a> |
    <a href="../index.php">Logout</a>
</nav>

<h3>Current Meetings</h3>
        
        <?php
        session_start();
        $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
        if (!$dbConnection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $currentMeetingsQuery = 'select * from enroll where student_id = ' . $_SESSION['sessionID'];
        $currentMeetingsResult = $dbConnection->query($currentMeetingsQuery);

        if($currentMeetingsResult->num_rows > 0) {
            while ($row = $currentMeetingsResult->fetch_assoc()) {
                $currentMeetingID = $row['meeting_id'];

                $meetingDataQuery = 'select * from meetings where meeting_id = ' . $currentMeetingID;
                $meetingDataResult = $dbConnection->query($meetingDataQuery);

                if ($meetingDataResult->num_rows > 0) {
                    while ($dataRow = $meetingDataResult->fetch_assoc()) {
                        $meetingName = $dataRow['meeting_name'];
                        $meetingID = $dataRow['meeting_id'];
                        $date = $dataRow['date'];
                        $time = $dataRow['time_slot_id'];
                        $capacity = $dataRow['capacity'];
                        $groupID = $dataRow['group_id'];
                        $announcement = $dataRow['announcement'];


                        echo
                            "<h4>--------Meeting Details----------</h4>" .
                            "Meeting Name : $meetingName<br>".
                            "Meeting ID : $meetingID<br>" .
                            "Date: $date<br>" .
                            "Time: $time<br>" .
                            "Capacity: $capacity<br>" .
                            "Group ID: $groupID<br>" .
                            "Announcement: $announcement<br>";

                        $enrolledStudentsQuery = 'select * 
                                                from users 
                                                where id in (
                                                    select student_id
                                                    from enroll
                                                    where meeting_id = ' . $currentMeetingID . '
                                                )';
                        try {
                            $enrolledStudentsResult = $dbConnection->query($enrolledStudentsQuery);
                        } catch (Exception $e) {
                            echo $e;
                        }

                        if ($enrolledStudentsResult->num_rows > 0) {
                            echo "<h4>Enrolled Students</h4>";
                            while ($enrolledRow = $enrolledStudentsResult->fetch_assoc()) {
                                echo "Name: " . $enrolledRow['name'];
                                echo "<br>Email: " . $enrolledRow['email'] . '<br><br>';
                            }
                        } else {
                            echo "No other students enrolled";
                        }

                    }
                } else {
                    echo "Unexpected error: Meeting from enroll table does not exist";
                }
            }
        } else {
            echo "Not enrolled in any meetings";
        }
        ?>

<h2>Join Meeting:</h2>
<h3>Input Corresponding Meeting ID</h3>

<section>
    <br><br>
    <form action="" method="post">
        <label for="group">Select Meeting to Join: </label>
        <form action="" method="post">
        <input type="text" id="joinmeet" name="joinmeet">
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
        <input type="text" id="deletemeet" name="deletemeet">
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <br><br>
    </form>
</section>

<?php
        function redirect($url) {
            header('Location: '.$url);
        }

                $query = 'select * from meetings';
                $result = mysqli_query($dbConnection, $query);
            
            
            if (mysqli_num_rows($result) > 0) {
        
                while($row = mysqli_fetch_assoc($result)) {
                    $meetingName = $row['meeting_name'];
                    $meetingID = $row['meeting_id'];
                    $date = $row['date'];
                    $time = $row['time_slot_id'];
                    $capacity = $row['capacity'];
                    $groupID = $row['group_id'];
                    $announcement = $row['announcement'];

        
                    echo"Meeting Name : $meetingName<br>".
                        "Meeting ID : $meetingID<br>" .
                        "Date: $date<br>" .
                        "Time: $time<br>" .
                        "Capacity: $capacity<br>" .
                        "Group ID: $groupID<br>" .
                        "Announcement: $announcement<br>" . 

                        "<br>---------------------------------------------------------<br>";
                }

            }else{
                echo "0 results";
            }
            if(isset($_POST['join'])) {
                $meetingID = $_POST['joinmeet'];
                $studentID = $_SESSION['sessionID'];
                if (empty($meetingID)) {
                    echo "<br><br>Input valid Meeting ID";
                } else {
                    // Query meeting to determine current capacity
                    $capacityQuery = 'select count(*) as currentCapacity 
                                    from enroll 
                                    where meeting_id = ' . $meetingID;
                    $capacityResult = $dbConnection->query($capacityQuery);

                    $capacityRow = $capacityResult->fetch_assoc();
                    if ($capacityRow['currentCapacity'] > 5) {
                        echo "Meeting is at capacity, cannot join";
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
                                    redirect('studentJoinMeeting.php');
                                }
                            }
                        }
                    }
                }
            }
            if(isset($_POST['delete'])) {
                $meetingID = $_POST['deletemeet'];
                $studentID = $_SESSION['sessionID'];
                if (empty($meetingID)) {
                    echo "<br><br>Input valid Meeting ID";
                } else {
                    $deleteQuery = 'delete from enroll 
                                where student_id = ' . $studentID .' and meeting_id = ' . $meetingID;
                    echo $deleteQuery;
                    try {
                        $result = mysqli_query($dbConnection, $deleteQuery);
                    } catch (mysqli_sql_exception $e) {
                        echo "Student was never enrolled in meeting";
                    }
                }
            }

?>
</body>
</html>
