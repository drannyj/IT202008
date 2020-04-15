<?php
session_start();
echo 'Hello, ' . $_SESSION['username'] . "!";

?>

<html>
<head>
<title> Logged in </title>
</head>
<body>
<form action = 'banklogout.php'>
<br><button type = 'submit' value = "Submit">Logout</button><br>
</form>
</body>
</html>