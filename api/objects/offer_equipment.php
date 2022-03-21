<?php
class OfferEquipment
{
    private $conn;
    private $table_name = "offer_equipments";
    private $table_name2 = "equipments";
    public $id;
    public $cid;
    public $eid;
    public $quantity;

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
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            cid = :cid,
            eid = :eid,
            quantity = :quantity
             ";

        $stmt = $this->conn->prepare($query);
        // sanitize
       $this->cid = htmlspecialchars(strip_tags($this->cid));
       $this->eid = htmlspecialchars(strip_tags($this->eid));
       $this->quantity = htmlspecialchars(strip_tags($this->quantity));
      // $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':cid', $this->cid);
        $stmt->bindParam(':eid', $this->eid);
        $stmt->bindParam(':quantity', $this->quantity);   
      //  $stmt->bindParam(':name', $this->name);   
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

    function ReadDetail($id)

{
    $query = "SELECT e.name,e.unit_price,eo.quantity 
    FROM
    " . $this->table_name . " eo," . $this->table_name2 . " e WHERE eo.cid=? AND eo.eid=e.id" . "";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id]);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $equipments_arr = array("records" => array());
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $equipment_item = array(
                "name" => $name,
                "unit_price" => $unit_price,
                "quantity" => $quantity,
                
            );
            array_push($equipments_arr["records"], $equipment_item);
        }
        http_response_code(200);
        return $equipments_arr["records"];
    }
}

function delete($cid){
    $query = "DELETE FROM 
    offer_equipments WHERE offer_equipments.cid=?" . "";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute([$cid]);
         http_response_code(200);
}
}
