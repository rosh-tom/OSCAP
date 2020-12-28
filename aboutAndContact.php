<?php 
session_start();
 
require '~connection.php';

$searchme = "false";
	$findme = "";
	$ErrMess = "";
 

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}
 	
 	if(isset($_POST['btn_sendMessage'])){
 		 Global $conn;
 		 $fname = $_POST['txt_fname'];
 		 $email = $_POST['txt_email'];
 		 $mess = $_POST['txt_message'];
 		 $sql_query = "insert into tbl_messages (fname, eEmail, myMessage) values ('$fname', '$email', '$mess')";
 		if( mysqli_query($conn, $sql_query)){
 			$ErrMess = "Message successfully sent";
 		}else{
 			$ErrMess = "Something went wrong";
 		}

 		}


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


		<div class = "backtoindexCART" style = "margin-top: 20px; margin-bottom: 20px;">
			<a href="index.php">Home</a>
			<a href="Vegetables.php">Vegetable</a>
			<a href="fruits.php">Fruits</a>
			<a href="root_crops.php">Root Crops</a>
			<a href="others.php">Others</a>
		</div>

		<center><h1>ABOUT US</h1></center>
	 

			<div class = "kami">
				<div class = "card" style="margin-left: 24px;">
					<img class = "myimg" src="images/DSCN0721.jpg" />
	  				<h1>RUSTOM D. CADENAS</h1>
	  				<p>"Tawag sa mga singkit? -Shyness"</p>	 				 
				</div>
				<div class = "card">
					<img class = "myimg" src="images/shel.jpg" />
	  				<h1>SHELLY F. ESPAÑA</h1>
	  				<p>"Ito ang Tama" #Redhorse</p>	 				 
				</div>
				<div class = "card">
					<img   class = "myimg" src="images/jorimlee.jpg" />
	  				<h1>JORIM LEE</h1>
	  				<p>A wiseman once said: "Ayus Lang"</p>	 				 
				</div>


				<center><h1>CONTACT US</h1></center>
<form action = "aboutAndContact.php" method="post">
				<div class = "contact">
					<label>Full Name: </label><br>
					<input type="text" name="txt_fname"> <br><br>
					<label>Email:</label><br>
					<input type="text" name="txt_email"> <br><br>
					<label>Message:</label><br>
					<textarea name = "txt_message"></textarea><br><br>
					<button name = "btn_sendMessage">SEND</button><br><br> <p><?php echo $ErrMess; ?></p>
				</div>

			</div>
	
</form>
	 
 
			<div class = "footer"><a href="aboutAndContact.php">CONTACT US | ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS | ABOUT US</a></div>
 
 

	


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