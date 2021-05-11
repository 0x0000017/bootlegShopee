<?php
session_start();

require_once ('php/CreateDb.php');
require_once ('php/component.php');

$database = new CreateDb("Productdb", "Producttb");
$product_id = $_GET['id'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details - WhatsShop</title>

    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Mono">
	
</head>
<body>
<?php require_once ("php/header.php"); ?>
<div class="container-fluid">
<?php
	$result = $database->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                                if ($row['id'] == $product_id){
                                    pDetails($row['product_image'], $row['product_name'],$row['product_price'], $row['product_desc'], $row['id']);
								}
							}

?>
<button type="submit" class="btn btn-warning my-3 float-right" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>