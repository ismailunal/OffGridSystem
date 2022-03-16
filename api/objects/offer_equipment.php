<?php
class Equipment
{
    private $conn;
    private $table_name = "equipmnets";

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
            quantity = :quantity";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->cid));
        $this->amount = htmlspecialchars(strip_tags($this->eid));
        $this->watt = htmlspecialchars(strip_tags($this->quantity));

        $stmt->bindParam(':cid', $this->cid);
        $stmt->bindParam(':eid', $this->eid);
        $stmt->bindParam(':quantity', $this->quantity);
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
