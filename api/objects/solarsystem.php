
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
             </tr> </thead> <tbody>";
            foreach ($solars_arr["records"] as $record) {
                echo  "
<th id=\"{$record['cid']}\" scope=\"row\">{$record['name']}</th>
<td >{$record['phone']}</td>
<td>{$record['email']}</td>
<td>{$record['amper']}</td>
<td>{$record['solarp']}</td>
<td>{$record['panelcount']}</td>
<td>{$record['created']}</td>";
echo "<form action=\"\" method=\"POST\">";
if($record['status']==0){
echo "<td><button type=\"submit\" class=\"btn btn-warning mb-2\" name=\"soffer\" id=\"{$record['cid']}\">İncele</button></td>";
}
else if($record['status']==1){
echo "<td><button type=\"submit\" class=\"btn btn-success mb-2\" name=\"coffer\" id=\"{$record['cid']}\">Kapandı</button></td>";
}
else if($record['status']==2){
echo "<td><button type=\"submit\" class=\"btn btn-info mb-2\" name=\"poffer\" id=\"{$record['cid']}\">Süreçte</button></td>";
}
else if($record['status']==3){
    echo "<td><button type=\"submit\" class=\"btn btn-dark mb-2\" name=\"noffer\" id=\"{$record['cid']}\">Olumsuz</button></td>";
    }
echo " <td><button type=\"submit\" class=\"btn btn-danger mb-2\" name=\"doffer\" id=\"{$record['cid']}\">Sil</button></td></tr>";
            }
            echo "</form>";
            echo "</tbody>";
        } else if ($num == 0) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Kullanıcı Bulunamadı!
          </div>";
        }
        //return $stmt;
    }
    //---------------------------------------------------------------------------------------------------------------------
    function ReadDeviceDetail($name)

    {
        $query = "SELECT d.name,d.amount,d.watt,d.hour,d.day,d.wattrequired,d.capacity,d.amper,d.solarp,d.panelcount,c.name as cname 
        FROM
        " . $this->table_name_d . " d," . $this->table_name_c . " c WHERE c.name like ? AND c.id=d.cid" . "";

        $stmt = $this->conn->prepare($query);
        $name2 = "%$name%";
        $stmt->execute([$name2]);
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
        //return $stmt;
    }
    //---------------------------------------------------------------------------------------------------------------
    function showDetails($panels)
    {





        echo  "<div class=\"alert alert-warning\" role=\"alert\">
           Kullanıcı Bulunamadı!
          </div>";
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
}

?>