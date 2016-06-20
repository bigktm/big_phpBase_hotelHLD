<?php
if (isset($_REQUEST['themtin'])){

	$rs_chondm = 1;
	$rs_title = "";
	$rs_content = "";
	$rs_createDate = date('Y-m-d H:i:s');

	if ($_REQUEST['chondm']){
		$rs_chondm = $_REQUEST['chondm'];
	}

	if ($_REQUEST['title']){
		$rs_title = $_REQUEST['title'];
	}

	if ($_REQUEST['content']){
		$rs_content = $_REQUEST['content'];
	}

	if ($_REQUEST['createDate']){
		$rs_createDate = $_REQUEST['createDate'];
	}

	$result = add_new($rs_title,$rs_content,$rs_createDate,$rs_chondm);
	if($result) {
		header("location:admin.php?option=tintuc");
	}
}

if (isset($_REQUEST['btn_edit'])){
	$rs_id = 0;
	$rs_chondm = 1;
	$rs_title = "";
	$rs_content = "";
	$rs_createDate = date('Y-m-d H:i:s');

	if ($_REQUEST['suatin']){
		$rs_id = $_REQUEST['suatin'];
	}

	if ($_REQUEST['chondm']){
		$rs_chondm = $_REQUEST['chondm'];
	}

	if ($_REQUEST['title']){
		$rs_title = $_REQUEST['title'];
	}

	if ($_REQUEST['content']){
		$rs_content = $_REQUEST['content'];
	}

	if ($_REQUEST['createDate']){
		$rs_createDate = $_REQUEST['createDate'];
	}

	$result = update_new($rs_id,$rs_title,$rs_content,$rs_createDate,$rs_chondm);
	if(!$result) {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không lưu được.</div>";
	}
}

if (isset($_REQUEST['xoatin'])){
	$result = delete_new($_REQUEST['xoatin']);
	if($result) {
		echo "<div class='alert alert-block alert-success fade in'>Xóa thành công.</div>";
	}else {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không xóa được.</div>";
	}
}
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-laptop"></i> Tin tức</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="admin.php">Trang chủ</a></li>
			<li><i class="fa fa-laptop"></i>Tin tức</li>						  	
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
					<li><a href="#tao" data-toggle="tab">Tạo Tin tức</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="danhsach">
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<table class="table table-striped table-advance table-hover" style="width:80%;">
										<thead>
											<tr>
												<th class="text-center"> STT</th>
												<th class="text-center"> Tiêu đề</th>
												<th class="text-center"> Nội dung</th>
												<th class="text-center"> Ngày đăng</th>
												<th class="text-center"> Danh mục</th>
												<th class="text-center"> Phương thức</th>
											</tr>
										</thead>
										<tbody>

											<?php
											$i=1;
											$result_dm = get_news();
											if (isset($_REQUEST['suatin'])){
												$newId = $_REQUEST['suatin'];
											}else{
												$newId = null;
											}
											while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
											{
												if ($row_dm['id'] == $newId) {
													echo "<tr><form name='form_edit' method='POST'>
													<td class='text-center'>{$i}</td>
													<td class='text-center'>
														<input type='text' name='title' value='{$row_dm['title']}'>
													</td>
													<td class='text-center'><input type='text' name='content' value='{$row_dm['content']}'></td>
													<td class='text-center'><input type='date' name='createDate' value='{$row_dm['createDate']}'></td>
													<td class='text-center'>
														<select name='chondm' class='form-control'>";

															$categories = get_categories();
															if(isset($_REQUEST['chondm']))
															{
																$chondm= $_REQUEST['chondm'];
															}else{$chondm=$row_dm['categoryId'];}
															while($row=mysql_fetch_array($categories))
															{
																if($chondm==$row[id])
																{
																	echo "<option value='$row[id]' selected='selected' >$row[name]</option>";
																}else {
																	echo "<option value='$row[id]'>$row[name]</option>";
																}
															}

															echo "</select>
														</td>
														<td class='text-center'>
															<div class='btn-group'>
																<button class='btn btn-info' type='submit' name='btn_edit'><i class='icon_check_alt2'></i>
																</button>
																<a class='btn btn-warning' href='admin.php?option=tintuc'><i class='icon_blocked'></i>
																</a>
															</div>
														</td></form>
													</tr>";
												}else {
													echo "<tr>
													<td class='text-center'>{$i}</td>
													<td class='text-center'>{$row_dm['title']}</td>
													<td class='text-center'>{$row_dm['content']}</td>
													<td class='text-center'>{$row_dm['createDate']}</td>
													<td class='text-center'>{$row_dm['name']}</td>
													<td class='text-center'>
														<div class='btn-group'>
															<a class='btn btn-success' href='admin.php?option=tintuc&suatin={$row_dm['id']}'><i class='icon_pencil-edit'></i></a>
															<a class='btn btn-danger' href='admin.php?option=tintuc&xoatin={$row_dm['id']}'><i class='icon_close_alt2'></i></a>
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
								<label class="control-label col-lg-4">Tiêu đề</label>

								<div class="col-lg-4">
									<input type="text" id="title" name="title" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-4">Nội dung</label>

								<div class="col-lg-4">
									<textarea id="content" name="content" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-4">Ngày tạo</label>

								<div class="col-lg-4">
									<input type="date" id="createDate" name="createDate" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-4">Danh mục</label>
								<div class="col-lg-4">
									<select name="chondm" class="form-control">
										<option value='' >Chọn Danh mục</option>

										<?php

										$categories = get_categories();
										if(isset($_REQUEST['chondm']))
										{
											$chondm= $_REQUEST['chondm'];
										}else{$chondm='';}
										while($row=mysql_fetch_array($categories))
										{
											if($chondm==$row[id])
											{
												echo "<option value='$row[id]' selected='selected' >$row[name]</option>";
											}else {
												echo "<option value='$row[id]'>$row[name]</option>";
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-actions no-margin-bottom" style="text-align:center;">
								<input type="submit" value="Thêm tin" name="themtin" class="btn btn-primary btn-lg " />
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
