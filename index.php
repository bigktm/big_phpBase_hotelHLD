<?php 
require 'ham.php';
ob_start();
if(isset($_GET['option']))
{
	$option = $_GET['option'];
}else {
	$option ="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Hotel app">
	<meta name="author" content="">
	<title>Khách Sạn Hoàng Linh Đan</title>

	<!-- Bootstrap CSS -->    
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- bootstrap theme -->
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<!--external css-->
	<!-- font icon -->
	<link href="css/elegant-icons-style.css" rel="stylesheet" />
	<link href="css/font-awesome.min.css" rel="stylesheet" /> 
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style-responsive.css" rel="stylesheet" />

</head>
<body>
	<!-- Nav-bar fixed-top -->
	<!-- Fixed navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><strong>Hoàng Linh Đan</strong> Hotel</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Trang chủ</a></li>
					<li><a href="index.php?option=gioithieu">Giới thiệu</a></li>
					<li><a href="index.php?option=lienhe">Liên hệ</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dịch vụ Phòng <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?option=caocap">Cao cấp</a></li>
							<li><a href="index.php?option=hangtrung">Hạng trung</a></li>
							<li><a href="index.php?option=hangthuong">Hạng thường</a></li>
						</ul>
					</li>
				</ul>

				<?php
				if (isset($_SESSION['sesUser'])) {
					echo "<ul><li class='dropdown navbar-right'style=' margin-top: 3px;'>
					<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
						<span class='profile-ava'>
							<img alt='avatar' width='40px' height='40px' src='img/".$_SESSION['sesUser']['avatar']."'>
						</span>
						<span class='username'>".$_SESSION['sesUser']['email']."</span>
						<b class='caret'></b>
					</a>
					<ul class='dropdown-menu'>
						<div class='log-arrow-up'></div>
						<li class='eborder-top'>
							<a href='index.php?option=profile'><i class='icon_profile'></i> Thông tin cá nhân</a>
						</li>
						<li>
							<a href='index.php?option=logout'><i class='icon_key_alt'></i> Đăng xuất</a>
						</li>
					</ul>
				</li></ul>";
			}else {
				echo "<ul class='nav navbar-nav navbar-right'><li><a href='index.php?option=login'>Đăng nhập</a></li>
				<li><a href='index.php?option=register'>Đăng ký</a></li></ul>";
			}

			?>
		</div>
	</div>
</nav>

<div class="container main-contents">
	<div class="row">
		<div class="col-xs-6 col-md-8">
			<?php
			if($option){
				if($option == 'login'){
					require 'login.php';
				}else if($option == 'register'){
					require 'register.php';
				}else if($option == 'lienhe'){
					require 'lienhe.php';
				}else if($option == 'gioithieu'){
					require 'gioithieu.php';
				}else if($option == 'caocap'){
					require 'caocap.php';
				}else if($option == 'hangtrung'){
					require 'hangtrung.php';
				}else if($option == 'hangthuong'){
					require 'hangthuong.php';
				}else if($option == 'profile'){
					require 'profile.php';
				}else if($option == 'logout'){
					require 'logout.php';
				}else if($option == 'danhmuc'){
					if (isset($_REQUEST['danhmucId'])) {
						require 'danhmuc.php';
					}
				}else if($option == 'tintuc'){
					if (isset($_REQUEST['chitiet'])) {
						require 'chitiettintuc.php';
					}
				}else{
					require 'main.php';
					// $dem = 0;
					// while ( $dem < 17) {

					// 	for ($i=0; $i < 60; $i++) { 
					// 		if ($i < 10) {
					// 			echo $dem.":0".$i.", ";
					// 		}else {
					// 			echo $dem.":".$i.", ";
					// 		}
					// 	}
					// 	echo "<br/>";
					// 	$dem += 1;
					// }
				}
			}else{
				require 'main.php';
				// $dem = 0;
				// while ( $dem <= 17) {

				// 	for ($i=0; $i < 60; $i++) { 
				// 		if ($i < 10) {
				// 			echo $dem.":0".$i.", ";
				// 		}else {
				// 			echo $dem.":".$i.", ";
				// 		}
				// 	}
				// 	echo "<br/>";
				// 	$dem += 1;
				// }
			}
			?>
		</div>
		<div class="col-xs-6 col-md-3 col-md-offset-1">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" style="height: 34px;">
						<img class="image-search" src="images/icon_search.png" />
					</button>
				</span>
			</div><!-- /input-group -->
			<div class="categories">
				<h3>Danh mục Tin tức</h3>
				<ul class="list-nav-right">
					<?php
					$categories = get_categories();

					while($row_dm_mnu=mysql_fetch_array($categories))
					{
						echo "<li class='asidebar-li'><a href='index.php?option=danhmuc&danhmucId={$row_dm_mnu['id']}'>{$row_dm_mnu['name']}</a></li>";
					}
					?>
				</ul>
			</div>
			<div class="popular">
				<h3>Bài viết mới nhất</h3>
				<ul class="list-nav-right">
					<?php
					$lastnew = get_lastnew();

					while($row_lastnew_mnu=mysql_fetch_array($lastnew))
					{
						echo "<li class='asidebar-li'><a href='index.php?option=tintuc&chitiet={$row_lastnew_mnu['id']}'>{$row_lastnew_mnu['title']}</a></li>";
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div><!-- End #container -->

<!-- Footer -->
<footer class="footer-distributed">

	<div class="footer-left">

		<h3>Company<span>logo</span></h3>

		<p class="footer-links">
			<a href="index.php">Trang chủ</a>
			·
			<a href="index.php?option=gioithieu">Giới thiệu</a>
			·
			<a href="index.php?option=lienhe">Liên hệ</a>
			·
			<a href="index.php?option=caocap">Phòng cao cấp</a>
			·
			<a href="index.php?option=hangtrung">Phòng hạng trung</a>
			·
			<a href="index.php?option=hangthuong">Phòng hạng thường</a>
		</p>

		<p class="footer-company-name">Hoàng Linh Đan Hotel &copy; 2016</p>
	</div>

	<div class="footer-center">

		<div>
			<i class="fa fa-map-marker"></i>
			<p><span>21, đường Bạch Đằng </span> Đà Nẵng, Việt Nam</p>
		</div>

		<div>
			<i class="fa fa-phone"></i>
			<p>+05113 555 555</p>
		</div>

		<div>
			<i class="fa fa-envelope"></i>
			<p><a href="mailto:support@hoanglinhdan.com">support@hoanglinhdan.com</a></p>
		</div>

	</div>

	<div class="footer-right">

		<p class="footer-company-about">
			<span>Hoàng Linh Đan Hotel</span>
			Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
		</p>

		<div class="footer-icons">

			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-github"></i></a>

		</div>

	</div>

</footer>
<!-- JQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src="js/main.js"></script>
</body>
</html>