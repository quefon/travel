<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<?php
		ini_set("max_execution_time", "18000");
    	$db_host = "mysql.cs.ccu.edu.tw";
    	$db_user = "hcf103u";
    	$db_pass = "wen50521";
    	$db_select = "hcf103u_travel";
    	//$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
    	$dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
    	if($dbh->connect_errno){
        	echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
    	}
			
			$sqlA="SELECT * FROM 樂";
			$sqlB="SELECT * FROM 住";
			foreach ( $dbh->query($sqlA) as $valueA ){	
				$ID1=$valueA['ID'];
				$lng1=$valueA['位置_經度'];
				$lat1=$valueA['位置_緯度'];
				foreach ( $dbh->query($sqlB) as $valueB ){	
					$ID2=$valueB['ID'];
					$lng2=$valueB['位置_經度'];
					$lat2=$valueB['位置_緯度'];
					//echo $ID1."_";//$lng1.$lat1."<br>";
					//echo $ID2."_";//$lng2.$lat2."<br>";
					$distance=getDistance($lng1,$lat1,$lng2,$lat2);
					$distance = number_format($distance,5);
					//echo $distance."<br>";
					$sql_insert="INSERT INTO `距離樂住` (`樂ID`,`住ID`,`距離`) VALUES('$ID1','$ID2','$distance')";
					$dbh->exec($sql_insert);
				}//echo "<br>";
			}
		function getDistance($lng1,$lat1,$lng2,$lat2){//根據經緯度計算計離{
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
	</body>
</html>
