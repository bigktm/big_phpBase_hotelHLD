<?php 

if(isset($_REQUEST['login']))
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	get_userdn($email,$password);
}else{
	$email="";
}

if(isset($_REQUEST['signup']))
{
	header("location:index.php?option=register");
}

if(isset($_GET['create']))
{
	if ($_GET['create'] == 'success') {
		echo "<div class='alert alert-block alert-success fade in'>Create an account success!</div>";
	}
}
?>
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-users"></i> Đăng nhập</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
			<li><i class="fa fa-users"></i>Đăng nhập</li>                
		</ol>
	</div>
</div>

<div class="row">
<div class="col-md-offset-3 col-md-6 col-sm-10 col-xs-12">
		<form class="form-login" method="POST" action="">        
			<div class="login-wrap">
				<p class="login-img"><i class="icon_lock_alt"></i></p>
				<div class="input-group" style="margin-bottom: 5px;">
					<span class="input-group-addon"><i class="icon_profile"></i></span>
					<input type="text" class="form-control" name="email" placeholder="Email" autofocus>
				</div>
				<div class="input-group" style="margin-bottom: 5px;">
					<span class="input-group-addon"><i class="icon_key_alt"></i></span>
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				<button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Đăng nhập</button>
				<button class="btn btn-info btn-lg btn-block" name="signup" type="submit">Đăng ký</button>
			</div>
		</form>
	</div>
</div>
