<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <title>Login</title>
  <style media="screen">
    body{
      font-family: 'Kanit', sans-serif;
    }
    #form{
      padding-top: 150px;
    }
  </style>
</head>
<?php
  session_start();

  if (isset($_SESSION['login_name']) && isset($_SESSION['role'])) {
      echo "<body>
              <div class='container'>
                <div class='row'>
                  <div class='col-md-offset-4 col-md-4'>";
                  echo "สวัสดี ".$_SESSION['login_name'];
                  echo "<br/>คุณมีสิทธิ์เป็น ".$_SESSION['role'];
                  echo "<br/><a href='action_logout.php' class='btn btn-primary'>Logout</a>
                        <br/><a href='page_admin.php' class='btn btn-primary'>คลังสินค้า</a>
                    <a href=\"#\" class='btn btn-primary'>กลับสู่หน้าหลัก</a>
                    </div>
                  </div>
              </div>
            </body>";
  }else {
?>
  <body>
    <div id="form" class="container">
      <div class="row">
        <div class="col-md-offset-4 col-md-4">
          <form class="" action="action_login.php" method="post">
              <h1><i class="glyphicon glyphicon-user"></i> Login</h1>
              <label>Username</label>
              <input type="text" class="form-control" name="username" value="" /><br/>
              <label>Password</label>
              <input type="password" class="form-control" name="passwd" value=""/><br/>
              <button type="submit" name="submit_button" value="login" class="btn btn-success btn-block">Login</button>
            </br/>
            </br/>
          </form>
        </div>

      </div>
    </div>

  </body>

<?php } ?>
</html>
