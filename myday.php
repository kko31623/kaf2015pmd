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
        $results = getFoodRecs($location);
        break;
    default:
      	echo "You are " . $mood . ", But we don't support it yet sorry ;(";
}
?>

<html>
<head>
<link rel="stylesheet" href="CSS/stylesheet.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Patrick+Hand|Permanent+Marker|Rock+Salt" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="main">
  <ol>
    <?php foreach($results as $result): ?>
      <li>
        <h3><?= $result["name"] ?></h3>
      </li>
    <?php endforeach ?>
  </ol>




</div> 
</body>
</html>


