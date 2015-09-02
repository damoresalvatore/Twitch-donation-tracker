<?php    
$json = file_get_contents("https://api.twitch.tv/kraken/streams/UpATreeZelda.json?");
echo $json;
?>