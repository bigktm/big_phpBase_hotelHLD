<?php
if (isset($_REQUEST['themphong'])){

	$rs_roomtypeId = 1;
	$rs_label = "";
	$rs_description = "";

	if ($_REQUEST['label']){
		$rs_label = $_REQUEST['label'];
	}

	if ($_REQUEST['description']){
		$rs_description = $_REQUEST['description'];
	}

	$result = add_phong($rs_label,$rs_description,$rs_roomtypeId);
	if($result) {
		header("location:admin.php?option=caocap");
	}
}

if (isset($_REQUEST['btn_save'])){
	$rs_id = 0;
	$rs_chonstatus = 0;
	$rs_label = "";
	$rs_description = "";
	$rs_roomtypeId = 1;

	if ($_REQUEST['suaphong']){
		$rs_id = $_REQUEST['suaphong'];
	}

	if ($_REQUEST['chonstatus']){
		$rs_chonstatus = $_REQUEST['chonstatus'];
	}

	if ($_REQUEST['label']){
		$rs_label = $_REQUEST['label'];
	}

	if ($_REQUEST['description']){
		$rs_description = $_REQUEST['description'];
	}

	$result = update_phong($rs_id,$rs_label,$rs_description,$rs_chonstatus,$rs_roomtypeId);
	if(!$result) {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không lưu được.</div>";
	}
}

