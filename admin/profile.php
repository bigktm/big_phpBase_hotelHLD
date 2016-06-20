<?php
if (isset($_REQUEST['btn_save'])){
  $rs_name = 1;
  $rs_occupation = "";
  $rs_phoneNumber = "";
  $rs_birthDate = "";

  if ($_REQUEST['name']){
    $rs_name = $_REQUEST['name'];
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

  $result = update_profile($rs_name,$rs_birthDate,$rs_occupation,$rs_phoneNumber);
  if(!$result) {
    echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không lưu được.</div>";
  }else {
    update_session();
    echo "<div class='alert alert-block alert-success fade in'>Cập nhật thành công.</div>";
  }
}

if (isset($_REQUEST['doimatkhau'])){

  $rs_mkcu = "";
  $rs_mkmoi = "";
  $rs_remk = "";

  if ($_REQUEST['oldpassword']){
    $rs_mkcu = $_REQUEST['oldpassword'];
  }

  if ($_REQUEST['newpassword']){
    $rs_mkmoi = $_REQUEST['newpassword'];
  }

  if ($_REQUEST['repassword']){
    $rs_remk = $_REQUEST['repassword'];
  }
  if ($rs_mkcu && $rs_mkmoi && $rs_remk && $_SESSION['currUser']['password'] === $rs_mkcu) {
    $result = update_password($rs_mkmoi);
    if($result) {
      update_session();
      echo "<div class='alert alert-block alert-success fade in'>Cập nhật thành công.</div>";
    }else {
      echo "<div class='alert alert-block alert-danger fade in'>Lỗi! Không cập mật khẩu được.</div>";
    }
  }else if($rs_mkmoi !== $rs_remk){
    echo "<div class='alert alert-block alert-danger fade in'>Nhập mật khẩu không khớp.</div>";
  }else if(!$rs_mkcu){
    echo "<div class='alert alert-block alert-danger fade in'>Nhập mật khẩu cũ.</div>";
  }else if(!$rs_mkmoi){
    echo "<div class='alert alert-block alert-danger fade in'>Nhập mật khẩu mới.</div>";
  }else if(!$rs_remk){
    echo "<div class='alert alert-block alert-danger fade in'>Nhập lại mật khẩu mới.</div>";
  }else {
    echo "<div class='alert alert-block alert-danger fade in'>Mật khẩu không đúng.</div>";
  }
}

/*upload ảnh*/
function rand_string($length) {
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen( $chars );
$str = "";
for( $i = 0; $i < $length; $i++ ) {
$str .= $chars[ rand( 0, $size - 1 ) ];
 }
return $str;
}

if(isset($_FILES['image'])){
  $errors= array();
  $file_name = $_FILES['image']['name'];
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

  $expensions= array("jpeg","jpg","png");

  if(in_array($file_ext,$expensions)=== false){
    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
  }

  if($file_size > 2097152){
    $errors[]='File size must be excately 2 MB';
  }

  if(empty($errors)==true){
    $my_string = rand_string(6);
    $my_string = $my_string."-".$file_name;
    move_uploaded_file($file_tmp,"img/".$my_string);
    $result = update_avatar($my_string);
    update_session();
    if($result) {
      echo "<div class='alert alert-block alert-success fade in'>Upload thành công.</div>";
      header('location:admin.php?option=profile');
    }else {
      echo "<div class='alert alert-block alert-danger fade in'>Không cập nhật được ảnh đại diện.</div>";
    }
    
  }else{
   print_r("<div class='alert alert-block alert-danger fade in'>".$errors."</div>");
 }
}
?>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-users"></i> THÔNG TIN CÁ NHÂN</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="admin.php">Home</a></li>
      <li><i class="fa fa-users"></i>Thông tin Cá nhân</li>                
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#danhsach" data-toggle="tab">Thông tin</a>
          </li>
          <li><a href="#tao" data-toggle="tab">Thay đổi Mật khẩu</a>
          </li>
          <li><a href="#avatar" data-toggle="tab">Ảnh đại diện</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade in active" id="danhsach">
            <div class="row">
              <div class="col-lg-12">
                <section class="panel">

                  <?php
                  if (isset($_REQUEST['suaprofile'])){
                    echo "<div class='panel-body bio-graph-info'>
                    <form name='form_profile' method='POST'>
                      <div class='row'>
                        <div class='bio-row'>
                          <p><span>Name </span> <input type='text' id='name' name='name' class='form-control' value='{$_SESSION['currUser']['name']}' /></p>
                        </div>                                              
                        <div class='bio-row'>
                          <p><span>Birthday</span> <input type='date' id='birthDate' name='birthDate' class='form-control' value='{$_SESSION['currUser']['birthDate']}' /></p>
                        </div>
                        <div class='bio-row'>
                          <p><span>Occupation </span> <input type='text' id='occupation' name='occupation' class='form-control' value='{$_SESSION['currUser']['occupation']}' /></p>
                        </div>
                        <div class='bio-row'>
                          <p><span>Email </span> <input type='text' id='email' name='email' class='form-control' value='{$_SESSION['currUser']['email']}' disabled/></p>
                        </div>
                        <div class='bio-row'>
                          <p><span>Phone </span> <input type='text' id='phoneNumber' name='phoneNumber' class='form-control' value='{$_SESSION['currUser']['phoneNumber']}' /></p>
                        </div>
                      </div>
                      <div class='row text-center'>
                        <button class='btn btn-info' type='submit' name='btn_save'>Lưu lại
                        </button>
                        <a class='btn btn-warning' href='admin.php?option=profile'>Hủy bỏ
                        </a>
                      </div></form>
                    </div>";
                  }else {
                    echo "<div class='panel-body bio-graph-info'>
                    <div class='row'>
                      <div class='bio-row'>
                        <p><span>Name </span>: &nbsp {$_SESSION['currUser']['name']}</p>
                      </div>                                              
                      <div class='bio-row'>
                        <p><span>Birthday</span>: &nbsp {$_SESSION['currUser']['birthDate']}</p>
                      </div>
                      <div class='bio-row'>
                        <p><span>Occupation </span>: &nbsp {$_SESSION['currUser']['occupation']}</p>
                      </div>
                      <div class='bio-row'>
                        <p><span>Email </span>: &nbsp {$_SESSION['currUser']['email']}</p>
                      </div>
                      <div class='bio-row'>
                        <p><span>Phone </span>: &nbsp {$_SESSION['currUser']['phoneNumber']}</p>
                      </div>
                    </div>
                    <div class='row text-center'>
                      <a class='btn btn-primary btn-success' href='admin.php?option=profile&suaprofile={$_SESSION['currUser']['id']}'>Sửa thông tin</a>
                    </div>
                  </div>";
                }
                ?>
              </section>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tao">
          <br/>
          <form action="" class="form-horizontal" method="POST" id="block-validate">
            <div class="form-group">
              <label class="control-label col-lg-4">Mật khẩu cũ</label>

              <div class="col-lg-4">
                <input type="password" id="oldpassword" name="oldpassword" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-4">Mật khẩu mới</label>

              <div class="col-lg-4">
                <input type="password" id="newpassword" name="newpassword" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-4">Nhập lại Mật khẩu</label>

              <div class="col-lg-4">
                <input type="password" id="repassword" name="repassword" class="form-control" />
              </div>
            </div>
            <div class="form-actions no-margin-bottom" style="text-align:center;">
              <input type="submit" value="Thay đổi" name="doimatkhau" class="btn btn-primary btn-lg " />
            </div>

          </form>
        </div>
        <div class="tab-pane fade" id="avatar">
          <br/>
          <form action="" name="form_upload" method="POST" enctype="multipart/form-data">
            <div class="col-lg-4">
              <input type="file" name="image" class="form-control" />
            </div>
            <div class="col-lg-4">
              <input type="submit" class="btn btn-primary" value="Upload"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<section>
  <div class="row">
    <div class="text-center">
    </div>                                             
  </div>
</section>