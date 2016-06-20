<?php 
$i=1;
if(isset($_REQUEST['chitiet']))
{
	$result_dm = get_news_detail($_REQUEST['chitiet']);
	$row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC);
	$result_user = get_username($row_dm['userId']);
	$row_user = mysql_fetch_array($result_user, MYSQL_ASSOC);
}

?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-users"></i> Chi tiết Tin tức</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
			<li><i class="fa fa-users"></i>Chi tiết Tin tức</li>                
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $row_dm['title']; ?>
			</div>
			<div class="panel-body">
				<p><?php echo $row_dm['content']; ?>
				</p>
				
				<br>
				<address>
					<strong>Ngày đăng : </strong>
					<?php echo $row_dm['createDate']; ?>
					&nbsp&nbsp&nbsp&nbsp&nbsp
					<strong>Đăng bởi : </strong>
					<?php echo $row_user['name']; ?>
				</address>
			</div>
		</div>
	</div>
</div>
