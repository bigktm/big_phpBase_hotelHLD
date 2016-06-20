<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-users"></i> Danh mục tin</h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
			<li><i class="fa fa-users"></i>Danh mục tin</li>                
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
						<th class="text-center"> Tiêu đề</th>
						<th class="text-center"> Nội dung</th>
						<th class="text-center"> Ngày đăng</th>
						<th class="text-center"> Danh mục</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$i=1;
					if(isset($_REQUEST['danhmucId']))
					{
						$result_dm = get_news_user($_REQUEST['danhmucId']);
					}else {
						$result_dm = "";
					}

					while($row_dm = mysql_fetch_array($result_dm, MYSQL_ASSOC))
					{
						echo "<tr>
						<td class='text-center'>{$i}</td>
						<td class='text-center'><a href='index.php?option=tintuc&chitiet={$row_dm['id']}'>{$row_dm['title']}</a></td>
						<td class='text-center'>{$row_dm['content']}</td>
						<td class='text-center'>{$row_dm['createDate']}</td>
						<td class='text-center'>{$row_dm['name']}</td></tr>";
						$i++;
					}

					?>
				</tbody>
			</table>
		</section>
	</div>
</div>
