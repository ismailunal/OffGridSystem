<?php

include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
include_once 'api/objects/solar.php';
include_once 'api/objects/offer_equipment.php';
include_once 'api/config/calculator.php';
include_once 'api/objects/customer.php';
include_once 'api/objects/general.php';

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
$solar = new Solar($db);
$solarsystem = new Solarsystem($db);
$offer_equipment=new OfferEquipment($db);
$offer_equipment_read=new OfferEquipment($db);
$general=new General($db);

$customerid=$_POST['offertableid'];



$customerarr=$customer->readbyID($customerid);
$solararr = $solarsystem->ReadDetail($customerid);
$offer_equipment_arr = $offer_equipment_read->ReadDetail($customerid);

if(isset($_POST['setsuccess'])){
    $customer->updateStatus($customerid,1);
}
if(isset($_POST['setfailed'])){
    $customer->updateStatus($customerid,3);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card">
    <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cihazlar</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Gücü</th>
                        <th scope="col">Kullanım Saati</th>
                        <th scope="col">Hafalık Kullanım/Gün</th>
                        <th scope="col">Gerekli Panel Sayısı</th>
                    </tr>
                    <tr>
                        <?php
                        foreach ($solararr as $record) {
                            echo  "<tr>
<td>{$record['name']}</td>          
<td>{$record['amount']}</td>
<td>{$record['watt']}</td>
<td>{$record['hour']}</td>
<td>{$record['day']}</td>
<td>{$record['panelcount']}</td>
</tr>";
                        } ?>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Kapsam</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Birim Fiyat</th>
                        <th scope="col">Toplam Fiyat</th>
                    </tr>
                </thead>
                <tbody>
                   
                        <?php
                        //offer_equipment_arr
                        $total_price=0;
                        $tax=$general->readtax();
                            $dollar=$general->readcurrency();
                        foreach($offer_equipment_arr as $record){
                            $total_unique_price= $record['unit_price'] * $record['quantity'];
                            $total_price+=$total_unique_price;
                            
                            echo   "<tr><td>
                             {$record['name']}
                        </td>
                        <td>
                       {$record['quantity']}
                        </td>
                        <td>{$record['unit_price']} $</td>
                        <td>{$total_unique_price} $</td></tr> " ;
                        }
                        ?>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">Toplam</td>
                        <td><?php echo $total_price?> $</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">KDV</td>
                        <td><?php echo $total_price*$tax/100; ?>$</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">Genel Toplam</td>
                        <td><?php echo $total_price+($total_price*$tax/100);?> $</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">Genel Toplam</td>
                        <td><?php echo $dollar*($total_price+($total_price*$tax/100));
                            $solar->addPrice($dollar*($total_price+($total_price*$tax/100)),35);
                        ?> TL</td>
                    </tr>
                </tbody>
            </table>
            <h4>TEKLİFİN YAPILDIĞI ZAMANDAKİ GENEL TOPLAM  <?php echo $solar->readofferprice($customerid) ?> TL İDİ.</h4>
    </div>
    <a class="btn btn-primary" href="solaradmin.php">Panel Ekranına Geri Dön</a>
</body>