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
		city[1]=["全部","花蓮市","鳳林鎮","玉里鎮","新城鄉","吉安鄉","壽豐鄉"
					,"光復鄉","豐濱鄉","瑞穗鄉","富里鄉","秀林鄉","萬榮鄉","卓溪鄉"];
		city[2]=["全部","臺東市","成功鎮","關山鎮","長濱鄉","池上鄉","東河鄉","鹿野鄉","卑南鄉","大武鄉","綠島鄉"
					,"太麻里鄉","海端鄉","延平鄉","金峰鄉","達仁鄉","蘭嶼鄉"];
		
		function renew(index)
		{
			for(var i=0;i<city[index].length;i++)
				document.food.township.options[i]=new Option(city[index][i], city[index][i]);
			document.food.township.length=city[index].length;
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
			<li class="selected"><a href="food.php">食FOOD</a></li>
			<li><a href="live.php">住LIVE</a></li>
			<!--<li><a href="go.php">行GO</a></li>-->
			<li><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>
	</div>
	<div id="body">
		<div class="form">
		選擇欲查詢的餐廳地區
		<br>
		<form name="food" method="get" action="foodAction.php">
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
		</form></div>
		<!--<hr>-->
		<div class="final">
	<?php
		
		$city=$_GET['city'];
		$township=$_GET['township'];

        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbh->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }
        if ( $township=="" )
            $sql="SELECT count(*) FROM 食,鄉鎮市區 WHERE 地址_其他 LIKE '...'";
        else if ( $township=="全部" )
            $sql="SELECT count(*) FROM 食,鄉鎮市區 WHERE (鄉鎮市區.縣市='$city') AND (鄉鎮市區.編號=食.地址_編號)";
        else
            $sql="SELECT count(*) FROM 食,鄉鎮市區 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (鄉鎮市區.編號=食.地址_編號)";

        $rs=$dbh->query($sql);
        $pagesize=10;  //每頁顯示筆數
        $rownum=$rs->fetchcolumn(); //獲取總數
        if ( $rownum==0 ){
            echo "<span>沒有符合的資料</span><br><img src='images/oops1.png'></div>";
        }
        else{
            if ( ($rownum/$pagesize)>intval($rownum/$pagesize) )
                $TotalPage=intval($rownum/$pagesize)+1;
            else
                $TotalPage=intval($rownum/$pagesize);
            if ( !isset($_GET["page"]) )
                $page=1;
            else if ( $_GET["page"]<1 )
                $page=1;
            else if ( $_GET["page"]>$TotalPage )
                $page=$TotalPage;
            else
                $page=$_GET["page"];

            $prepage =$page-1;    //上一頁
            $nextpage=$page+1;    //下一頁
            $myURL=$_SERVER["PHP_SELF"];
            $pageurl='';
            echo "查詢地點：".$city.$township."<br>";
            if ($page == 1)
                $pageurl.="最前頁 | 上一頁 | ";
            else
                $pageurl.="<a href='".$myURL."?page=1&city=".$city."&township=".$township."'>最前頁</a>"
                    ." | <a href='".$myURL."?page=".$prepage."&city=".$city."&township=".$township."'>上一頁</a> | ";
            if ($page==$TotalPage || $TotalPage==0)
                $pageurl.="下一頁 | 最後頁";
            else
                $pageurl.="<a href='".$myURL."?page=".$nextpage."&city=".$city."&township=".$township."'>下一頁</a>"
                    ." | <a href='".$myURL."?page=".$TotalPage."&city=".$city."&township=".$township."'>最後頁</a>";
            echo $pageurl;

            if ( $township=="全部" )
                $sql="SELECT * FROM 食,鄉鎮市區 WHERE (鄉鎮市區.縣市='$city') AND (鄉鎮市區.編號=食.地址_編號) Limit ".($page-1)*$pagesize.",".$pagesize;
            else
                $sql="SELECT * FROM 食,鄉鎮市區 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (鄉鎮市區.編號=食.地址_編號) Limit ".($page-1)*$pagesize.",".$pagesize;

            $datalist=$dbh->query($sql);
            echo "<table><tr><th>餐廳名稱</th></tr><tr>";
            while ( $row=$datalist->fetch() ) {
                echo "<td><a href='foodAll.php?ID=".$row['ID']."'>".$row['名稱']."</a></td></tr>";
            }
            echo "</table>";
            echo "<br /> 當前第 $page 頁 | 共 $TotalPage 頁</div>";
        }

	?>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
