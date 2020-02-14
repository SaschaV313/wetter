<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wetterstation</title>
	<meta http-equiv="refresh" content="600">
	<link href="css/styles.min.css" rel="stylesheet">
	<link href="css/clock.css" rel="stylesheet">
	<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
	<link href="css/weather-icons-wind.min.css" rel="stylesheet" type="text/css">
	<script src="js/calendar.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
	<script type="text/javascript" src="js/coolclock.js"></script>
	<script type="text/javascript" src="js/moreskins.js"></script>
	<script src="code/highcharts.js"></script>
	<script type="text/javascript" src="code/themes/dark-unica.js"></script>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
		CoolClock.config.skins = {
			mySkin: {
				outerBorder: {
					lineWidth: 0,
					radius: 0,
					color: "white",
					alpha: 0
				},
				smallIndicator: {
					lineWidth: 2,
					startAt: 89,
					endAt: 94,
					color: "red",
					alpha: 1
				},
				largeIndicator: {
					lineWidth: 4,
					startAt: 83,
					endAt: 94,
					color: "red",
					alpha: 1
				},
				hourHand: {
					lineWidth: 8,
					startAt: 0,
					endAt: 60,
					color: "red",
					alpha: 1
				},
				minuteHand: {
					lineWidth: 4,
					startAt: 0,
					endAt: 80,
					color: "red",
					alpha: 1
				},
				secondHand: {
					lineWidth: 1,
					startAt: 0,
					endAt: 85,
					color: "red",
					alpha: 1
				},
				secondDecoration: {
					lineWidth: 3,
					startAt: 0,
					radius: 4,
					fillColor: "red",
					color: "red",
					alpha: 1
				}
			}
		}
	</script>
</head>

<body onload="CoolClock.findAndCreateClocks()">
	<table class="table-center">
		<tr class="h50">
			<td align=center>
				<canvas id="clk1" class="CoolClock:mySkin:175"></canvas>
			</td>
			<td align=center>
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
				<table>
					<tr style="font-size: 500%;">
						<td align=center style="padding: 10px">
							<b><?php echo round($obj['main']['temp'], 1);?> &deg;C </b>
						</td>
						<td>
							<i class="wi wi-owm-<?php echo $prefix.$obj['weather'][0]['id'];?>"></i>
						</td>
					</tr>
					<tr style="font-size: 130%;">
						<td align=right style="padding: 10px;">
							<i class="wi wi-barometer"></i> <?php echo $obj['main']['pressure'];?>&nbsp;hPa
						</td>
						<td aligh=left style="padding: 10px;">
							<?php echo $obj['main']['humidity'];?>&nbsp;<i class="wi wi-humidity"></i> 
						</td>
					</tr>
					<tr style="font-size: 130%;">
						<td align=right style="padding: 10px;">
							<i class="wi wi-strong-wind"></i> <?php echo $obj['wind']['speed'];?>&nbsp;m/sec
						</td>
						<td align=left style="padding: 10px;">
							<i class='wi wi-wind <?php echo "from-".ceil((round(($obj['wind']['deg'])/22.5) % 16)*22.5)."-deg'>";?></i>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="h50">
			<td align=center>
			<script type="text/javascript">
					Kalender(dm, dj);
				</script>
			</td>
			<td>
				<?php include('chart.inc.php'); ?>
			</td>
		</tr>
	</table>
	<div class="update">OWM Update: <?php echo date("d.m.y H:i",$now); ?></div>
	<div class="fc-update">YR.no Update: <?php echo $forecast_update; ?></div>
</body>
</html>