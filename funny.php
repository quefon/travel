<!DOCTYPE html>
<?php session_start();
	if ( @$_SESSION['usename']!="quefon" && @$_SESSION['password']!="1234"){
		$_SESSION['usename']=0;
		$_SESSION['password']=0;
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/body2.css" type="text/css">
	<script>
		var city=new Array();
		city[0]=["---"];
		city[1]=["全部","花蓮市","鳳林鎮","玉里鎮","新城鄉","吉安鄉","壽豐鄉"
					,"光復鄉","豐濱鄉","瑞穗鄉","富里鄉","秀林鄉","萬榮鄉","卓溪鄉"];
		city[2]=["全部","臺東市","成功鎮","關山鎮","長濱鄉","池上鄉","東河鄉","鹿野鄉","卑南鄉","大武鄉","綠島鄉"
					,"太麻里鄉","海端鄉","延平鄉","金峰鄉","達仁鄉","蘭嶼鄉"];
		function renew(index)
		{
			for(var i=0;i<city[index].length;i++)
				document.fun.township.options[i]=new Option(city[index][i], city[index][i]);
			document.fun.township.length=city[index].length;
		}
		function ChangeA(){
				document.getElementById("A").style.display="block";
				document.getElementById("B").style.display="none";
		}
		function ChangeB(){
			document.getElementById("A").style.display="none";
			document.getElementById("B").style.display="block";
		}
		window.onload=function(){
		var num=1;
		var tNum=5;
		var duration=2000;
		run();
		for(var i=1; i<=tNum; i++){
			document.getElementById("pic"+i).style.display="none";
		}
		document.getElementById("pic1").style.display="block";
		function autoShow(){
			for(var i=1; i<=tNum; i++){
				document.getElementById("pic"+i).style.display="none";
			}
			if(num<tNum){ num++;}else{ num=1;}
			document.getElementById("pic"+num).style.display="block";
		}
		function run(){ myInterval= setInterval(autoShow, duration);}
	}
	</script>
</head>
<body>
	<div id="header">
		<?php
			if ($_SESSION['usename']=="quefon" && $_SESSION['password']=="1234")
				echo "<div class='supervisor'><a href='logout.php?where=".$_SERVER['PHP_SELF']."'>登出</a><a href='login.php'>管理介面</a></div>";
			else
				echo "<div class='supervisor'><a href='login.php'>管理員登入</a></div>";
		?>
		<a href="home.php" class="logo"><img src="images/logo.png" alt=""></a>
		<ul>
			<li><a href="home.php">首頁HOME</a></li>
			<li><a href="food.php">食FOOD</a></li>
			<li><a href="live.php">住LIVE</a></li>
			<!--<li><a href="go.php">行GO</a></li>-->
			<li class="selected"><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>
	</div>
	<div id="body">
		<div class="form">
		<input type='button' class='button' value='以地區搜尋' onClick='ChangeA()'>
		<input type='button' class='button' value='以分類搜尋' onClick='ChangeB()'><br><br>
		<div id="A" class="">
		選擇欲查詢的玩樂地區<br>
		<form name="fun" method="GET" action="funnyActionA.php">
			縣市：<select name="city" onChange="renew(this.selectedIndex)">
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select><br>
			鄉鎮市區：<select name="township">
				<option value="">---</option>
			</select><br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
		<div id="B" class="" style="display:none;">
		選擇欲查詢的玩樂類型<br>
		<form method="GET" action="funnyActionB.php">
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="生態">生態</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="溫泉">溫泉</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="古蹟">古蹟</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="公園">公園</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="文化">文化</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="宗教">宗教</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="原住民文化">原住民文化</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="觀光工廠">觀光工廠</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="步道/古道">步道/古道	</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="地方展館/藝術">地方展館/藝術</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="遊樂區">遊樂區</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="自然風景">自然風景</label>	
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="自行車道">自行車道</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="農場/牧場/茶園/果園">農場/牧場/茶園/果園</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="其他">其他</label><br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
		<div class="picture">
			<div id="pic1"><img src="images/fun/1.jpg"><br>花蓮鯉魚潭</div>
			<div id="pic2"><img src="images/fun/2.jpg"><br>花蓮七星潭風景區</div>
			<div id="pic3"><img src="images/fun/3.jpg"><br>臺東伯朗大道</div>
			<div id="pic4"><img src="images/fun/4.jpg"><br>臺東鹿野高台</div>
			<div id="pic5"><img src="images/fun/5.jpg"><br>臺東史前文化博物館</div>
		</div>
	</div>
	<div id="footer"><br><br><br><br></div>
	</body>
</html>
