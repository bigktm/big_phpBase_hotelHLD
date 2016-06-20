<?php
if (isset($_REQUEST['themdanhmuc'])){

	$rs_name = "";

	if ($_REQUEST['name']){
		$rs_name = $_REQUEST['name'];
	}

	$result = add_danhmuc($rs_name);
	if($result) {
		header("location:admin.php?option=danhmuc");
	}
}

if (isset($_REQUEST['btn_save'])){
	$rs_id = 0;
	$rs_name = "";

	if ($_REQUEST['suadanhmuc']){
		$rs_id = $_REQUEST['suadanhmuc'];
	}

	if ($_REQUEST['name']){
		$rs_name = $_REQUEST['name'];
	}

	$result = update_danhmuc($rs_id,$rs_name);
	if(!$result) {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không lưu được.</div>";
	}
}

if (isset($_REQUEST['xoadanhmuc'])){
	$result = delete_danhmuc($_REQUEST['xoadanhmuc']);
	if($result) {
		echo "<div class='alert alert-block alert-success fade in'>Xóa thành công.</div>";
	}else {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không xóa được.</div>";
	}
}
?>
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-laptop"></i> Danh mục</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="admin.php">Trang chủ</a></li>
			<li><i class="fa fa-laptop"></i>Danh mục</li>						  	
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#danhsach" data-toggle="tab">Danh sách</a>
					</li>
					<li><a href="#tao" data-toggle="tab">Tạo Danh mục</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="danhsach">
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<table class="table table-striped table-advance table-hover" style="width:50%;">
										<thead>
											<tr>
												<th class="text-center"> STT</th>
												<th class="text-center"> Tên</th>
												<th class="text-center"> Action</th>
											</tr>
										</thead>
										<tbody>

											<?php
											$i=1;
											$result = get_categories();
											if (isset($_REQUEST['suadanhmuc'])){
												$danhmucId = $_REQUEST['suadanhmuc'];
											}else{
												$danhmucId = null;
											}
											while($row = mysql_fetch_array($result, MYSQL_ASSOC))
											{
												if ($row['id'] == $danhmucId){
													echo "<tr><form name='form_edit' method='POST'>
													<td class='text-center'>{$i}</td>
													<td class='text-center'><input type='text' name='name' value='{$row['name']}'></td>
													<td class='text-center'>
														<div class='btn-group'>
															<button class='btn btn-info' type='submit' name='btn_save'><i class='icon_check_alt2'></i>
															</button>
															<a class='btn btn-warning' href='admin.php?option=danhmuc'><i class='icon_blocked'></i>
															</a>
														</div>
													</td></form></tr>";
												}else {
													echo "<tr>
													<td class='text-center'>{$i}</td>
													<td class='text-center'>{$row['name']}</td>
													<td class='text-center'>
														<div class='btn-group'>
															<a class='btn btn-success' href='admin.php?option=danhmuc&suadanhmuc={$row['id']}'><i class='icon_pencil-edit'></i></a>
															<a class='btn btn-danger' href='admin.php?option=danhmuc&xoadanhmuc={$row['id']}'><i class='icon_close_alt2'></i></a>
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
								<label class="control-label col-lg-4">Name</label>

								<div class="col-lg-4">
									<input type="text" id="name" name="name" class="form-control" />
								</div>
							</div>
							<div class="form-actions no-margin-bottom" style="text-align:center;">
								<input type="submit" value="Thêm Danh mục" name="themdanhmuc" class="btn btn-primary btn-lg " />
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>