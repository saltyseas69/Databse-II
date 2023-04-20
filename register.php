<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Account</title>
</head>
<body>

<h1>Register Account</h1>

<section>
    <a href="./index.php">Account Login</a>
    <br><br>
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
        <label for="grade">Grade (if Student): </label>
        <input type="text" id="grade" name="grade">
        <br><br>
        <label for="type">Account Type: </label>
        <select name="type" id="type">
            <option value="admins">Admin</option>
            <option value="students">Student</option>
            <option value="parents">Parent</option>
        </select>
        <br><br>
        <input type="submit" name="register" value="Register">
    </form>
</section>

<?php
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['register'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];
    $grade = $_POST['grade'];

    if (empty($id) || empty($email) || empty($password) || empty($name) || empty($phone) || empty($type)) {
        echo "Data required in all fields except grade";
    } else {
        $query = 'insert into users values (' . $id . ', "' . $email . '", "' . $password . '", "' . $name . '", ' . $phone . ')';
        $result = mysqli_query($dbConnection, $query);

        if (!$result) {
            echo "<br>Could not insert into User table<br>";
        } else {
            echo "<br>Successfuly inserted into User table<br>";

            switch ($type) {
                case "admins":
                    $query = 'insert into admins values (' . $id .')';
                    $result = mysqli_query($dbConnection, $query);
                    if (!$result) {
                        echo "<br>Could not insert into Admin table<br>";
                    } else {
                        echo "<br>Successfuly inserted into Admin table<br>";
                    }
                    break;
                case "students":
                    $query = 'insert into students values (' . $id .', ' . $grade .')';
                    $result = mysqli_query($dbConnection, $query);
                    if (!$result) {
                        echo "<br>Could not insert into Students table<br>";
                    } else {
                        echo "<br>Successfuly inserted into Students table<br>";
                    }
                    break;
                case "parents":
                    $query = 'insert into parents values (' . $id .')';
                    $result = mysqli_query($dbConnection, $query);
                    if (!$result) {
                        echo "<br>Could not insert into Parents table<br>";
                    } else {
                        echo "<br>Successfuly inserted into Parents table<br>";
                    }
                    break;
                default:
                    echo "<br>Unexpected error, invalid Acct Type<br>";
            }
        }
    }
}
?>
</body>
</html>