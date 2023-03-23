<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Homepage</title>
</head>
<body>
    <H1>Student Homepage</H1>

    <p>Groups are determined based on grade level.</p>
    <section>
    <br><br>
    <form action="" method="post">

        <label for="type">Select Grade Level: </label>
        <select name="grade" id="grade">
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</section>

<?php


$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
function redirect($url) {
    header('Location: '.$url);
}

if(isset($_POST['submit'])) {
    $grade = $_POST['grade'];
        if($grade == 4) {
            redirect("/Databse-II/Student/studentGroup1.php");
        }
        else if($grade == 5) {
            redirect("/Databse-II/Student/studentGroup2.php");
        }

    }

?>


</body>
</html>