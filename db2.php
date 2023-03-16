<!DOCTYPE html>
<head>
    <title>Avenger's Training School</title>
</head>
<body>

<h1>Avenger's School</h1>

<article>
    <form action="" method="">
        <label for="AcctId">Choose Account Type: </label>
            <select name="AcctId" id="AcctId">
                <option value="Admin">Admin</option>
                <option value="Student">Student</option>
                <option value="Parent">Parent</option>
            </select>
        <br><br>
        <label for="UID">Enter UID: </label>
        <input type="text" id="UID" name="UID">
        <br><br>
        <label for="Action">Choose Action: </label>
        <select name="Action" id="Action">
            <option value="Admin - Create Material">Admin - Create Material</option>
            <option value="Admin - Create Meeting">Admin - Create Meeting</option>
            <option value="Admin - Modify Material">Admin - Modify Material</option>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Save">
    </form>

    <form method="post">
        <input type="submit" name="TestRetrieveStudents"
               value="TestRetrieveStudents"/>

        <input type="submit" name="TestRetrieveAdmin"
               value="TestRetrieveAdmin"/>
    </form>
</article>

<?php
if(isset($_POST['TestRetrieveStudents'])) {
    $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
    $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
    if (!$dbConnection) {
        die("Connection failed: " . mysqli_connect_error());
    }

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

</body>
</html>
