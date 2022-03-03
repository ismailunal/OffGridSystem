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
    public $wattrequired;
    public $capacity;
    public $amper;
    public $solarp;
    public $panelcount;
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
            wattrequired = :wattrequired,
            capacity = :capacity,
            amper=:amper,
            solarp = :solarp,
            panelcount=:panelcount,
            userid=:userid";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->watt = htmlspecialchars(strip_tags($this->watt));
        $this->hour = htmlspecialchars(strip_tags($this->hour));
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->wattrequired = htmlspecialchars(strip_tags($this->wattrequired));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));
        $this->amper = htmlspecialchars(strip_tags($this->amper));
        $this->solarp = htmlspecialchars(strip_tags($this->solarp));
        $this->panelcount = htmlspecialchars(strip_tags($this->panelcount));
        $this->userid = htmlspecialchars(strip_tags($this->userid));    

        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':watt', $this->watt);
        $stmt->bindParam(':hour', $this->hour);
        $stmt->bindParam(':day', $this->day);
        $stmt->bindParam(':wattrequired', $this->wattrequired);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':amper', $this->amper);
        $stmt->bindParam(':solarp', $this->solarp);
        $stmt->bindParam(':panelcount', $this->panelcount);
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
