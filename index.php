<!DOCTYPE html>
<head>
    <title>Avenger's Training School</title>
    <style>
        h1 {
            text-align: center;
        }
        section {
            text-align: center;
        }
        label {
             display: inline-block;
             width: 10%;
             text-align: right;
        }
    </style>
</head>
<body>

<h1>Avenger's School</h1>

<section>
    <a href="/Databse-II/register.php">Register New Account</a>
    <br><br>
    <form action="" method="post">
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <br><br>
        <label for="password">Password: </label>
        <input type="text" id="password" name="password">
        <br><br>
        <input type="submit" name="submit" value="Login">
    </form>
</section>

<?php
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = 'select password from users where email = "' . $email . '"';
    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dbPassword = $row["password"];
            if ($password == $dbPassword) {
                // Go to page based on user type (i.e. Student, Admin, Parents)
                echo "Jumping to user specific page";
            } else {
                echo "<br>Password invalid.";
            }
        }
    } else {
        echo "<br>Email invalid. No account found.";
    }
}
?>

</body>
</html>
