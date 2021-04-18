<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
		$_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
		header("Location: login.php");
		exit;
} 
if(isset($_SESSION["filled"]) && $_SESSION["filled"] === true){
		header("refresh: 1; url=payment.php");
		exit;
}

// Include config file
require_once "php/users.php";
require_once "php/header.php";

// variables
$name = $addr1 = $addr2 = $addr3 = $city = $country = "";
$name_err = $addr1_err = $city_err = $country_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
 	// validate first name	
	if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
		$name = trim($_POST["name"]);
    }
	
	// validate address
	if(empty(trim($_POST["addr1"]))){
        $addr1_err = "Please enter your main address.";
    } else{
		$addr1 = trim($_POST["addr1"]);
	}
	
	// validate city
	if(empty(trim($_POST["city"]))){
        $city_err = "Please enter your city.";
    } else{
		$city = trim($_POST["city"]);
	}
	
	//validate country
	if(empty(trim($_POST["country"]))){
        $country_err = "Please enter your country.";
    } else{
		$country = trim($_POST["country"]);
	}	
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($addr1_err) && empty($city_err) && empty($country_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO shipping (name, addr1, addr2, addr3, city, country) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_addr1, $param_addr2, $param_addr3, $param_city, $param_country);
            
            // Set parameters
			$param_name = $name;
			$param_addr1 = $addr1;
			$param_addr2 = $addr2;
			$param_addr3 = $addr3;
			$param_city = $city;
			$param_country = $country;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				
				session_start();
                // store the session
				$_SESSION["filled"] = true;
                $_SESSION["name"] = $name; 
				$_SESSION["addr1"] = $addr1;
				$_SESSION["city"] = $city;
				$_SESSION["country"] = $country;
				
				header("refresh: 1; url=payment.php");
            } else{
                echo '<script>alert("Oops! Something went wrong. Please try again later.");</script>';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bootleg Shopee</title>
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
	<center>
        <h2>Shipping Information</h2>
        <p>Please fill this form before proceeding..</p>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
		
			<!--Name-->
			<div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" style = "width: 30%" maxlength="35">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>   
			
			<!--Address-->
			<div class="form-group">
                <label>Main Address</label>
                <input type="text" name="addr1" class="form-control <?php echo (!empty($addr1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $addr1; ?>" style = "width: 30%" maxlength="35">
                <span class="invalid-feedback"><?php echo $addr1_err; ?></span>
            </div>   
			<!--Address 2-->
			<div class="form-group">
                <label>Alternate Address 1</label>
                <input type="text" name="addr2" class="form-control " value="" style = "width: 30%" maxlength="35">
            </div>		
			<!--Address 3-->
			<div class="form-group">
                <label>Alternate Address 2</label>
                <input type="text" name="addr3" class="form-control " value="" style = "width: 30%" maxlength="35">
            </div>	
			
			<!--City-->
			<div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>" style = "width: 30%" maxlength="35">
                <span class="invalid-feedback"><?php echo $city_err; ?></span>
            </div> 
			
			<!--Country-->
            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $country; ?>" style = "width: 30%" maxlength="35">
                <span class="invalid-feedback"><?php echo $country_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Continue">
            </div>
        </form>
    </div>   
	
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</div>
</body>
</html>