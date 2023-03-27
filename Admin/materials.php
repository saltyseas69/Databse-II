<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materials Page (Admin)</title>
</head>
<body>
<h1>Materials Page</h1>

<br>
<nav>
    <a href="./admin.php">Home</a> |
    <a href="./accountDetails.php">Account</a> |
    <a href="./meetings.php">Meetings</a> |
    <a href="./materials.php">Materials</a> |
    <a href="./ta.php">Teaching Assistant</a> |
    <a href="../index.php">Logout</a>
</nav>

<h3>Create Material  |  Update Material  |  Delete Material</h3>
<br>
<section>
    <form action="" method="post">
        <label for="materialID">Material ID: </label>
        <input type="text" id="materialID" name="materialID">
        <br><br>
        <label for="meetingID">Meeting ID: </label>
        <input type="text" id="meetingID" name="meetingID">
        <br><br>
        <label for="title">Title: </label>
        <input type="text" id="title" name="title">
        <br><br>
        <label for="author">Author: </label>
        <input type="text" id="author" name="author">
        <br><br>
        <label for="type">Type: </label>
        <input type="text" id="type" name="type">
        <br><br>
        <label for="url">URL: </label>
        <input type="text" id="url" name="url">
        <br><br>
        <label for="notes">Notes: </label>
        <input type="text" id="notes" name="notes">
        <br><br>
        <label for="date">Assigned Date(yyyy-mm-dd): </label>
        <input type="text" id="date" name="date">
        <br><br>
        <input type="submit" name="create" value="Create">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
    </form>
</section>

<p><br><br>---------------------------------------------------------<br><br></p>
<h3>Current Materials</h3>
<br>
<?php
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = 'select * from material';
$result = mysqli_query($dbConnection, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $materialId = $row['material_id'];
        $meetingId = $row['meeting_id'];
        $title = $row['title'];
        $author = $row['author'];
        $type = $row['type'];
        $url = $row['url'];
        $notes = $row['notes'];
        $assignedDate = $row['assigned_date'];

        echo "Material ID: $materialId<br>" .
            "Meeting ID: $meetingId<br>" .
            "Title: $title<br>" .
            "Author: $author<br>" .
            "Type: $type<br>" .
            "URL: $url<br>" .
            "Notes: $notes<br>" .
            "Assigned Date: $assignedDate<br><br>---------------------------------------------------------<br><br>";
    }
} else {
    echo "<br>No material currently available<br>";
}

if(isset($_POST['create'])) {
    $createMaterialId = $_POST['materialID'];
    $createMeetingId = $_POST['meetingID'];
    $createTitle = $_POST['title'];
    $createAuthor = $_POST['author'];
    $createType = $_POST['type'];
    $createUrl = $_POST['url'];
    $createNotes = $_POST['notes'];
    $createAssignedDate = $_POST['date'];

    if (empty($createMaterialId) || empty($createMeetingId) || empty($createTitle) || empty($createAuthor) ||
        empty($createType) || empty($createUrl) || empty($createNotes) || empty($createAssignedDate)) {
        echo "<br><br>Data required in all fields";
    } else {
        $createQuery = 'insert into material values (' .
            $createMaterialId . ', ' .
            $createMeetingId . ', ' .
            '"' . $createTitle . '", ' .
            '"' . $createAuthor . '", ' .
            '"' . $createType . '", ' .
            '"' . $createUrl . '", ' .
            '"' . $createNotes . '", ' .
            $createAssignedDate . ')';
        try {
            $result = mysqli_query($dbConnection, $createQuery);
        } catch (mysqli_sql_exception $e) {
            echo $e;
        }
    }
}

if(isset($_POST['update'])) {
    $udpateMaterialId = $_POST['materialID'];
    $updateMeetingId = $_POST['meetingID'];
    $updateTitle = $_POST['title'];
    $updateAuthor = $_POST['author'];
    $updateType = $_POST['type'];
    $updateUrl = $_POST['url'];
    $updateNotes = $_POST['notes'];
    $updateAssignedDate = $_POST['date'];

    if (empty($udpateMaterialId)) {
        echo "<br><br>Material ID required for updates";
    } else {
        if (empty($updateMeetingId) && empty($updateTitle) && empty($updateAuthor) && empty($updateType) && empty($updateUrl) &&
            empty($updateNotes) && empty($updateAssignedDate)) {
            echo "<br><br>Data required in at least one field";
        } else {
            if (!empty($updateMeetingId)) {
                $updateQuery = 'update material set meeting_id = ' . $updateMeetingId . ' where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateTitle)) {
                $updateQuery = 'update material set title = "' . $updateTitle . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateAuthor)) {
                $updateQuery = 'update material set author = "' . $updateAuthor . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateType)) {
                $updateQuery = 'update material set type = "' . $updateType . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateUrl)) {
                $updateQuery = 'update material set url = "' . $updateUrl . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateNotes)) {
                $updateQuery = 'update material set notes = "' . $updateNotes . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
            if (!empty($updateAssignedDate)) {
                $updateQuery = 'update material set assigned_date = "' . $updateAssignedDate . '" where material_id = ' . $udpateMaterialId;
                try {
                    $result = mysqli_query($dbConnection, $updateQuery);
                } catch (mysqli_sql_exception $e) {
                    echo $e;
                }
            }
        }
    }
}

if(isset($_POST['delete'])) {
    $deleteMaterialId = $_POST['materialID'];

    if (empty($deleteMaterialId)) {
        echo "<br><br>Material ID required";
    } else {
        $deleteQuery = "delete from material where material_id = " . $deleteMaterialId;
        try {
            $result = mysqli_query($dbConnection, $deleteQuery);
        } catch (mysqli_sql_exception $e) {
            echo $e;
        }
    }
}
?>

</body>
</html>
