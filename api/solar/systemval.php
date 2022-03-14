<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once '../config/database.php';
include_once '../objects/solar.php';
include_once '../config/calculator.php';
include_once '../objects/customer.php';
include_once '../objects/device.php';
$content = file_get_contents("../../index.php");
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

if(!empty($username)&&!empty($email)&&
!empty($phone)){
   $customer->name = $username;
   $customer->email = $email;
   $customer->phone = $phone;
   $customer->location = $coordinate;
   $customer->information = $information;
   if(!empty($autonomyday) && !empty($season)){
    $customer->autonomyday = $autonomyday;
    $customer->season = $season;
   }
   else{
    $customer->autonomyday = 1;
    $customer->season = 1;
   }
   $customer->created = date("Y-m-d h:i:sa");
}
// create the device and system
if($customer->create()){
  http_response_code(201);
}
else{
  http_response_code(400);
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
// [0][0] [1][0] [2][0] [3][0] [0][1] [1][1] [2][1] [3][1] [0][2] [1][2] [2][2]
$stmt=$device->selectcustomerid();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
  $maxrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
$max = $maxrow['id'];
for($i=0;$i<count($devices[0]);$i++){
     $j=0;
   $device->amount = $devices[$j][$i];
   if($device->amount>0){
     if(isset($matches[1][$i])){
      $device->name=$matches[1][$i];
     }
     else $device->name="Cihaz " . $i;
    $device->watt = $devices[$j+1][$i];
    $device->hour = $devices[$j+2][$i];
    $device->day = $devices[$j+3][$i];  
    $device->cid= $max;
    (float)$solar->connected+=(float)$device->watt*(float)$device->amount;
    $costwattparam=Calculator::cal_costw($device->amount,(float)$device->watt,(float)$device->hour,$device->day);
    $solar->watthour+=$costwattparam;
    $invertedparam=Calculator::cal_inverted($costwattparam);
    $solar->wattinverted+=$invertedparam;
    $requiredparam=Calculator::cal_requiredtotalwatt($invertedparam,$customer->autonomyday);
    $device->wattrequired=$requiredparam;
    $solar->wattrequired+=$requiredparam;
    $capacityparam=$requiredparam/0.6;
    $device->capacity=$capacityparam;
    $solar->capacity+=$capacityparam;
    $amperparam=$capacityparam/24;       //24 ile bölündü 12 ve 48 ihtimalleri var
    $device->amper=$amperparam;
    $solar->amper+=$amperparam;
    $device->solarp=$invertedparam/5/0.7;
    $solar->solarp+=$invertedparam/5/0.7;
    $countparam=$capacityparam/(5*330); //içerideki 330 değeri deşiştirilebilir olmalı
    $device->panelcount=$countparam;
    $solar->panelcount+=$countparam;
if($device->create()){
    http_response_code(201);
}
else{
    http_response_code(400);
    }
}
}
$solar->cid=$max;
if($solar->create()){
  http_response_code(201);
}
else{
  http_response_code(400);
  }
  //----------------------------------------READ-----------------------------------------
 // $stmt = $device->readByName("Klima");
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
              "cid" => $cid
          );
    
          array_push($devices_arr["records"], $device_item);
      }
      http_response_code(200);
     // echo json_encode($devices_arr);
  }
    
  else{
      http_response_code(404);
      echo json_encode(
          array("message" => "No devices found.")
      );
    }

   // --------------------------------------READ WITH CUSTOMER----------------------------------------
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
      // echo json_encode($devices_arr);
   }
     
   else{
       http_response_code(404);
       echo json_encode(
           array("message" => "No devices found.")
       );
     }
    // header('location: https://heromuhendislik.com/');
?>