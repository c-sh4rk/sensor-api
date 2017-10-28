<?php
$mysqli = new mysqli("localhost", "root", "mysql37", "sensors");

$output = null;
$mode = $_GET['mode'];

if(!$mode){
  $mode = "lastValues";
}

if($mode == "lastValues"){
  require_once("./lastValues.php");
  $output = getLastValues();
}

if($mode == "getSensorList"){
  require_once("./getSensorList.php");
  $output = getSensorList();
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
echo json_encode($output);
 ?>
