<?php
class Bill
{
    private $conn;
    private $table_name = "bills";
    private $table_name2 = "suppliers";
    public $id;
    public $sid;
    public $created;
    public $total;

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
    function create(){
        $query = "INSERT INTO " . $this->table_name . "
        SET
            sid = :sid,
            created = :created,
            total = :total
             ";

        $stmt = $this->conn->prepare($query);
        // sanitize
       $this->sid = htmlspecialchars(strip_tags($this->sid));
       $this->created = htmlspecialchars(strip_tags($this->created));
       $this->total = htmlspecialchars(strip_tags($this->total));

        $stmt->bindParam(':sid', $this->sid);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':total', $this->total);   
   
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function selectsupplierid(){
        $query= "SELECT id FROM suppliers ORDER BY id DESC LIMIT 1";    
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    }?>