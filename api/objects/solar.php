<?php
class Solar
{
    private $conn;
    private $table_name = "solars";

    public $id;
    public $cid;
    public $connected;
    public $watthour;
    public $wattinverted;
    public $wattrequired;
    public $capacity;
    public $amper;
    public $solarp;
    public $panelcount;
    public $offer_price;
    public $panelwatt;
    public $voltah;

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
            connected = :connected,
            watthour = :watthour,
            wattinverted = :wattinverted,
            wattrequired = :wattrequired,
            capacity = :capacity,
            amper = :amper,
            solarp=:solarp,
            panelcount=:panelcount";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->cid = htmlspecialchars(strip_tags($this->cid));
        $this->connected = htmlspecialchars(strip_tags($this->connected));
        $this->watthour = htmlspecialchars(strip_tags($this->watthour));
        $this->wattinverted = htmlspecialchars(strip_tags($this->wattinverted));
        $this->wattrequired = htmlspecialchars(strip_tags($this->wattrequired));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));
        $this->amper = htmlspecialchars(strip_tags($this->amper));
        $this->solarp = htmlspecialchars(strip_tags($this->solarp));
        $this->panelcount = htmlspecialchars(strip_tags($this->panelcount));

        // bind the values
        $stmt->bindParam(':cid', $this->cid, PDO::PARAM_INT);
        $stmt->bindParam(':connected', $this->connected);
        $stmt->bindParam(':watthour', $this->watthour);
        $stmt->bindParam(':wattinverted', $this->wattinverted);
        $stmt->bindParam(':wattrequired', $this->wattrequired);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':amper', $this->amper);
        $stmt->bindParam(':solarp', $this->solarp);
        $stmt->bindParam(':panelcount', $this->panelcount);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function selectcustomerid()
    {
        $query = "SELECT id FROM customers ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function addPrice($price,$id){
        $query = "UPDATE solars SET offer_price=" .$price ." WHERE cid=" . $id ."";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function readofferprice($id){
        $query = "SELECT
        offer_price
    FROM
        " . $this->table_name . " WHERE cid=" .$id."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function readPanelCount($id){
        $query = "SELECT
        panelcount
    FROM
        " . $this->table_name . " WHERE cid=" .$id."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function readAmper($id){
        $query = "SELECT
        amper
    FROM
        " . $this->table_name . " WHERE cid=" .$id."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function readWatt($id){
        $query = "SELECT
        panelwatt
    FROM
        " . $this->table_name . " WHERE cid=" .$id."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function readVolt($id){
        $query = "SELECT
        voltah
    FROM
        " . $this->table_name . " WHERE cid=" .$id."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    function updateSolarValues($customerid,$panelwatt,$voltah,$panelcount,$amper){
        $query = "UPDATE solars " ."
        SET 
         panelwatt=" . $panelwatt . ",voltah=" .$voltah. ",panelcount=" . $panelcount . ",amper=" . $amper . 
        " WHERE cid=". $customerid ."";

        $stmt = $this->conn->prepare($query); 
    // $this->panelwatt=htmlspecialchars(strip_tags($this->panelwatt));
    // $stmt->bindParam(':panelwatt', $this->panelwatt);
    // $this->voltah=htmlspecialchars(strip_tags($this->voltah));
    // $stmt->bindParam(':voltah', $this->voltah);
    // $this->panelcount=htmlspecialchars(strip_tags($this->panelcount));
    // $stmt->bindParam(':panelcount', $this->panelcount);
    // $this->amper=htmlspecialchars(strip_tags($this->amper));
    // $stmt->bindParam(':amper', $this->amper);
    
       if($stmt->execute()){
    
        return true;
       }else{return false;}
        
    }

}
?>
