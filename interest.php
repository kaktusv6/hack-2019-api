<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require 'config/debug.php';
require 'config/db.php';

$mysql = Database::getMySql();

$startDate = $_REQUEST['date_start'];
$endDate = $_REQUEST['date_end'];
$symptoms = $_REQUEST['symptoms'];

$query = "select regions.latitude as 'lat', regions.longitude as 'lng', symptoms.name as 'symptom', interest.fact_interest, interest.date
          from interest
          inner join regions on interest.region_id = regions.id
          inner join symptoms on interest.symptom_id = symptoms.id WHERE interest.date between '$startDate' and '$endDate'";

if (count($symptoms) > 0) {
  $query .= " and symptoms.name in ( '";
  for ($i = 0; $i < count($symptoms); $i++) {
    $query .= $symptoms[$i];
    if ($i != count($symptoms) - 1) {
      $query .= "', '";
    }
    else {
      $query .= "' )";
    }
  }
}

$res = $mysql->query($query);
$arInteresting = [];
while ($row = mysqli_fetch_assoc($res)) {
  $arInteresting[] = $row;
}

echo json_encode($arInteresting);
