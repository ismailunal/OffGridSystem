<?php
class Supplier
{
    private $conn;
    private $table_name = "suppliers";
    private $table_name2 = "bills";
    public $id;
    public $name;
    public $phone;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getSuplier()
    {
        $query = "SELECT
         s.name,s.phone,b.total,b.sid 
    FROM
        " . $this->table_name . " s," . $this->table_name2 . " b WHERE s.id=b.sid ORDER BY b.created" . " DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $sup_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $sup_item = array(
                    "name" => $name,
                    "phone" => $phone,
                    "total" => $total,
                    "sid" => $sid
                );
                array_push($sup_arr["records"], $sup_item);
            }
            http_response_code(200);

            echo  "
            <thead>
            <tr>
               <th class=\"col-5\" scope=\"col\">İsim</th>
               <th class=\"col-3\" scope=\"col\">Telefon</th>
               <th class=\"col-2\" scope=\"col\">Tedarikçiye Ödenen Tutar</th>
               <th class=\"col-2\" scope=\"col\"></th>
             </tr> </thead> <tbody>
             ";
            foreach ($sup_arr["records"] as $record) {
                echo "<form action=\"solaradmin.php\" method=\"POST\">
                ";
                echo  "
<tr><th scope=\"row\">
<input name=\"supbill[]\" type=\"hidden\" value=\"{$record['sid']}\" >
{$record['name']}
</th>
<td >{$record['phone']}</td>
<td>{$record['total']}</td>
<td><button type=\"submit\" class=\"btn btn-danger mb-2 deletesupplier\" name=\"supplierdeleteform\" id=\"{$record['sid']}\">Sil</button></td></tr>
</tr>
";

}
echo "
            <input type=\"hidden\" class=\"form-control\" name=\"troubleid\" id=\"generalformid\" readonly/>
            </form>";
            echo "</tbody>";
}}


    function create(){
        $query = "INSERT INTO " . $this->table_name . "
        SET
          
            name = :name,
            phone = :phone
             ";

        $stmt = $this->conn->prepare($query);
        // sanitize

       $this->name = htmlspecialchars(strip_tags($this->name));
       $this->phone = htmlspecialchars(strip_tags($this->phone));

     
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':phone', $this->phone);   
   
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete_data($id){
        $query = "DELETE FROM 
        suppliers WHERE suppliers.id=?" . "";
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute([$id]);
         
             return $stmt;
    }


}
    ?>