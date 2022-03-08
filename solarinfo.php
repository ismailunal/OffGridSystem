<?php
include_once 'api/config/database.php';
include_once 'api/objects/solarsystem.php';
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

                            <div>
                                <select class="form-control" id="inputGroupSelect200" name="panels">
                                    <option value="330">Gse 330W Monokristal Panel</option>
                                    <option value="340">Pantec 340 W Monokristal Panel</option>
                                    <option value="205">Pantec 205W Monokristal panel</option>
                                    <option value="280">Pantec 280W Polikristal Panel</option>
                                    <option value="170">Pantec 170W Polikristal Panel</option>
                                    <option value="40">Pantec 40W Polikristal Panel</option>
                                    <option value="20">Pantec 20W Polikristal Panel</option>
                                </select>
                                <select class="form-control" id="inputGroupSelect201" name="amps">
                                    <option value="24">24 V</option>
                                    <option value="12">12 V</option>
                                    <option value="48">48 V</option>
                                </select>
                                <input type="text" class="form-control" name="inname" placeholder="İsim Giriniz" aria-label="Order by Name" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-dark " type="submit" name="fname">Ara</button>
                                </div>
                            </div>
                            <div>
                                <select class="form-control" id="inputGroupSelect300" name="panels1">
                                    <option value="330">Gse 330W Monokristal Panel</option>
                                    <option value="340">Pantec 340 W Monokristal Panel</option>
                                    <option value="205">Pantec 205W Monokristal panel</option>
                                    <option value="280">Pantec 280W Polikristal Panel</option>
                                    <option value="170">Pantec 170W Polikristal Panel</option>
                                    <option value="40">Pantec 40W Polikristal Panel</option>
                                    <option value="20">Pantec 20W Polikristal Panel</option>
                                </select>
                                <select class="form-control" id="inputGroupSelect301" name="amps1">
                                    <option value="24">24 V</option>
                                    <option value="12">12 V</option>
                                    <option value="48">48 V</option>
                                </select>
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
                            <button type="submit" class="btn btn-dark mb-3" name="ssystem" id="system">Panel Seçimine Göre Göster</button>
                        </div>


                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="innamedel" placeholder="İsim Giriniz" aria-label="Delete" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger mb-3" name="duser">Kullanıcıyı Sil</button>
                            </div>
                        </div>
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
                        $panels = $_POST['panels'];
                        $amps = $_POST['amps'];
                        $iname = $_POST['inname'];
                        $solarsystem->readWithName($panels, $amps, $iname);
                    } else if (isset($_POST['fphone'])) {
                        $panels1 = $_POST['panels1'];
                        $amps1 = $_POST['amps1'];
                        $iphone = $_POST['inphone'];
                        $solarsystem->readWithNumber($panels1, $amps1, $iphone);
                    } else if (isset($_POST['odate'])) {
                        $solarsystem->OrderwithDate();
                    } else if (isset($_POST['fname2'])) {
                        $iname2 = $_POST['inname2'];
                        $solarsystem->ReadDeviceDetail($iname2);
                    } else if (isset($_POST['ssystem'])) {
                        $panels = $_POST['panels'];
                        $solarsystem->showDetails($panels);
                    } else if (isset($_POST['duser'])) {
                        $iname3 = $_POST['innamedel'];
                        $solarsystem->deleteUser($iname3);
                    }


                    if(isset($_POST['id'])){
                        echo "sadsad";
                        $id= $_POST['id'];
                      $solarsystem->delete_data_id($id);
                    }

                    ?>

                </table>
            </main>
        </div>
    </div>

    <script>
$(document).ready(function() {
	
	$(document).on("click", ".btn-danger", function() { 
        var $ele = $(this).parent().parent();
		$.ajax({
			url: "solarinfo.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).attr("id")
			},
			success: function(){
                $ele.fadeOut().remove();
				
			}
		});
	});
});
</script>
</body>

</html>