<?php
session_start();
$qtty = '';
require_once ("php/CreateDb.php");
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
    <title>Cart - Home 家 Store</title>
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
				
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($rw = mysqli_fetch_assoc($result)){
							$_SESSION['product_name'] = $rw['product_name'];
							$id = $rw['id'];
							$pname = $rw['product_name'];
							$pprice = $rw['product_price'];
							$pimage = $rw['product_image'];
							$quantity = $rw['product_stock'];                                   
                            foreach ($product_id as $id){
                                if ($rw['id'] == $id){
									echo '
									<form action="cart.php?action=remove&id=',$id,'" method="POST" class="cart-items">
									<div class="border rounded">
										<div class="row bg-white">
											<div class="col-md-3 pl-0">
												<img src=',$pimage,' alt="Image1" class="img-fluid">
											</div>
											<div class="col-md-6">
												<h5 class="pt-2">',$pname,'</h5>
												<small class="text-secondary">Seller: definitelyNotScam</small>
												<h5 class="pt-2">PHP ',$pprice,'</h5>	
												<button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
											</div>
											<div class="col-md-3 py-5">
												<div>
												<div class="center">
													<div class="input-group">
														<span class="input-group-btn">
															<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
															<i class = "fas fa-minus"></i>
															</button>
														</span>
														<input type="text" name="quant[2]" class="form-control input-number" value="0" min="1" max=" ',$quantity,' ">
															<span class="input-group-btn">
																<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
																<i class = "fas fa-plus"></i>
																</button>
															</span>
													</div>
												</div>	
												</div>
											</div>
										</div>
									</div>
									</form>';
									$total = $total + (int)$pprice;

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
                                echo "<h6>Price</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h4>Amount Payable</h4>
                    </div>
                    <div class="col-md-6">
                        <h6>PHP <?php echo $total; ?></h6>
                        
						</h6>
						<h6 class="text-success">PHP 						
						<?php 
							if ($total == 0) {
								$shipping_fee = $shipping_fee * 0;
								echo $shipping_fee;
							} else {
								echo $shipping_fee;
							}
						?>
						</h6>
                        <hr>
                        <h4>PHP <?php
                            echo $total = $total + $shipping_fee;
                            ?></h4>
							<?php 	
								if ($total == 0) {
									echo '<a href ="auth.php" class="btn btn-warning my-3 disabled" name="checkout">Checkout <i class="fas fa-shopping-cart"></i></a>';
								} else {
									echo '<a href ="auth.php" class="btn btn-warning my-3 name="checkout">Checkout <i class="fas fa-shopping-cart"></i></a>';
								}
							?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
