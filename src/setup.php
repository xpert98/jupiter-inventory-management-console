<html>
<head>
    <title>Setup</title>
</head>
<body>

<?php
include 'secret.php';
$secret = new secret;
?>

<form action="processSetup.php" method="POST">

Database Server Host:
<br>
<input type="text" name="dbhost">
<br>
<br>
Database Schema Name:
<br>
<input type="text" name="schema">
<br>
<br>
Database User Name:
<br>
<input type="text" name="dbuser">
<br>
<br>
Database User Password:
<br>
<input type="password" name="dbpass">
<br>
<br>
Jupiter Inventory Management Console Admin Password:
<br>
<input type="password" name="adminpass">
<br>
<br>

<input type="submit" value="Submit"> 

</form>

</body>
</html>