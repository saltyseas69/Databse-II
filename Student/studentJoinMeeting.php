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
            $current_meeting = "SELECT meeting_name 
            FROM enroll, meetings 
            WHERE student_id = $_SESSION[sessionID] AND enroll.meeting_id = meetings.meeting_id";
            $result = $dbConnection->query($current_meeting);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> Meeting Name: ". $row["meeting_name"];
                }
            } 
            else{
                echo "0 results";
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

// $studentQuery = 'SELECT student_id
//                  FROM enroll, meetings
//                  WHERE enroll.meeting_id =  meetings.meeting_id';
//                  //GROUP BY meeting_id
//             $studentResult = mysqli_query($dbConnection, $studentQuery);

// $studentQuery1 = 'SELECT name, email
//                 FROM users, students
//                 WHERE users.id = students.'.$studentResult;
//                 $studentResult1 = mysqli_query($dbConnection, $studentQuery1);
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
                // while($row = mysqli_fetch_assoc($studentResult1)){
                //     $studentName = $row['name'];
                //     $studentEmail = $row['email'];

                //     echo"Student Name: $studentName<br>";
                // }

            }else{
                echo "0 results";
            }
            if(isset($_POST['join'])) {
                $meetingID = $_POST['joinmeet'];
                $studentID = $_SESSION['sessionID'];
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
                                redirect('studentJoinMeeting.php');
                            }
                        }
                    }
                }
            }


            // if(isset($_POST['delete'])) {
            //     $meeting_id = $_POST['deletemeet'];
            //     $student_id = $_SESSION['sessionID'];
            //     if(empty($meeting_id)){
            //         echo "Please enter meeting ID";
            //     }
            //     else if($meeting_id = $meetingID){
            //         $deleteQuery = 'delete from enroll values (' . 
            //             $meeting_id . ', '. $student_id. ')';
            //             echo "Meeting has been successfully deleted.";
            //             redirect('studentJoinMeeting.php');
            //     }
            //     else {
            //         echo "No meetings added"; 
            //     }
            // }
            if(isset($_POST['delete'])) {
                $meetingID = $_POST['deletemeet'];
                $studentID = $_SESSION['sessionID'];
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
                        $deleteQuery = 'delete from enroll values (' .
                            $meetingID . ', '. $studentID .')';
                        try {
                            $result = mysqli_query($dbConnection, $deleteQuery);
                        } catch (mysqli_sql_exception $e) {
                            echo $e;
                        } finally {
                            if ($result) {
                                echo "<br><br>Student Deleted to meeting";
                                redirect('studentJoinMeeting.php');
                            }
                        }
                    }
                }
            }

?>
</body>
</html>