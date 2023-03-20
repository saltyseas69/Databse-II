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
            
            
        ?>
    </body>
</html>