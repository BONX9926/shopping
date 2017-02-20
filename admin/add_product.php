<?php
/*
[product_image] => Array
        (
            [name] => 2.jpg
            [type] => image/jpeg
            [tmp_name] => C:\xampp\tmp\php5731.tmp
            [error] => 0
            [size] => 2110
        )
*/

  require('conDB/conDB.php');
  $name   = addslashes($_POST['product_name']);
  $price  = addslashes($_POST['product_price']);
  $image  = "";
  if (isset($_FILES['product_image'])) {
    $SRC = $_FILES['product_image']['tmp_name'];
    $DEST = "product_image/".md5(microtime())."."
            .pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
    $image = basename($DEST);

    if (!move_uploaded_file($SRC,$DEST)) {
      echo "ย้ายรูปสินค้าไม่สำเร็จ";

    }
  }






    $sql = "INSERT INTO `product`(`id`,`name`, `image`, `price`, `last_update`)
            VALUES (NULL,'{$name}','{$image}','{$price}',Now())";

            if ($result = mysqli_query($DB_MAIN_LINK,$sql)) {
                $product = mysqli_insert_id($DB_MAIN_LINK);
                echo "เพิ่มสินค้าเรียบร้อยแล้ว หมายเลขสินค้า".$product;
                echo "<br/>";
  		          echo '<a href="form_product.php class="btn btn-primary">ย้อนกลับ</a>';
            }else {
              echo mysqli_error($con);
            }

?>
