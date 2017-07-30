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
        $dbgo = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbgo->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbgo->connect_errno.")".$dbgo->connect_error;
        }
		if ( $how==1 ){
			echo "<div class='one'><span>修改食資料</span></div>";
			$sql="SELECT * FROM 食 WHERE ID='$ID'";
			foreach ( $dbgo->query($sql) as $value )
			{
				echo "<div class='form'><form name='live' action='alterFoodAction2.php?ID=$ID&how=1&' method='GET'>"
				."ID：<input type='text' name='ID' readonly='value' value='".$value['ID']."'><br>"
				."名稱：<input type='text' name='name' value='".$value['名稱']."' required><br>"
				."地址編號:<input type='text' value=".$value['地址_編號']." name='num' required><br>"
				."街道巷弄：<input type='text' value=".$value['地址_其他']." name='adress' required><br>"
				."營業時間：<input type='text' value=".$value['營業時間']." name='time' required><br>"
				."電話：<input type='text' value=".$value['電話']." name='phone' required><br>"
				."經度(-180~180)：<input type='text' value=".$value['位置_經度']." name='longitude' required><br>"
				."緯度(-90~90)：<input type='text' value=".$value['位置_緯度']." name='latitude' required><br>"
				."<br><input class='button' type='submit' value='確認' />"
				."<input class='button' type ='button' onclick='history.back()' value='取消' /><br></form></div><br>";
			}
		}
		else if ( $how==2 ){
			echo "<div class='one'><span>刪除食資料</span></div>";
			$sql="DELETE FROM 食 WHERE ID='$ID'";
            $inserert = $dbgo->prepare($sql);
            $inserert->execute();
			if ( $dbgo->errorCode()!=00000 ){
				die("<script> alert(\"刪除失敗\"); location.href=\"alterFood.php\";</script>");
			}
			else{
				die("<script> alert(\"刪除成功\"); location.href=\"run.php\";</script>");
			}		
		}
		echo "<div class=township>";
		echo "<b>鄉鎮市區編號參考</b><br>";
		$sql="SELECT * FROM 鄉鎮市區";
		foreach ( $dbgo->query($sql) as $value ){
			echo $value['縣市'].$value['鄉鎮市區'];
			echo "=".$value['編號']."<br>";
		}
		echo "</div>";
	?>
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
