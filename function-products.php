<?php
    require('admin/conDB/conDB.php');
    function get_products($DB_MAIN_LINK, $id=null){
        $data = array();
        $return = array();
        $return['result'] = false;
        $sql = "SELECT * FROM `product`";

        if($id != null && trim($id) != ''){
            $sql .= "WHERE id = '".addslashes($id)."' ";
            
        }

        $result = mysqli_query($DB_MAIN_LINK, $sql) or die ('[Funt:get_products_all]'.mysql_error());
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
            $data[ $row['id'] ]	= $row;
            }
            $return['result'] = true;
            $return['data'] = $data;
          }
          return $return;
        }
      


      ?>
