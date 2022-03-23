<?php
include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
include_once 'api/objects/equipment.php';
include_once 'api/config/calculator.php';
include_once 'api/objects/customer.php';
include_once 'api/objects/general.php';
?>



<style>
    .right-align{ text-align: right; }
</style>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Offgrid Ongrid Solar Panel Sistem Hesaplama Hero Mühendislik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <div class="d-none d-xl-block col-xl-2 bd-toc">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    <form action="" method="POST">
                        <div class="input-group mb-3">

                            <button type="submit" class="btn btn-dark mb-3" name="odate" id="date">Tarihe Göre Teklifleri Göster</button>
                            <!-- <button type="submit" class="btn btn-dark mb-3" name="ssystem" id="system">Bu buton üst buton sonucu olarak dönen liste içerisindeki bulunan butonlara özel çalışacak olup demodur.</button> -->
                            <button type="submit" class="btn btn-dark mb-3" name="upequipment" id="update_equipment">Teçhizat Özelliklerini Güncelle</button>
                            <button type="submit" class="btn btn-dark mb-3" name="bfrom" id="ad_equipment">Toptancıdan Alınan Ürünleri Gir</button>
                            <div>
                            <input type="text" class="form-control" name="updatecurrency" id="cursd" placeholder="Döviz Değerini Giriniz"/>
                            <button type="submit" class="btn btn-dark mb-3" name="upcurrency" id="ad_cur">Döviz Fiyatını Güncelle $</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-7 bd-content" role="main">
           
                <?php 
                
                if (isset($_POST['ssystem']))
                    echo "<form action=\"offer.php\" method=\"POST\">";
                else
                    echo "
                    <table class=\"table table-striped\" id=\"table-content-equipment\">";
                ?>

                <?php
                $database = new Database();
                $db = $database->getConnection();
                $solarsystem = new Solarsystem($db);
                $customer = new Customer($db);
                $equipments = $solarsystem->getEquipments();
                $equip = new Equipment($db);
                $currency=new General($db);
                if(isset($_POST['upcurrency'])){
                    $currencyvalue=$_POST['updatecurrency'];
                    $currency->update($currencyvalue);
                }

                if(isset($_POST['troubleid']))
                $trouble_id=$_POST['troubleid'];
                if (isset($_POST['butid'])) {
                    echo "başarılı";
                }

                if (isset($_POST['odate'])) {
                    $solarsystem->OrderwithDate();
                    echo "</table>";
                } else if (isset($_POST['ssystem'])) {
                    $customerstatus=$customer->readStatus($trouble_id);
                    $solarsystem->showSolarDetails($trouble_id, $equipments,$customerstatus); //
                    //------------------------İD DEĞİŞECEK
                    //id değişecek
                    echo "</table>";
                    if($customerstatus==0 || $customerstatus==2){
                    echo "<div id=\"contentd\">
                        <div>
                            <button type=\"button\" class=\"btn btn-secondary\" id=\"adddev\">EKLE</button>
        
                        </div>";
                    }

                    if ($customerstatus == 2) {
                        echo "<button type=\"submit\" id=\"formbuttontooffer\" class=\"mt-5 btn btn-info btn-lg btn-block\">YENİ TEKLİF DEĞERLERİNİ GÖNDER</button>";
                        echo "
                        </div> </form>";
                        echo "<form action=\"offertable.php\"  method=\"POST\">
                        <input type=\"hidden\" class=\"form-control\" name=\"showcurrent\" id=\"showid\" value=\"000\" readonly/> 
                        <input type=\"hidden\" class=\"form-control\" name=\"offertableid\" id=\"showid\" value=\"{$trouble_id}\" readonly/>
                        <button type=\"submit\" class=\"mt-3 btn btn-warning btn-lg btn-block\">MEVCUT TEKLİFİ GÖRÜNTÜLE</button>";
                    echo "</form>";
                    echo "<form action=\"offertable.php\"  method=\"POST\"> 
                    <input type=\"hidden\" class=\"form-control\" name=\"setsuccess\" id=\"showid\" value=\"111\" readonly/> 
                        <input type=\"hidden\" class=\"form-control\" name=\"offertableid\" id=\"closeid\" value=\"{$trouble_id}\" readonly/>
                        <button type=\"submit\" class=\"mt-3 btn btn-success btn-lg btn-block\">TEKLİFİ OLUMLU SONUÇLANDIR</button>";
                    echo "</form>";
                    echo "<form action=\"offertable.php\"  method=\"POST\"> 
                    <input type=\"hidden\" class=\"form-control\" name=\"setfailed\" id=\"showid\" value=\"222\" readonly/> 
                        <input type=\"hidden\" class=\"form-control\" name=\"offertableid\" id=\"closeid\" value=\"{$trouble_id}\" readonly/>
                        <button type=\"submit\" class=\"mt-3 btn btn-danger btn-lg btn-block\">TEKLİFİ OLUMSUZ SONUÇLANDIR</button>";
                    echo "</form>";
                    } else if($customerstatus == 0) {
                        echo "<button type=\"submit\" class=\"mt-3 btn btn-warning btn-lg btn-block\">TEKLİF OLUŞTUR</button>";
                        echo "
                        </div> </form>";
                    echo "</form>";               
                    }
                    else if($customerstatus == 1) {
                        
                    echo "</form>";
                    echo "<form action=\"offertable.php\"  method=\"POST\"> 
                        <input type=\"hidden\" class=\"form-control\" name=\"offertableid\" id=\"closeid\" value=\"{$trouble_id}\" readonly/>
                        <button type=\"submit\" class=\"mt-5 btn btn-success btn-lg btn-block\">BAŞARILI SOUNÇLANAN TEKLİF</button>";
                    echo "</form>";
                    }
                    else if($customerstatus == 3) {
                    echo "</form>";
                    echo "<form action=\"offertable.php\"  method=\"POST\"> 
                        <input type=\"hidden\" class=\"form-control\" name=\"offertableid\" id=\"closeid\" value=\"{$trouble_id}\" readonly/>
                        <button type=\"submit\" class=\"mt-5 btn btn-danger btn-lg btn-block\">OLUMSUZ SONUÇLANAN TEKLİF</button>";
                    echo "</form>";
                    }
                   
                }
                else if(isset($_POST['customerdeleteform'])){
                    $customer->delete_data($trouble_id);
                    
                }
                else if (isset($_POST['upequipment'])) {
                    $eqloop = $equip->read();
                    echo "<button id=\"equipmentform\"  type=\"button\" class=\"mt-5 btn btn-link btn-lg btn-block addnewequipment\">YENİ TEÇHİZAT EKLE</button>";
                    //                 echo "
                    //                 <h3>Teçhizat Güncelleme</h3>
                    // <form action=\"\" method=\"POST\" id='update_account_form'>
                    //     <div class=\"form-group\">
                    //         <label for=\"eqname\">İsim</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"eqname\" id=\"eqname\" required value=\"Buraya veri çekilecek\" />
                    //     </div>

                    //     <div class=\"form-group\">
                    //         <label for=\"eqtype\">Tip</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"eqtype\" id=\"eqtype\" required value=\"Tip gelecek\" />
                    //     </div>

                    //     <div class=\"form-group\">
                    //         <label for=\"eqbrand\">Marka</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"eqbrand\" id=\"eqbrand\" required value=\"Marka\" />     
                    //                </div>

                    //     <div class=\"form-group\">
                    //         <label for=\"equnit\">Birim</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"equnit\" id=\"equnit\" required value=\"Birim\"/>
                    //     </div>
                    //     <div class=\"form-group\">
                    //         <label for=\"equnitprice\">Birim Fiyatı</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"equnitprice\" id=\"equnitprice\" required value=\"Birim Fiyat\"/>
                    //     </div>
                    //     <div class=\"form-group\">
                    //         <label for=\"eqvalue\">Değer (W/AH/V)</label>
                    //         <input type=\"text\" class=\"form-control\" name=\"eqvalue\" id=\"eqvalue\" required value=\"Değer\"/>
                    //     </div>

                    //     <button type='submit' class='btn btn-primary'>
                    //         Değişiklikleri Kaydet
                    //     </button>
                    // </form>
                    //                 ";
                } else if (isset($_POST['bfrom'])) {
                    echo "
                        <form action=\"supbill.php\" method=\"POST\" id='set_sup_bill'>
                        <div class=\"form-group col-md-6\">
                        <h2>Satın Alma İşlemi</h2>
                        <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Tedarikçi İsmi</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"supname\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
</div>
</div>
<div class=\"form-group col-md-6\">
                        <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Tedarikçi Telefon Numarası</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"supphone\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
</div>
</div>

<div class=\"form-group col-md-6\">
                        <div class=\"input-group mb-3\">
  <div class=\"input-group-prepend\">
    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Fatura Miktarı</span>
  </div>
  <input type=\"text\" class=\"form-control\" name=\"billtotal\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
  <div class=\"input-group-append\">
  <span class=\"input-group-text\">$</span>
  </div>
</div>
<button type='submit' class='btn btn-primary btn-block'>
                                  Kaydet
                             </button>
</div>

</form>
                        ";
                }


                ?>
                </table>
                </form>
            </main>
        </div>
    </div>
    <script>
        var html = `
        <tr>
        <td>
        <select class="form-control" id="inputGroupSelect901" name="equipmentid[]">
        <?php foreach ($equipments as $equipment) {
            echo "<option value=\"{$equipment['id']}\">{$equipment['name']}</option>";
        } ?>                              
                  </select>
        </td>
        <td>
        <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSele">Adet</label>
                        </div>
                        <input class="form-control" type="number" step="0.5" min="0" max="10000" title="Miktar Giriniz" placeholder="Adet" name="quantity[]" id="quantity2" />
                    </div>
       </td>
        
     `;
        $(document).ready(function() {
            $("#adddev").click(function() {
                $("#createrow").append(html);
            });
        });
    </script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

            $('select').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                
            });
            $(document).on('click', '#update_equipment', function() {
                showUpdateEquipment();
            });
            // $(document).on('click', '.btn-warning', function(e) {
            //     // e.preventDefault();
            //     var butid = $(this).attr("id");
            //     $.ajax({
            //         url: "solaradmin.php",
            //         type: "POST",
            //         contentType: "application/json; charset=utf-8",
            //         data: {
            //             butid: butid
            //         },
            //         success: function() {
   

            //         },
            //         failure: function(response) {
            //             alert('in failure callback, response =', response);
            //         }
            //     });
            // });
        });
    </script>
    <script>
        var form = `           <form action="equipment.php\" method=\"POST\" id='set_equipment_values'>
                                        <h3 id="equipmentadd">Teçhizat Ekle</h3>
                                        
                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat İsmi</span>
  
                                <input type="text" class="form-control" name="eqname" id="eqname"  />
                            </div></div>

                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat Türü</span>
                                <input type="text" class="form-control" name="eqtype" id="eqtype"  />
                            </div></div>

                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat Markası</span>
                                <input type="text" class="form-control" name="eqbrand" id="eqbrand"  />     
                                       </div></div>

                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat Birimi</span>
                                <input type="text" class="form-control" name="equnit" id="equnit"/>
                            </div></div>
                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat Birim Fiyatı</span>
                                <input type="text" class="form-control" name="equnitprice" id="equnitprice" />
                            </div></div>
                            <div class="form-group col-md-6">
                            <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Teçhizat Değer (W/AH/V)</span>
                                <input type="text" class="form-control" name="eqvalue" id="eqvalue" />
                            </div></div>
                            <div class="form-group col-md-6">
                            <button type='submit' class='btn btn-primary btn-block equipmentbuttons'>
                                EKLE
                            </button></div></form>
                        
                        `;
                        var id=`
                        <input type="hidden" class="form-control" name="sequipmentid" id="seqid" readonly/>
                        `;


        $(document).ready(function() {
            $(".addnewequipment").click(function() {
                $(".addnewequipment").hide();
                $(".updateequipment").hide();
                $("#table-content-equipment").before(form);
            });
            $(".updateequipment").click(function() {
                $(".addnewequipment").hide();
                $(".updateequipment").hide();
                $("#table-content-equipment").before(form);
                $("#set_equipment_values").prepend(id);
                $("#seqid").val($(this).attr("id"));
                $(".equipmentbuttons").text("GÜNCELLE");    
                $("#equipmentadd").text($(this).text() + " Güncelle")      
            });
            $(".mainformbutton0").click(function() {
                
                    $("#generalformid").val($(this).attr("id"));
                    $("#table-content-equipment").hide();
                   
                   
            });
            $(".mainformbutton1").click(function() {
                  
                $("#generalformid").val($(this).attr("id"));
                $("#table-content-equipment").hide();
                $("#adddev").hide();
                $(".closeable").hide();
            });  
            $(".mainformbutton2").click(function() {
                   
                $("#generalformid").val($(this).attr("id"));
                $("#table-content-equipment").hide();
                
            });  
            $(".mainformbutton3").click(function() {
                   
                $("#generalformid").val($(this).attr("id"));
                $("#table-content-equipment").hide();
                $("#adddev").hide();
                $(".closeable").hide();
            }); 
            $(".deletecustomer").click(function() {
                   
                   $("#generalformid").val($(this).attr("id"));
                   $("#table-content-equipment").hide();
                   
               });               
        });


        $('td').each(function(){ 
    var idx = $(this).index();
    $('tr').each(function(){ $(this).children('td:eq('+idx+')').addClass('right-align');})  
 });
//  $('td').each(function(){ 
//     $('tr').each(function(){ 
        
//         })  
//  });

var fixedvalues=document.getElementsByClassName("right-align");
for (i = 0; i < fixedvalues.length; i++) {
  var currentValue = fixedvalues[i].innerHTML;
  if(!isNaN(currentValue)){
    var newValue = Number(currentValue).toFixed(2);
  fixedvalues[i].innerHTML = newValue;
  }

}

    </script>
</body>

</html>