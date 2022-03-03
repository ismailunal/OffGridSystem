<?php
include_once 'api/config/database.php';
include_once 'api/solar/solarsystem.php';
include_once 'api/config/calculator.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lorem ipsum sit amet consectetur adipisicing elit. Itaque, voluptatibus numquam ab quidem ducimus ex aliquam voluptatem quas, vero doloremque id consequuntur. Nostrum temporibus non voluptatum debitis commodi et animi.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <div class="d-none d-xl-block col-xl-2 bd-toc">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    <form action="" method="POST">
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" name="inname" placeholder="İsim Giriniz" aria-label="Order by Name" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark " type="submit" name="fname">Ara</button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="inphone" placeholder="Telefon numarası giriniz" aria-label="Order by Phone" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit" name="fphone">Ara</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark mb-3" name="odate" id="date">Tarihe göre tüm sistemleri sırala</button>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="inname2" placeholder="İsim Giriniz" aria-label="Order by Name" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info mb-3" name="fname2" id="item">İsme Göre Detaylı Eşya Dökümü Göster</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark mb-3" name="ssystem" id="system">Sistem Detaylarını Göster</button>
                        <button type="submit" class="btn btn-info mb-3">Button</button>
                    </form>
                </div>
            </div>
            <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-7 bd-content" role="main">
                <table class="table table-striped">
                    <?php
                    $database = new Database();
                    $db = $database->getConnection();
                    $solarsystem = new Solarsystem($db);
                    if (isset($_POST['fname'])) {
                        $iname = $_POST['inname'];
                        $solarsystem->readWithName($iname);
                    } else if (isset($_POST['fphone'])) {
                        $iphone = $_POST['inphone'];
                        $solarsystem->readWithNumber($iphone);
                    } else if (isset($_POST['odate'])) {
                        $solarsystem->OrderwithDate();
                    } else if(isset($_POST['fname2'])){
                        $iname2 = $_POST['inname2'];
                        $solarsystem->ReadDeviceDetail($iname2);
                    }

                    ?>

                </table>
            </main>
        </div>
    </div>
</body>

</html>