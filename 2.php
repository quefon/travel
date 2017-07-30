<html>
<head>
</head>
<body>
<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("F-D0047-039.xml");
$locationtDom = $xmlDoc->getElementsByTagName("location");
foreach($locationtDom as $location){
	$locationName=$location->getElementsByTagName("locationName");
	$startTime=$location->getElementsByTagName("startTime");
	$endTime=$location->getElementsByTagName("endTime");
	$elementName=$location->getElementsByTagName("elementName");
	$elementValue=$location->getElementsByTagName("elementValue");
	$parameterValue=$location->getElementsByTagName("parameterValue");
	
	//Wind風向描述、風速Wx天氣描述PoP降雨率MaxT最高溫MinT最低溫UVI紫外線指數、曝曬級數
	
	echo $locationName->item(0)->nodeValue."<br/>";//鄉鎮市區
	for ( $i=0; $i<15; $i++ ){
		echo $startTime->item($i)->nodeValue."~";
		echo $endTime->item($i)->nodeValue."<br/>";
		for ( $j=0; $j<14; $j++ ){//3Wind、4Wx、5PoP、6MaxT、7MinT、8MaxCI、9MinCI、10MaxAT、11MinAT、12UVI、13WeatherDescription 
			echo $elementName->item($j)->nodeValue.":";
			switch( $j ){
			case 0:case 1:case 2:
				echo $elementValue->item($i+($j*15))->nodeValue."<br/>";
				break;
			case 3:
				echo $parameterValue->item($i*4)->nodeValue.";";
				echo $parameterValue->item($i*4+1)->nodeValue.";";
				echo $parameterValue->item($i*4+2)->nodeValue.";";
				echo $parameterValue->item($i*4+3)->nodeValue."<br/>";
				break;
			case 4:case 5:case 6:case 7:case 8:case 9:case 10:case 11:
				echo $elementValue->item($i+($j-1)*15)->nodeValue."<br/>";
				break;
			case 12:
				echo $parameterValue->item($i*2+75)->nodeValue.";";
				echo $parameterValue->item($i*2+76)->nodeValue."<br/>";
				break;
			case 13:
				echo $elementValue->item($i+11*15)->nodeValue."<br/>";
				break;
			}
		}echo "<br>";
	}echo "<br><br>";
}
?> 
</body>
</html>