<!DOCTYPE HTML>
<html>
    <head>
        <title>Parent Homepage</title>
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
        <h1>Avengers Parents Initiative</h1>
        
        <h3>Child Info</h3>
        <?php
            $dbConnection = mysqli_connect("localhost", "root", "", "DB2");
            if (!$dbConnection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT * FROM students";

            $result = $dbConnection->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> Student ID: ". $row["student_id"]. "<br>";
                }
            } 
            else{
                echo "0 results";
            }
            
            $dbConnection->close();
        
        ?>
    </body>
</html>