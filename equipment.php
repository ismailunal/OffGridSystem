<?php
include_once 'api/config/database.php';
include_once 'api/objects/equipment.php';



$database = new Database();
$db = $database->getConnection();
$equipment = new Equipment($db);
if (!isset($_POST['delid'])) {
  $eqname = $_POST['eqname'];
  $eqtype = $_POST['eqtype'];
  $eqbrand = $_POST['eqbrand'];
  $equnit = $_POST['equnit'];
  $equnitprice = $_POST['equnitprice'];
  $eqvalue = $_POST['eqvalue'];

  $equipment->name = $eqname;
  $equipment->type = $eqtype;
  $equipment->brand = $eqbrand;
  $equipment->unit = $equnit;
  $equipment->unit_price = $equnitprice;
  $equipment->value = $eqvalue;

  if (empty($_id) || is_null($_id)) {
    if ($equipment->create()) {
      echo "<div class=\"alert alert-success\" role=\"alert\">
      Ekipman Bilgileri Başarı ile Eklendi!
    </div>";
      http_response_code(201);
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">
      Ekipman Bilgileri Eklenirken Sorun oluştu!
    </div>";
      http_response_code(400);
    }
  } else if (!empty($_id) || !is_null($_id)) {
    $_id = $_POST['sequipmentid'];
    if ($equipment->update($_id)) {
      echo "<div class=\"alert alert-success\" role=\"alert\">
      Ekipman Bilgileri Başarı ile Güncellendi!
    </div>";
      http_response_code(201);
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">
      Ekipman Bilgileri Güncellenirken bir sorun oluştu!
    </div>";
      http_response_code(400);
    }
  }
  header("refresh:3;url=solaradmin.php");
};
if (isset($_POST['delid'])) {
  $_id = $_POST['delid'];
  if ($equipment->delete($_id)) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
  Ekipman Bilgileri Silindi!
</div>";
    http_response_code(201);
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
  Ekipman Bilgileri Silinirken bir sorun oluştu!
</div>";
    http_response_code(400);
  }
  header("refresh:3;url=solaradmin.php");
}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>