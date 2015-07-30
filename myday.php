<?php
function getFoodRecs($location){
  $ch = curl_init();
    
  curl_setopt($ch, CURLOPT_URL, "http://api.ratings.food.gov.uk/Establishments?longitude=0&latitude=51.4&pageNumber=1&pageSize=10&maxDistanceLimit=1&sortOptionKey=Rating_desc");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-version:2', 'accept: text/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($ch);
  curl_close($ch);      
  

  $data = json_decode($json);
    
  $listData = array();
  foreach ($data->establishments as $item) {
    $listData[] = array(
      'name' => $item->BusinessName,
      'address' => $item->AddressLine1,
      'type' => $item->BusinessType,
      'rating' => $item->RatingValue,
    );
  }
  
  return $listData;
}



$mood = $_POST["mood"];
$travel = $_POST["Method_of_Travel"];
$budget = $_POST["Budget"];
$time = $_POST["Time"];
$location = array(
  "lat" => 50,
  "lng" => 0
);

switch ($mood) {
    case "hungry":
        echo "You are hungry. :P";
        $results = getFoodRecs($location);
        break;
    default:
      	echo "You are " . $mood . ", But we don't support it yet sorry ;(";
}


