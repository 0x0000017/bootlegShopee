<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo '<script>alert("Passed");</script>';
	header("refresh: 2; url=index.php");
    exit;
}
else {
	header("refresh: 2; url=login.php");
}
?>
<html>
<head>
</head>
<body>
<P>REDIRECTING...</p>
</body>
</html>