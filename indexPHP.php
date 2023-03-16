<?php

$dbConnection = mysqli_connect("localhost", "root", "", "DBPhase2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    echo $email;
}

if(isset($_POST['TestRetrieveStudents'])) {
    $query = "select * from students";
    $res = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            echo "student_id: " . $row["student_id"]. " - grade: " . $row["grade"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($dbConnection);
}
if(isset($_POST['TestRetrieveAdmin'])) {
    $query = "select * from admins";
    $res = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            echo "admin_id: " . $row["admin_id"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($dbConnection);
}
?>
