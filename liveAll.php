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
	<link rel="stylesheet" href="css/body4.css" type="text/css">
	<script>
		function mapChange(){
			document.getElementById("map").style.display="block";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="none";
			document.getElementById("fun").style.display="none";
		}
		function weatherChange(){
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="block";
			document.getElementById("food").style.display="none";
			document.getElementById("fun").style.display="none";
		}
		function foodChange(){
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="block";
			document.getElementById("fun").style.display="none";
		}
		function funChange(){
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="none";
			document.getElementById("fun").style.display="block";
			document.getElementById("food").style.display="none";
		}
		function DChange(){
			document.getElementById("townshipA").style.display="none";
			document.getElementById("townshipB").style.display="none";
			document.getElementById("distanceA").style.display="block";
			document.getElementById("distanceB").style.display="block";
		}
		function TChange(){
			document.getElementById("townshipA").style.display="block";
			document.getElementById("townshipB").style.display="block";
			document.getElementById("distanceA").style.display="none";
			document.getElementById("distanceB").style.display="none";
		}
		function Change5(){
			document.getElementById("D5A").style.display="block";
			document.getElementById("D5B").style.display="block";
			document.getElementById("D10A").style.display="none";
			document.getElementById("D10B").style.display="none";
		}
		function Change10(){
			document.getElementById("D5A").style.display="none";
			document.getElementById("D5B").style.display="none";
			document.getElementById("D10A").style.display="block"
			document.getElementById("D10B").style.display="block";
		}
		function liveOver(){ document.getElementById("liveIcon").setAttribute("src","images/icon/nearLiveH.png"); }
		function liveOut(){ document.getElementById("liveIcon").setAttribute("src","images/icon/nearLive.png"); }
		function mapOver(){ document.getElementById("mapIcon").setAttribute("src","images/icon/mapH.png"); }
		function mapOut(){ document.getElementById("mapIcon").setAttribute("src","images/icon/map.png"); }
		function weaOver(){ document.getElementById("weatherIcon").setAttribute("src","images/icon/weatherH.png"); }
		function weaOut(){ document.getElementById("weatherIcon").setAttribute("src","images/icon/weather.png"); }
		function funOver(){ document.getElementById("funIcon").setAttribute("src","images/icon/nearFunH.png"); }
		function funOut(){ document.getElementById("funIcon").setAttribute("src","images/icon/nearFun.png"); }
		function foodOver(){ document.getElementById("foodIcon").setAttribute("src","images/icon/nearFoodH.png"); }
		function foodOut(){ document.getElementById("foodIcon").setAttribute("src","images/icon/nearFood.png"); }
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
	<?php
		$ID=$_GET['ID'];
        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbh->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }

			$num="SELECT * FROM 住,鄉鎮市區 WHERE (ID='$ID') AND (鄉鎮市區.編號=住.地址_編號)";
			foreach ( $dbh->query($num) as $value )
			{	
				$city=$value['縣市'];
				$township=$value['鄉鎮市區'];
			};
			$sql="SELECT * FROM 住 WHERE ID='$ID'";
			echo "<div class='allFinal'><table>";
			foreach ( $dbh->query($sql) as $value )
			{	
				echo "<tr><th><span>".$value['名稱']."</span></th></tr>"
				."<tr><td><b>地址：</b>".$city.$township.$value['地址_其他']."</td></tr>"
				."<tr><td><b>電話：</b>".$value['電話']."</td></tr>"
				."<tr><td><b>網站：</b><a href='".$value['網站']."'>按這</a></td></tr>";
				echo "</table>";
				echo "<div class='picture'><br><img src='images/liveAll/".$value['ID'].".jpg'></div><br></div>";
			};
			echo "<div class='link'>";
			echo "<ul>";
			echo "<li><a onmouseover='mapOver()' onmouseout='mapOut()'>
				<input type='image' id='mapIcon' img src='images/icon/map.png' onClick='mapChange()'></a><br>GOOGLE MAP</li>";
			echo "<li><a onmouseover='weaOver()' onmouseout='weaOut()'>
				<input type='image' id='weatherIcon' img src='images/icon/weather.png' onClick='weatherChange()'></a><br>天氣狀況</li>";
			echo "<li><a onmouseover='foodOver()' onmouseout='foodOut()'>
				<input type='image' id='foodIcon' img src='images/icon/nearFood.png' onClick='foodChange()'></a><br>附近美食</li>";
			echo "<li><a onmouseover='funOver()' onmouseout='funOut()'>
				<input type='image' id='funIcon' img src='images/icon/nearFun.png' onClick='funChange()'></a><br>附近玩樂</li>";
			echo "</ul><br></div><br>";

			echo "<div id='map' class='other' display='none'>";
			$sql="SELECT * FROM 住 WHERE ID='$ID'";//map
			foreach ( $dbh->query($sql) as $value )
			{	
				echo "<iframe frameborder='0' scrolling='no' marginheight='0' marginwidth='0'
				width='1000px' height='800px'
				src='https://maps.google.com/maps?q=".$value['位置_緯度'].",".$value['位置_經度']."&amp;z=17&amp;output=embed&amp;hl=zh-TW'></iframe>";
			};echo "</div>"; 
			
			
			echo "<div id='weather' class='other' style='display:none'>";//weather
			echo "<table border='1'>";
			echo "<b><tr><th><b>日期</b></th><th><b>時間</b></th><th><b>風向</b></th><th><b>風速</b>
				</th><th><b>降雨率</b></th><th><b>最高溫</b></th><th><b>最低溫</b></th><th><b>天氣狀況</b></th></b>";
			$sql="SELECT * FROM 住,天氣 WHERE (ID='$ID') AND (天氣.編號=住.地址_編號)";
			foreach ( $dbh->query($sql) as $value )
			{	
				echo "<tr><th>".mb_substr( $value['時間'],6,4,"utf-8")."</th>";
				echo "<th>".mb_substr( $value['時間'],11,8,"utf-8")."</th>";
				echo "<th>".$value['風向']."</th>";
				echo "<th>".$value['風速']."m/s</th>";
				echo "<th>".$value['降雨率']."</th>";
				echo "<th>".$value['最高溫']."</th>";
				echo "<th>".$value['最低溫']."</th>";
				echo "<th>".$value['天氣描述']."</th></tr>";
				
			};echo "</table></div>";
			//美食
			echo "<div id='food' class='other' style='display:none'>
				<input type='button' class='button' value='地區' onClick='TChange()'>
				<input type='button' class='button' value='距離' onClick='DChange()'>";
			echo "<div id='townshipA' class='near'>";
			$sql="SELECT * FROM 住,鄉鎮市區 WHERE (住.ID='$ID') AND (鄉鎮市區.編號=住.地址_編號)";
			$row=$dbh->query($sql)->fetch();
			echo "<b>".$row['鄉鎮市區']."其他美食</b><br>";	
			$sql="SELECT * FROM 住,食 WHERE (住.ID='$ID') AND (食.地址_編號=住.地址_編號)";
			$datalist=$dbh->query($sql);
			while ( $row=$datalist->fetch() ) {
				echo "<a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";	
			}
			echo "</div>";
			echo "<div id='distanceA' class='near' style='display:none'>
				<input type='button' class='button' value='小於5km' onClick='Change5()'>
				<input type='button' class='button' value='5到10km' onClick='Change10()'>";
			echo "<div id='D5A' class='distance'>";
			echo "<b>小於5km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離食住,食 WHERE (距離食住.住ID='$ID') AND (距離食住.距離<5) AND (距離食住.食ID=食.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離食住,食 WHERE (距離食住.住ID='$ID') AND (距離食住.距離<5) AND (距離食住.食ID=食.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}
			echo "</div>";
			echo "<div id='D10A' class='distance' style='display:none'>";
			echo "<b>5到10km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離食住,食 WHERE (距離食住.住ID='$ID') AND (距離食住.距離>=5) AND (距離食住.距離<10) AND (距離食住.食ID=食.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離食住,食 WHERE (距離食住.住ID='$ID') AND (距離食住.距離>=5) AND (距離食住.距離<10) AND (距離食住.食ID=食.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}echo "</div></div></div>";
	
			//玩樂
			echo "<div id='fun' class='other' style='display:none'>
				<input type='button' class='button' value='地區' onClick='TChange()'>
				<input type='button' class='button' value='距離' onClick='DChange()'>";
			echo "<div id='townshipB' class='near'>";
			$sql="SELECT * FROM 住,鄉鎮市區 WHERE (住.ID='$ID') AND (鄉鎮市區.編號=住.地址_編號)";
			$row=$dbh->query($sql)->fetch();
			echo "<b>".$row['鄉鎮市區']."其他玩樂</b><br>";	
			$sql="SELECT * FROM 住,樂 WHERE (住.ID='$ID') AND (住.地址_編號=樂.地址_編號)";
			$datalist=$dbh->query($sql);
			while ( $row=$datalist->fetch() ) {
				echo "<a href='funnyAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";	
			}
			echo "</div>";
			echo "<div id='distanceB' class='near' style='display:none'>
				<input type='button' class='button' value='小於5km' onClick='Change5()'>
				<input type='button' class='button' value='5到10km' onClick='Change10()'>";
			echo "<div id='D5B' class='distance'>";
			echo "<b>小於5km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離樂住,樂 WHERE (距離樂住.住ID='$ID') AND (距離樂住.距離<5) AND (距離樂住.樂ID=樂.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離樂住,樂 WHERE (距離樂住.住ID='$ID') AND (距離樂住.距離<5) AND (距離樂住.樂ID=樂.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='funnyAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}
			echo "</div>";
			echo "<div id='D10B' class='distance' style='display:none'>";
			echo "<b>5到10km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離樂住,樂 WHERE (距離樂住.住ID='$ID') AND (距離樂住.距離>=5) AND (距離樂住.距離<10) AND (距離樂住.樂ID=樂.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離樂住,樂 WHERE (距離樂住.住ID='$ID') AND (距離樂住.距離>=5) AND (距離樂住.距離<10) AND (距離樂住.樂ID=樂.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='funnyAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}echo "</div></div></div>";
	?> 
	</div>
	<div style="clear:both;"></div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
