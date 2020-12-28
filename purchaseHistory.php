<?php 
session_start();
$user_id = $_SESSION['user_id'];
require '~connection.php';

$searchme = "false";
	$findme = "";
 

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}

	?>

 

<!DOCTYPE html>
<html>
<head>
	<title>OSCAP - Cart</title>
	<link rel="stylesheet" type="text/css" href="~tomastyle.css">
	<link rel="icon" href="webimages/logo.png">
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
	

	<div class = "CARTcontent">

		<div class = "divSPACER"></div>
		
			<div class = "backtoindexCART">
			<a href="index.php">Home</a>
			<a href="Vegetables.php">Vegetable</a>
			<a href="fruits.php">Fruits</a>
			<a href="root_crops.php">Root Crops</a>
			<a href="others.php">Others</a>
		</div>

		<div class = "divSPACER"></div>
	 
<table>
				<thead class = "CARTcontentTHead">
					<tr>
						<th>Date</th>
						<th>Item</th>
						<th class = "CARTcontentTPrice">Price</th>
						<th class = "CARTcontentTQuan">Quantity</th>
						<th class = "CARTcontentTtotal">Total</th>
						<th class = "removeCart">Status</th>

					</tr>					
				</thead>

				<?php 	global $conn;
					$sql_query = "select * from tbl_history where user_id = '$user_id' order by id desc";
					$result = mysqli_query($conn, $sql_query);
				 
					while ($row = mysqli_fetch_array($result)) {	
					 
						 
 ?>				<tbody>
					<tr>
						<td><p><?php echo $row['order_date'] ?></p></td>
						<td><p><?php echo $row['pro_name']; ?></p></td>
						<td>₱ <?php echo $row['pro_price'] ?> .00 / kls</td>						
						<td>  <?php echo $row['qty']; ?> kls  </td>
						<td>₱ <?php echo $row['total']; ?> .00</td>
						<td> ✔ </td>
					</tr>

					<?php }   ?>

				
					
				</tbody>

			</table>
			 
	</div>

 		<div style = "margin-top: 57px; width: 100%;"></div>
			<div class = "footer"><a href="aboutAndContact.php">CONTACT US | ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS | ABOUT US</a></div>


	</form>


</body>
</html>


<?php 

function displayCARTcount(){
global $conn, $count, $user_id;
	$sql = "select * from tbl_mycart where quantity > 0 and user_id = '$user_id'";
	$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$count = $count + 1;
 
		}

echo $count;
	
}


function totalCART(){
global $conn, $total, $user_id;
	$sql = "select * from tbl_mycart where quantity > 0 and user_id = '$user_id'";
	$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$total = $total + $row['total'];
 
		}

echo $total + 20;
	
}
 ?>