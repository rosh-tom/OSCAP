<?php 


function displayCARTcount(){
global $conn, $count;
	$sql = "select * from tbl_mycart where quantity > 0";
	$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$count = $count + 1;
 
		}

echo $count;
	
}


function totalCART(){
global $conn, $total;
	$sql = "select * from tbl_mycart where quantity > 0";
	$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			$total = $total + $row['total'];
 
		}

echo $total;
	
}



 ?>