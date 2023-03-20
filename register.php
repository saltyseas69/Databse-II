<!DOCTYPE html>
<head>
    <title>Register Account</title>
    <style>
        h1 {
            text-align: center;
        }
        section {
            text-align: center;
        }
        label {
            display: inline-block;
            width: 12%;
            text-align: right;
        }
    </style>
</head>
<body>

<h1>Register Account</h1>

<section>
    <a href="/Databse-II/index.php">Account Login</a>
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
        $query = 'insert into users values ()';
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
}
?>
</body>
</html>