if (isset($_REQUEST['xoaphong'])){
	$result = delete_phong($_REQUEST['xoaphong']);
	if($result) {
		echo "<div class='alert alert-block alert-success fade in'>Xóa thành công.</div>";
	}else {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không xóa được.</div>";
	}
}
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-laptop"></i> Phòng cao cấp</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="admin.php">Trang chủ</a></li>
			<li><i class="fa fa-laptop"></i>Phòng cao cấp</li>						  	
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#thue" data-toggle="tab">Phòng đã thuê</a>
					</li>
					<li><a href="#trong" data-toggle="tab">Phòng còn trống</a>
					</li>
					<li><a href="#tao" data-toggle="tab">Tạo Phòng</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="thue">
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<table class="table table-striped table-advance table-hover" style="width:80%;">
										<thead>
											<tr>
												<th class="text-center"> STT</th>
												<th class="text-center"> Tên phòng</th>
												<th class="text-center"> Mô tả</th>
												<th class="text-center"> Tình trạng</th>
												<th class="text-center"> Loại phòng</th>
												<th class="text-center"> Phương thức</th>
											</tr>
										</thead>
										<tbody>

											<?php
											$i=1;
											$status = "";
											if (isset($_REQUEST['suaphong'])){
												$phongId = $_REQUEST['suaphong'];
											}else{
												$phongId = null;
											}
											$result_dm = get_rooms(1,1);
											while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
											{
												if ($row_dm['id'] == $phongId){

													echo "<tr><form name='form_edit' method='POST'>
													<td class='text-center'>{$i}</td>
													<td class='text-center'><input type='text' name='label' value='{$row_dm['label']}'></td>
													<td class='text-center'><input type='text' name='description' value='{$row_dm['description']}'></td>
													<td class='text-center'>
														<select name='chonstatus' class='form-control'>";

															if(isset($_REQUEST['chonstatus']))
															{
																$chonstatus = $_REQUEST['chonstatus'];
															}else{$chonstatus = $row_dm[status];}

															if($chonstatus == 1)
															{
																echo "<option value='1' selected='selected' >Đã thuê</option><option value='0'>Trống</option>";
															}else {
																echo "<option value='1' >Đã thuê</option><option value='0' selected='selected' >Trống</option>";
															}

															echo "</select></td>
															<td class='text-center'><input type='text' name='name' value='{$row_dm['name']}' disabled></td>
															<td class='text-center'>
																<div class='btn-group'>
																	<button class='btn btn-info' type='submit' name='btn_save'><i class='icon_check_alt2'></i>
																	</button>
																	<a class='btn btn-warning' href='admin.php?option=caocap'><i class='icon_blocked'></i>
																	</a>
																</div></td></form>
															</tr>";
														}else {
															if ($row_dm['status'] == 1) {
																$status = "Đã thuê";
															}else {
																$status = "Trống";
															}
															echo "<tr>
															<td class='text-center'>{$i}</td>
															<td class='text-center'>{$row_dm['label']}</td>
															<td class='text-center'>{$row_dm['description']}</td>
															<td class='text-center'>{$status}</td>
															<td class='text-center'>{$row_dm['name']}</td>
															<td class='text-center'>
																<div class='btn-group'>
																	<a class='btn btn-success' href='admin.php?option=caocap&suaphong={$row_dm['id']}'><i class='icon_pencil-edit'></i></a>
																	<a class='btn btn-danger' href='admin.php?option=caocap&xoaphong={$row_dm['id']}'><i class='icon_close_alt2'></i></a>
																</div></td>
															</tr>";
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
							<div class="tab-pane fade" id="trong">
								<div class="row">
									<div class="col-lg-12">
										<section class="panel">
											<table class="table table-striped table-advance table-hover" style="width:80%;">
												<thead>
													<tr>
														<th class="text-center"> STT</th>
														<th class="text-center"> Tên phòng</th>
														<th class="text-center"> Mô tả</th>
														<th class="text-center"> Tình trạng</th>
														<th class="text-center"> Loại phòng</th>
														<th class="text-center"> Phương thức</th>
													</tr>
												</thead>
												<tbody>

													<?php
													$i=1;
													$status = "";
													if (isset($_REQUEST['suaphong'])){
														$phongId = $_REQUEST['suaphong'];
													}else{
														$phongId = null;
													}
													$result_dm = get_rooms(1,0);
													while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
													{
														if ($row_dm['id'] == $phongId){

															echo "<tr><form name='form_edit' method='POST'>
															<td class='text-center'>{$i}</td>
															<td class='text-center'><input type='text' name='label' value='{$row_dm['label']}'></td>
															<td class='text-center'><input type='text' name='description' value='{$row_dm['description']}'></td>
															<td class='text-center'>
																<select name='chonstatus' class='form-control'>";

																	if(isset($_REQUEST['chonstatus']))
																	{
																		$chonstatus = $_REQUEST['chonstatus'];
																	}else{$chonstatus = $row_dm[status];}

																	if($chonstatus == 1)
																	{
																		echo "<option value='1' selected='selected' >Đã thuê</option><option value='0'>Trống</option>";
																	}else {
																		echo "<option value='1' >Đã thuê</option><option value='0' selected='selected' >Trống</option>";
																	}

																	echo "
																</select>
															</td>
															<td class='text-center'><input type='text' name='name' value='{$row_dm['name']}' disabled></td>
															<td class='text-center'>
																<div class='btn-group'>
																	<button class='btn btn-info' type='submit' name='btn_save'><i class='icon_check_alt2'></i>
																	</button>
																	<a class='btn btn-warning' href='admin.php?option=caocap'><i class='icon_blocked'></i>
																	</a>
																</div></td></form>
															</tr>";
														}else {
															if ($row_dm['status'] == 1) {
																$status = "Đã thuê";
															}else {
																$status = "Trống";
															}
															echo "<tr>
															<td class='text-center'>{$i}</td>
															<td class='text-center'>{$row_dm['label']}</td>
															<td class='text-center'>{$row_dm['description']}</td>
															<td class='text-center'>{$status}</td>
															<td class='text-center'>{$row_dm['name']}</td>
															<td class='text-center'>
																<div class='btn-group'>
																	<a class='btn btn-success' href='admin.php?option=caocap&suaphong={$row_dm['id']}'><i class='icon_pencil-edit'></i></a>
																	<a class='btn btn-danger' href='admin.php?option=caocap&xoaphong={$row_dm['id']}'><i class='icon_close_alt2'></i></a>
																</div></td>
															</tr>";
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
										<label class="control-label col-lg-4">Tên phòng</label>

										<div class="col-lg-4">
											<input type="text" id="label" name="label" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-4">Mô tả</label>

										<div class="col-lg-4">
											<textarea id="description" name="description" class="form-control" /></textarea>
										</div>
									</div>
									<div class="form-actions no-margin-bottom" style="text-align:center;">
										<input type="submit" value="Thêm Phòng" name="themphong" class="btn btn-primary btn-lg " />
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>