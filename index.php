<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avenger's Training School</title>
</head>
<body>

<h1>Avenger's School</h1>

<section>
    <a href="./register.php">Register New Account</a>
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
session_start();
function redirect($url) {
    header('Location: '.$url);
}

$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $receivedPassword = $_POST['password'];

    $query = 'select * from users where email = "' . $email . '"';
    $result = mysqli_query($dbConnection, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dbPassword = $row["password"];
            if ($receivedPassword == $dbPassword) {
                // Go to page based on user type (i.e. Student, Admin, Parents)
                $userId = $row['id'];
                $_SESSION['sessionID'] = $row['id'];
                echo "Determining User type with ID: " . $userId;

                $studentFound = true;
                $adminFound = true;
                $parentFound = true;

                // Check Student Table
                try {
                    $studentCheckQuery = 'select * from students where student_id = "' . $userId . '"';
                    $studentCheckResult = mysqli_query($dbConnection, $studentCheckQuery);
                } catch (Exception $e) {
                    echo "<br>ID not found within Student table";
                    $studentFound = false;
                }

                // Check Admin Table
                try {
                    $adminCheckQuery = 'select * from admins where admin_id = "' . $userId . '"';
                    $adminCheckResult = mysqli_query($dbConnection, $adminCheckQuery);
                } catch (Exception $e) {
                    echo "<br>ID not found within Admin table";
                    $adminFound = false;
                }

                // Check Parent Table
                try {
                    $parentCheckQuery = 'select * from parents where parent_id = "' . $userId . '"';
                    $parentCheckResult = mysqli_query($dbConnection, $parentCheckQuery);
                } catch (Exception $e) {
                    echo "<br>ID not found within Parent table";
                    $parentFound = false;
                }

                if ($studentFound && mysqli_num_rows($studentCheckResult) > 0){
                    // ID is in student table, jump to student page
                    redirect("/Databse-II/Student/studentAccount.php");
                } else if ($adminFound && mysqli_num_rows($adminCheckResult) > 0){
                    // ID is in admin table, jump to admin page
                    redirect("/Databse-II/Admin/admin.php");
                } else if ($parentFound && mysqli_num_rows($parentCheckResult) > 0){
                    // ID is in parent table, jump to parent page
                    redirect("/Databse-II/Parent/parenthome.php");
                } else {
                    echo "<br>Unforeseen error, expected ID in user table but none was found";
                }
                break;
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
