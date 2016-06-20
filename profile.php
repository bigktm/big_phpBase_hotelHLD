<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> THÔNG TIN CÁ NHÂN</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="index.php">Trang chủ</a></li>
      <li><i class="fa fa-users"></i>Thông tin Cá nhân</li>                
    </ol>
  </div>
</div>

<section class="panel">
  <div class="panel-body bio-graph-info">
    <h1>Thông tin</h1>
    <div class="row">
      <div class="bio-row">
        <p><span>Name </span>: &nbsp<?php echo $_SESSION['sesUser']['name'];?></p>
      </div>                                              
      <div class="bio-row">
        <p><span>Birthday</span>: &nbsp<?php echo $_SESSION['sesUser']['birthDate'];?></p>
      </div>
      <div class="bio-row">
        <p><span>Occupation </span>: &nbsp<?php echo $_SESSION['sesUser']['occupation'];?></p>
      </div>
      <div class="bio-row">
        <p><span>Email </span>: &nbsp<?php echo $_SESSION['sesUser']['email'];?></p>
      </div>
      <div class="bio-row">
        <p><span>Phone </span>: &nbsp<?php echo $_SESSION['sesUser']['phoneNumber'];?></p>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="row">                                              
  </div>
</section>