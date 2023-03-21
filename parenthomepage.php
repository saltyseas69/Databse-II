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
            
            //select the child of the parent that logged in
            $childof = "SELECT student_id FROM child_of WHERE parent_id = 1";
            
            //the variable defined in the last line is used to access the db
            $childof_result = $dbConnection->query($childof);

            //now fetch all the data while the rows are not empty
                while($row = $childof_result->fetch_assoc()){
                    echo "<br> Child ID: ". $row["student_id"];
                }
            
            //select the child name using the result of previous query
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