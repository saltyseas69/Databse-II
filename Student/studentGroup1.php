<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Group Page 1</title>
</head>
<body>
    <H1>Student Group Page 1</H1>
    <nav>
    <a href="./selectGrade.php">Home</a> |
    <a href="./studentAccount.php">Account Details</a> |
    <a href="../index.php">Logout</a>
    </nav>

    <p>Students may add more than one group.</p>
    <section>
    <br><br>
    <form action="" method="post">

        <label for="group">Select Group to Add: </label>
        <form action="" method="post">
        <input type="text" id="groupadd" name="groupadd">
        <br><br>
        <br><br>
        <input type="submit" name="add" value="Add">
    </form>
</section>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = 'select * from groups where grade_req = 4';
            $result = mysqli_query($dbConnection, $query);
        
            if (mysqli_num_rows($result) > 0) {
        
                while($row = mysqli_fetch_assoc($result)) {
                    $groupID = $row['group_id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $grade_req = $row['grade_req'];
        
                    echo"Group ID : $groupID<br>" .
                        "Group Name: $name<br>" .
                        "Description: $description<br>" .
                        "Grade Requirement: $grade_req<br>" .
                        "<br>---------------------------------------------------------<br>";
                }
            }else{
                echo "0 results";
            }

if(isset($_POST['add'])) {
    $id = $_POST['groupadd'];
    if(empty($id)){
        echo "Please select a group to add";
    }
    else if($id = $groupID){
        $createQuery = 'insert into member_of values (' . 
            $groupID . ', '. $_SESSION['sessionID']; 
            $addresult = mysqli_query($dbConnection, $createQuery);
            echo "Group has been successfully added.";

    }
    else {
        echo "No classes added"; 
    }
}
    
?>


</body>
</html>

