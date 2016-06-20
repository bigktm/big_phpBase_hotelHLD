<?php
mysql_connect("localhost","root","root") or die("không thể kết nối database");
mysql_select_db("hldhotel");
mysql_query("SET NAMES 'utf8'");
session_start();

$userId = 0;
if (isset($_SESSION['sesUser'])){
	$GLOBALS['userId'] = $_SESSION['sesUser']['id'];
}


function update_session()
{
	$userId = $GLOBALS['userId'];
	if($userId){
		$sql = mysql_query("SELECT * FROM user WHERE id =".$userId);
		if(mysql_num_rows($sql)==1)
		{
			$row = mysql_fetch_array($sql);
			$_SESSION['sesUser'] = $row;
		}
	}
}

function get_userdn($email,$password)
{

	$sql = mysql_query("SELECT * FROM user WHERE email ='".$email."' AND password = '".$password."'");
	if(mysql_num_rows($sql)==1)
	{
		$row = mysql_fetch_array($sql);
		$_SESSION['sesUser'] = $row;
		header("location:index.php");
	}else{
		echo "Tên đăng nhập hoặt mật khẩu sai";
	}
}

function register_user($name,$email,$password)
{
	$query = "INSERT INTO user(id, name, email, password, type, hotelId, avatar) VALUES ('','".$name."','".$email."','".$password."',0,1,'userd.jpg')";
	$sql = mysql_query($query);
	if ($sql == 1){
		echo "<div class='alert alert-block alert-success fade in'>Đăng ký thành công!</div>";
	}else {
		echo "<div class='alert alert-block alert-danger fade in'>Lỗi!". mysql_error(). "</div>";
	}
}

function get_categories()
{
	$query = "select * from category";
	$sql = mysql_query($query);
	return $sql;
}

function get_lastnew()
{
	$query = "select new.id, new.title, new.content, new.createDate, category.name, new.categoryId from new left join category on new.categoryId = category.id ORDER BY new.createDate DESC LIMIT 10";
	$sql = mysql_query($query);
	return $sql;
}

function get_news_detail($newId)
{
	$query = "select new.title, new.content, new.createDate, category.name, new.categoryId, new.userId from new left join category on new.categoryId = category.id where new.id=".$newId;
	$sql = mysql_query($query);
	return $sql;
}

function get_news_user($danhmucId)
{
	$query = "select new.id, new.title, new.content, new.createDate, category.name, new.categoryId from new left join category on new.categoryId = category.id where categoryId=".$danhmucId;
	$sql = mysql_query($query);
	return $sql;
}

function get_username($userId)
{
	$query = "select name from user where id=".$userId;
	$sql = mysql_query($query);
	return $sql;
}

function get_rooms_user($roomTypeId)
{
	$query = "select room.id, room.label, room.status, room.description, room.roomtypeId, roomtype.name from room left join roomtype on room.roomTypeId = roomtype.id where room.roomTypeId = ". $roomTypeId;
	$sql = mysql_query($query);
	return $sql;
}

/*Quản lý Tin tức*/
function add_new($rs_title,$rs_content,$rs_createDate,$rs_chondm)
{
	$userId = $GLOBALS['userId'];
	if($userId){
		$sql = mysql_query("insert into new(title,content,createDate,categoryId,userId) 
			values(N'".$rs_title."',N'".$rs_content."','".$rs_createDate."','".$rs_chondm."','".$userId."')");
		return $sql;
	}else {
		return false;
	}
}

function update_new($rs_id,$rs_title,$rs_content,$rs_createDate,$rs_chondm)
{
	$sql = mysql_query("UPDATE new SET title='".$rs_title."',content='".$rs_content."',createDate='".$rs_createDate."',categoryId=".$rs_chondm." WHERE id=".$rs_id);

	return $sql;
}

function delete_new($rs_id)
{
	$sql = mysql_query("DELETE FROM new WHERE id=".$rs_id);
	return $sql;
}

/*Quản lý Danh mục*/
function add_danhmuc($rs_name)
{
	$sql = mysql_query("insert into category(name,hotelId) 
		values(N'".$rs_name."',1)");
	return $sql;
}

function update_danhmuc($rs_id,$rs_name)
{
	$sql = mysql_query("UPDATE category SET name='".$rs_name."' WHERE id=".$rs_id);
	print_r($sql);
	return $sql;
}

function delete_danhmuc($rs_id)
{
	$sql = mysql_query("DELETE FROM category WHERE id=".$rs_id);
	return $sql;
}

/*Quản lý profile*/
function update_profile($rs_name,$rs_birthDate,$rs_occupation,$rs_phoneNumber)
{
	$userId = $GLOBALS['userId'];
	if($userId){
		$sql = mysql_query("UPDATE user SET name='".$rs_name."',birthDate='".$rs_birthDate."',occupation='".$rs_occupation."',phoneNumber='".$rs_phoneNumber."' WHERE id=".$userId);
		return $sql;
	}else {
		return false;
	}
}

function update_password($rs_mkmoi)
{
	$userId = $GLOBALS['userId'];
	if($userId){
		$sql = mysql_query("UPDATE user SET password='".$rs_mkmoi."' WHERE id=".$userId);
		return $sql;
	}else {
		return false;
	}
}

function update_avatar($avatar)
{
	$userId = $GLOBALS['userId'];
	if($userId){
		$sql = mysql_query("UPDATE user SET avatar='".$avatar."' WHERE id=".$userId);
		return $sql;
	}else {
		return false;
	}
}

/*Quản lý người dùng*/
function get_nguoidung()
{
	$query = "select * from user";
	$sql = mysql_query($query);
	return $sql;
}

function add_nguoidung($rs_name,$rs_email,$rs_password,$rs_chonloai,$rs_birthDate,$rs_occupation,$rs_phoneNumber)
{
	$sql = mysql_query("insert into user(name,email,password,type,hotelId,avatar,birthDate,occupation,phoneNumber) 
		values(N'".$rs_name."',N'".$rs_email."',N'".$rs_password."',".$rs_chonloai.",1,'userd.jpg','".$rs_birthDate."',N'".$rs_occupation."','".$rs_phoneNumber."')");
	return $sql;
}

function update_nguoidung($rs_id,$rs_name,$rs_birthDate,$rs_occupation,$rs_phoneNumber,$rs_chonloai)
{
	$sql = mysql_query("UPDATE user SET name='".$rs_name."',birthDate='".$rs_birthDate."',occupation='".$rs_occupation."',phoneNumber='".$rs_phoneNumber."',type=".$rs_chonloai." WHERE id=".$rs_id);
	return $sql;
}

function delete_nguoidung($rs_id)
{
	$sql = mysql_query("DELETE FROM user WHERE id=".$rs_id);
	return $sql;
}

/*Quản lý phòng*/
function add_phong($rs_label,$rs_description,$rs_roomtypeId)
{
	$sql = mysql_query("insert into room(label,description,status,roomtypeId) 
		values(N'".$rs_label."',N'".$rs_description."',0,".$rs_roomtypeId.")");
	return $sql;
}

function update_phong($rs_id,$rs_label,$rs_description,$rs_chonstatus,$rs_roomtypeId)
{
	$sql = mysql_query("UPDATE room SET label='".$rs_label."',description='".$rs_description."',status=".$rs_chonstatus.",roomtypeId=".$rs_roomtypeId." WHERE id=".$rs_id);
	print_r($sql);
	return $sql;
}

function delete_phong($rs_id)
{
	$sql = mysql_query("DELETE FROM room WHERE id=".$rs_id);
	return $sql;
}

?>

