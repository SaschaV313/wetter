<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wetterstation</title>
	<meta http-equiv="refresh" content="600">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/styles.min.css" rel="stylesheet">
	<link href="css/clock.css" rel="stylesheet">
	<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/calendar.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]--> 
	<script type="text/javascript" src="js/coolclock.js"></script> 
	<script type="text/javascript" src="js/moreskins.js"></script>
	<script>
		 CoolClock.config.skins = {mySkin: {
						outerBorder:      { lineWidth: 0, radius: 0, color: "white", alpha: 0 },
						smallIndicator:   { lineWidth: 2, startAt: 89, endAt: 94, color: "red", alpha: 1 },
						largeIndicator:   { lineWidth: 4, startAt: 83, endAt: 94, color: "red", alpha: 1 },
						hourHand:         { lineWidth: 8, startAt: 0, endAt: 60, color: "red", alpha: 1 },
						minuteHand:       { lineWidth: 4, startAt: 0, endAt: 80, color: "red", alpha: 1 },
						secondHand:       { lineWidth: 1, startAt: 0, endAt: 85, color: "red", alpha: 1 },
						secondDecoration: { lineWidth: 3, startAt: 0, radius: 4, fillColor: "red", color: "red", alpha: 1 }
					 }
					}
		</script>
	</head>
	<body  onload="CoolClock.findAndCreateClocks()">
	<div class="container-fluid">
		<div class="row align-items-center h50">
			<div class="col text-center">
				<canvas id="clk1" class="CoolClock:mySkin:175"></canvas>
			</div>
			<div class="col text-center">
				<script type="text/javascript">
					Kalender(dm,dj);
	    		</script> 
			</div>
		</div>
	<div class="row align-items-center h50">
			<div class="col text-center">
<?php
  $json_string = 'http://api.openweathermap.org/data/2.5/weather?id=2851337&APPID=f7a8b11a00cb27d9f234e7620d8850e0&lang=de&units=metric';
  $jsondata = file_get_contents($json_string);
  $obj = json_decode($jsondata, true);
  
  $now = date('U'); //get current time
  
  if($now > $obj['sys']['sunrise'] and $now < $obj['sys']['sunset']){
	$prefix = 'day-';
  }else{
	$prefix = 'night-';
  }
  echo "<!--"; 
  print_r($obj);
  echo "!-->";
?>
<div class="row align-items-center" style="font-size: 500%; margin: 10px 0px;">
	<div class="col">
		<span><b><?php echo round($obj['main']['temp'], 1);?> &deg;C </b></span>
		<span><i class="wi wi-owm-<?php echo $prefix.$obj['weather'][0]['id'];?>"></i></span>
	</div>
</div>
<div class="row" style="font-size: 130%;">
	<div class="col text-right">
		<div><i class="wi wi-barometer"></i>
			<?php echo $obj['main']['pressure'];?>&nbsp;hPa 
		</div>
	</div>
	<div class="col text-left"> 
			<i class="wi wi-humidity"></i> <?php echo $obj['main']['humidity'];?>&nbsp;% 
	</div>
</div>
<div class="row" style="font-size: 130%;">
	<div class="col text-right">
		<div ><i class="wi wi-strong-wind"></i>
			<?php echo $obj['wind']['speed'];?>&nbsp;m/sec 
		</div>
	</div>
	<div class="col text-left"> 
		<i class="wi wi-wind-direction"></i> <?php echo $obj['wind']['deg'];?>&deg;
	</div>
</div>

</div>
  			<div class="col text-center">
<?php
  $json_string = 'http://api.openweathermap.org/data/2.5/forecast?id=2851337&APPID=f7a8b11a00cb27d9f234e7620d8850e0&lang=de&units=metric';
  $jsondata = file_get_contents($json_string);
  $forecast = json_decode($jsondata, true);
  echo "<!--";
  print_r($forecast['list']);
  echo "!-->";
?>
<div id="wcom-00d7fed59a314571e5bbba68b3d80c2e" class="wcom-default w300x250 align-center" style="border: 0px none; background-color: transparent; border-radius: 0px; color: rgb(255, 0, 0);"><link rel="stylesheet" href="//cs3.wettercomassets.com/woys/5/css/w.css" media="all"><div class="wcom-city"><a style="color: rgb(255, 0, 0);" href="https://www.wetter.com/deutschland/quierschied/fischbach/DE0008466002.html" target="_blank" rel="nofollow" title="Wetter Fischbach">Wetter Fischbach</a></div><div id="wcom-00d7fed59a314571e5bbba68b3d80c2e-weather"></div><script type="text/javascript" src="//cs3.wettercomassets.com/woys/5/js/w.js"></script><script type="text/javascript">_wcomWidget({id: 'wcom-00d7fed59a314571e5bbba68b3d80c2e',location: 'DE0008466002',format: '300x250',type: 'spaces'});</script></div>
<?php
echo "<table><tr>";
$tabelle=array();
foreach($forecast['list'] as $data)
{
	$prefix=($data['sys']['pod']=='d')?"day-":"night-";
/*
	echo "<td style='font-size: 42%;'>";
	echo "<div>".date("d.m.", $data['dt'])."<br />".date("H:i", $data['dt'])."</div>";
	echo "<div><i class='wi wi-owm-".$prefix.$data['weather'][0]['id']."'></i></div>";
	echo "<div><i class='wi wi-thermometer'></i> max. ".$data['main']['temp_max']."&nbsp;&deg;C</div>";
	echo "<div><i class='wi wi-thermometer'></i> min. ".$data['main']['temp_min']."&nbsp;&deg;C</div>";
	echo "<div><i class='wi wi-barometer'></i> ".$data['main']['pressure']."&nbsp;hPa</div>";
	echo "<div><i class='wi wi-humidity'></i> ".$data['main']['humidity']."&nbsp;%</div>";
	echo "<div><i class='wi wi-strong-wind'></i> ".$data['wind']['speed']."&nbsp;m/sec</div>";
	echo "<div><i class='wi wi-wind-direction'></i> ".$data['wind']['deg']."&deg;</div>";
	echo "</td>";
*/
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
				</div>
			</div>
		</div>
	</body>
</html>