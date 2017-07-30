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
				document.fun.township.options[i]=new Option(city[index][i], city[index][i]);
			document.fun.township.length=city[index].length;
		}
			function ChangeA(){
				document.getElementById("A").style.display="block";
				document.getElementById("B").style.display="none";
			}
			function ChangeB(){
				document.getElementById("A").style.display="none";
				document.getElementById("B").style.display="block";
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
			<li class="selected"><a href="funny.php">樂FUN</a></li>
			<li><a href="weather.php">天氣WEATHER</a></li>
		</ul>
	</div>
	<div id="body">
		<div class="form">
		<input type='button' class='button' value='以地區搜尋' onClick='ChangeA()'>
		<input type='button' class='button' value='以分類搜尋' onClick='ChangeB()'><br><br>
		<div id="A" class="" style="display:none;">
		選擇欲查詢的玩樂地區<br>
		<form name="fun" method="GET" action="funnyActionA.php">
			縣市：<select name="city" onChange="renew(this.selectedIndex)">
				<option value="" select="on">---</option>
				<option value="花蓮縣">花蓮縣</option>
				<option value="臺東縣">臺東縣</option>
			</select><br>
			鄉鎮市區：<select name="township">
				<option value="">---</option>
			</select><br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
		<div id="B" class="">
		選擇欲查詢的玩樂類型<br>
		<form method="GET" action="funnyActionB.php">
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="生態">生態</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="溫泉">溫泉</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="古蹟">古蹟</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="公園">公園</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="文化">文化</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="宗教">宗教</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="原住民文化">原住民文化</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="觀光工廠">觀光工廠</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="步道/古道">步道/古道	</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="地方展館/藝術">地方展館/藝術</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="遊樂區">遊樂區</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="自然風景">自然風景</label>	
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="自行車道">自行車道</label><br>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="農場/牧場/茶園/果園">農場/牧場/茶園/果園</label>
			<label><input style="height:30px;width:30px;" type="checkbox" name="type[]" value="其他">其他</label><br>
			<input class="button" type="submit" value="查詢" />
		</form></div>
		<!--<hr>-->
		<div class="final">	
	<?php
		@$type=$_GET['type'];
		for ( $i=0; $i<count($type); $i++){
			@$A=$A.sprintf("&type[%s]=%s", $i, $type[$i]);
		}
        $db_host = "mysql.cs.ccu.edu.tw";
        $db_user = "hcf103u";
        $db_pass = "wen50521";
        $db_select = "hcf103u_travel";
        //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
        $dbgo = new mysqli($db_host,$db_user,$db_pass,$db_select);
        if($dbgo->connect_errno){
            echo "Failed to connect to MYSQL:(".$dbgo->connect_errno.")".$dbgo->connect_error;
        }
        if ( !isset($_GET['type']) )
            echo "<span>沒有選擇分類</span>";
        else{
            $sql="SELECT count(*) FROM 樂 WHERE 分類 IN ('".implode("','", $_GET['type'])."')";
            //$="SELECT count(*) FROM 樂 WHERE (鄉鎮市區.鄉鎮市區='$township') AND (鄉鎮市區.編號=樂.地址_編號)";
            $rs=$dbh->query($sql);
            $pagesize=10;  //每頁顯示筆數
            $rownum=$rs->fetchcolumn(); //獲取總數echo $rownum;
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
                if ($page == 1)
                    $pageurl.="最前頁 | 上一頁 | ";
                else
                    $pageurl.="<a href='".$myURL."?page=1".$A."'>最前頁</a>"
                        ." | <a href='".$myURL."?page=".$prepage.$A."'>上一頁</a> | ";
                if ($page==$TotalPage || $TotalPage==0)
                    $pageurl.="下一頁 | 最後頁";
                else
                    $pageurl.="<a href='".$myURL."?page=".$nextpage.$A."'>下一頁</a>"
                        ." | <a href='".$myURL."?page=".$TotalPage.$A."'>最後頁</a>";
                echo $pageurl;

                $sql="SELECT * FROM 樂 WHERE 分類 IN ('".implode("','", $_GET['type'])."') Limit ".($page-1)*$pagesize.",".$pagesize;
                $datalist=$dbh->query($sql);
                echo "<table><tr><th>景點名稱</th></tr><tr>";
                while ( $row=$datalist->fetch() ) {
                    echo "<td>".$row['分類']."  <a href='funnyAll.php?ID=".$row['ID']."'>".$row['名稱']."</a></td></tr>";
                }
                echo "</table>";
                echo "<br /> 當前第 $page 頁 | 共 $TotalPage 頁</div>";
            }

		}
	?>
	<div class="footer"><br><br><br><br></div>
</body>
</html>
