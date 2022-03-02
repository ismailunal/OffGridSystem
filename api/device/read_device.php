<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/device.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$device = new Device($db);
  
// query products
$stmt = $device->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
  
    // products array
    $devices_arr=array("records" =>array());
 
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $device_item=array(
            "id" => $id,
            "name" => $name,
            "amount" => $amount,
            "watt" => $watt,
            "hour" => $hour,
            "day" => $day,
            "costwatt" => $costwatt,
            "invertedwatt" => $invertedwatt,
            "requiredamper" => $requiredamper,
            "userid" => $userid
        );
  
        array_push($devices_arr["records"], $device_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show devicess data in json format
    echo json_encode($devices_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no devices found
    echo json_encode(
        array("message" => "No devices found.")
    );
}