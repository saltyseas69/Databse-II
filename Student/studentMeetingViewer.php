<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Meeting Viewer</title>
</head>
<body>

<h1>Student Meeting Viewer</h1>

<nav>
    <a href="./selectGrade.php">Home</a> |
    <a href="./studentJoinMeeting.php">Join</a> | 
    <a href="../index.php">Logout</a>
</nav>

<h2>Other Students In Meeting:</h2>

<?php
session_start();
$dbConnection = mysqli_connect("localhost", "root", "", "DB2");
if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}



?>
