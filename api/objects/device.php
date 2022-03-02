<?php
class Device
{
    private $conn;
    private $table_name = "devices";

    public $id;
    public $name;
    public $amount;
    public $watt;
    public $hour;
    public $day;
    public $costwatt;
    public $invertedwatt;
    public $requiredamper;
    public $userid;

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
            amount = :amount,
            watt = :watt,
            hour = :hour,
            day = :day,
            costwatt = :costwatt,
            invertedwatt = :invertedwatt,
            requiredamper=:requiredamper,
            userid=:userid";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->watt = htmlspecialchars(strip_tags($this->watt));
        $this->hour = htmlspecialchars(strip_tags($this->hour));
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->costwatt = htmlspecialchars(strip_tags($this->costwatt));
        $this->invertedwatt = htmlspecialchars(strip_tags($this->invertedwatt));
        $this->requiredamper = htmlspecialchars(strip_tags($this->requiredamper));
        //$this->userid = htmlspecialchars(strip_tags($this->userid));    

        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':watt', $this->watt);
        $stmt->bindParam(':hour', $this->hour);
        $stmt->bindParam(':day', $this->day);
        $stmt->bindParam(':costwatt', $this->costwatt);
        $stmt->bindParam(':invertedwatt', $this->invertedwatt);
        $stmt->bindParam(':requiredamper', $this->requiredamper);
        $stmt->bindParam(':userid', $this->userid,PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function selectuserid(){
        $query= "SELECT id FROM customers ORDER BY id DESC LIMIT 1";    
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
