<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parent and Child Account</title>
    <style>
        h1 {
            text-align: center;
        }
        nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Parent and Child Account Details</h1>

<nav>
    <a href="./parenthomepage.php">Home</a> |
    <a href="./parentAccount.php">Account</a> |
    <a href="../index.php">Logout</a>
</nav>

<h2>Parent Account Details:</h2>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$parent = "select * from users where id = " . $_SESSION['sessionID'];
$p_result = mysqli_query($dbConnection, $parent);

if (mysqli_num_rows($p_result) > 0) {
    while ($row = mysqli_fetch_assoc($p_result)) {
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

echo "<br><br>Child Account Details:<br>";
//select the child of the parent that logged in
$childof = "SELECT student_id FROM child_of WHERE parent_id = " . $_SESSION['sessionID'];
//the variable defined in the last line is used to access the db
$childof_result = $dbConnection->query($childof);
//now fetch all the data while the rows are not empty
    while($row = $childof_result->fetch_assoc()){
        $child_name = $row["student_id"];
    }

//select the child name using the result of previous query
$studentname = "SELECT * FROM users WHERE id = " . $child_name;
$sname_result = $dbConnection->query($studentname);
    while($row = $sname_result->fetch_assoc()){
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