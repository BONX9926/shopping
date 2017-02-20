<?php

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "shopping";
$DB_MAIN_LINK = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

if (!!$DB_MAIN_LINK) {
  mysqli_select_db($DB_MAIN_LINK,$DATABASE);
  mysqli_set_charset($DB_MAIN_LINK,"utf8");
} else {

    die("เชื่อมต่อไม่สำเร็จ");
}


?>
