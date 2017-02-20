<?php
// detect product ID isset for editing mode
if (isset($_POST['product_id'])){

	// include database connection
	require('conDB/conDB.php');

	// product ID
	$product_id = $_POST['product_id'];
	$product_name = addslashes($_POST['product_name']);
	$product_price = str_replace(",", "", addslashes($_POST['product_price']));
	$product_image = " ";

	$IMAGE_UPLOADED = false;

	if (!empty($_FILES['product_image']['name'])) {
		$SRC = $_FILES['product_image']['tmp_name'];
		$DEST = "product_image/".md5(microtime())."."
						.pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
		$product_image = basename($DEST);
		if (!move_uploaded_file($SRC,$DEST)) {
			echo "ย้ายรูปสินค้าไม่สำเร็จ";
			die;
		}
		else {
			$IMAGE_UPLOADED = true;
		}

	}

	// delete product by ID
	$query = "UPDATE `product` SET `name`='".$product_name."', `price`='".$product_price."'";
	if ($IMAGE_UPLOADED === true) {
		$query .= ",image='".$product_image."'";
	}
	$query .= "WHERE `id` LIKE '".$product_id."'";
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
	?>
