<?php
if (isset($_REQUEST['themnguoidung'])){

	$rs_chonloai = 0;
	$rs_name = "";
	$rs_email = "";
	$rs_password = "";
	$rs_repassword = "";
	$rs_birthDate = date('Y-m-d H:i:s');
	$rs_occupation = "";
	$rs_phoneNumber = "";

	if ($_REQUEST['chonloai']){
		$rs_chonloai = $_REQUEST['chonloai'];
	}

	if ($_REQUEST['name']){
		$rs_name = $_REQUEST['name'];
	}

	if ($_REQUEST['email']){
		$rs_email = $_REQUEST['email'];
	}

	if ($_REQUEST['password']){
		$rs_password = $_REQUEST['password'];
	}

	if ($_REQUEST['repassword']){
		$rs_repassword = $_REQUEST['repassword'];
	}

	if ($_REQUEST['birthDate']){
		$rs_birthDate = $_REQUEST['birthDate'];
	}

	if ($_REQUEST['occupation']){
		$rs_occupation = $_REQUEST['occupation'];
	}

	if ($_REQUEST['phoneNumber']){
		$rs_phoneNumber = $_REQUEST['phoneNumber'];
	}

	if ($rs_password !== $rs_repassword) {
		echo "<div class='alert alert-block alert-danger fade in'>Mật khẩu không khớp.</div>";
	}else{
		$result = add_nguoidung($rs_name,$rs_email,$rs_password,$rs_chonloai,$rs_birthDate,$rs_occupation,$rs_phoneNumber);
		if($result) {
			header("location:admin.php?option=nguoidung");
		}
	}
	
}

if (isset($_REQUEST['btn_save'])){
	$rs_id = 0;
	$rs_chonloai = 0;
	$rs_name = "";
	$rs_occupation = "";
	$rs_phoneNumber = "";
	$rs_birthDate = date('Y-m-d H:i:s');

	if ($_REQUEST['suanguoidung']){
		$rs_id = $_REQUEST['suanguoidung'];
	}

	if ($_REQUEST['chonloai']){
		$rs_chonloai = $_REQUEST['chonloai'];
	}

	if ($_REQUEST['name']){
		$rs_name = $_REQUEST['name'];
	}

	if ($_REQUEST['birthDate']){
		$rs_birthDate = date($_REQUEST['birthDate']);
	}

	if ($_REQUEST['occupation']){
		$rs_occupation = $_REQUEST['occupation'];
	}

	if ($_REQUEST['phoneNumber']){
		$rs_phoneNumber = $_REQUEST['phoneNumber'];
	}

	$result = update_nguoidung($rs_id,$rs_name,$rs_birthDate,$rs_occupation,$rs_phoneNumber,$rs_chonloai);
	if(!$result) {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không lưu được.</div>";
	}else {
		echo "<div class='alert alert-block alert-success fade in'>Đã cập nhật thông tin.</div>";
	}
}

