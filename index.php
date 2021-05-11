<?php
session_start();

// adding this here because
// add to cart function doesnt work on other page
// bullshit 

if (isset($_POST['add'])){
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
		if(in_array($_POST['product_id'], $item_array_id)){
			echo '<script>alert("The item is already in cart !");</script>';
			
		} else {
			$count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );
            $_SESSION['cart'][$count] = $item_array;
		}
    }else{
		
        $item_array = array(
                'product_id' => $_POST['product_id']
        );
		
        $_SESSION['cart'][0] = $item_array;
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
    <title>Index - WhatsShop</title>
	
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Mono">
	
</head>
<body>

<?php require_once ("php/header.php"); ?>
<br><br><br>
<div class = "container">
        <div class="row">
				<?php
                    $conn = mysqli_connect("localhost", "root", "", "productdb");
                    $sql = mysqli_query($conn, "SELECT * from producttb");

                    while($rw = mysqli_fetch_array($sql))
					{
						$_SESSION['product_name'] = $rw['product_name'];
                        $id = $rw['id'];
						$pname = $rw['product_name'];
						$pprice = $rw['product_price'];
						$pimage = $rw['product_image'];
					echo '
                    <div class="col-md-3 col-sm-6 my-3 my-md-0">
						<form action="index.php" method="POST">
							<div class="card shadow">
								<img src="',$pimage,'" alt="Image1" class="img-thumbnail" height =200 width = 200></a>
								<div class="card-body">
									<a href="productDetails.php?id=',$id,'"><h6 class="card-title">',$pname,'</h6>
									<h6>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									<h6>
								<h6>
									<br>
									<span class="price">PHP ',$pprice,'</span><br> 
								</h6>				
								<input type="hidden" name="product_id" value="',$id,'">
								</div>
							</div>
						</form>
					</div>';
                    }
				?>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
