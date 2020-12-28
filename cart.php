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


if(isset($_GET['minus'])){
	global $conn;
	$id = $_GET['minus'];
	$sql = "update tbl_mycart set quantity = quantity-1, total = total-price where id = '$id'";
	mysqli_query($conn,$sql);
 
}

if(isset($_GET['plus'])){
	global $conn;
	$id = $_GET['plus'];
	$sql = "update tbl_mycart set quantity = quantity+1, total = total+price where id = '$id'";
	mysqli_query($conn,$sql);
 
}	
if(isset($_GET['del'])){
	global $conn;
	$id = $_GET['del'];
	$sql = "delete from tbl_mycart where id = '$id'";
	mysqli_query($conn,$sql);

 
}

if(isset($_GET['checkout'])){
	 global $conn;
	 date_default_timezone_set("Asia/Hong_Kong");
	$today = date("F j, Y, g:i a");
 

	 $id = $_GET['checkout'];
	 $sql_query = "select * from tbl_mycart where user_id = '$id' and quantity > 0";
	 $result = mysqli_query($conn, $sql_query);

	 while ($row = mysqli_fetch_array($result)) {
	 	$pro_id = $row['pro_id'];
	 	$pro_name = $row['item_name'];
	 	$pro_price = $row['price'];
	 	$qty = $row['quantity'];
	 	$total = $row['total'];
	  

	 	$sql_query1 = "insert into tbl_history (order_date, user_id, pro_id, pro_name, pro_price, qty, total) values ('$today', '$id', '$pro_id', '$pro_name', '$pro_price', '$qty', '$total')";
	 	mysqli_query($conn, $sql_query1);
	 	 
	 }

	 $sql_query2 = "delete from tbl_mycart where user_id = '$id'";
	 mysqli_query($conn, $sql_query2);

	 $total = 0;
}


if($_SESSION['loggedin'] !== "1"){
	header("location: login.php");}
 
?>



<!DOCTYPE html>
<html>
<head>
 
	</script>
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
		
			<div class = "backtoindexCART">
			<a href="index.php">Home</a>
			<a href="Vegetables.php">Vegetable</a>
			<a href="fruits.php">Fruits</a>
			<a href="root_crops.php">Root Crops</a>
			<a href="others.php">Others</a>
		</div>
	 

			<table>
				<thead class = "CARTcontentTHead">
					<tr>
						<th colspan="2">Item</th>
						<th class = "CARTcontentTPrice">Price</th>
						<th class = "CARTcontentTQuan">Quantity</th>
						<th class = "CARTcontentTtotal">Total</th>
						<th class = "removeCart"></th>

					</tr>					
				</thead>

				<?php 	global $conn;
					$sql_query = "select * from tbl_mycart where quantity > 0 and user_id = '$user_id' order by id desc";
					$result = mysqli_query($conn, $sql_query);
				 
					while ($row = mysqli_fetch_array($result)) {	
					 
						 
 ?>				<tbody>
					<tr>
						<td class = "widthIMG"><img class = "CartIMG" src="images/<?php echo $row['image']?>"></td>
						<td><p><?php echo $row['item_name']; ?></p><p><?php echo $row['item_sdescript'] ?></p></td>
						<td>₱ <?php echo $row['price'] ?> .00 / kls</td>						
						<td> <a href = "cart.php?minus=<?php echo $row['id'] ?>"><button> - </button> </a> <?php echo $row['quantity']; ?> kls <a href="cart.php?plus=<?php echo $row['id'] ?>"><button> + </button></a></td>
						<td>₱ <?php echo $row['total']; ?> .00</td>
						<td><a href="cart.php?del=<?php echo $row['id'] ?>"><button> X </button></a></td>
					</tr>

					<?php }   ?>

				
					
				</tbody>

			</table>
	 

	</div>

		<div class = "buynow">
			 <div class = "Label">Shipping Fee: &nbsp;<span class = "spanme">FREE ✔</span></div>
			 <div class = "Label">Total: &nbsp;<span class = "spanme">  ₱ <?php totalCART() ?> .00</span></div>
			 <div class = "Label">Payment: &nbsp;<span class = "spanme"><input type="radio" name="cod" checked="checked"> Cash on Delivery</span></div>
			  <div class = "btnCheck"><a href="cart.php?checkout=<?php echo $user_id; ?>"><button class = "btnCHECKOUT">CHECK OUT</button></a></div>
		</div>

 
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


echo $total;
	
}
 ?>