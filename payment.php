<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    echo '<script>alert("Log in first !")</script>';
	header("refresh: 2; url=login.php");
    exit;
}
// Include config file
require_once "php/users.php";
require_once "php/CreateDb.php";
require_once "php/component.php";

$db = new CreateDb("Productdb", "Producttb");

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
          }
      }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
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
				$max_weight = 1000;
				
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){
                                    paymentLanding($row['product_image'], 
												$row['product_name'],
												$row['product_price'], 
												$row['id'], 
												$row['product_weight']);
                                    $total = $total + (int)$row['product_price'];
									$total_weight = $total_weight + (int)$row['product_weight'];
									if ($total_weight > $max_weight){
										$total = $total + $additional_fee;
										if ($total_weight > 2000 ){
											$additional_fee = $additional_fee + 70;
										}
										$shipping_carrier = $shipping_carrier + 1;
									}

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
						<h6>Total Weight</h6>
						<h6>Shipping Carriers </h6>
						
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>PHP <?php echo $total; ?></h6>
                        <h6 class="text-success">PHP 
						<?php 
							if ($total_weight > $max_weight) {
								$shipping_fee = $shipping_fee + $additional_fee;
								echo $shipping_fee;
							} else if ($total_weight == 0) {
								$shipping_fee = 0;
								echo $shipping_fee;
							} else {
								echo $shipping_fee;
							}
							
							?>
						</h6>
						<h6><?php echo $total_weight?> grams</h6>
						<h6>
						<?php 
							if ($total_weight == 0) {
								$shipping_carrier = 0;
								echo $shipping_carrier;
							} else {
								echo $shipping_carrier;
							}
							?> carrier/s
						</h6>
                        <hr>
                        <h6>PHP <?php
                            echo $total = $total + $shipping_fee;
                            ?></h6>
							<a href ="placeOrder.php" class="btn btn-warning my-3" name="checkout">Confirm <i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
