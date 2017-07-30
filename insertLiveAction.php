<?php
		ini_set("max_execution_time", "60");
			@$name=$_GET['name'];
			@$category=$_GET['category'];
			@$city=$_GET['city'];
			@$township=$_GET['township'];
			@$adress=$_GET['adress'];
			@$phone=$_GET['phone'];
			@$web=$_GET['web'];
			@$longitude=$_GET['longitude'];
			@$latitude=$_GET['latitude'];
			@$min=$_GET['min'];
			@$max=$_GET['max'];
		$db_host = "mysql.cs.ccu.edu.tw";
		$db_user = "hcf103u";
		$db_pass = "wen50521";
		$db_select = "hcf103u_travel";
		//$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
		$dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
		if($dbh->connect_errno){
			echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
		}

			$sql="SELECT * FROM 住 ORDER BY ID asc";
			foreach ( $dbh->query($sql) as $value ){	
				$lastID=mb_substr( $value['ID'],1,3,"utf-8");
			}
			$sql="SELECT * FROM 鄉鎮市區 WHERE (縣市='$city') AND (鄉鎮市區='$township')";
			foreach ( $dbh->query($sql) as $value ){	
				$num=$value['編號'];
			}//echo $num;
			$lastID++;
			$sql="INSERT INTO `住` (`ID`, `名稱`, `分類`, `價格_最高`, `價格_最低`, `地址_編號`, `地址_其他`, `電話`, `網站`, `位置_經度`, `位置_緯度`) VALUES
			('H$lastID', '$name', '$category', '$max', '$min', '$num', '$adress', '$phone', '$web', '$longitude', '$latitude')";
			$HID="H".$lastID;
			$dbh->exec($sql);
			$sqlA="SELECT * FROM 樂";
			foreach ( $dbh->query($sqlA) as $valueA )
			{	
				$FID=$valueA['ID'];
				$lng2=$valueA['位置_經度'];
				$lat2=$valueA['位置_緯度'];
				$distance=getDistance($longitude,$latitude,$lng2,$lat2);
				$distance = number_format($distance,5);
				$sql_insert="INSERT INTO `距離樂住` (`樂ID`,`住ID`,`距離`) VALUES('$FID','$HID','$distance')";
				$dbh->exec($sql_insert);
			}
			$sqlB="SELECT * FROM 食";
			foreach ( $dbh->query($sqlB) as $valueB )
			{	
				$RID=$valueB['ID'];
				$lng2=$valueB['位置_經度'];
				$lat2=$valueB['位置_緯度'];
				$distance=getDistance($longitude,$latitude,$lng2,$lat2);
				$distance = number_format($distance,5);
				$sql_insert="INSERT INTO `距離食住` (`住ID`,`食ID`,`距離`) VALUES('$HID','$RID','$distance')";
				$dbh->exec($sql_insert);
			}

			if ( $dbh->errorCode()!=00000 )
			{
				die("<script> alert(\"新增失敗\"); location.href=\"insertLive.php\";</script>");   
				print_r($sth->errorInfo());
			}
			else{
				die("<script> alert(\"新增成功\"); location.href=\"run.php\";</script>");
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
