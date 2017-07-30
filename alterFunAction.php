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
				document.live.township.options[i]=new Option(city[index][i], city[index][i]);
			document.live.township.length=city[index].length;
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
	<div class="one">
	<?php
		@$ID=$_GET['ID'];
		@$how=$_GET['how'];

        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbh->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }
		if ( $how==1 ){
			echo "<div class='one'><span>修改樂資料</span></div>";
			$sql="SELECT * FROM 樂 WHERE ID='$ID'";
			foreach ( $dbh->query($sql) as $value ) {
				echo "<div class='form'><form name='live' action='alterFunAction2.php?ID=$ID&how=1&' method='GET'>"
				."ID：<input type='text' name='ID' readonly='value' value='".$value['ID']."'><br>"
				."名稱：<input type='text' name='name' value='".$value['名稱']."' required><br>"
				."分類：<input type='text' value=".$value['分類']." name='category' required><br>"
				."地址編號:<input type='text' value=".$value['地址_編號']." name='num' required><br>"
				."街道巷弄：<input type='text' value=".$value['地址_其他']." name='adress' required><br>"
				."電話：<input type='text' value=".$value['電話']." name='phone' required><br>"
				."網站：<input type='text' value=".$value['網站']." name='web'><br>"
				."經度(-180~180)：<input type='text' value=".$value['位置_經度']." name='longitude' required><br>"
				."緯度(-90~90)：<input type='text' value=".$value['位置_緯度']." name='latitude' required><br>"
				."<br><input class='button' type='submit' value='確認' />"
				."<input class='button' type ='button' onclick='history.back()' value='取消' /><br></form></div><br>";
			}
		}
		else if ( $how==2 ){
			echo "<div class='one'><span>刪除樂資料</span></div>";			
			$sql="DELETE FROM 樂 WHERE ID='$ID'";
			$dbh->exec($sql);
			if ( $dbh->errorCode()!=00000 ){
				die("<script> alert(\"刪除失敗\"); location.href=\"alterFun.php\";</script>");   
				print_r($sth->errorInfo());
			}
			else{
				die("<script> alert(\"刪除成功\"); location.href=\"run.php\";</script>");
			}
		}
		echo "<div class=township>";
		echo "<b>鄉鎮市區編號參考</b><br>";
		$sql="SELECT * FROM 鄉鎮市區";
		foreach ( $dbh->query($sql) as $value ){
			echo $value['縣市'].$value['鄉鎮市區'];
			echo "=".$value['編號']."<br>";
		}
		echo "</div>";
	?>
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
