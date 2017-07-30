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
	<link rel="stylesheet" href="css/body3.css" type="text/css">
	<script>
		function goChange(){
			document.getElementById("go").style.display="block";
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="none";
			document.getElementById("live").style.display="none";
		}
		function mapChange(){
			document.getElementById("go").style.display="none";
			document.getElementById("map").style.display="block";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="none";
			document.getElementById("live").style.display="none";
		}
		function weatherChange(){
			document.getElementById("go").style.display="none";
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="block";
			document.getElementById("food").style.display="none";
			document.getElementById("live").style.display="none";
		}
		function foodChange(){
			document.getElementById("go").style.display="none";
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="block";
			document.getElementById("live").style.display="none";
		}
		function liveChange(){
			document.getElementById("go").style.display="none";
			document.getElementById("map").style.display="none";
			document.getElementById("weather").style.display="none";
			document.getElementById("food").style.display="none";
			document.getElementById("live").style.display="block";
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
		function foodOver(){ document.getElementById("foodIcon").setAttribute("src","images/icon/nearFoodH.png"); }
		function foodOut(){ document.getElementById("foodIcon").setAttribute("src","images/icon/nearFood.png"); }
		function liveOver(){ document.getElementById("liveIcon").setAttribute("src","images/icon/nearLiveH.png"); }
		function liveOut(){ document.getElementById("liveIcon").setAttribute("src","images/icon/nearLive.png"); }
		function goOver(){ document.getElementById("goIcon").setAttribute("src","images/icon/goH.png"); }
		function goOut(){ document.getElementById("goIcon").setAttribute("src","images/icon/go.png"); }
		function mapOver(){ document.getElementById("mapIcon").setAttribute("src","images/icon/mapH.png"); }
		function mapOut(){ document.getElementById("mapIcon").setAttribute("src","images/icon/map.png"); }
		function weaOver(){ document.getElementById("weatherIcon").setAttribute("src","images/icon/weatherH.png"); }
		function weaOut(){ document.getElementById("weatherIcon").setAttribute("src","images/icon/weather.png"); }
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
	<?php
		
		$ID=$_GET['ID'];
        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbgo->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }
			$num="SELECT * FROM 樂,鄉鎮市區 WHERE (ID='$ID') AND (鄉鎮市區.編號=樂.地址_編號)";
			foreach ( $dbh->query($num) as $value )
			{	
				$city=$value['縣市'];
				$township=$value['鄉鎮市區'];
			};
			$sql="SELECT * FROM 樂 WHERE ID='$ID'";
			echo "<div class='allFinal'><table>";
			foreach ( $dbh->query($sql) as $value )
			{	
				echo "<tr><th><span>".$value['名稱']."</span></th></tr>"
				."<tr><td><b>類型：</b>".$value['分類']."</td></tr>"
				."<tr><td><b>票價：</b>".$value['票價']."</td></tr>"
				."<tr><td><b>地址：</b>".$city.$township.$value['地址_其他']."</td></tr>"
				."<tr><td><b>開放時間：</b>".$value['開放時間']."</td></tr>"
				."<tr><td><b>電話：</b>".$value['電話']."</td></tr>"
				."<tr><td><b>網站：</b><a href='".$value['網站']."'>按這</a></td></tr>";
				echo "</table>";
				echo "<div class='picture'><img src='images/funAll/".$value['ID'].".jpg'></div><br></div>";
			};

			echo "<div class='link'>";
			echo "<ul>";
			echo "<li><a onmouseover='mapOver()' onmouseout='mapOut()'>
				<input type='image' id='mapIcon' img src='images/icon/map.png' onClick='mapChange()'></a><br>GOOGLE MAP</li>";
			echo "<li><a onmouseover='weaOver()' onmouseout='weaOut()'>
				<input type='image' id='weatherIcon' img src='images/icon/weather.png' onClick='weatherChange()'></a><br>天氣狀況</li>";
			echo "<li><a onmouseover='goOver()' onmouseout='goOut()'>
				<input type='image' id='goIcon' img src='images/icon/go.png' onClick='goChange()'></a><br>交通狀況</li>";
			echo "<li><a onmouseover='liveOver()' onmouseout='liveOut()'>
				<input type='image' id='liveIcon' img src='images/icon/nearLive.png' onClick='liveChange()'></a><br>附近住宿</li>";
			echo "<li><a onmouseover='foodOver()' onmouseout='foodOut()'>
				<input type='image' id='foodIcon' img src='images/icon/nearFood.png' onClick='foodChange()'></a><br>附近美食</li>";
			echo "</ul><br></div><br>";

			echo "<div id='map' class='other' display='none'>";
			$sql="SELECT * FROM 樂 WHERE ID='$ID'";//map
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
			$sql="SELECT * FROM 樂,天氣 WHERE (ID='$ID') AND (天氣.編號=樂.地址_編號)";
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
			
			echo "<div id='go' class='other' style='display:none'>";//交通
			$sqlA="SELECT * FROM 樂 WHERE ID='$ID'";
			foreach ( $dbh->query($sqlA) as $value ){	
				if ( $value['交通資訊_開車']=="" || $value['交通資訊_開車']=="null")
					echo "<b>自行開車</b><br>無<br>";
				else
					echo "<b>自行開車</b><br>".$value['交通資訊_開車']."<br>";
				if ( $value['交通資訊_大眾運輸']==""  ||  $value['交通資訊_開車']=="null")
					echo "<b>大眾運輸</b><br>無<br>";
				else
					echo "<b>大眾運輸</b><br>".$value['交通資訊_大眾運輸']."<br>";
			}
			echo "<b>可搭乘之公車</b><br>";
			$sqlB="SELECT * FROM 樂,行 WHERE (ID='$ID') AND (樂.ID=行.景點ID)";
			$sqlC="SELECT COUNT(*) FROM 樂,行 WHERE (ID='$ID') AND (樂.ID=行.景點ID)";
			$rownum=$dbh->query($sqlC)->fetchcolumn();
			if ( $rownum==0 )
				echo "無<br>";
			foreach ( $dbh->query($sqlB) as $value ){	
				echo "路線：".$value['路線']."，下車站名：".$value['下車站名']."<br>";
			}echo "<br></div>";
			
			//美食
			echo "<div id='food' class='other' style='display:none'>
				<input type='button' class='button' value='地區' onClick='TChange()'>
				<input type='button' class='button' value='距離' onClick='DChange()'>";
			echo "<div id='townshipA' class='near'>";
			$sql="SELECT * FROM 樂,鄉鎮市區 WHERE (樂.ID='$ID') AND (鄉鎮市區.編號=樂.地址_編號)";
			$row=$dbh->query($sql)->fetch();
			echo "<b>".$row['鄉鎮市區']."其他美食</b><br>";	
			$sql="SELECT * FROM 樂,食 WHERE (樂.ID='$ID') AND (食.地址_編號=樂.地址_編號)";
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
			$sql="SELECT COUNT(*) FROM 距離食樂,食 WHERE (距離食樂.樂ID='$ID') AND (距離食樂.距離<5) AND (距離食樂.食ID=食.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離食樂,食 WHERE (距離食樂.樂ID='$ID') AND (距離食樂.距離<5) AND (距離食樂.食ID=食.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}
			echo "</div>";
			echo "<div id='D10A' class='distance' style='display:none'>";
			echo "<b>5到10km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離食樂,食 WHERE (距離食樂.樂ID='$ID') AND (距離食樂.距離>=5) AND (距離食樂.距離<10) AND (距離食樂.食ID=食.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離食樂,食 WHERE (距離食樂.樂ID='$ID') AND (距離食樂.距離>=5) AND (距離食樂.距離<10) AND (距離食樂.食ID=食.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}echo "</div></div></div>";
			

			//住宿
			echo "<div id='live' class='other' style='display:none'>
				<input type='button' class='button' value='地區' onClick='TChange()'>
				<input type='button' class='button' value='距離' onClick='DChange()'>";
			echo "<div id='townshipB' class='near'>";
			$sql="SELECT * FROM 樂,鄉鎮市區 WHERE (樂.ID='$ID') AND (鄉鎮市區.編號=樂.地址_編號)";
			$row=$dbh->query($sql)->fetch();
			echo "<b>".$row['鄉鎮市區']."其他住宿</b><br>";	
			$sql="SELECT * FROM 樂,住 WHERE (樂.ID='$ID') AND (住.地址_編號=樂.地址_編號)";
			$datalist=$dbh->query($sql);
			while ( $row=$datalist->fetch() ) {
				echo "<a href='liveAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";	
			}
			echo "</div>";
			echo "<div id='distanceB' class='near' style='display:none'>
				<input type='button' class='button' value='小於5km' onClick='Change5()'>
				<input type='button' class='button' value='5到10km' onClick='Change10()'>";
			echo "<div id='D5B' class='distance'>";
			echo "<b>小於5km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離樂住,住 WHERE (距離樂住.樂ID='$ID') AND (距離樂住.距離<5) AND (距離樂住.住ID=住.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離樂住,住 WHERE (距離樂住.樂ID='$ID') AND (距離樂住.距離<5) AND (距離樂住.住ID=住.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='liveAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}
			echo "</div>";
			echo "<div id='D10B' class='distance' style='display:none'>";
			echo "<b>5到10km</b><br>";
			$sql="SELECT COUNT(*) FROM 距離樂住,住 WHERE (距離樂住.樂ID='$ID') AND (距離樂住.距離>=5) AND (距離樂住.距離<10) AND (距離樂住.住ID=住.ID)";
			$num=$dbh->query($sql)->fetchcolumn();
			//echo $num;
			if ( $num==0 )
				echo "無此資料";
			else{
				$sql="SELECT * FROM 距離樂住,住 WHERE (距離樂住.樂ID='$ID') AND (距離樂住.距離>=5) AND (距離樂住.距離<10) AND (距離樂住.住ID=住.ID)";
				$datalist=$dbh->query($sql);	
				while ( $row=$datalist->fetch() ) {
					echo "<a href='liveAll.php?ID=".$row['ID']."'>".$row['名稱']."</a><br>";}
			}echo "</div></div></div>";	

	?> 
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
