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
    <a href="./studentJoinMeeting.php">Join</a> |
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
$query = 'select * from meetings';
$studentQuery = 'SELECT student_id
                FROM enroll, meetings
                WHERE enroll.meeting_id =  meetings.meeting_id';
            $studentResult = mysqli_query($dbConnection, $studentQuery);
$studentQuery1 = 'SELECT name, email
                FROM users, students
                WHERE users.id = '. $studentResult  ;
                $studentResult1 = mysqli_query($dbConnection, $studentQuery1);
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
                    $studentName = $row['name'];
                    $studentEmail = $row['email'];
        
                    echo"Meeting Name : $meetingName<br>".
                        "Meeting ID : $meetingID<br>" .
                        "Date: $date<br>" .
                        "Time: $time<br>" .
                        "Capacity: $capacity<br>" .
                        "Group ID: $groupID<br>" .
                        "Announcement: $announcement<br>" .
                        "Students in Meeting :  $studentName ". 

                        "<br>---------------------------------------------------------<br>";
                }
            }else{
                echo "0 results";
            }

            if(isset($_POST['join'])) {
                $meeting_id = $_POST['meeting'];
                if(empty($meeting_id)){
                    echo "Please enter meeting ID";
                }
                else if($meeting_id = $meetingID){
                    $createQuery = 'insert into enroll values (' . 
                        $meeting_id . ', '. $_SESSION['sessionID']. ')'; 
                        $addresult = mysqli_query($dbConnection, $createQuery);
                        echo "Meeting has been successfully added.";
            
                }
                else {
                    echo "No meetings added"; 
                }
            }
            
            if(isset($_POST['delete'])) {
                $meeting_id = $_POST['meeting'];
                if(empty($meeting_id)){
                    echo "Please enter meeting ID";
                }
                else if($meeting_id = $meetingID){
                    $createQuery = 'delete from enroll values (' . 
                        $meeting_id . ', '. $_SESSION['sessionID']. ')'; 
                        $delete = mysqli_query($dbConnection, $createQuery);
                        echo "Meeting has been successfully deleted.";
            
                }
                else {
                    echo "No meetings added"; 
                }
            }
?>
</body>
</html>