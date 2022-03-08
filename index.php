<?php include ('process.php');
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar enerji sistemi hesaplama aracı </title>
    <meta name="description" content="Solar enerji hesaplama, elektrik tüketim hesaplama, fotovoltaik enerji hesaplama, Güneş Elektrik Hesaplama" />
    <meta name="keywords" content="Solar enerji hesaplama aracı,fotovoltaik enerji hesaplama, offgrid sistem hesaplama, akü sistemleri, aydınlatma, Güneş Enerjisi hesaplama, solar akü hesaplama, solar enerji hesaplama">
    <meta name="author" content="" />
    <meta name="googlebot" content="Solar modül hesaplama, off-grid hesaplama aracı, Solar enerjisi hesaplama, akü ile elektrik depolama, akü hesaplama, Solar enerji teklifi almak" />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
    <script>
        // trigger when registration form is submitted

        // jQuery codes
    </script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>-->
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="https://heromuhendislik.com/">
            <img src="hero.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Hero Mühendislik
        </a>
    </nav>
    <h3 class="p-2 bg-warning border" id="descr">Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</h3>
    <div class="container">
        <form action="api/solar/systemval.php" method="POST" id="offgridform" class="form-horizontal" role="form">
            <h3 class="p-2 bg-light border" id="products1">Beyaz Eşya</h3>
            <!-----------------------------------AIR COND..................---------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/air2.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="airconheader">Klima</h5>
                </div>
                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect01" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect02" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="999">9000 BTU</option>
                            <option value="1500">12000 BTU</option>
                            <option value="1800">18000 BTU</option>
                            <option value="2300">22000 BTU</option>
                            <option value="1200">9000 BTU Inverter</option>
                            <option value="1600">12000 BTU Inverter</option>
                            <option value="2000">18000 BTU Inverter</option>
                            <option value="2500">22000 BTU Inverter</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect03">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="houraircon" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect04">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect04" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!---------------------------------------FRIDGE1-------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/fridge.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" name="deneme12" id="fridgeheader">Buzdolabı</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect05">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect05" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect06">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect06" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="65">A Sınıfı mini</option>
                            <option value="50">A+ Sınıfı mini</option>
                            <option value="150">A Sınıfı ev</option>
                            <option value="130">A+ Sınıfı ev</option>
                            <option value="80">A++ Sınıfı ev</option>
                            <option value="70">A+++ Sınıfı ev</option>
                            <option value="150">Derindondurucu</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect07">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourfridge" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect08">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect08" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!---------------------------------------OVEN2------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/oven.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="ovenheader">Fırın</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect09">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect09" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect10">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect10" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="2500">A</option>
                            <option value="2000">A+</option>
                            <option value="1500">A++</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect11">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="houroven" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect12">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect12" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!--------------------------------------DISHWASHER3------------------------------------------>
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/dish.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="dishheader">Bulaşık Makinesi</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect13">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect13" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect14">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect14" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="2750">A</option>
                            <option value="2000">A+</option>
                            <option value="1500">A++</option>
                            <option value="1200">A+++</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect15">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourdish" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect16">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect16" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!--------------------------------------WASHMACHINE4----------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/wash.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="washheader">Çamaşır Makinesi</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect17">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect17" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect18">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect18" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1200">A</option>
                            <option value="900">A+</option>
                            <option value="800">A++</option>
                            <option value="350">A+++</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect19">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourwash" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect20">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect20" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------MICROWAVEOVEN5----------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/micro.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="microheader">Mikrodalga Fırın</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect21">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect21" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect22">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect22" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1000">A+</option>
                            <option value="800">A++</option>
                            <option value="600">A+++</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect23">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourmicro" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect24">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect24" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="p-2 bg-light border" id="products2">Elektronik Ev Eşyası</h3>
            <!----------------------------------------2222222--------------------------------->
            <!-------------------------------------TELEVISION6--------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/tv.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="tvheader">Televizyon</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect25">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect25" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect26">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect26" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="190">Tüplü</option>
                            <option value="200">Plazma</option>
                            <option value="65">27 inç LCD - 68 cm</option>
                            <option value="70">32 inç LCD - 82 cm</option>
                            <option value="42">42 inç LCD - 106 cm</option>
                            <option value="48">48 inç LCD - 122 cm</option>
                            <option value="50">50 inç LCD - 140 cm ve daha büyük</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect27">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourtv" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect28">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect28" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------LAPTOP7------------------------------------------>
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/laptop.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="laptopheader">Dizüstü Bilgisayar</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect29">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect29" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect30">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect30" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="50">50 Watt</option>
                            <option value="100">100 Watt</option>
                            <option value="150">150 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect31">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourlaptop" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect32">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect32" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!------------------------------------DESKTOP8---------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/desktop.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="desktopheader">Masaüstü Bilgisayar</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect33">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect33" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect34">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect34" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="100">100 Watt</option>
                            <option value="150">150 Watt</option>
                            <option value="175">175 Watt</option>
                            <option value="200">200 Watt</option>
                            <option value="250">250 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect35">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourdesktop" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect36">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect36" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------CHARGER9------------------------------------------>
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/charger.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="chargeheader">Şarj Aleti</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect37">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect37" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect38">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect38" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="5">5 Watt</option>
                            <option value="10">10 Watt</option>
                            <option value="15">15 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect39">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourcharge" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect40">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect40" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------SATELLITERECIEVER10------------------------------------------>
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/satellite.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="satelliteheader">Uydu Alıcı</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect41">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect41" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect42">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect42" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="50">50 Watt</option>
                            <option value="75">75 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect43">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hoursat" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect44">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect44" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!------------------------------------------------GAMECONSOLE11---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/gameconsole.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="gameheader">Oyun Konsolu</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect45">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect45" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect46">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect46" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="50">50 Watt</option>
                            <option value="100">100 Watt</option>
                            <option value="150">150 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect47">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourgame" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect48">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect48" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="p-2 bg-light border" id="products4">Küçük Ev Aletleri</h3>
            <!-------------------------------4444444444444444444444444444444---------------------------------->
            <!----------------------------------------KETTLE22---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/kettle.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="kettleheader">Kettle</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect89">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect89" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect90">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect90" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1800">1800 Watt</option>
                            <option value="2000">2000 Watt</option>
                            <option value="2200">2200 Watt</option>
                            <option value="2500">2500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect91">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourkettle" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect92">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect92" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------TOASTMACHINE23---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/toaster.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="toastheader">Tost Makinesi</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect93">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect93" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect94">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect94" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1800">1800 Watt</option>
                            <option value="2000">2000 Watt</option>
                            <option value="2200">2200 Watt</option>
                            <option value="2500">2500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect95">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourtoast" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect96">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect96" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------VACUUMCLEANER15---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/vacuum.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="vacuumheader">Elektrikli Süpürge</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect61">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect61" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect62">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect62" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="700">A Sınıfı 700 Watt</option>
                            <option value="850">B Sınıfı 850 Watt</option>
                            <option value="1000">C Sınıfı 1000 Watt</option>
                            <option value="1200">D Sınıfı 1200 Watt</option>
                            <option value="1500">E Sınıfı 1500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect63">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourvacuum" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect64">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect64" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------HAIRDRYER16---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/hair.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="hairheader">Saç Kurutma Makinesi</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect65">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect65" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect66">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect66" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1500">1500 Watt</option>
                            <option value="2000">2000 Watt</option>
                            <option value="2500">2500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect67">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourhair" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect68">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect68" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------CHARGEDRILL17---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/cdrill.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="cdrillheader">Şarjlı Matkap</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect69">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect69" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect70">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect70" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="500">500 Watt</option>
                            <option value="750">750 Watt</option>
                            <option value="1000">1000 Watt</option>
                            <option value="1250">1250 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect71">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourcdrill" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect72">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect72" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------ELECDRILL18---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/eldrill.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="edrillheader">Elektrikli Matkap</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect73">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect73" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect74">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect74" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="500">500 Watt</option>
                            <option value="750">750 Watt</option>
                            <option value="1000">1000 Watt</option>
                            <option value="1250">1250 Watt</option>
                            <option value="1500">1500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect75">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="houredrill" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect76">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect76" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------HAIRDRYER19---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/fan.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="hairheader">Vantilatör</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect77">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect77" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect78">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect78" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="1500">1500 Watt</option>
                            <option value="2000">2000 Watt</option>
                            <option value="2500">2500 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect79">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourfan" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect80">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect80" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------LAMPLED20---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/lampled.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="ledheader">Led Lamba</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect81">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect81" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect82">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect82" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="9">9 Watt</option>
                            <option value="12">12 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect83">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourled" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect84">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect84" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------LAMP21---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/lamp.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="lampheader">Lamba</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect85">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect85" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect86">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect86" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="16">16 Watt</option>
                            <option value="45">45 Watt</option>
                            <option value="60">60 Watt</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect87">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourlamp" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect88">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect88" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>

            <h3 class="p-2 bg-light border" id="products3">Tesisat</h3>
            <!-----------333333333333333333333333333333333333333333333333333333333333333333333---------------------------->
            <!--------------------------------------HEATPUMP12-------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/heater.svg#Layer_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="heatheader">Isı Pompası</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect49">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect49" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect50">Enerji Sınıfı</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="30000" title="En fazla otuz bin watt giriniz." placeholder="0-30000 watt arası değer" name="wattd[]" id="wattheat" />
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect51">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourheat" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect52">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect52" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!--------------------------------------WATERPUMP13-------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/water.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="waterheader">Su Pompası</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect53">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect53" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect54">Enerji Sınıfı</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="30000" title="En fazla otuz bin watt giriniz." placeholder="0-30000 watt arası değer" name="wattd[]" id="wattwater" />
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect55">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourwater" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect56">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect56" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------------------WATERHEATER14---------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-2">
                    <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                        <use xlink:href="svgs/waterheater.svg#Capa_1"></use>
                    </svg>
                    <h5 class="fw-bold mb-3" id="wheaterheader">Termosifon</h5>
                </div>
                <div class="form-group col-md-2">


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect57">Adet</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect57" name="numberd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 10; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>

                    </div>
                </div>
                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect58">Enerji Sınıfı</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect58" name="wattd[]">
                            <option value="0">Seçiniz</option>
                            <option value="2000">A</option>
                            <option value="1800">A+</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect59">Çalışma Süresi</label>
                        </div>
                        <input class="form-control" type="number" step="0.1" min="0" max="24" title="0-24 arası değer giriniz" placeholder="0,0 (Saat)" name="hourd[]" id="hourwheater" />
                    </div>
                </div>

                <div class="form-group col-md-2">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect60">Gün/Hafta</label>
                        </div>
                        <select class="form-control" id="inputGroupSelect60" name="dayd[]">
                            <script language="javascript" type="text/javascript">
                                for (var i = 0; i <= 7; i++) {
                                    document.write("<option>" + i + "</option>")
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <!---------------------------------------------------------------------------------------------------->
            <h4 class="p-2 bg-light border">GEREKLİ BİLGİLER</h4>

            <!--OTONOMİ SÜRESİ / ENERJİ İHTİYACI DÖNEMİ-->
            <div class="form-row align-items-center">

                <div class="form-group col-md-6">
                    <span class="help-block ">Otonomi Süresi (size yetecek enerji süresi / gün)</span>
                    <select type="text" id="autonomyday1" name="autonomyday" class="form-control " required>
                        <option value="0">Seçiniz</option>
                        <option value="1">1 gün</option>
                        <option value="2">2 gün</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <span class="help-block ">Enerji İhtiyacı Dönemi</span>
                    <select type="text" id="season1" name="season" class="form-control " required>
                        <option value="0">Seçiniz</option>
                        <option value="1">Sürekli</option>
                        <option value="2">Nisan ile Eylül arası</option>
                        <option value="3">Ekim ile Mart arası</option>
                    </select>

                </div>
                <div class="form-group col-md-6">
                    <span class="help-block ">Biliniyorsa Google Harita Koordinatları</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="coordinate"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <span class="help-block ">Varsa diğer belirtmek istediğiniz bilgiler</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="information"></textarea>
                </div>
            </div>
            <h4 class="p-2 bg-light border">İLETİŞİM BİLGİLERİ</h4>
            <!------------------------------------------------------------------------------------------------------------------->
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Ad Soyad</span>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Ad Soyad" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">E-posta</span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="mail@mail.com" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Telefon</span>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="(500)555555" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">GÖNDER</button>


        </form>
    </div>

</body>

</html>