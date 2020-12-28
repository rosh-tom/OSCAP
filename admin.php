<?php 
	// ------------------------------------------ required files ------------------------------------------
require '~connection.php';
session_start();

 if($_SESSION['user_type'] == "admin"){
 $searchme = "false";
	$findme = "";

	if(isset($_POST['btn_search'])){
		$findme = $_POST['text_search'];
		$searchme = "true";
		 

	}




	

	$edit_state = "false";
	$id = 0;

	global $image;
		$name_ = "";
		$short_description_ = "";
		$description_ = "";
		$price_ = "";		
		$category_ = "";
		$status_ = "";
		$imagehidden_ = "";
	 
	// ------------------------------------------ Upload Image -----------------------------------------
	 
	 if(isset($_POST['inp_btn_upload'])){ 
		$target = "images/".basename($_FILES['inp_pro_image']['name']);
		$image = $_FILES['inp_pro_image']['name'];
 		move_uploaded_file($_FILES['inp_pro_image']['tmp_name'], $target); 		 
	}

	// ------------------------------------------- Btn Save -------------------------------------------------

	if(isset($_POST['btn_save'])){
		global $conn;

		$imagehidden = $_POST['imagehidden'];
		$name = $_POST['p_name'];
		$short_description = $_POST['p_sdesciption'];
		$description = $_POST['p_des'];
		$price = $_POST['p_price'];		
		$category = $_POST['p_category'];
		$status = $_POST['available'];

		$sql_query = "insert into tbl_products (name, short_description, description, price, category, status, image) values ('$name', '$short_description', '$description', '$price', '$category', '$status', '$imagehidden')";		

		mysqli_query($conn, $sql_query);
	 
	}

	// ----------------------------------------------------------Btn Update -------------------------------------
	if(isset($_POST['btn_update'])){
		global $conn;

		$imagehidden = $_POST['imagehidden'];
		$name = $_POST['p_name'];
		$short_description = $_POST['p_sdesciption'];
		$description = $_POST['p_des'];
		$price = $_POST['p_price'];		
		$category = $_POST['p_category'];
		$status = $_POST['available'];
		$id = $_POST['forid'];

		$sql_query = "update tbl_products set name = '$name', short_description = '$short_description', description = '$description', price = '$price', category = '$category', status = '$status' where id = '$id'"; 	

		mysqli_query($conn, $sql_query);
 
	}

	// ---------------------------------------------- Delete Product --------------------------------------------

	if(isset($_GET['del'])){
		$id = $_GET['del'];	
		$sql_query =   "delete from tbl_products where id = $id";
 		mysqli_query($conn, $sql_query);
 		header("location: admin.php");

	}
	// --------------------------------------------- Edit Product ------------------------------------------------

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$edit_state = "true";

		$result = mysqli_query($conn, "select * from tbl_products where id = $id");
		$row = mysqli_fetch_array($result);

		
		$name_ = $row['name'];
		$short_description_ = $row['short_description'];
		$description_ = $row['description'];
		$price_ = $row['price'];		
		$category_ = $row['category'];
		$status_ = $row['status'];
		$image = $row['image'];
 
	}





 ?>

<!-- ************************************************ HTML CODES *************************************************  -->
<!DOCTYPE html>
<html>
<head>
	<title>OSCAP - Admin</title>
	<link rel="stylesheet" type="text/css" href="~tomastyle.css">
	<link rel="icon" href="webimages/logo.png">
</head>
<body>

	<form method = "post" action = "admin.php" enctype="multipart/form-data">

		<div class = "homenav">
				<a href="index.php"><img class = "logoIMG" src="webimages/logo.png"></a><div class = "logoLABEL">OSCAP</div>
				
