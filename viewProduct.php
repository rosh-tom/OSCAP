<?php require '~connection.php'; 
session_start();

	
	$searchme = "false";
	$findme = "";

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}


	if(isset($_GET['addtocart'])){
		$id = $_GET['addtocart'];
		
$my_id =  $_SESSION['user_id'];
		global $conn;


		if($_SESSION['loggedin'] == "1"){

		$my_id = $_SESSION['user_id'];
		$sql_query = "select * from tbl_products where id = '$id'";
		$result = mysqli_query($conn, $sql_query);
		$row = mysqli_fetch_array($result);
		$pro_id = $row['id'];
		$image = $row['image'];
		$item = $row['name'];
		$sdes = $row['short_description'];
		$price = $row['price'];
		$quantity = 1;
		$total = $price*$quantity;


		$cart_sql = "select * from tbl_mycart where pro_id = '$id'";
		$cart_result = mysqli_query($conn, $cart_sql);
		$cart_row = mysqli_fetch_array($cart_result);
		$cart_id = $cart_row['pro_id'];
		$cart_user_id = $cart_row['user_id'];

		$cart_total = $cart_row['price'];

		if($id == $cart_id and $cart_user_id == $my_id ){
$my_id =  $_SESSION['user_id'];
			$sql_query = "update tbl_mycart set quantity = quantity+1, total = total+'$cart_total' where pro_id = '$id' and user_id = '$my_id'";
	mysqli_query($conn,$sql_query);
	header('location: index.php');
		}else{
			$my_id =  $_SESSION['user_id'];
			
		$get_sql = "insert into tbl_mycart (user_id, image, pro_id, item_name, item_sdescript, price, quantity, total) values ('$my_id', '$image', '$pro_id', '$item', '$sdes', '$price', '$quantity', '$total' )";
		mysqli_query($conn, $get_sql);
		header('location: index.php');
		}

	}else{
		header("location: login.php");
	}


	}




?>


<html>

<head>
 <link rel="stylesheet" type="text/css" href="~tomastyle.css">
</head>

<body>
 
			<div class = "homenav">
				<a href="index.php"><img class = "logoIMG" src="webimages/logo.png"></a><div class = "logoLABEL">OSCAP</div>
				
<form method="post" action="search.php" autocomplete="off">
				<div class = "leftsideNav">
					<div class = "searching">
					<input class = "inpsearch" type="text" name="text_search" placeholder="want to find something?" value = "<?php echo $findme; ?>">
					<input class = "btnsearch" type="submit" name="btn_search" value = "Search">
					</div>

</form>

					
					<?php if(isset($_SESSION["loggedin"])=="0"){ ?>
						<div class = "loginLOGO" ><a href="login.php">Login</a></div> <div class = "breaker"> | </div>
						<div class = "registerLOGO"> <a href="register.php">Register</a></div>
					<?php }else{ ?>
							<div class = "cartLOGO" ><a href="cart.php"><img src="webimages/cart.png"><div class = "cartItems"><?php displayCARTcount(); ?></div></a></div><div class = "breaker"> | </div>
							<div class = "accountLOGO"><img src="webimages/account.png"><div class = "accName"><?php echo $_SESSION['fname']; ?></div> 
								<div class="navi_items_btn_dropdown">
									<a href="cart.php">My Cart</a>
									<a href="purchaseHistory.php">Purchase History</a>
									<a href="manageAccount.php">Account Settings</a>
									<?php if($_SESSION['user_type'] == "admin"){ ?>
									<a href="admin.php">Manage Products</a>
									<a href="viewMessages.php">View Messages</a>
									<?php } ?>
									<a href="index.php?destroy">Log Out</a>							 					 						
								</div>
							</div>
					 
					<?php } ?>
				</div>
			</div>


	<?php 
		global $conn;
		$pro_id = $_GET['viewProduct']; 
		$sql_query = "select * from tbl_products where id = '$pro_id'";
		$result = mysqli_query($conn, $sql_query);

		$row = mysqli_fetch_array($result);



	 


	?>
	<div class = "imageProduct">
		<img src = "images/<?php echo $row['image']; ?>">
	</div>



	<div class = "descriProduct">
		<h1><?php echo $row['name'] ?></h1>
		<h2> P <?php echo $row['price'] ?> .00</h2>
		<h3> <?php echo $row['short_description'] ?> </h3>
		<p><?php echo $row['description'] ?> </p>
		<a href="viewProduct.php?addtocart=<?php echo $row['id'] ?>"><button class = "btn_addme">Add to Cart</button></a>

		<div class = "backtoindex">
			<a href="index.php">Home</a>
			<a href="Vegetables.php">Vegetable</a>
			<a href="fruits.php">Fruits</a>
			<a href="root_crops.php">Root Crops</a>
			<a href="others.php">Others</a>
		</div>
	</div>

	<div class = "footer"><a href="aboutAndContact.php">CONTACT US | ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS | ABOUT US</a></div>
</body>



</html>


<?php function displayCARTcount(){
global $conn, $count;
$my_id = $_SESSION['user_id'];
	$sql = "select * from tbl_mycart where quantity > 0 and user_id = '$my_id'";
	$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$count = $count + 1;
 
		}

echo $count;
	
} ?>