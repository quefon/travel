<html>
<head>
</head>
<body>
<?php
    $db_host = "mysql.cs.ccu.edu.tw";
    $db_user = "hcf103u";
    $db_pass = "wen50521";
    $db_select = "hcf103u_travel";
    //$dbconnect = 'mysql:host='.$db_host.';dbname='.$db_select;
    $dbh = new mysqli($db_host,$db_user,$db_pass,$db_select);
    if($dbh->connect_errno){
        echo "Failed to connect to MYSQL:(".$dbh->connect_errno.")".$dbh->connect_error;
    }
	$xmlDoc = new DOMDocument();
	$xmlDoc->load("F-D0047-039.xml");
	$locationtDom = $xmlDoc->getElementsByTagName("location");
	$townnum=0;
	$x=0;$y=0;
	$township=Array(16);
	$num=Array(16);
	$time=Array(16*14);
	$windD=Array(16*14);
	$windV=Array(16*14);
	$weather=Array(16*14);
	$rainP=Array(16*14);
	$maxT=Array(16*14);
	$minT=Array(16*14);
	
	foreach($locationtDom as $location){
		$locationName=$location->getElementsByTagName("locationName");
		$startTime=$location->getElementsByTagName("startTime");
		$endTime=$location->getElementsByTagName("endTime");
		$elementName=$location->getElementsByTagName("elementName");
		$elementValue=$location->getElementsByTagName("elementValue");
		$parameterValue=$location->getElementsByTagName("parameterValue");
		//Wind風向描述、風速Wx天氣描述PoP降雨率MaxT最高溫MinT最低溫UVI紫外線指數、曝曬級數
		//3Wind、4Wx、5PoP、6MaxT、7MinT、8MaxCI、9MinCI、10MaxAT、11MinAT、12UVI、13WeatherDescription
		if ($x==8)
			$township[$x]=mb_substr( $locationName->item(0)->nodeValue,6,4,"utf-8");
		else
			$township[$x]=mb_substr( $locationName->item(0)->nodeValue,6,3,"utf-8");
		//echo $township[$x]."<br>";//echo $locationName->item(0)->nodeValue."<br/>";//鄉鎮市區
		for ( $i=1; $i<15; $i++ ){
			$time[$y]=$startTime->item($i)->nodeValue."~".$endTime->item($i)->nodeValue;
			//echo $time[$y]."<br>";//echo $startTime->item($i)->nodeValue."~".$endTime->item($i)->nodeValue."<br/>";
			for ( $j=0; $j<14; $j++ ){
				switch( $j ){
					case 0:case 1:case 2:case 8:case 9:case 10:case 11:case 12:case 13:
						break;
					case 3:
						//echo $elementName->item($j)->nodeValue.":";
						$windD[$y]=$parameterValue->item($i*4+1)->nodeValue;
						//echo $windD[$y].";";//echo $parameterValue->item($i*4+1)->nodeValue.";";
						$windV[$y]=$parameterValue->item($i*4+2)->nodeValue;
						//echo $windV[$y]."<br>";//echo $parameterValue->item($i*4+2)->nodeValue."<br/>";
						break;
					case 4:
						//echo $elementName->item($j)->nodeValue.":";
						$weather[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $weather[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 5:
						//echo $elementName->item($j)->nodeValue.":";
						$rainP[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $rainP[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 6:
						//echo $elementName->item($j)->nodeValue.":";
						$maxT[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $maxT[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 7:
						//echo $elementName->item($j)->nodeValue.":";
						$minT[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $minT[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
				}
			}$y++;//echo "<br>";
		}$x++;//echo "<br><br>";
	}
	
	$sql="DELETE FROM 天氣";
	$dbh->exec($sql);
	for ( $x=0; $x<16; $x++ ){
		echo $township[$x]." ";
		$sql="SELECT * FROM 鄉鎮市區 WHERE 鄉鎮市區='$township[$x]'";
		$datalist=$dbh->query($sql);
		while ( $row=$datalist->fetch() ) {
			$num[$x]=$row['編號'];
		}
		echo $num[$x]."<br>";
		for ( $y=0+$x*14; $y<14+$x*14; $y++ ){
			$time[$y]=trim($time[$y]);
			$time[$y]=preg_replace('/\s(?=)/', '', $time[$y]);
			$windD[$y]=trim($windD[$y]);
			$windD[$y]=preg_replace('/\s(?=)/', '', $windD[$y]);
			$windV[$y]=trim($windV[$y]);
			$windV[$y]=preg_replace('/\s(?=)/', '', $windV[$y]);
			$weather[$y]=trim($weather[$y]);
			$weather[$y]=preg_replace('/\s(?=)/', '', $weather[$y]);
			$rainP[$y]=trim($rainP[$y]);
			$rainP[$y]=preg_replace('/\s(?=)/', '', $rainP[$y]);
			$maxT[$y]=trim($maxT[$y]);
			$maxT[$y]=preg_replace('/\s(?=)/', '', $maxT[$y]);
			$minT[$y]=trim($minT[$y]);
			$minT[$y]=preg_replace('/\s(?=)/', '', $minT[$y]);

			echo $time[$y].$windD[$y].$windV[$y].$weather[$y]
			.$rainP[$y].$maxT[$y].$minT[$y]."<br>";
			
			$sql_insert="INSERT INTO `天氣` (`編號`,`時間`,`風向`,`風速`,`天氣描述`,`降雨率`,`最高溫`,`最低溫`)"
			."VALUES('$num[$x]','$time[$y]','$windD[$y]','$windV[$y]','$weather[$y]','$rainP[$y]','$maxT[$y]','$minT[$y]')";
			$dbh->exec($sql_insert);
		}
	}	
	$xmlDoc = new DOMDocument();
	$xmlDoc->load("F-D0047-043.xml");
	$locationtDom = $xmlDoc->getElementsByTagName("location");
	$townnum=0;
	$x=0;$y=0;
	$township=Array(13);
	$num=Array(13);
	$time=Array(13*14);
	$windD=Array(13*14);
	$windV=Array(13*14);
	$weather=Array(13*14);
	$rainP=Array(13*14);
	$maxT=Array(13*14);
	$minT=Array(13*14);
	
	foreach($locationtDom as $location){
		$locationName=$location->getElementsByTagName("locationName");
		$startTime=$location->getElementsByTagName("startTime");
		$endTime=$location->getElementsByTagName("endTime");
		$elementName=$location->getElementsByTagName("elementName");
		$elementValue=$location->getElementsByTagName("elementValue");
		$parameterValue=$location->getElementsByTagName("parameterValue");
		//Wind風向描述、風速Wx天氣描述PoP降雨率MaxT最高溫MinT最低溫UVI紫外線指數、曝曬級數
		//3Wind、4Wx、5PoP、6MaxT、7MinT、8MaxCI、13MinCI、10MaxAT、11MinAT、12UVI、13WeatherDescription
		$township[$x]=mb_substr( $locationName->item(0)->nodeValue,6,3,"utf-8");
		//echo $township[$x]."<br>";//echo $locationName->item(0)->nodeValue."<br/>";//鄉鎮市區
		for ( $i=1; $i<15; $i++ ){
			$time[$y]=$startTime->item($i)->nodeValue."~".$endTime->item($i)->nodeValue;
			//echo $time[$y]."<br>";//echo $startTime->item($i)->nodeValue."~".$endTime->item($i)->nodeValue."<br/>";
			for ( $j=0; $j<14; $j++ ){
				switch( $j ){
					case 0:case 1:case 2:case 8:case 13:case 10:case 11:case 12:case 13:
						break;
					case 3:
						//echo $elementName->item($j)->nodeValue.":";
						$windD[$y]=$parameterValue->item($i*4+1)->nodeValue;
						//echo $windD[$y].";";//echo $parameterValue->item($i*4+1)->nodeValue.";";
						$windV[$y]=$parameterValue->item($i*4+2)->nodeValue;
						//echo $windV[$y]."<br>";//echo $parameterValue->item($i*4+2)->nodeValue."<br/>";
						break;
					case 4:
						//echo $elementName->item($j)->nodeValue.":";
						$weather[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $weather[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 5:
						//echo $elementName->item($j)->nodeValue.":";
						$rainP[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $rainP[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 6:
						//echo $elementName->item($j)->nodeValue.":";
						$maxT[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $maxT[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
					case 7:
						//echo $elementName->item($j)->nodeValue.":";
						$minT[$y]=$elementValue->item($i+($j-1)*15)->nodeValue;
						//echo $minT[$y]."<br/>";//echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
						break;
				}
			}$y++;//echo "<br>";
		}$x++;//echo "<br><br>";
	}
	for ( $x=0; $x<13; $x++ ){
		echo $township[$x]." ";
		$sql="SELECT * FROM 鄉鎮市區 WHERE 鄉鎮市區='$township[$x]'";
		$datalist=$dbh->query($sql);
		while ( $row=$datalist->fetch() ) {
			$num[$x]=$row['編號'];
		}
		echo $num[$x]."<br>";
		for ( $y=0+$x*14; $y<14+$x*14; $y++ ){
			$time[$y]=trim($time[$y]);
			$time[$y]=preg_replace('/\s(?=)/', '', $time[$y]);
			$windD[$y]=trim($windD[$y]);
			$windD[$y]=preg_replace('/\s(?=)/', '', $windD[$y]);
			$windV[$y]=trim($windV[$y]);
			$windV[$y]=preg_replace('/\s(?=)/', '', $windV[$y]);
			$weather[$y]=trim($weather[$y]);
			$weather[$y]=preg_replace('/\s(?=)/', '', $weather[$y]);
			$rainP[$y]=trim($rainP[$y]);
			$rainP[$y]=preg_replace('/\s(?=)/', '', $rainP[$y]);
			$maxT[$y]=trim($maxT[$y]);
			$maxT[$y]=preg_replace('/\s(?=)/', '', $maxT[$y]);
			$minT[$y]=trim($minT[$y]);
			$minT[$y]=preg_replace('/\s(?=)/', '', $minT[$y]);

			echo $time[$y].$windD[$y].$windV[$y].$weather[$y]
			.$rainP[$y].$maxT[$y].$minT[$y]."<br>";
			
			$sql_insert="INSERT INTO `天氣` (`編號`,`時間`,`風向`,`風速`,`天氣描述`,`降雨率`,`最高溫`,`最低溫`)"
			."VALUES('$num[$x]','$time[$y]','$windD[$y]','$windV[$y]','$weather[$y]','$rainP[$y]','$maxT[$y]','$minT[$y]')";
			$dbh->exec($sql_insert);
		}

}
		
?> 
</body>
</html>
