<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require 'config/debug.php';
require 'config/db.php';

$mysql = Database::getMySql();

$query = "select distinct name from symptoms";
$res = $mysql->query($query);
$arSymptons = [];
while ($row = mysqli_fetch_assoc($res)) {
  $arSymptons[] = $row;
}

echo json_encode($arSymptons);

Database::closeConnection();
