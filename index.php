<!DOCTYPE html>
<head>
    <title>Avenger's Training School</title>
</head>
<body>

<?php
    include("indexPHP.php");
?>

<h1>Avenger's School</h1>

<section>
    <form action="" method="post">
        <label for="email">Email: </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password">
        <br>
        <input type="login" name="login" value="Login">
    </form>
</section>


<article>
    <form action="" method="post">
        <label for="AcctId">Choose Account Type: </label>
            <select name="AcctId" id="AcctId">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="parent">Parent</option>
            </select>
        <br><br>
        <label for="UID">Enter UID: </label>
        <input type="text" id="UID" name="UID">
        <br><br>
        <label for="Action">Choose Action: </label>
        <select name="Action" id="Action">
            <option value="Admin - Create Material">Admin - Create Material</option>
            <option value="Admin - Create Meeting">Admin - Create Meeting</option>
            <option value="Admin - Modify Material">Admin - Modify Material</option>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Save">
    </form>

    <form method="post">
        <input type="submit" name="TestRetrieveStudents"
               value="TestRetrieveStudents"/>

        <input type="submit" name="TestRetrieveAdmin"
               value="TestRetrieveAdmin"/>
    </form>
</article>

</body>
</html>
