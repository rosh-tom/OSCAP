<?php require '~connection.php'; 
session_start();
if($_SESSION['loggedin'] !== "1"){
	header("location: login.php");
}

	
$user_id = $_SESSION['user_id'];

$name = $lname = $email = $address = $username = $pass = "";
 $pass =   $newPass =   $confirmPass = ""; 
 

	$searchme = "false";
	$findme = "";
	$errMess = $errMess_1 = $errSuccess = "";
 

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}


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

 	$sql_query = "select * from tbl_users where user_id = '$user_id'";
						$result	= mysqli_query($conn, $sql_query);
						$row = mysqli_fetch_array($result);
						$name = $row['user_fname'];
						$lname = $row['user_lname'];
						$email = $row['user_email'];
						$address = $row['user_address'];
						$username = $row['user_uname'];


	if(isset($_POST['btn_save'])){
			global $conn;
			$name = $_POST['name'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$username = $_POST['username'];
			$password = $_POST['myPassword'];

		$sql_query = "select * from tbl_users where user_id = '$user_id'";
						$result	= mysqli_query($conn, $sql_query);
						$row = mysqli_fetch_array($result);

						if($password != $row['user_upass']){
							$errMess = "Incorrect Password";
						}else{
							$sql_query = "update tbl_users set user_fname = '$name', user_lname = '$lname', user_email = '$email', user_address = '$address', user_uname = '$username' where user_id = '$user_id'";
								mysqli_query($conn, $sql_query);

						}
		 

	}

	if(isset($_POST['btn_savePassword'])){
		 $pass = $_POST['txt_currentPass'];
		 $newPass = $_POST['text_newPass'];
		 $confirmPass = $_POST['text_confirmPass'];

		 		$sql_query = "select * from tbl_users where user_id = '$user_id'";
						$result	= mysqli_query($conn, $sql_query);
						$row = mysqli_fetch_array($result);

						if($pass != $row['user_upass']){
							$errMess_1 = "Incorrect Password";
						}else{
							if($newPass != $confirmPass){
								$errMess_1 = "Password did not match";
							}else{
								$sql_query = "update tbl_users set user_upass = '$newPass' where user_id = '$user_id'";
								mysqli_query($conn, $sql_query);
								$errSuccess = "Password Successfully Change";
							}

						}
		 

	}


 



?>



<!DOCTYPE html>
<html>
<head>
	<title>OSCAP - Manage Account</title>
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

			<div style = "margin-top: 35px;"></div>


			<div class = "backtoindexCART">
			<a href="index.php">Home</a>
			<a href="Vegetables.php">Vegetable</a>
			<a href="fruits.php">Fruits</a>
			<a href="root_crops.php">Root Crops</a>
			<a href="others.php">Others</a>
		</div>

		<center><h1>Messages</h1></center>
		<div class = "divSPACER"></div>

<div class = "accCONTAINER">

	<hr>
			<?php  
				Global $conn;
				$sql_query = "select * from tbl_messages order by id desc";
				$result = mysqli_query($conn, $sql_query);

				while($row = mysqli_fetch_array($result)){


			?>
			<br>
			<p>From: <?php echo $row['fname'] ?></p>
			<p>Email: <?php echo $row['eEmail'] ?></p>
			<p>Message: <?php echo $row['myMessage'] ?></p>
			<hr>

			<?php } ?>
		
</div>
	<br><br><br><br><br><br><br>

	<div class = "footer"><a href="aboutAndContact.php">CONTACT US | ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS | ABOUT US</a></div>
</body>

</html>


<?php 

 ?>