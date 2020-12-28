<?php require '~connection.php'; ?>



<!DOCTYPE html>
<html>
<head>
	<title>OSCAP</title>
	<link rel="icon" href="webimages/logo.png">
	<link rel="stylesheet" type="text/css" href="~tomastyle.css">
</head>
<body>

	<div class = "wallpaper">
		<p class ="wallpaperLabel" > ONLINE STORE OF CANTILAN AGRICULTURAL PRODUCTS</p>

	</div>

	<div class = "homenav">
		<a href=""><img class = "logoIMG" src="webimages/logo.png"></a><div class = "logoLABEL">OSCAP</div>

		<div class = "leftsideNav">
			<div class = "searching">
			<input type="text" name="">
			<input type="submit" name="" value = "Search">
			</div>
			<div class = "cartLOGO" ><a href=""><img src="webimages/cart.png"></a></div>
			<div class = "accountLOGO"> <a href=""> <img src="webimages/account.png"></a></div>
		</div>
	</div>

	<div class = "contentLabel">
		<h1>Featured Products</h1>
		<div class = "insideContentLabel">
			<a href="index.php" class = "selected">All</a>
			<a href="Vegetables.php" class = "notselected">Vegetables</a>
			<a href="fruits.php" class = "notselected">Fruits</a>
			<a href="root_crops.php" class = "notselected">Root Crops</a>
			<a href="others.php" class = "notselected">Others</a>
		</div>
	</div>

 <div class = "content">

		<?php 
			global $conn;
			$sql_query = "select * from tbl_products where status = 1";
			$result = mysqli_query($conn, $sql_query);
			while($row = mysqli_fetch_array($result)){
			
		 ?>
			<div class = "card">
				<a href = ""><img class = "myimg" src="<?php	echo 'images/'. $row['image'] . ' '; ?>" /></a>
	  				<h1><?php echo $row['name']; ?></h1>
	 				<p class="price"> <?php echo "₱ ". $row['price'] . ".00"; ?></p>
	  				<p> <?php echo $row['short_description'] ?>.</p>
	  				<a href = "index.php?addtocart=<?php echo $row['id']; ?>"><p><button>Add to Cart</button></p></a>
			</div>

		<?php } ?>


</div>
	<div class = "footer"> **tomas**</div>





</body>
</html>