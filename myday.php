<?php
$mood = $_POST["mood"];
$travel = $_POST["Method_of_Travel"];
$budget = $_POST["Budget"];
$time = $_POST["Time"];
$location = array(
  "lat" => 50,
  "lng" => 0
);

switch ($mood) {
    case "Hungry":
        echo "You are " . $mood;
        break;
    case default:
      echo "You are" . $mood . ", But we don't support it yet sorry ;(";
}
