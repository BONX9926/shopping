<?php
// detect product ID isset for editing mode
if (isset($_GET['product_id'])){

	// include database connection
	require('conDB/conDB.php');

	// product ID
	$product_id = addslashes($_GET['product_id']);

	// delete product by ID
	$query = "DELETE FROM `product` WHERE `id` LIKE '".$product_id."'";
	if ($result = mysqli_query($DB_MAIN_LINK, $query)){

		// redirect to ref page
		if (isset($_SERVER['HTTP_REFERER'])){
			header("location: ".$_SERVER['HTTP_REFERER']);
		}
		else {
			echo "ลบสินค้าเรียบร้อย";
		}
	}
	else {
		echo mysqli_error($DB_MAIN_LINK);
	}
}
