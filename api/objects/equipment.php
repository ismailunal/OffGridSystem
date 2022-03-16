<?php
class Equipment
{
    private $conn;
    private $table_name = "equipments";

    public $id;
    public $name;
    public $type;
    public $brand;
    public $unit;
    public $unit_price;
    public $value;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // select all query
        $query = "SELECT
        *
    FROM
        " . $this->table_name . "";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $equipments_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $equipment_item = array(
                    "id" => $id,
                    "name" => $name,
                    "type" => $type,
                    "brand" => $brand,
                    "unit" => $unit,
                    "unit_price" => $unit_price,
                    "value" => $value
                );
                array_push($equipments_arr["records"], $equipment_item);
            }
            http_response_code(200);
            foreach ($equipments_arr["records"] as $record) {
                echo  "
                <button type=\"button\" class=\"btn btn-info\" id=\"{$record['id']}\" >{$record['name']}</button>                         
                ";
            }
        } else if ($num == 0 || $num==null) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Bir Sorun Oluştu Bulunamadı!
          </div>";
        }
    

    }
    function readByName($name){
        // select all query
        $query = "SELECT
        *
    FROM
        " . $this->table_name . " WHERE name =?" ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute([$name]);
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            name = :name,
            type = :type,
            brand = :brand,
            unit = :unit,
            unit_price = :unit_price,
            value = :value";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->amount = htmlspecialchars(strip_tags($this->type));
        $this->watt = htmlspecialchars(strip_tags($this->brand));
        $this->hour = htmlspecialchars(strip_tags($this->unit));
        $this->day = htmlspecialchars(strip_tags($this->unit_price));
        $this->wattrequired = htmlspecialchars(strip_tags($this->value));
        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':amount', $this->type);
        $stmt->bindParam(':watt', $this->brand);
        $stmt->bindParam(':hour', $this->unit);
        $stmt->bindParam(':day', $this->unit_price);
        $stmt->bindParam(':wattrequired', $this->value);       
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function selectcustomerid(){
        $query= "SELECT id FROM customers ORDER BY id DESC LIMIT 1";    
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
