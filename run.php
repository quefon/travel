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
		function food(){
			document.getElementById("insertFood").style.display="block";
			document.getElementById("alterFood").style.display="block";
			document.getElementById("insertFun").style.display="none";
			document.getElementById("alterFun").style.display="none";
			document.getElementById("insertLive").style.display="none";
			document.getElementById("alterLive").style.display="none";
		}
		function live(){
			document.getElementById("insertFood").style.display="none";
			document.getElementById("alterFood").style.display="none";
			document.getElementById("insertFun").style.display="none";
			document.getElementById("alterFun").style.display="none";
			document.getElementById("insertLive").style.display="block";
			document.getElementById("alterLive").style.display="block";
		}
		function fun(){
			document.getElementById("insertFood").style.display="none";
			document.getElementById("alterFood").style.display="none";
			document.getElementById("insertFun").style.display="block";
			document.getElementById("alterFun").style.display="block";
			document.getElementById("insertLive").style.display="none";
			document.getElementById("alterLive").style.display="none";
		}
		function foodOver(){ document.getElementById("food").setAttribute("src","images/foodChange.jpg"); }
		function foodOut(){ document.getElementById("food").setAttribute("src","images/food.jpg"); }
		function liveOver(){ document.getElementById("live").setAttribute("src","images/liveChange.jpg"); }
		function liveOut(){ document.getElementById("live").setAttribute("src","images/live.jpg"); }
		/*function goOver(){ document.getElementById("go").setAttribute("src","images/goChange.jpg"); }
		function goOut(){ document.getElementById("go").setAttribute("src","images/go.jpg"); }*/
		function funOver(){ document.getElementById("fun").setAttribute("src","images/funChange.jpg"); }
		function funOut(){ document.getElementById("fun").setAttribute("src","images/fun.jpg"); }
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
	<div class="header">
		<ul>
			<li><a onmouseover="foodOver()" onmouseout="foodOut()"><input type="image" img id="food" src="images/food.jpg" onClick="food()"></a></li>
			<li><a onmouseover="liveOver()" onmouseout="liveOut()"><input type="image" img id="live" src="images/live.jpg" onClick="live()"></a></li>
			<!--<li><a href="go.php" onmouseover="goOver()" onmouseout="goOut()"><input type="image" img id="go" src="images/go.jpg"></a></li>-->
			<li><a onmouseover="funOver()" onmouseout="funOut()"><input type="image" img id="fun" src="images/fun.jpg" onClick="fun()"></a></li>
			<!--<li><a onmouseover="weaOver()" onmouseout="weaOut()"><input type="image" img id="weather" src="images/wea.jpg"></a></li>-->
		</ul><br>
	</div>
	<div id="insertFood" class="One" style="display:none;">
		<a href="insertFood.php">新增食資料</a>
	</div>
	<div id="alterFood" class="One" style="display:none;">
		<a href="alterFood.php">修改食資料</a>
	</div>
	<div id="insertFun" class="One" style="display:none;">
		<a href="insertFun.php">新增樂資料</a>
	</div>
	<div id="alterFun" class="One" style="display:none;">
		<a href="alterFun.php">修改樂資料</a>
	</div>	
	<div id="insertLive" class="One" style="display:none;">
		<a href="insertLive.php">新增住資料</a>
	</div>
	<div id="alterLive" class="One" style="display:none;">
		<a href="alterLive.php">修改住資料</a>
	</div>	

	<div class="footer"><br><br><br><br></div>
</body>
</html>
