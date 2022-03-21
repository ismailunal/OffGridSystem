
<?php
class Solarsystem
{
    private $conn;
    private $table_name_s = "solars";
    private $table_name_c = "customers";
    private $table_name_d = "devices";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function readWithName($panel, $amp, $name)
    {
        $query = "SELECT
        c.name,c.phone,c.email,s.connected,s.amper,s.solarp,s.panelcount 
   FROM
       " . $this->table_name_s . " s," . $this->table_name_c . " c WHERE c.name like ? AND c.id=s.cid" . "";
        $stmt = $this->conn->prepare($query);
        $name = "%$name%";
        $stmt->execute([$name]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            $solars_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $solar_item = array(
                    "name" => $name,
                    "phone" => $phone,
                    "email" => $email,
                    "connected" => $connected,
                    "amper" => $amper * (24 / $amp),
                    "solarp" => $solarp,
                    "panelcount" => $panelcount * (330 / $panel)
                );
                array_push($solars_arr["records"], $solar_item);
            }
            http_response_code(200);
            echo  "
            <thead>
            <tr>
               <th scope=\"col\">İsim</th>
               <th scope=\"col\">Telefon</th>
               <th scope=\"col\">E-posta</th>
               <th scope=\"col\">Bağlı(connected) Watt</th>
               <th scope=\"col\">Gerekli Amper(AH)</th>
               <th scope=\"col\">Güneş Paneli Hesabı</th>
               <th scope=\"col\">PanelSayısı</th>
             </tr> </thead> <tbody>";
            foreach ($solars_arr["records"] as $record) {
                echo  "<tr>
<th scope=\"row\">{$record['name']}</th>
<td>{$record['phone']}</td>
<td>{$record['email']}</td>
<td>{$record['connected']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>
</tr>";
            }
            echo "</tbody>";
        } else if ($num == 0) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Kullanıcı Bulunamadı!
          </div>";
        }
        //return $stmt;
    }
    //-----------------------------------------------------------------------------------------------------------------------------
    function readWithNumber($panel, $amp, $number)
    {
        $query = "SELECT
        c.name,c.phone,c.email,s.connected,s.amper,s.solarp,s.panelcount 
   FROM
       " . $this->table_name_s . " s," . $this->table_name_c . " c WHERE c.phone like ? AND c.id=s.cid" . "";
        $stmt = $this->conn->prepare($query);
        $phone = "%$number%";
        $stmt->execute([$phone]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            $solars_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $solar_item = array(
                    "name" => $name,
                    "phone" => $phone,
                    "email" => $email,
                    "connected" => $connected,
                    "amper" => $amper * (24 / $amp),
                    "solarp" => $solarp,
                    "panelcount" => $panelcount * (330 / $panel)
                );
                array_push($solars_arr["records"], $solar_item);
            }
            http_response_code(200);
            echo  "
            <thead>
            <tr>
               <th scope=\"col\">İsim</th>
               <th scope=\"col\">Telefon</th>
               <th scope=\"col\">E-posta</th>
               <th scope=\"col\">Bağlı(connected) Watt</th>
               <th scope=\"col\">Gerekli Amper(AH)</th>
               <th scope=\"col\">Güneş Paneli Hesabı</th>
               <th scope=\"col\">PanelSayısı</th>
             </tr> </thead> <tbody>";
            foreach ($solars_arr["records"] as $record) {
                echo  "<tr>
<th scope=\"row\">{$record['name']}</th>
<td>{$record['phone']}</td>
<td>{$record['email']}</td>
<td>{$record['connected']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>

</tr>";
            }
            echo "</tbody>";
        } else if ($num == 0) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Kullanıcı Bulunamadı!
          </div>";
        }
        //return $stmt;
    }
    //-----------------------------------------------------------------------------------------------------------------
    function OrderwithDate()
    {
        $query = "SELECT
         c.name,c.phone,c.email,s.amper,s.solarp,s.panelcount,c.created,s.cid,c.status 
    FROM
        " . $this->table_name_s . " s," . $this->table_name_c . " c WHERE c.id=s.cid ORDER BY c.created" . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $solars_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $solar_item = array(
                    "name" => $name,
                    "phone" => $phone,
                    "email" => $email,
                    "amper" => $amper,
                    "solarp" => $solarp,
                    "panelcount" => $panelcount,
                    "created" => $created,
                    "cid" => $cid,
                    "status" => $status
                );
                array_push($solars_arr["records"], $solar_item);
            }
            http_response_code(200);
            echo  "
            <thead>
            <tr>
               <th scope=\"col\">İsim</th>
               <th scope=\"col\">Telefon</th>
               <th scope=\"col\">E-posta</th>
               <th scope=\"col\">Gerekli Amper(AH)</th>
               <th scope=\"col\">Güneş Paneli Hesabı</th>
               <th scope=\"col\">PanelSayısı</th>
               <th scope=\"col\">Tarih</th>
               <th scope=\"col\"></th>
             </tr> </thead> <tbody>
             ";
            foreach ($solars_arr["records"] as $record) {
                echo "<form action=\"solaradmin.php\" method=\"POST\">
                ";
                echo  "
<th scope=\"row\">
<input name=\"deneme[]\" type=\"hidden\" value=\"{$record['cid']}\" >
{$record['name']}
</th>
<td >{$record['phone']}</td>
<td>{$record['email']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>
<td>{$record['created']}</td>";
if($record['status']==0){

echo "<td>
<input type=\"number\" name=\"singleid\" value= \"{$record['cid']}\" hidden>
<button type=\"submit\" class=\"btn btn-warning mb-2 mainformbutton0\" name=\"ssystem\" id=\"{$record['cid']}\">İncele</button>
</td>";
}
else if($record['status']==1){
echo "<td><button type=\"submit\" class=\"btn btn-success mb-2 mainformbutton1\" name=\"ssystem\" id=\"{$record['cid']}\">Kapandı</button></td>";
}
else if($record['status']==2){
echo "<td><button type=\"submit\" class=\"btn btn-info mb-2 mainformbutton2\" name=\"ssystem\" id=\"{$record['cid']}\">Süreçte</button></td>";
}
else if($record['status']==3){
    echo "<td><button type=\"submit\" class=\"btn btn-dark mb-2 mainformbutton3\" name=\"ssystem\" id=\"{$record['cid']}\">Olumsuz</button></td>";
    }
echo " <td><button type=\"submit\" class=\"btn btn-danger mb-2 deletecustomer\" name=\"customerdeleteform\" id=\"{$record['cid']}\">Sil</button></td></tr>";
            }
            echo "
            <input type=\"hidden\" class=\"form-control\" name=\"troubleid\" id=\"generalformid\" readonly/>
            </form>";
            echo "</tbody>";
        } else if ($num == 0) { 
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Kullanıcı Bulunamadı!
          </div>";
        }
        //return $stmt;
    }
    //---------------------------------------------------------------------------------------------------------------------
    function ReadDeviceDetail($id)

    {
        $query = "SELECT d.name,d.amount,d.watt,d.hour,d.day,d.wattrequired,d.capacity,d.amper,d.solarp,d.panelcount,c.name as cname 
        FROM
        " . $this->table_name_d . " d," . $this->table_name_c . " c WHERE c.id=? AND c.id=d.cid" . "";

        $stmt = $this->conn->prepare($query);
        //$name2 = "%$name%";
        $stmt->execute([$id]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            $solars_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $solar_item = array(
                    "name" => $name,
                    "amount" => $amount,
                    "watt" => $watt,
                    "hour" => $hour,
                    "day" => $day,
                    "wattrequired" => $wattrequired,
                    "capacity" => $capacity,
                    "amper" => $amper,
                    "solarp" => $solarp,
                    "panelcount" => $panelcount,
                    "cname" => $cname,
                );
                array_push($solars_arr["records"], $solar_item);
            }
            http_response_code(200);
            echo  "
            <thead>
            <tr>
               <th scope=\"col\">Cihaz</th>
               <th scope=\"col\">Adet</th>
               <th scope=\"col\">Watt</th>
               <th scope=\"col\">Saat-Gün</th>
               <th scope=\"col\">Gün-Hafta</th>
               <th scope=\"col\">Gerekli Watt</th>
               <th scope=\"col\">Kapasite</th>
               <th scope=\"col\">Amper</th>
               <th scope=\"col\">Solar Hesabı</th>
               <th scope=\"col\">Panel Sayısı</th>
               <th scope=\"col\">İsim</th>
               
             </tr> </thead> <tbody>";
            foreach ($solars_arr["records"] as $record) {
                echo  "<tr>
<th scope=\"row\">{$record['name']}</th>
<td>{$record['amount']}</td>
<td>{$record['watt']}</td>
<td>{$record['hour']}</td>
<td>{$record['day']}</td>
<td>{$record['wattrequired']}</td>
<td>{$record['capacity']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>
<td>{$record['cname']}</td>
</tr>";
            }
            echo "</tbody>";
        } else if ($num == 0) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Kullanıcı Bulunamadı!
          </div>";
        }
     //   return $solars_arr["records"];
    }
    //---------------------------------------------------------------------------------------------------------------
    function showSolarDetails($id,$equipments)
    {
        $query = "SELECT
         c.name,c.phone,c.email,s.amper,s.solarp,s.panelcount,s.cid,c.status ,s.connected,c.autonomyday,c.season,c.location,c.information
    FROM
        " . $this->table_name_s . " s," . $this->table_name_c . " c WHERE c.id=? AND c.id=s.cid" . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            $solars_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $solar_item = array(
                    "name" => $name,
                    "phone" => $phone,
                    "email" => $email,
                    "amper" => $amper,
                    "solarp" => $solarp,
                    "panelcount" => $panelcount,
                    "cid" => $cid,
                    "connected" => $connected,
                    "status" => $status,
                    "autonomyday" => $autonomyday,
                    "season" => $season,
                    "location" => $location,
                    "information" => $information
                );
                array_push($solars_arr["records"], $solar_item);
            }
            http_response_code(200);
            
            echo  "
            <table class=\"table\">
            <thead>
            <tr>
               <th scope=\"col\">İsim</th>
               <th scope=\"col\">Telefon</th>
               <th scope=\"col\">E-posta</th>
               <th scope=\"col\">Gerekli Amper(AH)</th>
               <th scope=\"col\">Güneş Paneli Hesabı</th>
               <th scope=\"col\">PanelSayısı</th>
               <th scope=\"col\">Bağlı Güç</th>
               <th scope=\"col\">Gün Sayısı</th>
               <th scope=\"col\">Sezon</th>
               <th scope=\"col\">Konum</th>
               <th scope=\"col\">Ek Bilgi</th>
               <th scope=\"col\"></th>
             </tr> </thead> <tbody> ";
            foreach ($solars_arr["records"] as $record) {
                echo  "
<th scope=\"row\"><input type=\"hidden\" name=\"customerid\" value=\"{$record['cid']}\"/>{$record['name']}</th>
<td >{$record['phone']}</td>
<td>{$record['email']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>
<td>{$record['connected']}</td>
<td>{$record['autonomyday']}</td>
<td>{$record['season']}</td>
<td>{$record['location']}</td>
<td>{$record['information']}</td>";
            }
            echo "</tbody></table>";
echo

"<table class=\"table\">
<thead class=\"thead-dark\">
    <tr>
        <th scope=\"col\">Kapsam</th>
        <th scope=\"col\">Adet</th>
    </tr>
</thead>
<tbody id=\"createrow\">
<tr>
        <td>
        <select class=\"form-control\" id=\"inputGroupSelect901\" name=\"equipmentid[]\">";                            
                   foreach($equipments as $equipment){
                        echo "<option value=\"{$equipment['id']}\">{$equipment['name']} </option>";
                    }
          echo  "</select>
        </td>
        <td>
        <div class=\"input-group\">
                        <div class=\"input-group-prepend\">
                            <label class=\"input-group-text\" for=\"inputGroupSele\">Adet</label>
                        </div>
                        <input class=\"form-control\" type=\"number\" step=\"0.5\" min=\"0\" max=\"10000\" title=\"Miktar Giriniz\" placeholder=\"Adet\" name=\"quantity[]\" id=\"quantity2\" />
                    </div>
       </td>
        "
        ;
        
        } //birim fiyatını çek kısmına name price olarak girilecek
        //return $stmt;
    
        