if (isset($_REQUEST['xoanguoidung'])){
	$result = delete_nguoidung($_REQUEST['xoanguoidung']);
	if($result) {
		echo "<div class='alert alert-block alert-success fade in'>Xóa thành công.</div>";
	}else {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không xóa được.</div>";
	}
}
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-laptop"></i> Người dùng</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="admin.php">Trang chủ</a></li>
			<li><i class="fa fa-laptop"></i>Người dùng</li>						  	
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#danhsach" data-toggle="tab">Danh sách</a>
					</li>
					<li><a href="#tao" data-toggle="tab">Tạo người dùng</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="danhsach">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<section class="panel">
									<table class="table table-striped table-advance table-hover" style="width:97%;">
										<thead>
											<tr>
												<th class="text-center"> STT</th>
												<th class="text-center"> Tên</th>
												<th class="text-center"> Email</th>
												<th class="text-center"> Ngày sinh</th>
												<th class="text-center"> Nghề nghiệp</th>
												<th class="text-center"> SĐT</th>
												<th class="text-center"> Loại người dùng</th>
												<th class="text-center"> Phương thức</th>
											</tr>
										</thead>
										<tbody>

											<?php
											$i=1;
											$result_dm = get_nguoidung();
											if (isset($_REQUEST['suanguoidung'])){
												$nguoidungId = $_REQUEST['suanguoidung'];
											}else{
												$nguoidungId = null;
											}
											while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
											{
												if ($row_dm['id'] == $nguoidungId) {
													echo "<tr><form name='form_nguoidung' method='POST'>
													<td class='text-center'>{$i}</td>
													<td class='text-center'>
														<input type='text' name='name' value='{$row_dm['name']}'>
													</td>
													<td class='text-center'>{$row_dm['email']}'</td>
													<td class='text-center'><input type='date' name='birthDate' value='{$row_dm['birthDate']}'></td>
													<td class='text-center'>
														<input type='text' name='occupation' value='{$row_dm['occupation']}'>
													</td><td class='text-center'>
													<input type='text' name='phoneNumber' value='{$row_dm['phoneNumber']}'>
												</td>
												<td class='text-center'>
													<select name='chonloai' class='form-control'>";

														if(isset($_REQUEST['chonloai']))
														{
															$chonloai = $_REQUEST['chonloai'];
														}else{$chonloai = $row_dm[type];}

														if($chonloai == 1)
														{
															echo "<option value='1' selected='selected' >Admin</option><option value='0'>User</option>";
														}else {
															echo "<option value='1' >Admin</option><option value='0' selected='selected' >User</option>";
														}

														echo "
													</select>
												</td>
												<td class='text-center'>
													<div class='btn-group'>
														<button class='btn btn-info' type='submit' name='btn_save'><i class='icon_check_alt2'></i>
														</button>
														<a class='btn btn-warning' href='admin.php?option=nguoidung'><i class='icon_blocked'></i>
														</a>
													</div>
												</td></form>
											</tr>";
										}else {
											if ($row_dm['type'] == 1) {
												$type = "Admin";
											}else {
												$type = "User";
											}
											echo "<tr>
											<td class='text-center'>{$i}</td>
											<td class='text-center'>{$row_dm['name']}</td>
											<td class='text-center'>{$row_dm['email']}</td>
											<td class='text-center'>{$row_dm['birthDate']}</td>
											<td class='text-center'>{$row_dm['occupation']}</td>
											<td class='text-center'>{$row_dm['phoneNumber']}</td>
											<td class='text-center'>{$type}</td>
											<td class='text-center'>
												<div class='btn-group'>
													<a class='btn btn-success' href='admin.php?option=nguoidung&suanguoidung={$row_dm['id']}'><i class='icon_pencil-edit'></i></a>
													<a class='btn btn-danger' href='admin.php?option=nguoidung&xoanguoidung={$row_dm['id']}'><i class='icon_close_alt2'></i></a>
												</div>
											</td></tr>";
										}

										$i++;
									}

									?>
								</tbody>
							</table>
						</section>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="tao">
				<br/>
				<form action="" class="form-horizontal" method="POST" id="block-validate">
					<div class="form-group">
						<label class="control-label col-lg-4">Tên </label>

						<div class="col-lg-4">
							<input type="text" id="name" name="name" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Email </label>

						<div class="col-lg-4">
							<input type="text" id="email" name="email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Mật khẩu </label>

						<div class="col-lg-4">
							<input type="password" id="password" name="password" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Nhập lại Mật khẩu </label>

						<div class="col-lg-4">
							<input type="password" id="repassword" name="repassword" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Ngày sinh</label>

						<div class="col-lg-4">
							<input type="date" id="birthDate" name="birthDate" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Nghề nghiệp </label>

						<div class="col-lg-4">
							<input type="text" id="occupation" name="occupation" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">SĐT </label>

						<div class="col-lg-4">
							<input type="text" id="phoneNumber" name="phoneNumber" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Loại người dùng</label>
						<div class="col-lg-4">
							<select name="chonloai" class="form-control">
								<?php
								if(isset($_REQUEST['chonloai']))
								{
									$chonloai = $_REQUEST['chonloai'];
								}else{$chonloai = 0;}

								if($chonloai == 1)
								{
									echo "<option value='1' selected='selected' >Admin</option><option value='0'>User</option>";
								}else {
									echo "<option value='1' >Admin</option><option value='0' selected='selected' >User</option>";
								}
								?>


							</select>
						</div>
					</div>
					<div class="form-actions no-margin-bottom" style="text-align:center;">
						<input type="submit" value="Thêm người dùng" name="themnguoidung" class="btn btn-primary btn-lg " />
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
