<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ShoeMart Shoe Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
		}
	?>
</head>

<body>
    <div class="brand">ShoeMart Shoe Store</div>
    <div class="address-bar"><strong>Premium</strong> Shoes for Men</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">ShoeMart Shoe Store</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
					<li><a href="bestseller.php">Best Sellers</a></li>
					<li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About</a></li>
					<li><a href="#" onclick="ManagementOnclick();">Management</a></li>
					<?php if($Username == null){echo '<li><a href="register.php?ActionType=Register">Register</a></li>';} ?>
					<?php if($Username == null){echo '<li><a href="Login.php?Role=User">Login</a></li>';} else {echo '<li><a href="Logout.php">Logout</a></li>';} ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
		<?php 
			$conn = mysqli_connect("localhost","root","","smss_db");
			$sql = "SELECT * FROM `tbl_products` order by ProductPrice";
			$Resulta = mysqli_query($conn,$sql);
		?>
		
		
		<?php while($Rows = mysqli_fetch_array($Resulta)){
		echo '	
		<div class="col-sm-4 col-lg-4 col-md-4">
             <div class="thumbnail">
				<h4 style="text-align: center;">'.$Rows[2].'</h4>
                <img style="border: 2px solid gray; border-radius: 10px; height: 229px; width: 298px;" src="data:image;base64,'.$Rows[8].'" alt="">
                <div class="caption">
					<p><strong>Product Name:</strong> '.$Rows[1].'</p>
					<p><strong>Size Available:</strong> '.$Rows[3].'</p>
					<p><strong>Colors Available:</strong> '.$Rows[4].'</p>
					<p><strong>₹ '.$Rows[5].'.00</strong></p>
                </div>
				<center><a onclick="addToCartOnclick('.$Rows[0].');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Add to Cart</a></center>
            </div>
        </div>
		';
		}?>
		
	</div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>
					<?php echo '<strong>'.$Username.'</strong>'; ?>
					<br>
					<strong>
					<?php if($Username != null){echo '<a href="ManageAccount.php?Role=User">Manage Account</a> |';} ?> 
					<?php if($Username == null){echo '<a href="Login.php?Role=User">Login</a>';} else {echo '<a href="Logout.php">Logout</a>';} ?> | 
					<a href="#">Back to top</a>
					</strong><br>
					Copyright &copy; ShoeMart Shoe Store 2017
					</p>
					
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
		function ManagementOnclick(){
			if(confirm("Only Administrators are allowed in this page, Please Login as an Administrator.") == true)
			{
				window.open("Login.php?Role=Admin","_self",null,true);
			}
		}
		
		function addToCartOnclick(ProductID)
		{	
			if(confirm("Are you sure you want to add this product to your cart?") == true){
			window.open("Order.php?ProductID="+ProductID,"_self",null,true);
			}
		}
    </script>
</body>

</html>
