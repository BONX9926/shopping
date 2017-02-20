<?php
	require('conDB/conDB.php');

// detect database connection
if (!empty($DB_MAIN_LINK)){
	// query products
	$query = "SELECT * FROM `product`";
	if ($result = mysqli_query($DB_MAIN_LINK, $query)){
		$num_rows = mysqli_num_rows($result);
		// have some product
		if ($num_rows > 0){ ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="4%">ลำดับ</th>
							<th width="5%">&nbsp;</th>
							<th width="55%">ชื่อสินค้า</th>
							<th width="20%" style="padding-right: 60px;"><div style="text-align:right;">ราคา</div></th>
							<th width="16%"><div style="text-align:center">แก้ไข / ลบ</div></th>
						</tr>
					</thead>
					<tbody><?php
					// each row
					$i=0;
					while ($rows = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo ++$i; ?></td>
							<td><img src="product_image/<?php echo $rows['image']; ?>" width="60" height="60" /></td>
							<td><?php echo $rows['name']; ?></td>
							<td align="right" style="padding-right: 60px;"><?php echo number_format($rows['price'], 2); ?></td>
							<td align="center"><a href="form_product.php?product_id=<?php echo $rows['id']; ?>">แก้ไข</a> / <a href="delete_product.php?product_id=<?php echo $rows['id']; ?>">ลบ</a></td>
						</tr><?php
					} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><?php
		}
		else {
			echo "ไม่พบรายการสินค้า";
		}
	}
	else {
		echo "Query error: ".mysqli_error($DB_MAIN_LINK);
	}
}
else {
	var_dump($DB_MAIN_LINK);
	echo "ไม่พบการเชื่อมต่อฐานข้อมูล";
}
