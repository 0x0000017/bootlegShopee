<?php

function component($productname, $productprice, $productimg, $productid){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-thumbnail\" height =200 width = 200></a>
                        <div class=\"card-body\">
                            <a href=\"productDetails.php?id=$productid\"><h6 class=\"card-title\">$productname</h6>
                            <h7>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h7>
                            <h7>
								<br>
                                <span class=\"price\">PHP $productprice</span><br> 
                            </h7>				
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}	
function cartElement($productimg, $productname, $productprice, $productid, $product_weight){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: definitelyNotScam</small>
                                <h5 class=\"pt-2\">PHP $productprice</h5>	
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
									<!--bullshit-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}
function pDetails($productimg, $productname, $productprice, $productdesc, $productid){
    $element = "
	<form action=\"index.php\" method=\"post\">
	<div class = \"container\">
		<div class = \"row\">
			<div class=\"col-md-6\">
			<br>
			<!--Product Image -->
				<img src =$productimg 
				alt =\"ProductImage\"
				class =\"image-responsive img-thumbnail\"
				height = 400
				width = 400>
			</div>
			<div class=\"col-md-6\">
			<!--Product Details-->
				<div class =\"row\">
					<div class =\"col-md-12\">
					<br>
						<h2>$productname</h2>
					</div>
				</div>
				<div class =\"row\">
					<div class =\"col-md-12\">
						<span class =\"label label-primary bg-success\">Brand New</span>
						<span class =\"monospaced\">No. 042069</span>
						<h7>
							<i class=\"fas fa-star\"></i>
                            <i class=\"fas fa-star\"></i>
                            <i class=\"fas fa-star\"></i>
                            <i class=\"fas fa-star\"></i>
                            <i class=\"far fa-star\"></i>
                        </h7>
					</div>
				</div>
				<div class =\"row\">
					<div class =\"col-md-12\">
						<h2 style = \"color: #EE4D2D\">
							PHP $productprice 
                        </h2>
					</div>
				</div>
				<div class=\"row\"> 
					<div class=\"col-md-12\">
						<p class=\"description\">
						<br><br>
							$productdesc
						</p>
					</div>
					<input type='hidden' name='product_id' value='$productid'>
				</div>			
		</div>
	</div>
	
	
	";
	echo $element;
}
function paymentLanding($productimg, $productname, $productprice, $productid, $product_weight){
    $element = "
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: definitelyNotScam</small>
                                <h5 class=\"pt-2\">PHP $productprice</h5>	
                            </div>
                            <div class=\"col-md-3 py-5\">
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}