<form method="post" action="search.php" autocomplete="off">
				<div class = "leftsideNav">
					<div class = "searching">
					<input class = "inpsearch" type="text" name="text_search" placeholder="want to find something?" value = "<?php echo $findme; ?>">
					<input class = "btnsearch" type="submit" name="btn_search" value = "Search">
					</div>




					<?php if(isset($_SESSION["loggedin"])=="0"){ ?>
						<div class = "loginLOGO" ><a href="login.php">Login</a></div> <div class = "breaker"> | </div>
						<div class = "registerLOGO"> <a href="register.php">Register</a></div>
					<?php }else{ ?>
							<div class = "cartLOGO" ><a href="cart.php"><img src="webimages/cart.png"><div class = "cartItems"><?php displayCARTcount(); ?></div></a></div><div class = "breaker"> | </div>
							<div class = "accountLOGO"> <a href=""> <img src="webimages/account.png"><div class = "accName"><?php echo $_SESSION['fname']; ?></div> </a> 
								<div class="navi_items_btn_dropdown">
									<a href="cart.php">My Cart</a>
									<a href="purchaseHistory.php">Purchase History</a>
									<a href="manageAccount.php">Account Settings</a>
									<?php if($_SESSION['user_type'] == "admin"){ ?>
									<a href="admin.php">Manage Products</a>
									<?php } ?>
									<a href="index.php?destroy">Log Out</a>							 					 						
								</div>
							</div>
					 
					<?php } ?>
				</div>
			</div>

		<div class = "leftside">

			<h2 class = "tomasTITLE">Options</h2>
			<hr class = "tomasHR">

				<input type="file" name="inp_pro_image" size = "50"> <input class = "class_upload" type="submit" name="inp_btn_upload" value="Upload">
					
					<div class = "div_img">
						<img src="<?php echo 'images/'. $image . ' ';  ?>">	

					</div>

					<div class = "items">
						<div> Product Name:</div>
						<div class="tomas_inpt"><input type="text" name="p_name" value = "<?php echo $name_ ?>"> <br></div>


						<div>Product Short Description : </div>
						<div class="tomas_inpt"><input type="text" name="p_sdesciption" value = "<?php echo $short_description_; ?>"> <br></div> 	


						<div>Product Description: </div>
						<div class="tomas_inpt"><textarea name="p_des"><?php echo $description_; ?></textarea> </div>

						<div>Product Price: </div>
						<div class="tomas_inpt"><input type="text" name="p_price"  value = "<?php echo $price_; ?>"> <br></div> 
						<div>Product Catergory:</div>
						<div class = "tomas_inpt">
							<select class = "dropme" name = "p_category">
								<OPTION <?php if($category_=="Vegetables"){ ?> selected <?php } ?>>Vegetables</OPTION>
								<OPTION <?php if($category_=="Root Crops"){ ?> selected <?php } ?>>Root Crops</OPTION>
								<OPTION <?php if($category_=="Fruits"){ ?> selected <?php } ?>>Fruits</OPTION>
								<OPTION <?php if($category_=="Others"){ ?> selected <?php } ?>>Others</OPTION>
							 </select>
						</div>
						<div>Available? :												
							<input class = "avail" type="radio" name="available" value = "1" <?php if($status_=="1"){  ?> checked="checked" <?php } ?>> Yes
							<input class = "avail" type="radio" name="available" value = "0" <?php if($status_=="0"){  ?> checked="checked" <?php } ?>> No			 
						</div>

						<input type="hidden" name="imagehidden" value = "<?php echo $image; ?>">
					 	<input type="hidden" name="forid" value = "<?php echo $id; ?>">
					 

						<?php if($edit_state == "false"): ?>
						<div class = "addproduct"><input type="submit" name="btn_save" value="Add Product"> </div>
						<?php else: ?>
						<div class = "addproduct"><input type="submit" name="btn_update" value="Save"> </div>
						<?php endif	 ?>
						 
					</div>



			
		</div>

		<div class = "rightside">
			<h2 class = "tomasTITLE">Product List</h2>
			<hr class = "tomasHR">

				<div class = "productlist">
					<table>
						<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Short Description</th>
									<th>Description</th>
									<th>Price</th>
									<th>Category</th>
									<th>Status</th>
									<th colspan = "2">Action</th>
								</tr>			
						</thead>
						<tbody>	


								<?php 

								if($searchme == "false"){
											$sql_query = "select * from tbl_products order by id desc"; 
								}else{
								
										$sql_query = "select * from tbl_products where name like '%".$findme."%' order by id desc";
										}
									$result = mysqli_query($conn, $sql_query);



									while ($row = mysqli_fetch_array($result)) {
										$des = $row['description'];

										if (strlen($des) > 50){
											 $stringCut = substr($des, 0, 50);
    										 $endPoint = strrpos($stringCut, ' ');
    										 $des = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    										 $des .= '...';

										}
								
								?>
										<tr>
											<td> <img src="images/<?php echo $row['image']; ?>"></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['short_description']; ?></td>
											<td><?php echo $des; ?></td>
											<td><?php echo "₱" .$row['price'];?></td>
											<td><?php echo $row['category']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><a class="edit_btn" href = "admin.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
											<td><a class="del_btn" href = "admin.php?del=<?php echo $row['id']; ?>">Delete</a>	</td>
										</tr>

								<?php 	} ?>
						</tbody>
					</table>
					

				</div>
			

		</div>

			<div class = "footer"><a href="aboutAndContact.php">CONTACT US | ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS | ABOUT US</a></div>


	</form>


</body>
</html>

<?php }else{
	 	header("location: index.php");
} ?>


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