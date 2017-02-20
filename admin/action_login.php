<?php
	session_start();

	error_reporting(-1);

	# 1
	require('conDB/conDB.php');

	//include("");

	# 2
	$username = $_POST['username'];
	$password = $_POST['passwd'];
	$query =
	"SELECT * FROM `user_accont` WHERE username LIKE '".$username."'";

	if ($result = mysqli_query($DB_MAIN_LINK, $query)){
		$num_rows = mysqli_num_rows($result);

		echo "<br/>";
		echo "Num rows: ".$num_rows;
		if ($num_rows === 1){
			$rows = mysqli_fetch_assoc($result);
			echo '<br/>';
			if ($rows['userpasswd'] == $password){
				// รหัสผ่านตรงกัน

				$_SESSION['login_name'] = $rows['full_name'];
				$_SESSION['role'] = $rows['role'];


				// set default redirect URL
				$redirect_url = "login.php";

				switch (strtoupper($_SESSION['role'])){
					case "ADMIN" :
						$redirect_url = "page_admin.php";
					break;
					case "STAFF" :
						$redirect_url = "page_staff.php";
					break;
					case "CUSTOMER" :
						$redirect_url = "login.php";
					break;
				}

				
				header("location: ".$redirect_url);
			}
			else {
				// รหัสผ่านผิด
				echo "รหัสผ่านไม่ถูกต้อง";
				echo "<a href=\"login.php\">กลับสู่หน้าหลัก</a>";
			}

			/*while ($rows = mysqli_fetch_assoc($result)){
				echo "<pre>";
				print_r($rows);
				echo "</pre>";
			}*/
		}
	}
	else {
		echo mysqli_error($DB_MAIN_LINK);
	}









	/*if ($_POST['username'] == "admin"
		&& $_POST['passwd'] == "11223344"){

		$_SESSION['login_name'] = "Warin P";
		$_SESSION['role'] = "ADMIN";


		echo "Login สำเร็จ";
		echo "<a href=\"login.php\">กลับสู่หน้าหลัก</a>";
	}
	else {
		echo "Login ไม่สำเร็จ";
	}


	echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/

	/*$name = 123456;
	echo "<div>action_login file</div>";
	echo $name;

	print "action_login file";
	*/
?>
