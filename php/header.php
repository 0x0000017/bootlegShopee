
<header id="header">
    <nav class="navbar navbar-expand-lg py-4 navbar-dark" style="background-color: #EE4D2D;">
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket"></i> bootleg Shopee
            </h3>
        </a>
        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
			<?php
				if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
				{
					echo "
							 <li class=\"nav-item dropdown px-3\">
								<a class=\"nav-link navbar-brand dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Hi, <b>", htmlspecialchars($_SESSION["firstName"]),"
								</a>
								<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
									<a class=\"dropdown-item\" href=\"logout.php\">Logout</a>
								</div>
							</li> 
							<a href=\"cart.php\" class=\"nav-item nav-link active\">
								<h5 class=\"px-1\">
									<i class=\"fas fa-shopping-cart\"></i>  My Cart&nbsp;&nbsp;";
									if (isset($_SESSION['cart']))
									{
										$count = count($_SESSION['cart']);
										echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
									}
									else
									{
										echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
									}
									echo "
								</h5>
							</a>";
				}
				else 
				{
					echo "<a href=\"login.php\" class =\"nav-item nav-link active\">
							<h5 class=\"px-3\" cart>
								<i class=\"fas fa-sign-in fw\"></i> Login
							</h5>
						 </a>
						 <a href=\"cart.php\" class=\"nav-item nav-link active\">
								<h5 class=\"px-1\">
									<i class=\"fas fa-shopping-cart\"></i>  My Cart&nbsp;&nbsp;";
									if (isset($_SESSION['cart']))
									{
										$count = count($_SESSION['cart']);
										echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
									}
									else
									{
										echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
									}
									echo "
								</h5>
							</a>";
				}
			?>
			</div>
        </div>
    </nav>
</header>