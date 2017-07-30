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
					document.live.township.options[i]=new Option(city[index][i], city[index][i]);	// 設定新選項
				document.live.township.length=city[index].length;	// 刪除多餘的選項
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
			<li class="selected"><a href="live.php">住LIVE</a></li>
			<!--<li><a href="go.php">行GO</a></li>-->
			<li><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>
	</div>
	<div id="body">
		<div class="form">
		<input type='button' class='button' value='以地區搜尋' onClick='ChangeA()'>
		<input type='button' class='button' value='以分類搜尋' onClick='ChangeB()'><br><br>
		<div id="A" class="">
		選擇欲查詢的住宿地區<br>
		<form name="live" method="GET" action="liveActionA.php">
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
		選擇欲查詢的住宿類型<br>
		<form method="GET" action="liveActionB.php">
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="旅館">旅館</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="民宿">民宿</label><br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
		<div class="picture">
			<div id="pic1"><img src="images/live/1.jpg"><br>花蓮花見幸福民宿</div>
			<div id="pic2"><img src="images/live/2.jpg"><br>花蓮澄品大飯店</div>
			<div id="pic3"><img src="images/live/3.jpg"><br>花蓮靜園池畔民宿</div>
			<div id="pic4"><img src="images/live/4.jpg"><br>臺東好望角渡假民宿</div>
			<div id="pic5"><img src="images/live/5.jpg"><br>臺東鹿鳴溫泉酒店</div>
		</div>
	</div>
	<div id="footer"><br><br><br><br></div>
	</body>
</html>
