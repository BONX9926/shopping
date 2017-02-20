<?php
session_start();

// validate is login
if (isset($_SESSION['login_name']) && isset($_SESSION['role']) ){

	// validate role is not "admin"
	if (strtoupper($_SESSION['role'])!="ADMIN"){
		echo "คุณไม่มีสิทธิ์ในการเข้าถึงหน้าสำหรับจัดการ";
		exit;
	}

	// set default variables
	$editing_mode = false;
	$_PRODUCT = array();
	$_PRODUCT['name'] = "";
	$_PRODUCT['price'] = "";
	$_PRODUCT['image'] = "";


	// detect product ID isset for editing mode
	if (isset($_GET['product_id'])){

		// include database connection
		require('conDB/conDB.php');

		// product ID
		$product_id = addslashes($_GET['product_id']);


		// get product detail
		$query = "SELECT * FROM `product` WHERE `id` LIKE '".$product_id."'";
		if ($result = mysqli_query($DB_MAIN_LINK, $query)){
			$num_rows = mysqli_num_rows($result);
			if ($num_rows === 1){
				$row = mysqli_fetch_assoc($result);
				$_PRODUCT['id'] = $row['id'];
				$_PRODUCT['name'] = $row['name'];
				$_PRODUCT['price'] = $row['price'];
				$_PRODUCT['image'] = $row['image'];

				$editing_mode = true;
			}
		}
	}
?>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<form class="form-horizontal" method="post" action="<?php echo ($editing_mode) ? "edit_product.php" : "add_product.php" ; ?>"
				enctype="multipart/form-data">
				<?php
				if ($editing_mode){
				?>
				<div class="form-group">
					<label for="product_name" class="col-sm-2 control-label">รหัสสินค้า</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" value="<?php echo $_PRODUCT['id']; ?>" disabled />
						<input type="hidden" name="product_id" value="<?php echo $_PRODUCT['id']; ?>" />
					</div>
				</div>
				<?php
				}
				?>
				<div class="form-group">
					<label for="product_name" class="col-sm-2 control-label">ชื่อสินค้า</label>
					<div class="col-sm-10">
						<input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $_PRODUCT['name']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="product_price" class="col-sm-2 control-label">ราคา</label>
					<div class="col-sm-10">
						<input type="text" name="product_price" id="product_price" class="form-control" value="<?php echo $_PRODUCT['price']; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="product_image" class="col-sm-2 control-label">ภาพสินค้า</label>
					<div class="col-sm-10">
						<input type="file" name="product_image" id="product_image" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
						<input type="submit" name="submit" id="submit" class="btn btn-primary" value="<?php echo ($editing_mode) ? "แก้ไขสินค้า" : "เพิ่มสินค้า" ; ?>" />
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<?php
}
else {
	echo "คุณไม่มีสิทธิ์ในการเข้าถึงหน้าดังกล่าว";
}
?><!-- This source code (product form) for educational purposes only. Made by Warin.P -->
