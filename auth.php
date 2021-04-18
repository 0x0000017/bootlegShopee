<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("refresh: 2; url=checkout.php");
    exit;
}
else {
	$_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    header("Location: login.php");
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