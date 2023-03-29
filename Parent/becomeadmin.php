<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parent to Admin Registration</title>
</head>
<body>

<h1>Register to Become an Admin</h1>
<nav>
            <a href="./parenthome.php">Home</a> |
            <a href="./parentAccount.php">Account</a> |
            <a href="./childofparent.php">Child Meetings</a> |
            <a href="./childAccount.php">Child Account</a> |
            <a href="./becomeadmin.php">Admin Registration</a> |
            <a href="../index.php">Logout</a>
        </nav>
        <br>
<b>Enter Admin credentials and click "Verify"</b>

<section>
    <br>
    <form action="" method="post">
        <label for="id">Id: </label>
        <input type="text" id="id" name="id">
        <br><br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <br><br>
        <label for="password">Password: </label>
        <input type="text" id="password" name="password">
        <br><br>
        <label for="name">Name: </label>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="phone">Phone: </label>
        <input type="text" id="phone" name="phone">
        <br><br>
        <input type="submit" name="register" value="Verify">
    </form>
</section>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}
$parent = "select * from users where id = " . $_SESSION['sessionID'];
$p_result = mysqli_query($dbConnection, $parent);

//find number of children of the parent that logged in
$childCount = "SELECT count(*) as childCount FROM child_of WHERE parent_id = " . $_SESSION['sessionID'];

//the variable defined in the last line is used to access the db
$childof_result = $dbConnection->query($childCount);
//now fetch all the data while the rows are not empty
$childOfRow = $childof_result->fetch_assoc();
$childCountActual = $childOfRow['childCount'];

if(isset($_POST['register'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if (empty($id) || empty($email) || empty($password) || empty($name) || empty($phone)) {
        echo "Data required in all fields except grade";
    } else {
    if ($childCountActual > 0) {
        echo "<br>Can not be admin with child enrolled in school<br>";
    }
    else {
        $query = 'insert into users values (' . $id . ', "' . $email . '", "' . $password . '", "' . $name . '", ' . $phone . ')';
        $result = mysqli_query($dbConnection, $query);

        if (!$result) {
            echo "<br>Could not insert into User table<br>";
        } else {
            echo "<br>Successfuly inserted into User table<br>";

            $query = 'insert into admins values (' . $id . ')';
            $result = mysqli_query($dbConnection, $query);

            if (!$result) {
                echo "<br>Could not insert into Admin table<br>";
            } else {
                echo "<br>Successfuly inserted into Admin table<br>";
            }

            }
        }
    }
}
?>
</body>
</html>