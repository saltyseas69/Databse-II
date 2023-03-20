<!DOCTYPE HTML>
<html>
    <head>
        <title>Parent Homepage</title>
    </head>

    <body>
        <h1>Avengers Parents Initiative</h1>

        <h3>Child Meeting Info</h3>
        <?php
            $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
            if (!$dbConnection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $student = array(students, meetings, groups);
            list($a, $b, $c) = $student;
            echo "Student Name: $a";
            echo "<br>";
            echo "Current Meetings: $b";
            echo "<br>";
            echo "Current Groups: $c";
        ?>
    </body>
</html>