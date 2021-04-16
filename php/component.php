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
function cartElement($productimg, $productname, $productprice, $productid){
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
                                <h5 class=\"pt-2\">$$productprice</h5>	
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}
function pDetails($productimg, $productname, $productprice, $productid){
    $element = "
	<form action=\"index.php\" method=\"post\">
	<div class = \"container\">
		<div class = \"row\">
			<div class=\"col-md-6\">
			<!--Product Image -->
				<img src =$productimg 
				alt =\"ProductImage\"
				class =\"image-responsive\">
			</div>
			<div class=\"col-md-6\">
			<!--Product Details-->
				<div class =\"row\">
					<div class =\"col-md-12\">
						<h2>$productname</h2>
					</div>
				</div>
				<div class =\"row\">
					<div class =\"col-md-12\">
						<span class =\"label label-primary\">Brand New</span>
						<span class =\"monospaced\">No. 042069</span>
					</div>
				</div>
				<div class=\"row\">
					<div class=\"col-md-12\">
						<p class=\"description\">
							All products are in good condition.
							And the most important of all, it's free shipping !.
						</p>
					</div>

					<input type='hidden' name='product_id' value='$productid'>
				</div>			
		</div>
	</div>
	
	
	";
	echo $element;
}