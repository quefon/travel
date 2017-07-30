<!DOCTYPE html>
<?php session_start(); 
	if ( @$_SESSION['usename']=="quefon" && @$_SESSION['password']=="1234")
		header ('Location: run.php');
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/body5.css" type="text/css">
	<script>
	</script>
</head>
<body>
	<div id="header">
		<div class='supervisor'><a href='home.php'>搜尋介面</a></div>
		<a href="home.php" class="logo"><img src="images/logo.png" alt=""></a>
		<!--<ul>
			<li><a href="home.php">首頁HOME</a></li>
			<li class="selected"><a href="food.php">食FOOD</a></li>
			<li><a href="live.php">住LIVE</a></li>
			<<li><a href="go.php">行GO</a></li>
			<li><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>-->
	</div>
	<div id="body">
	<div class="form">
		<form action="loginAction.php" method="post">
			請輸入<br>
			管理者帳號：<input type="text" name="usename" value=""><br>
			管理者密碼：<input type="password" name="password" value=""><br>
			<input class="button" type="submit" value="確認" />
		</form></div>
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
