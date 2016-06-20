<?php 
if(isset($_REQUEST['cancel']))
{
    header("location:index.php");
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
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> Đăng ký</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
      <li><i class="fa fa-users"></i>Đăng ký</li>                
    </ol>
  </div>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6 col-sm-10 col-xs-12">
        <form class="form-login" method="POST" action="">        
            <div class="login-wrap">
                <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Password">
                </div>
                <button class="btn btn-info btn-lg btn-block" name="register" type="submit">Đăng ký</button>
                <button class="btn btn-danger btn-lg btn-block" name="cancel" type="submit">Hủy</button>
            </div>
        </form>
    </div>
</div>