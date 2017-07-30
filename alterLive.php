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
		function execute(){
			if ( confirm('確定要刪除此資料？') ){
				location.href="alterLiveAction.php?ID="+ID+"&how=2";
			}
			else
				window.event.returnValue=false;
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
	<div class="form">
		<form name="live" method="GET" action="alterLive.php">
			縣市：<select name="city" onChange="renew(this.selectedIndex)" required>
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select>
			<br>
			鄉鎮市區：<select name="township" required>
				<option value="">---</option>
			</select>
			<br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
	<div class="final">
	<?php
		@$city=$_GET['city'];
		@$township=$_GET['township'];
        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbh->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
        }
        $sql="SELECT count(*) FROM 住,鄉鎮市區 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (鄉鎮市區.編號=住.地址_編號)";
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

            $sql="SELECT * FROM 住,鄉鎮市區 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (鄉鎮市區.編號=住.地址_編號) Limit ".($page-1)*$pagesize.",".$pagesize;

            $datalist=$dbh->query($sql);
            echo "<table border='1'><tr><th>編號</th><th>住宿名稱</th><th>動作</th></tr>";
            while ( $row=$datalist->fetch() ) {
                $ID=$row['ID'];
                echo "<tr><td>".$row['ID']."</td><td>".$row['名稱']."</td>";
                echo "<td><a href='alterLiveAction.php?ID=".$row['ID']."&how=1'><input class='button' type='button' value='修改'></a>
                <input class='button' onClick='execute()' type='button' value='刪除'></td></tr>";
                ?><script>var ID='<?php echo $ID;?>'</script><?php
            }
            echo "</table>";
            echo "<br /> 當前第 $page 頁 | 共 $TotalPage 頁</div>";
        }
	?>
	</div>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
