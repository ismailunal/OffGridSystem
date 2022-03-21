<?php
include_once 'api/config/database.php';
include_once 'api/objects/bill.php';
include_once 'api/objects/supplier.php';

$name = $_POST['supname'];
$phone = $_POST['supphone'];
$total = $_POST['billtotal'];
$database = new Database();
$db = $database->getConnection();
$bill = new Bill($db);
$supplier = new Supplier($db);

$supplier->name = $name;
$supplier->phone = $phone;
$bill->created = date("Y-m-d h:i:sa");
$bill->total = $total;

if ($supplier->create()) {
    http_response_code(201);
} else {
    http_response_code(400);
}

$stmt = $bill->selectsupplierid();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num > 0) {
    $maxrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
$max = $maxrow['id'];
$bill->sid = $max;

if ($bill->create()) {
    http_response_code(201);
    echo "<div class=\"alert alert-success\" role=\"alert\">
        Fatura Bilgileri Başarı ile Eklendi!
      </div>";
} else {
    http_response_code(400);
    echo "<div class=\"alert alert-danger\" role=\"alert\">
        Fatura Bilgileri Eklenirken Bir Sorunla Karşılaşıldı!
      </div>";
}
header("refresh:3;url=solaradmin.php");
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