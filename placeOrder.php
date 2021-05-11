<?php
session_start();

require_once ("php/CreateDb.php");
require_once ("php/component.php");

$db = new CreateDb("Productdb", "Producttb");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place Order - WhatsShop</title>

    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Mono">
	
</head>
<body class="bg-light">

<?php
    require_once ('php/header.php');
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart" 	>
                <h6>My Cart</h6>
                <hr>

                <?php

                $total = 0;
				$shipping_fee = 100;
				$additional_fee = 70;
				$shipping_carrier = 1;
				$total_weight = 0;
				$max_weight = 5000;
				
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){
                                    paymentLanding($row['product_image'], 
												$row['product_name'],
												$row['product_price'], 
												$row['id']);
                                    $total = $total + (int)$row['product_price'];

                                }		
                            }
							
                        }
						
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
						
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>PHP <?php echo $total; ?></h6>
                        <h6 class="text-success">PHP 
						<?php 
							if (isset($_SESSION['cart'])){
								$count  = count($_SESSION['cart']);
                                $totalsf = $shipping_fee * $count;
								echo $totalsf;
                            }else{
								$shipping_fee = 0;
								echo $shipping_fee;
                            }
							?>
						</h6>
                        <hr>
                        <h6>PHP <?php
                            echo $total = $total + $shipping_fee;
                            ?></h6>
							
							
                    </div>
                </div>
            </div>
			<div class="pt-4">
                <h6>CUSTOMER INFORMATION</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <h6>Name</h6>
                        <h6>Address</h6>
						<hr>
						<h6>City/Province</h6>
						<h6>Country</h6>
						
                    </div>
                    <div class="col-md-6">
                        <h6><?php 
								if($_SESSION['name']) {
									echo $_SESSION['name'];
								}
							?>
						</h6>
                        <h6><?php 
								if($_SESSION['addr1']) {
									echo $_SESSION['addr1'];
								}
							?>
						</h6>
						<h6><?php 
								if($_SESSION['city']) {
									echo $_SESSION['city'];
								}
							?>
						</h6>
						<h6><?php 
								if($_SESSION['country']) {
									echo $_SESSION['country'];
								}
							?>
						</h6>
                        <hr>
						<a href ="success.php" class="btn btn-warning my-3" name="checkout">Proceed !</a>
						
						
					</div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
