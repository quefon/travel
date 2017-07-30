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
			city[1]=["花蓮市","鳳林鎮","玉里鎮","新城鄉","吉安鄉","壽豐鄉"
						,"光復鄉","豐濱鄉","瑞穗鄉","富里鄉","秀林鄉","萬榮鄉","卓溪鄉"];
			city[2]=["臺東市","成功鎮","關山鎮","長濱鄉","池上鄉","東河鄉","鹿野鄉","卑南鄉","大武鄉","綠島鄉"
						,"太麻里鄉","海端鄉","延平鄉","金峰鄉","達仁鄉","蘭嶼鄉"];
			
			function renew(index)
			{
				for(var i=0;i<city[index].length;i++)
					document.weather.township.options[i]=new Option(city[index][i], city[index][i]);	// 設定新選項
				document.weather.township.length=city[index].length;	// 刪除多餘的選項
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
			<li><a href="funny.php">樂FUN</a></li>
			<li class="selected"><a href="weather.php">天氣WEATHER</a></li>
		</ul>
	</div>
	<div id="body">
		<div class="form">
		選擇欲查詢天氣的地區
		<br>
		<form name="weather" method="get" action="weatherAction.php">
			縣市：<select name="city" onChange="renew(this.selectedIndex)">
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select>
			<br>
			鄉鎮市區：<select name="township">
			<option value="">---</option>
			</select>
			<br>
			<input class="button" type="submit" value="查詢" />
		</form>
	<?php
		$township=$_GET['township'];
        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbgo = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbgo->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbgo->connect_errno.")".$dbgo->connect_error;
        }
        if ( $township=="" )
            echo "<br><span>沒有符合的資料</span><br><img src='images/oops1.png'></div>";
        else{
            echo "<br><b>".$township."的天氣狀況</b></div>";
            echo "<table border='1'>";
            echo "<b><tr><th><b>日期</b></th><th><b>時間</b></th><th><b>風向</b></th><th><b>風速</b>
                    </th><th><b>降雨率</b></th><th><b>最高溫</b></th><th><b>最低溫</b></th><th><b>天氣狀況</b></th></b>";
            $sql="SELECT * FROM 鄉鎮市區,天氣 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (天氣.編號=鄉鎮市區.編號)";
            foreach ( $dbh->query($sql) as $value ) {
                echo "<tr><th>".mb_substr( $value['時間'],6,4,"utf-8")."</th>";
                echo "<th>".mb_substr( $value['時間'],11,8,"utf-8")."</th>";
                echo "<th>".$value['風向']."</th>";
                echo "<th>".$value['風速']."m/s</th>";
                echo "<th>".$value['降雨率']."</th>";
                echo "<th>".$value['最高溫']."</th>";
                echo "<th>".$value['最低溫']."</th>";
                echo "<th>".$value['天氣描述']."</th></tr>";
            }echo "</table>";
        }
	?>
	</div>
	</body>
</html>
