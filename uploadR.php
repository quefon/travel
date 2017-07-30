<?php
	$db_host = "mysql.cs.ccu.edu.tw";
	$db_user = "hcf103u";
	$db_pass = "wen50521";
	$db_select = "hcf103u_travel";
	//$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
	$dbgo = new mysqli($db_host,$db_user,$db_pass,$db_select);
	if($dbgo->connect_errno){
    	echo "Failed to connect to MYSQL:(".$dbgo->connect_errno.")".$dbgo->connect_error;
	}
	$sql="SELECT * FROM 食 ORDER BY ID asc";
	foreach ( $dbh->query($sql) as $value ){
		$lastID=mb_substr( $value['ID'],1,3,"utf-8");
	}
	$lastID++;
	$RID="R".$lastID;
	if ($_FILES["file"]["error"] > 0)
		echo "上傳圖片失敗";
	else {
		//echo "檔案名稱:".$_FILES["file"]["name"]."<br/>";
		//echo "檔案類型:".$_FILES["file"]["type"]."<br/>";
		//echo "檔案大小:".($_FILES["file"]["size"]/1024)."kb<br/>";
		//echo "暫存名稱:".$_FILES["file"]["tmp_name"];
		$split=explode(".",$_FILES["file"]["name"]);
		$new_name=$RID.".".$split[1];
		echo "上傳圖片成功";
		move_uploaded_file($_FILES["file"]["tmp_name"],"images/foodAll/".$new_name);
	}
?>
