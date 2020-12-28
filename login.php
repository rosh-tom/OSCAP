 	<?php 

 	session_start(); 	
 	require '~connection.php';		
		if(isset($_SESSION["loggedin"]) == "1"){
	  	header("location: index.php");
	  exit;

	}

 
$user = $pass = $Errmsg = "";



	if(isset($_POST['btn_login'])){

		global $conn;
		$user = $_POST['username'];
		$pass = $_POST['password'];


		if(empty($user) or empty($pass)){

			$Errmsg = "Username or password cannot be empty";  

		}
		else{ 

				$result = mysqli_query($conn, "select * from tbl_users where user_uname = '".$user."'");
				 if(!$result){ 
			 		$Errmsg = "Username or password is incorrect";  
				 }else{ 

					$row = mysqli_fetch_array($result); 

				if ($row['user_uname'] == $user && $row['user_upass'] == $pass){

					$_SESSION["fname"] = $row["user_fname"];
					$_SESSION["lname"] = $row["user_lname"];
					$_SESSION["username"] = $row["user_name"];
					$_SESSION["user_id"] = $row["user_id"];
					$_SESSION["user_type"] = $row["user_type"];					
					$_SESSION["loggedin"] = "1";

					if($_SESSION["user_type"] == "admin"){
						header('location: index.php');
					}
					else{
					header("location: index.php");

					}

			 }else{
			 	$Errmsg = "Username or password is incorrect";  
			 }
			}
		 
		}




	}
 ?>


<html>
	
		<head>
		
			<title> Online Store of Cantilan Agricultural Products </title>
			
			<link rel="stylesheet" type="text/css" href="~tomastyle_login.css"/>
			<link rel="icon" href="webimages/logo.png">

			 
		</head>
		

		<body>
			<form method="post" autocomplete="off" action = "login.php">

			<div class = "container">

				<div class = "frm_login">

					<div class = "login_avatar">						
							<label>ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS </label>
					</div>

					<div class = "login_avatar">						
						<img class = "avatar" src="webimages/userlogin_avatar.png">
					</div>				


					<div class = "login_wrapper">

						<div class = "login_itemgroup">						
							<input type="text" name="username" placeholder="Username" />
						</div>

						<div class = "login_itemgroup">					
							<input type="password" name="password" placeholder="Password">
						</div>

						<div class = "login_itemgroup">					
							<input class = "login_btn" type="submit" name = "btn_login" value = "Log in">
						</div>

						<div class = "login_avatar">						
							<label style = "margin-right: 20px; color: red; ">&nbsp; <?php echo $Errmsg; ?> &nbsp;</label>
						</div>

						<div class = "login_lower">						
							<a href = "index.php" class = "forgotpass">Home</a>
							<a href = "register.php" class = "regist">Create New Account? </a>
						</div>

					</div>
					


				</div>
				

			</div>

		</form>
			
		
		</body>

</html>