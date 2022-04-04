<?php

include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
include_once 'api/objects/solar.php';
include_once 'api/objects/offer_equipment.php';
include_once 'api/config/calculator.php';
include_once 'api/objects/customer.php';
include_once 'api/objects/general.php';
include_once 'api/objects/device.php';

$customerid=$_POST['customerid']; //ok
$equipmentid=$_POST['equipmentid']; //ok
$equipmentquantity=$_POST['quantity']; //ok
$panelwatt=$_POST['inputForChangeWatt'];
// if(gettype($panelwatt)==='string'){
//     $panelwatt=(int)330;
// }
$voltah=$_POST['inputForChangeVolt'];
// if(gettype($voltah)==='string'){
//     $voltah=(int)24;
// }
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
$general=new General($db);
$device=new Device($db);
$prewatt=$solar->readWatt($customerid);
$prevolt=$solar->readVolt($customerid);
// $solar->panelwatt=$panelwatt;
// $solar->voltah=$voltah;
$panelcount= $solar->readPanelCount($customerid) *$solar->readWatt($customerid) / $panelwatt;
$amper= $solar->readAmper($customerid) * $solar->readVolt($customerid) / $voltah;
// $solar->panelcount= $panelcount;
// $solar->amper=  $amper;

$solar->updateSolarValues($customerid,$panelwatt,$voltah,$panelcount,$amper);
$offer_equipment->cid=$customerid;
$customerstatus=$customer->readStatus($customerid);

if($customerstatus==0){
    $customerstatus=2;
    $customer->updateStatus($customerid,$customerstatus);
}
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
//$customer->updateStatus($id);
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
            <a class="text-danger" href="solaradmin.php">SOLAR ENERJİ FİYAT TEKLİFİ</a>
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
                        $voltdev=$prevolt/$voltah;
                        foreach ($solararr as $record) {
                             $panco=$record['panelcount']*$prewatt/$panelwatt;
                             $amperdev=$record['amper']*$voltdev;
                             $deviceid=$record['id'];
                           $device->updateDevices($panco,$amperdev,$deviceid,$customerid);
     
                            echo  "<tr>
<td>{$record['name']}</td>          
<td>{$record['amount']}</td>
<td>{$record['watt']}</td>
<td>" . number_format($record['hour'],1) ."</td>
<td>{$record['day']}</td>
<td>";echo number_format($panco,1); echo "</td>
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
                        <th id="canhide" scope="col">Birim Fiyat</th>
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
                        <td id=\"bbb\">
                       {$record['quantity']}
                        </td>
                        <td id=\"canhidesub\">" . number_format($record['unit_price'],1) ."$</td>
                        <td>". number_format($total_unique_price,2) . " $</td></tr> " ;
                        }
                        ?>
                    
                    <tr>
                        <td></td>
                        <td>1$=<?php echo number_format($dollar,2) ?>TL</td>
                        <td class="text-danger">Toplam</td>
                        <td><?php echo number_format($total_price,1)?> $</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">KDV</td>
                        <td><?php echo number_format(($total_price*$tax/100),1); ?>$</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">Genel Toplam</td>
                        <td><?php echo number_format($total_price+($total_price*$tax/100),1);?> $</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-danger">Genel Toplam</td>
                        <td><?php echo number_format($dollar*($total_price+($total_price*$tax/100)),2);
                            $solar->addPrice($dollar*($total_price+($total_price*$tax/100)),$customerid);
                        ?> TL</td>
                    </tr>
                </tbody>
            </table>
            <script>

$(document).ready(function() {
     var tmp="";
    var fixtd=`<td id="fixtd"></td>`;
            $("#canhide").click(function() {
                if(tmp===""){
                    $("#canhide").html(tmp);
                    $("#canhidesub").hide();
                    $("#bbb").after(fixtd);
                    tmp="Birim Fiyat";
                }
                else{
                    $("#canhide").html(tmp);
                    $("#canhidesub").show();
                    $('#fixtd').remove();
                    tmp="";
                }
            });
        });
            </script>

            <h2>Teklif Koşulları</h2>
            <p>Fiyatlarımız nakit fiyattır. Ödeme yöntemleri için detay konuşulabilir. </br>
                 Birim fiyatlara KDV dahildir. </br>
                 Fiyatlarımız verildiği tarihten itibaren 15 gün geçerlidir.</br>
                 Döviz olarak verilen tekliflerde ödeme, döviz cinsinden alınmaktadır. Faturanın not bölümüne, TL olarak kesilmiş olan faturanın, döviz cinsinden değeri yazılacaktır.</br>
                Tüm sipariş, alıcı firmanın fiyat teklifine kaşe ve imza ile onay vermesiyle bir seferde alınır.</br>
                Geciken ödemeler için aylık %8 gecikme cezası uygulama hakkımız saklıdır.</br>
                Teklifimiz bir bütündür bölünemez. </br>
                İhtilaf halinde Antalya mahkemeleri ve icra daireleri yetkilidir.</br>
            </p>

        </div>
    </div>
</body>

</html>