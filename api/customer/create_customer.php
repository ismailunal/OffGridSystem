<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate customer object
$customer = new Customer($db);
 
// get posted data
    $data = json_decode(file_get_contents("php://input"));
 if(!empty($data->name)&&!empty($data->email)&&
 !empty($data->phone)&&!empty($data->location)&&
 !empty($data->information)&&!empty($data->autonomyday)&&
 !empty($data->season)){
    echo $data->name;
    $customer->name = $data->name;
    $customer->email = $data->email;
    $customer->phone = $data->phone;
    $customer->location = $data->location;
    $customer->information = $data->information;
    $customer->autonomyday = $data->autonomyday;
    $customer->season = $data->season;
    $customer->created = date("Y-m-d h:i:sa");
 }
// set customer property values

 
// create the customer
if($customer->create()){
 
    // set response code
    http_response_code(201);
 
    // display message: customer was created
    echo json_encode(array("message" => "customer was created."));
}
 
// message if unable to create customer
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create customer
    echo json_encode(array("message" => "Unable to create customer."));
}
?>