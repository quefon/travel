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
		@$name=$_GET['name'];
		@$city=$_GET['city'];
		@$township=$_GET['township'];
		@$adress=$_GET['adress'];
		@$phone=$_GET['phone'];
		@$longitude=$_GET['longitude'];
		@$latitude=$_GET['latitude'];
		@$time=$_GET['time'];
		@$num=$_GET['num'];

		$db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbh->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }
        $sql="update 食 SET 名稱='$name' WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 營業時間='$time' WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 地址_編號='$num'  WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 地址_其他='$adress'  WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 電話='$phone'  WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 位置_經度='$longitude'  WHERE ID='$ID'";
        $dbh->exec($sql);
        $sql="update 食 SET 位置_緯度='$latitude'  WHERE ID='$ID'";
        $dbh->exec($sql);

        $sqlA="SELECT * FROM 樂";
        foreach ( $dbh->query($sqlA) as $valueA ){
            $FID=$valueA['ID'];
            $lng2=$valueA['位置_經度'];
            $lat2=$valueA['位置_緯度'];
            $distance=getDistance($longitude,$latitude,$lng2,$lat2);
            $distance = number_format($distance,5);
            $sql_insert="update 距離食樂 SET 距離='$distance'  WHERE 食ID='$ID' AND 樂ID='$FID'";
            $dbh->exec($sql_insert);
        }
        $sqlB="SELECT * FROM 住";
        foreach ( $dbh->query($sqlB) as $valueB ) {
            $HID=$valueB['ID'];
            $lng2=$valueB['位置_經度'];
            $lat2=$valueB['位置_緯度'];
            $distance=getDistance($longitude,$latitude,$lng2,$lat2);
            $distance = number_format($distance,5);
            $sql_insert="update 距離食住 SET 距離='$distance'  WHERE 食ID='$ID' AND 住ID='$HID'";
            $dbh->exec($sql_insert);
        }
        if ( $dbh->errorCode()!=00000 ) {
            die("<script> alert(\"修改失敗\"); location.href=\"alterFood.php\";</script>");
        }
        else{
            die("<script> alert(\"修改成功\"); location.href=\"run.php\";</script>");
        }
        function getDistance($lng1,$lat1,$lng2,$lat2){//根據經緯度計算計離
            $radLat1=deg2rad($lat1);//將角度轉換為弧度
            $radLat2=deg2rad($lat2);
            $radLng1=deg2rad($lng1);
            $radLng2=deg2rad($lng2);
            $a=$radLat1-$radLat2;//兩緯度之差,緯度<90
            $b=$radLng1-$radLng2;//兩經度之差，精度<180
            $s=2*asin(sqrt(pow(sin($a/2),2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137;
            return $s;
        }
    ?>
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
