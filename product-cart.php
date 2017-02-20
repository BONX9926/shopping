<?php

	require_once('admin/conDB/conDB.php');
	require_once('function-products.php');
	if(isset($_POST) && count($_POST) > 0 ){

		foreach ($_POST as $key => $value) {
			if(strpos($key, "product-") == 0){
				$_id = str_replace("product-","",$key);
				$_product = get_products($DB_MAIN_LINK, $_id);
				if ($_product['result'] === true) {
					$_info = $_product['data'][$_id];
					print_r($_info);
					print $_info['name']." ".$_info['price'];
				}
			}
		}
	}

?>
