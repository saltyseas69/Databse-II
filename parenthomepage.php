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
            
            $childof = "SELECT student_id FROM child_of WHERE parent_id = 1";
            $childof_result = $dbConnection->query($childof);
                while($row = $childof_result->fetch_assoc()){
                    echo "<br> Child ID: ". $row["student_id"];
                }

            $studentname = "SELECT * FROM users WHERE id = 7";
            $sname_result = $dbConnection->query($studentname);
                while($row = $sname_result->fetch_assoc()){
                    echo "<br> Child Name: ". $row["name"]. "<br>";
                }
            
            
            
            
            $sql = "SELECT name FROM groups";

            $result = $dbConnection->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br> Group Name: ". $row["name"]. "<br>";
                }
            } 
            else{
                echo "0 results";
            }
            
            $dbConnection->close();
        
        ?>
    </body>
</html>