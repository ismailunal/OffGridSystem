<?php
// start session
session_start();
include_once 'api/config/database.php';
include_once 'api/objects/device.php';
include_once 'api/objects/customer.php';
include_once 'api/objects/solar.php';
include_once 'calculator.php';
 
// class instances will be here
// set page title
$page_title="Solar";
$database = new Database();
$db = $database->getConnection();
$device = new Device($db);
$solar= new Solar($db);

$stmt = $solar->readWithCustomer('test2');
   $num = $stmt->rowCount();
   if($num>0){
       $solars_arr=array("records" =>array());
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           extract($row);   
           $solar_item=array(
               "name" => $name,
               "phone" => $phone,
               "email" => $email,
               "amper" => $amper,
               "solarp" => $solarp,
               "panelcount" => $panelcount
           );    
           array_push($solars_arr["records"], $solar_item);
       }
       http_response_code(200);
       echo  "
       <div class=\"container-fluid\">
    <div class=\"row flex-xl-nowrap\">
        <div class=\"d-none d-xl-block col-xl-2 bd-toc\">
        <div class=\"btn-group-vertical\" role=\"group\" aria-label=\"Vertical button group\">
            <div class=\"input-group mb-3\">
                <input type=\"text\" class=\"form-control\" placeholder=\"İsim Giriniz\" aria-label=\"Order by Name\" aria-describedby=\"button-addon2\">
                <div class=\"input-group-append\">
                    <button class=\"btn btn-dark\" type=\"button\" id=\"fname\">Bul</button>
                </div>
            </div>
            <div class=\"input-group mb-3\">
                <input type=\"text\" class=\"form-control\" placeholder=\"Telefon numarası giriniz\" aria-label=\"Order by Phone\" aria-describedby=\"button-addon2\">
                <div class=\"input-group-append\">
                    <button class=\"btn btn-info\" type=\"button\" id=\"fphone\">Bul</button>
                </div>
            </div>
            <button type=\"button\" class=\"btn btn-dark mb-3\" id=\"date\">Tarihe göre tüm sistemleri sırala</button>
            <button type=\"button\" class=\"btn btn-info mb-3\" id=\"item\">İsme Göre Detaylı Eşya Dökümü Göster</button>
            <button type=\"button\" class=\"btn btn-dark mb-3\" id=\"system\">Sistem Detaylarını Göster</button>
            <button type=\"button\" class=\"btn btn-info mb-3\">Button</button>
        </div>
    </div>
       <main class=\"col-12 col-md-9 col-xl-10 py-md-3 pl-md-7 bd-content\" role=\"main\">
       <table class=\"table table-striped\">
       <thead>
         <tr>
           <th scope=\"col\">İsim</th>
           <th scope=\"col\">Telefon</th>
           <th scope=\"col\">E-posta</th>
           <th scope=\"col\">Gerekli Amper(AH)</th>
           <th scope=\"col\">Güneş Paneli Hesabı</th>
           <th scope=\"col\">PanelSayısı</th>
         </tr>
       </thead>
       <tbody>";
        foreach($solars_arr["records"] as $record){
          echo  "<tr>
      <th scope=\"row\">{$record['name']}</th>
            <td>{$record['phone']}</td>
            <td>{$record['email']}</td>
            <td>{$record['amper']}</td>
            <td>{$record['solarp']}</td>
            <td>{$record['panelcount']}</td>
            
    </tr>";
       // echo "<ul>{$record['id']}</ul>";
        }
        echo " </tbody>
        </table>
            </main>
            </div>
        </div>";

    //   foreach($devices_arr as $device_arr){
    //     echo "<li>{$device_arr} </li>";
    //   }
      
  }
    
  else{
    
      // set response code - 404 Not found
      http_response_code(404);
    
      // tell the user no solar found
      echo json_encode(
          array("message" => "No solar found.")
      );
    }
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lorem ipsum  sit amet consectetur adipisicing elit. Itaque, voluptatibus numquam ab quidem ducimus ex aliquam voluptatem quas, vero doloremque id consequuntur. Nostrum temporibus non voluptatum debitis commodi et animi.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- <script>
    $(document).ready(function(){
        $(document).on('click','#fname',function(){

        })
    })
</script> -->
