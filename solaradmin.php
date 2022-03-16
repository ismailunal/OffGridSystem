<?php
include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
include_once 'api/objects/equipment.php';
include_once 'api/config/calculator.php';
?>





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
                            <button type="submit" class="btn btn-dark mb-3" name="ssystem" id="system">Bu buton üst buton sonucu olarak dönen liste içerisindeki bulunan butonlara özel çalışacak olup demodur.</button>
                            <button type="submit" class="btn btn-dark mb-3" name="upequipment" id="update_equipment">Teçhizatları Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
            <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-7 bd-content" role="main">
           <?php if (isset($_POST['ssystem']))echo "<form action=\"offer.php\" method=\"POST\">";
           else
            echo "<table class=\"table table-striped\" id=\"table-content\">";
           ?>
                
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $solarsystem = new Solarsystem($db);
                    $equipments = $solarsystem->getEquipments();
                    $equip = new Equipment($db);
                    
                    if(isset($_POST['butid'])){
                        echo "başarılı";
                    }                
                    
                    if (isset($_POST['odate'])) {
                        $solarsystem->OrderwithDate();
                        echo "</table>";
                    } else if (isset($_POST['ssystem'])) {
                        
                        $solarsystem->showSolarDetails(34, $equipments);
                        echo "</table>";
                        echo "<div id=\"contentd\">
                        <div>
                            <button type=\"button\" class=\"btn btn-secondary\" id=\"adddev\">EKLE</button>
        
                        </div>
                        <button type=\"submit\" class=\"mt-5 btn btn-success btn-lg btn-block\">TEKLİF OLUŞTUR</button>
                        </div> </form>";
                        echo "</form>";
                    } else if (isset($_POST['upequipment'])) {
                        $eqloop = $equip->read();
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
        <select class="form-control" id="inputGroupSelect901" name="equipment[]">
        <?php foreach ($equipments as $equipment) {
            echo "<option>{$equipment['name']}</option>";
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
        <td><input class=\"form-control\" type=\"text\"  readonly>  </td>
     `;
        $(document).ready(function() {
            $("#adddev").click(function() {
                $("#createrow").append(html);
            });
        });
    </script>
    <!--BUG WARNING dont use .btn-danger class for other button  -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

            $('select').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                alert(valueSelected);
            });
            $(document).on('click', '#update_equipment', function() {
                showUpdateEquipment();
            });
            $(document).on('click', '.btn-warning', function(e) {
               // e.preventDefault();
                var butid = $(this).attr("id");
                $.ajax({
                    url: "solaradmin.php",
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    data: {
                        butid: butid
                    },
                    success: function(result) {
                      //  event.preventDefault() ;
                        alert('success');
                        alert('in success callback response ='+ (result)); 
                        alert(butid);

                    },
                    failure: function (response) { 
            alert('in failure callback, response =', response); 
        } 
                });
            });
        });
    </script>
</body>

</html>