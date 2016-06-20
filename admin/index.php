
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin Login</title>
</head>
<body>
<?php
	if(!isset($_SESSION['currUser']))
	{
		require 'login.php';
	}else {
		header("location:admin.php");
	}



?>

</body>
</html>