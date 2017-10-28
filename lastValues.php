<?php
function getLastValues(){
  global $mysqli;

  $sql = "SELECT a.sensorId, a.type, a.timestamp, a.value FROM sensor_data a INNER JOIN (SELECT MAX(id) as maxId, sensorId, type FROM sensor_data GROUP BY sensorId, type) b ON a.id = b.maxId";
  $query = $mysqli->prepare($sql);
  $query->execute();
  $result = $query->get_result();


  $output = array();

  while($row = $result->fetch_assoc()){
    $row["timestamp"] = (new DateTime($row["timestamp"]))->format('c');
    $output[] = $row;
  }
  return $output;

}


 ?>
