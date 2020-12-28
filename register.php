 	<?php 

 	require '~connection.php';

 	if(isset($_POST['btn_createAcc'])){
 		global $conn;
 		$fname = $_POST['fname'];
 		$lname = $_POST['lname'];
 		$email = $_POST['email'];
 		$address = $_POST['address'];
 		$username = $_POST['username'];
 		$password = $_POST['password'];
 		$recovery = $_POST['recovery'];
 		$status = "1";
 		$usertype = "user";
 		

 		$sql_query = "insert into tbl_users (user_fname, user_lname, user_email, user_address, user_uname, user_upass, user_recovery, user_status, user_type) values ('$fname', '$lname', '$email', '$address', '$username', '$password', '$recovery', '$status', '$usertype ')";

 	//	echo $fname." ".$lname." ".$email." ".$address." ".$username." ".$password." ".$recovery." ".$status." ".$usertype;

 		mysqli_query($conn, $sql_query);

 		header('location: index.php');
 	}

 	if(isset($_POST['btn_login'])){

 		header("location: login.php");

 	}

 ?>


<html>
	
		<head>
		
			<title> OSCAP - Register new User</title>			
			<link rel="stylesheet" type="text/css" href="~tomastyle_login.css"/>
			<link rel="icon" href="webimages/logo.png">			 
		</head>
		

		<body>
			<form method="post" autocomplete="off" action = "register.php">

			<div class = "container">

				<div class = "frm_login">

					<div class = "login_wrapper">
						 
					 <div class = "createLABEL">Create new Account</div>
				 
						 <div class = "leftdivider">
						 	<p>First Name :</p>
						 	<p>Last Name : </p>
						 	<p>Email : </p>
						 	<p>Address: </p>
						 	<p>Username: </p>
						 	<p>Password: </p>
						 	<p>Recovery: </p>

						 </div>

						 <div class = "rightdivider">
						  <input type="text" name="fname" placeholder="First Name" />
						  <input type="text" name="lname" placeholder="Last Name" />
						  <input type="text" name="email" placeholder="Email" />
						  <input type="text" name="address" placeholder="Address" />
						  <input type="text" name="username" placeholder="Username" />
						  <input type="password" name="password" placeholder="Password" />
						  <input type="text" name="recovery" placeholder="Recovery" />
						 </div>						 
						 <div class = "btnCreate">

						 	<input class = "cancel" type="submit" name="btn_login" Value = "Log in instead">
						 	<input class = "btn_createAcc" type="submit" name="btn_createAcc" Value = "Save">

						 </div>
						 
					 
					 

					</div>
					


				</div>
				

			</div>

		</form>
			
		
		</body>

</html>