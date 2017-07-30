<!DOCTYPE HTML>
<?php session_start();
	if ( @$_SESSION['usename']!="quefon" && @$_SESSION['password']!="1234"){
		$_SESSION['usename']=0;
		$_SESSION['password']=0;
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>home</title>
	<link rel="stylesheet" href="css/header.css" type="text/css">
	<link rel="stylesheet" href="css/body.css" type="text/css">
	<script>
		window.onload=function(){
		var num=1;
		var tNum=11;
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
	function foodOver(){ document.getElementById("food").setAttribute("src","images/foodChange.jpg"); }
	function foodOut(){ document.getElementById("food").setAttribute("src","images/food.jpg"); }
	function liveOver(){ document.getElementById("live").setAttribute("src","images/liveChange.jpg"); }
	function liveOut(){ document.getElementById("live").setAttribute("src","images/live.jpg"); }
	/*function goOver(){ document.getElementById("go").setAttribute("src","images/goChange.jpg"); }
	function goOut(){ document.getElementById("go").setAttribute("src","images/go.jpg"); }*/
	function funOver(){ document.getElementById("fun").setAttribute("src","images/funChange.jpg"); }
	function funOut(){ document.getElementById("fun").setAttribute("src","images/fun.jpg"); }
	function weaOver(){ document.getElementById("weather").setAttribute("src","images/weaChange.jpg"); }
	function weaOut(){ document.getElementById("weather").setAttribute("src","images/wea.jpg"); }
	
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
		<div class="logo">
			<a href="home.php" class="logo"><img src="images/logo.png" alt=""></a>
		</div>
		<!--<ul>
			<li class="selected"><a href="index.html">首頁HOME</a></li>
			<li><a href="food.php">食FOOD</a></li>
			<li><a href="">住LIVE</a></li>
			<li><a href="">行GO</a></li>
			<li><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>-->
	</div>
	<div id="body">
		<div>
			<div id="pic1" class="picture"><img src="images/home/1.jpg"></div>
			<div id="pic2" class="picture"><img src="images/home/2.jpg"></div>
			<div id="pic3" class="picture"><img src="images/home/3.jpg"></div>
			<div id="pic4" class="picture"><img src="images/home/4.jpg"></div>
			<div id="pic5" class="picture"><img src="images/home/5.jpg"></div>
			<div id="pic6" class="picture"><img src="images/home/6.jpg"></div>
			<div id="pic7" class="picture"><img src="images/home/7.jpg"></div>
			<div id="pic8" class="picture"><img src="images/home/8.jpg"></div>
			<div id="pic9" class="picture"><img src="images/home/9.jpg"></div>
			<div id="pic10" class="picture"><img src="images/home/10.jpg"></div>
			<div id="pic11" class="picture"><img src="images/home/11.jpg"></div>
		</div>
		<div class="header">
			<ul>
				<li><a href="food.php" onmouseover="foodOver()" onmouseout="foodOut()"><img id="food" src="images/food.jpg"></a></li>
				<li><a href="live.php" onmouseover="liveOver()" onmouseout="liveOut()"><img id="live" src="images/live.jpg"></a></li>
				<!--<li><a href="go.php" onmouseover="goOver()" onmouseout="goOut()"><img id="go" src="images/go.jpg"></a></li>-->
				<li><a href="funny.php" onmouseover="funOver()" onmouseout="funOut()"><img id="fun" src="images/fun.jpg"></a></li>
				<li><a href="weather.php" onmouseover="weaOver()" onmouseout="weaOut()"><img id="weather" src="images/wea.jpg"></a></li>
			</ul>
			<br>
		</div>
	</div>
	<div id="footer"><br><br><br><br></div>
</body>
</html>
