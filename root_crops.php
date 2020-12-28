<?php require '~connection.php'; 
	//require '~functions.php';
	 
session_start();

	

	$searchme = "false";
	$findme = "";

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}


	if(isset($_GET['destroy'])){
		session_destroy();

		header("location: index.php");


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



<!DOCTYPE html>
<html>
<head>
	<title>OSCAP</title>
	<link rel="icon" href="webimages/logo.png">
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
	<div class = "contentLabel">
		<h1>Root Crops</h1>
		<div class = "insideContentLabel">
			<a href="all.php" class = "notselected">All</a>
			<a href="Vegetables.php" class = "notselected">Vegetables</a>
			<a href="fruits.php" class = "notselected">Fruits</a>
			<a href="root_crops.php" class = "selected">Root Crops</a>
			<a href="others.php" class = "notselected">Others</a>
		</div>
	</div>

 <div class = "content">

		<?php 
			global $conn;
			if($searchme == "false"){
				 
			$sql_query = "select * from tbl_products where status = 1 and category = 'Root Crops' order by id desc";
			}else{
				$sql_query = "select * from tbl_products where status = 1 and name like '%".$findme."%'";
				 
			}
			$result = mysqli_query($conn, $sql_query);

			while($row = mysqli_fetch_array($result)){
			
		 ?>
			<div class = "card">
				<a href = "viewProduct.php?viewProduct=<?php echo $row['id']; ?>"><img class = "myimg" src="<?php	echo 'images/'. $row['image'] . ' '; ?>" /></a>
	  				<h1><?php echo $row['name']; ?></h1>
	 				<p class="price"> <?php echo "₱ ". $row['price'] . ".00"; ?></p>
	  				<p> <?php echo $row['short_description'] ?>.</p>
	  				<a href = "index.php?addtocart=<?php echo $row['id']; ?>"><p><button>Add to Cart</button></p></a>
			</div>

		<?php } ?>


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