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
}
    ?>