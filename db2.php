<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Avenger's Training School</title>
</head>
<body>

<h1>Avenger's School</h1>
<?php
    echo "Hello World";
?>
<ul>
    <li>
        <label for="AcctId">Choose Account Type: </label>
        <select name="AcctId" id="AcctId">
            <option value="Admin">Admin</option>
            <option value="Student">Student</option>
            <option value="Parent">Parent</option>
        </select>
    </li>
    <li>
        <label for="UID">Enter UID: </label>

    </li>
    <li>
        <label for="Action">Choose Action: </label>
        <select name="Action" id="Action">
            <option value="Admin">Admin</option>
            <option value="Student">Student</option>
            <option value="Parent">Parent</option>
        </select>
    </li>
    <p>UID: </p>
    <p>Action:</p>
</ul>

</body>
</html>