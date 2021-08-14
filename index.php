<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="allstyle.css" rel="stylesheet">
	<title>Index</title>
</head>

<body>
	<?php if (isset($_POST["submit"])) {
		if (empty($_SESSION['a_check'])) {
			$_SESSION['temppass'] = "";
			$_SESSION['tempuser'] = "";
		} else {
			$_SESSION['temppass'] = $_SESSION['password'];
			$_SESSION['tempuser'] = $_SESSION['username'];
		}
		$_SESSION['password'] = "";
		$_SESSION['username'] = "";
		header('Location: login.php');
		exit;
	} ?>
	<form action="index.php" method="POST">
		<h3 style="text-align: center;">Chúc mừng bạn có username là <?php echo $_SESSION['username'] ?> đã đăng nhập thành công ! </h3>
		<div class="khung_login" style="left: 40%;">
			<button type="submit" name="submit" id="btn_login" class="btn_login">
				Logout
			</button>
		</div>
	</form>
</body>

</html>