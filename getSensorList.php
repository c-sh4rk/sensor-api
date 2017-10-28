<?php
function getSensorList(){
  global $mysqli;

  $sql = "SELECT sensorId, type FROM sensor_data GROUP BY sensorId, type";
  $query = $mysqli->prepare($sql);
  $query->execute();
  $result = $query->get_result();

  while($row = $result->fetch_assoc()){
    $output[] = $row;
  }

  return $output;
}

?>
