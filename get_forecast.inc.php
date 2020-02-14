<?php 
  
// Initialize a file URL to the variable 
$url = 'https://www.yr.no/place/Germany/Saarland/Quierschied/forecast_hour_by_hour.xml'; 
  
// Use basename() function to return the base name of file  
$file_name = 'xml/'.basename($url); 
   
// Use file_get_contents() function to get the file 
// from url and use file_put_contents() function to 
// save the file by using base name 
if(file_put_contents( $file_name,file_get_contents($url))) { 
    $forecast_update=date("d.m.y H:i",date('U')); 
    //echo $forecast_update;
} 
  
?> 