else{
        echo  "<div class=\"alert alert-warning\" role=\"alert\">
           Kullanıcı Bulunamadı!
          </div>";
}
    }
    //---------------------------------------------------------------------------------------------------------------
    //delete devices,customers,solars from devices inner join customers on devices.cid=customers.id inner join solars on customers.id=solars.cid where customers.name='dar';
    function deleteUser($name)
    {
        $query = "DELETE FROM 
    customers WHERE customers.name=?" . "";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute([$name]);
        $num = $stmt->rowCount();
        if ($num > 0) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
    {$name} isimli kullanıcının tüm bilgileri silindi!
  </div>";
        } else {
            echo  "<div class=\"alert alert-danger\" role=\"alert\">
    {$name} isimli kullanıcı bulunamadı!
  </div>";
        }

       
    }
    function delete_data_id($id){
    $query = "DELETE FROM 
    customers WHERE customers.id=?" . "";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute([$id]);
         http_response_code(200);
}
function ReadDetail($id)

{
    $query = "SELECT d.name,d.amount,d.watt,d.hour,d.day,d.wattrequired,d.capacity,d.amper,d.solarp,d.panelcount,c.name as cname 
    FROM
    " . $this->table_name_d . " d," . $this->table_name_c . " c WHERE c.id=? AND c.id=d.cid" . "";

    $stmt = $this->conn->prepare($query);
    //$name2 = "%$name%";
    $stmt->execute([$id]);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $solars_arr = array("records" => array());
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $solar_item = array(
                "name" => $name,
                "amount" => $amount,
                "watt" => $watt,
                "hour" => $hour,
                "day" => $day,
                "wattrequired" => $wattrequired,
                "capacity" => $capacity,
                "amper" => $amper,
                "solarp" => $solarp,
                "panelcount" => $panelcount,
                "cname" => $cname,
            );
            array_push($solars_arr["records"], $solar_item);
        }
        http_response_code(200);
        return $solars_arr["records"];
    }
}
function getEquipments(){
    $query ="SELECT * FROM equipments" . "";
    $stmt=$this->conn->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
        if ($num > 0) {
            $equipment_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $equipment_item = array(
                    "id"=>$id,
                    "name" => $name,
                    "unit" => $unit,
                    "unit_price" => $unit_price
                );
                array_push($equipment_arr["records"], $equipment_item);
            }
        }
        return $equipment_arr['records'];
    }
}

?>