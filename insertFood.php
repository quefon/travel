<!DOCTYPE html>
<?php session_start(); 
	if ($_SESSION['usename']!="quefon" && $_SESSION['password']!="1234")
		header ('Location: login.php');
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/body5.css" type="text/css">
	<script>
		var city=new Array();
		city[0]=["---"];
		city[1]=["花蓮市","鳳林鎮","玉里鎮","新城鄉","吉安鄉","壽豐鄉"
					,"光復鄉","豐濱鄉","瑞穗鄉","富里鄉","秀林鄉","萬榮鄉","卓溪鄉"];
		city[2]=["臺東市","成功鎮","關山鎮","長濱鄉","池上鄉","東河鄉","鹿野鄉","卑南鄉","大武鄉","綠島鄉"
					,"太麻里鄉","海端鄉","延平鄉","金峰鄉","達仁鄉","蘭嶼鄉"];
		function renew(index)
		{
			for(var i=0;i<city[index].length;i++)
				document.food.township.options[i]=new Option(city[index][i], city[index][i]);
			document.food.township.length=city[index].length;
		}
	</script>
</head>
<body>
	<div id="header">
		<?php
			if ($_SESSION['usename']=="quefon" && $_SESSION['password']=="1234")
				echo "<div class='supervisor'><a href='logout.php?where=".$_SERVER['PHP_SELF']."'>登出</a><a href='home.php'>搜尋介面</a></div>";
		?>
		<div class='supervisor'></a></div>
		<a href="run.php" class="logo"><img src="images/logo.png" alt=""></a>
		<!--<ul>
			<li><a href="home.php">首頁HOME</a></li>
			<li class="selected"><a href="food.php">食FOOD</a></li>
			<li><a href="live.php">住LIVE</a></li>
			<li><a href="go.php">行GO</a></li>
			<li><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>-->
	</div>
	<div id="body">
		<div class="one"><span>新增食資料</span></div>
		<div class="form">
		<form action="uploadR.php" method="post" enctype="multipart/form-data" target="frame_upload">
			圖片：<br><input style="width:450px;" type="file" name="file" id="file" /><br><input type="submit" name="submit" value="確定上傳圖片" />
		</form>
		<iframe src="./uploadR.php" style="display:none;" id="frame_upload" name="frame_upload"></iframe> 
		<br>
		<form name="food" action="insertFoodAction.php" method="GET">
			名稱：<input type="text" name="name" required><br>
			縣市：<select name="city" onChange="renew(this.selectedIndex)" required>
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select><br>
			鄉鎮市區：<select name="township" required>
				<option value="">---</option>
			</select><br>
			街道巷弄：<input type="text" name="adress" required><br>
			營業時間：<input type="text" name="time" required><br>
			電話：<input type="text" name="phone" required><br>
			經度(-180~180)：<input type="text" name="longitude" required><br>
			緯度(-90~90)：<input type="text" name="latitude" required><br>
			<br><input class="button" type="submit" value="確認" />
			<input class="button" type ="button" onclick="history.back()" value="取消" /><br>
		</form>
		</div>
		
	<div class="footer"><br><br><br><br></div>
</body>
</html>
