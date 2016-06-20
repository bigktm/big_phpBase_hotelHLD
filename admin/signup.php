<?php 
require 'ham.php';
if(isset($_SESSION['currUser']))
{
  header("location:admin.php");
}

if(isset($_REQUEST['cancel']))
{
  header("location:login.php");
}

if(isset($_REQUEST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if($password === $repassword) {
        register_user($name,$email,$password);
    }else {
        echo "<div class='alert alert-block alert-danger fade in'>Password not match?</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Admin Register</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-img3-body">

    <div class="container">

      <form class="login-form" method="POST" action="">        
        <div class="login-wrap">
            <p class="text-center" style="font-weight: 400;font-size: 27px;">Register an Account</p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name">
          </div>
          <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Password">
        </div>
        <button class="btn btn-info btn-lg btn-block" name="register" type="submit">Register</button>
        <button class="btn btn-danger btn-lg btn-block" name="cancel" type="submit">Cancel</button>
    </div>
</form>
</div>
</body>
</html>
