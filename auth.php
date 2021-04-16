<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("refresh: 2; url=checkout.php");
    exit;
}
else {
	header("refresh: 1; url=login.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
</head>
<body>
<P>REDIRECTING</p>
</body>
</html>