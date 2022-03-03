<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once 'api/config/database.php';
include_once 'api/objects/solar.php';
include_once 'api/config/calculator.php';
$content = file_get_contents("index.php");
$pattern= '/<h[5-6].*?>(.*)<\/h[5-6]>/i';
preg_match_all($pattern,$content,$matches);
//-----------------
$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
//diğer bilgiler
$autonomyday=$_POST['autonomyday'];
$season=$_POST['season'];
$coordinate=$_POST['coordinate'];
$information=$_POST['information'];
$username=$_POST['username'];
$email=$_POST['email'];
$phone=$_POST['phone'];
if(!empty($autonomyday)&&!empty($season)&&
!empty($username)&&!empty($email)&&
!empty($phone)){
   
   $customer->name = $username;
   $customer->email = $email;
   $customer->phone = $phone;
   $customer->location = $coordinate;
   $customer->information = $information;
   $customer->autonomyday = $autonomyday;
   $customer->season = $season;
   $customer->created = date("Y-m-d h:i:sa");
}
// create the customer
if($customer->create()){
 
  // set response code
  http_response_code(201);

  // display message: customer was created
  //echo json_encode(array("message" => "customer was created."));
}

// message if unable to create customer
else{

  // set response code
  http_response_code(400);

  // display message: unable to create customer
 // echo json_encode(array("message" => "Unable to create customer."));
}
//-----------------------------------------------------------------------------------------------------------
$device = new Device($db);
$numbers =$_POST['numberd'];
$watts=$_POST['wattd'];
$hours=$_POST['hourd'];
$days=$_POST['dayd'];
$devices=array();

array_push($devices,$numbers,$watts,$hours,$days);

$solar =new Solar($db);
//print_r($devices);
//  0->numbers
//  1->watts
//  2->hours
//  3->days
// must go [0][0] [1][0] [2][0] [3][0] [0][1] [1][1] [2][1] [3][1] [0][2] [1][2] [2][2]

// foreach($devices as $key){
//     echo "\n";
//     foreach($key as $subkey){
//         echo $subkey ;
//     }
// }
//echo count($devices);
$stmt=$device->selectuserid();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
  $maxrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
$max = $maxrow['id'];
//$max++;
for($i=0;$i<count($devices[0]);$i++){
   // for($j=0;$j<count($devices);$j++){
     //   echo $devices[$j][$i] . "-----------";
     $j=0;
   // $device->name = $devices[$j][$i];
   $device->amount = $devices[$j][$i];
   if($device->amount>0){
    $device->name=$matches[1][$i];
    $device->watt = $devices[$j+1][$i];
    $device->hour = $devices[$j+2][$i];
    $device->day = $devices[$j+3][$i];  
    $device->userid= $max;
    (float)$solar->connected+=(float)$device->watt*(float)$device->amount;
    $costwattparam=Calculator::cal_costw($device->amount,$device->watt,$device->hour,$device->day);
    $solar->watthour+=$costwattparam;
    $invertedparam=Calculator::cal_inverted($costwattparam);
    $solar->wattinverted+=$invertedparam;
    $requiredparam=Calculator::cal_requiredtotalwatt($invertedparam,$customer->autonomyday);
    $solar->wattrequired+=$requiredparam;
    $capacityparam=$requiredparam/0.6;
    $solar->capacity+=$capacityparam;
    $amperparam=$capacityparam/24;       //24 ile bölündü 12 ve 48 ihtimalleri var
    $solar->amper+=$amperparam;
    $solar->solarp+=$invertedparam/5/0.7;
    $countparam=$capacityparam/(5*330); //içerideki 330 değeri deşiştirilebilir olmalı
    $solar->panelcount+=$countparam;
 
if($device->create()){
 
    // set response code
    http_response_code(201);
 
    // display message: device was created
    //echo json_encode(array("message" => "device was created."));
}
 
// message if unable to create device
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create device
    //echo json_encode(array("message" => "Unable to create device."));

    }
}
}
$solar->userid=$max;
if($solar->create()){
 
  // set response code
  http_response_code(201);

  // display message: device was created
  //echo json_encode(array("message" => "device was created."));
}

// message if unable to create device
else{

  // set response code
  http_response_code(400);

  // display message: unable to create device
  //echo json_encode(array("message" => "Unable to create device."));

  }
  //print_r($device->readByName("Klima")) ;
  //----------------------------------------READ-----------------------------------------
  $stmt = $device->readByName("Klima");
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

   // --------------------------------------READ WITH CUSTOMER----------------------------------------
   //$stmt = $solar->readWithCustomer('Mustafa');
   $num = $stmt->rowCount();
   if($num>0){
       $devices_arr=array("records" =>array());
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           extract($row);   
           $device_item=array(
               "name" => $name,
               "phone" => $phone,
               "email" => $email,
               "amper" => $amper,
               "solarp" => $solarp,
               "panelcount" => $panelcount
           );    
           array_push($devices_arr["records"], $device_item);
       }
       http_response_code(200);
       echo json_encode($devices_arr);
   }
     
   else{
       http_response_code(404);
       echo json_encode(
           array("message" => "No devices found.")
       );
     }
?>