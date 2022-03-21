<?php

include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
include_once 'api/objects/solar.php';
include_once 'api/objects/offer_equipment.php';
include_once 'api/config/calculator.php';
include_once 'api/objects/customer.php';

$customerid=$_POST['customerid']; //ok
$equipmentid=$_POST['equipmentid']; //ok
$equipmentquantity=$_POST['quantity']; //ok
$id=$customerid; // funny xd
//$equipmentprice=$_POST['price'];

$equipments_posted=array();
array_push($equipments_posted,$equipmentid,$equipmentquantity);

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
$solar = new Solar($db);
$solarsystem = new Solarsystem($db);
$offer_equipment=new OfferEquipment($db);
$offer_equipment_read=new OfferEquipment($db);
$offer_equipment->cid=$customerid;
$offer_equipment->delete($customerid);
for($i=0;$i<count($equipments_posted[0]);$i++){
    $j=0;
$offer_equipment->eid=$equipments_posted[$j][$i];
$offer_equipment->quantity=$equipments_posted[$j+1][$i];

//$offer_equipment->name=$equipments_posted[][];

if($offer_equipment->create()){
    http_response_code(201);
}
else{
    http_response_code(400);
    }
}

$customerarr=$customer->readbyID($id);
$solararr = $solarsystem->ReadDetail($id);
$offer_equipment_arr = $offer_equipment_read->ReadDetail($id);
$customer->updateStatus($id);
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
        <div class="card-header text-center text-danger">
            <img src="hero.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <img src="hero.png" width="25" height="25" class="d-inline-block align-top" alt="">
            <img src="hero.png" width="20" height="20" class="d-inline-block align-top" alt="">
            SOLAR ENERJİ FİYAT TEKLİFİ
            <img src="hero.png" width="20" height="20" class="d-inline-block align-top" alt="">
            <img src="hero.png" width="25" height="25" class="d-inline-block align-top" alt="">
            <img src="hero.png" width="30" height="30" class="d-inline-block align-top" alt="">
        </div>
        <div class="card-body">
            <!-- <h4 class="p-0 bg-danger border text-center text-white" id="descr">Teklif</h4> -->
            <table>
                <thead> </thead>
                <tbody>
                    <tr>
                        <td>İlgili Kişi : </td>
                        <td><?php 
                        foreach($customerarr['records'] as $customera){
                            echo $customera['name'];
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>E-posta : </td>
                        <td><?php 
                        foreach($customerarr['records'] as $customera){
                            echo $customera['email'];
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Telefon : </td>
                        <td><?php 
                        foreach($customerarr['records'] as $customera){
                            echo $customera['phone'];
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Teklif Veren : </td>
                        <td>Hero Mühendislik Sanayi ve Ticaret LTD. ŞTİ. </td>
                    </tr>
                    <tr>
                        <td>E-posta : </td>
                        <td>bilgi@heromuhendislik.com--teklif@heromuhendislik.com</td>
                    </tr>
                    <tr>
                        <td>Telefon : </td>
                        <td>0554 370 5590</td>
                    </tr>
                </tbody>
            </table>
            <p class="card-text">Önemli Not : Teklif hazırlanırken kullanılan tüm hesaplamalar ortalama tahmini değerlerdir.</p>
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
                        $tax=18; //select from db
                            $dollar=16; //select from db
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

            <h2>Teklif Koşulları</h2>
            <p> İLK TEKLİF GELDİĞİNDE BİR ÖNCEKİ TEKLİF OLUŞTURMA SAYFASINDAN BURAYA GELİNECEK </br>
                SÜREÇTE OLAN TEKLİF DÜZENLEME İŞLEMİ İÇİN EKİPMANLAR OTOMATİK SEÇİLEREK </br>
                ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc</br>
                dddddddddddddddddddd</br>
                eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee</p>

        </div>
    </div>
</body>

</html>