<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Account</title>
</head>
<body>

<h1>Admin Account Details</h1>

<nav>
    <a href="./admin.php">Home</a> |
    <a href="./accountDetails.php">Account</a> |
    <a href="./meetings.php">Meetings</a> |
    <a href="./materials.php">Materials</a> |
    <a href="../index.php">Logout</a>
</nav>

<h2>Current Account Details:</h2>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "select * from users where id = " . $_SESSION['sessionID'];
$result = mysqli_query($dbConnection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $currID = $row['id'];
        $currEmail = $row['email'];
        $currPassword = $row['password'];
        $currName = $row['name'];
        $currPhone = $row['phone'];

        echo "ID: $currID<br>" .
            "Email: $currEmail<br>" .
            "Password: $currPassword<br>" .
            "Name: $currName<br>" .
            "Phone: $currPhone<br>";
    }
} else {
    echo "Unexpected Error: Cannot retrieve account information";
}

if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if (empty($email) && empty($password) && empty($name) && empty($phone)) {
        echo "No data to update";
    } else {
        if (!empty($email)) {
            $updateQuery = 'update users set email = "' . $email . '" where id = ' . $_SESSION['sessionID'];
            $updateResult = mysqli_query($dbConnection, $updateQuery);

            if (!$updateResult) {
                echo "Unexpected error, unable to update data";
            } else {
                header("Refresh:0");
            }
        }
        if (!empty($password)) {
            $updateQuery = 'update users set password = "' . $password . '" where id = ' . $_SESSION['sessionID'];
            $updateResult = mysqli_query($dbConnection, $updateQuery);

            if (!$updateResult) {
                echo "Unexpected error, unable to update data";
            } else {
                header("Refresh:0");
            }
        }
        if (!empty($name)) {
            $updateQuery = 'update users set name = "' . $name . '" where id = ' . $_SESSION['sessionID'];
            $updateResult = mysqli_query($dbConnection, $updateQuery);

            if (!$updateResult) {
                echo "Unexpected error, unable to update data";
            } else {
                header("Refresh:0");
            }
        }
        if (!empty($phone)) {
            $updateQuery = 'update users set phone = ' . $phone . ' where id = ' . $_SESSION['sessionID'];
            $updateResult = mysqli_query($dbConnection, $updateQuery);

            if (!$updateResult) {
                echo "Unexpected error, unable to update data";
            } else {
                header("Refresh:0");
            }
        }
    }
}
?>

<h3>Input any desired changes (ID is unable to be altered)</h3>

<section>
    <form action="" method="post">
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
        <input type="submit" name="update" value="Update">
    </form>
</section>

</body>
</html>