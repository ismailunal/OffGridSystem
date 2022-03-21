<?php 
include_once 'api/config/database.php';
include_once 'api/objects/equipment.php';

$eqname = $_POST['eqname'];
$eqtype = $_POST['eqtype'];
$eqbrand = $_POST['eqbrand'];
$equnit = $_POST['equnit'];
$equnitprice = $_POST['equnitprice'];
$eqvalue = $_POST['eqvalue'];
if(isset($_POST['sequipmentid'])){
   $id= $_POST['sequipmentid']; 
};


$database = new Database();
$db = $database->getConnection();
$equipment = new Equipment($db);

$equipment->name = $eqname;
$equipment->type = $eqtype;
$equipment->brand = $eqbrand;
$equipment->unit = $equnit;
$equipment->unit_price = $equnitprice;
$equipment->value = $eqvalue;

if(empty($id) || is_null($id)){
  
    if ($equipment->create()) {
        echo "oluşturma";
        http_response_code(201);
    } else {
        http_response_code(400);
    }
}
else if(!empty($id) || !is_null($id)){
  
    if ($equipment->update($id)) {
        echo "güncelle";
        echo $id;
        http_response_code(201);
    } else {
        http_response_code(400);
    }
}
header("refresh:3;url=solaradmin.php");

?>