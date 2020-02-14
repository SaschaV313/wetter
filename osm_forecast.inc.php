<link href="css/styles.min.css" rel="stylesheet">
<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
<link href="css/weather-icons-wind.min.css" rel="stylesheet" type="text/css">

<?php
  $json_string = 'http://api.openweathermap.org/data/2.5/forecast?id=2851337&APPID=f7a8b11a00cb27d9f234e7620d8850e0&lang=de&units=metric';
  $jsondata = file_get_contents($json_string);
  $forecast = json_decode($jsondata, true);
  echo "<!--";
  print_r($forecast['list']);
  echo "!-->";

echo "<table><tr>";
$tabelle=array();
foreach($forecast['list'] as $data)
{
	$prefix=($data['sys']['pod']=='d')?"day-":"night-";

	echo "<td style='font-size: 50%;'>";
	echo "<div>".date("d.m.", $data['dt'])."<br />".date("H:i", $data['dt'])."</div>";
	echo "<div><i class='wi wi-owm-".$prefix.$data['weather'][0]['id']."'></i></div>";
	echo "<div><i class='wi wi-thermometer'></i> max. ".$data['main']['temp_max']."&nbsp;&deg;C</div>";
	echo "<div><i class='wi wi-thermometer'></i> min. ".$data['main']['temp_min']."&nbsp;&deg;C</div>";
	echo "<div><i class='wi wi-barometer'></i> ".$data['main']['pressure']."&nbsp;hPa</div>";
	echo "<div><i class='wi wi-humidity'></i> ".$data['main']['humidity']."&nbsp;%</div>";
	echo "<div><i class='wi wi-strong-wind'></i> ".$data['wind']['speed']."&nbsp;m/sec</div>";
	echo "<div><i class='wi wi-wind-direction'></i> ".$data['wind']['deg']."&deg;</div>";
	echo "</td>";

	$dt = $data['dt'];
	$tabelle['tag'][$dt] = date("d.m.", $data['dt']);
	$tabelle['zeit'][$dt] = date("H:i", $data['dt']);
	$tabelle['symbol'][$dt] = "wi wi-owm-".$prefix.$data['weather'][0]['id'];
	$tabelle['temp'][$dt] = $data['main']['temp'];
	$tabelle['tmax'][$dt] = $data['main']['temp_max'];
	$tabelle['tmin'][$dt] = $data['main']['temp_min'];
	$tabelle['druck'][$dt] = $data['main']['pressure'];
	$tabelle['feucht'][$dt] = $data['main']['humidity'];
	$tabelle['wstark'][$dt] = $data['wind']['speed'];
	$tabelle['wricht'][$dt] = $data['wind']['deg'];
}
echo "</tr></table>";
echo "<!--";
print_r($tabelle);
echo "!-->";
?>