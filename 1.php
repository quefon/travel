<html>
<head>
	<title>quefon's page</title>
</head>
<body>
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
    $sql="SELECT * FROM 樂 WHERE 地址_縣市 ='花蓮縣'";
    echo "connect success<br/>";
    foreach ( $dbgo->query($sql) as $value ) {
        echo $value['編號']."  ". $value['名稱']."  ". $value['分類']."<br>";
    }
?>
</body>
</html>


