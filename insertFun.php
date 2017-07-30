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
				document.fun.township.options[i]=new Option(city[index][i], city[index][i]);
			document.fun.township.length=city[index].length;
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
		<div class="one"><span>新增樂資料</span></div>
		<div class="form">
		<form action="uploadF.php" method="post" enctype="multipart/form-data" target="frame_upload">
			圖片：<br><input style="width:450px;" type="file" name="file" id="file" /><br><input type="submit" name="submit" value="確定上傳圖片" />
		</form>
		<iframe src="./uploadF.php" style="display:none;" id="frame_upload" name="frame_upload"></iframe> 
		
		<form name="fun" action="insertFunAction.php" method="GET">
			名稱：<input type="text" name="name" required><br>
			分類：<select name="category" required>
				<option value="生態">生態</option>
				<option value="溫泉">溫泉</option>
				<option value="古蹟">古蹟</option>
				<option value="公園">公園</option>
				<option value="文化">文化</option>
				<option value="宗教">宗教</option>
				<option value="原住民文化">原住民文化</option>
				<option value="觀光工廠">觀光工廠</option>
				<option value="步道/古道">步道/古道	</option>
				<option value="地方展館/藝術">地方展館/藝術</option>
				<option value="遊樂區">遊樂區</option>
				<option value="自然風景">自然風景</option>	
				<option value="自行車道">自行車道</option>
				<option value="農場/牧場/茶園/果園">農場/牧場/茶園/果園</option>
				<option value="其他">其他</option>
			</select><br>
			縣市：<select name="city" onChange="renew(this.selectedIndex)" required>
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select><br>
			鄉鎮市區：<select name="township" required>
				<option value="">---</option>
			</select><br>
			街道巷弄：<input type="text" name="adress" required><br>
			開放時間：<input type="text" name="time" required><br>
			票價：<input type="text" name="money" required><br>
			電話：<input type="text" name="phone" required><br>
			網站：<input type="text" name="web"><br>
			經度(-180~180)：<input type="text" name="longitude" required><br>
			緯度(-90~90)：<input type="text" name="latitude" required><br>
			交通狀況_自行開車：<br><input type="textbox" style="height:100px;" name="car" ><br>
			交通狀況_大眾運輸：<br><input type="textbox" style="height:100px;" name="other" ><br>
			<br><input class="button" type="submit" value="確認" />
			<input class="button" type ="button" onclick="history.back()" value="取消" /><br>
		</form>
		</div>
		
	<div class="footer"><br><br><br><br></div>
</body>
</html>
