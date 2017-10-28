<?php
function getValuesInRange(){
  global $mysqli;

  $type = $_GET['type'];
  $sensorId = $_GET['sensorId'];
  if(!$sensorId OR !$type){
    throwError();
  }

  $start = $_GET['start'];
  $end = $_GET['end'];

  if(!$start){
    $start = date("U") - (24*60*60);
  }

  if(!$end){
    $end = date("U");
  }

  $sql = "SELECT timestamp, value FROM sensor_data WHERE sensorId = '".$sensorId."' AND type = '".$type."' AND timestamp BETWEEN FROM_UNIXTIME(".$start.") AND FROM_UNIXTIME(".$end.") ORDER BY timestamp ASC";
  $query = $mysqli->prepare($sql);
  $query->execute();
  $result = $query->get_result();


  while($row = $result->fetch_assoc()){
    $row["timestamp"] = (new DateTime($row["timestamp"]))->format('c');
    $output[] = $row;
  }

  return $output;
}


?>
