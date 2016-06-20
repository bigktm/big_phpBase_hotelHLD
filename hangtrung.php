<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> Hạng trung</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
      <li><i class="fa fa-users"></i>Hạng trung</li>                
    </ol>
  </div>
</div>
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
					</tr>
				</thead>
				<tbody>

					<?php
					$i=1;
					$status = "";
					$result_dm = get_rooms_user(2);
					while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
					{
						
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
						<td class='text-center'>{$row_dm['name']}</td></tr>";
						$i++;
					}
					?>
				</tbody>
			</table>
		</section>
	</div>
</div>