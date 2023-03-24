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

    <p>Students may add more than one group.</p>
    <section>
    <br><br>
    <form action="" method="post">

        <label for="type">Select Group to Add: </label>
        <select name="group" id="group">
            <option value="Intro Mathematics">Intro Mathematics</option>
            <option value="Arithmetic">Arithmetic</option>
            <option value="Geometry">Geometry</option>
        </select>
        <br><br>
        <input type="submit" name="add" value="Add">
    </form>
</section>

<?php

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
    $groupID = $_POST['groupID'];
    if(empty($groupID)){

    }
    else{
        $createQuery = 'insert into member_of values (' . 
            $groupID . ', '. $_SESSION['sessionID']; 
    }
}
    
?>


</body>
</html>