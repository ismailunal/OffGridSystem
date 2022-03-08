<?php
class Solar
{
    private $conn;
    private $table_name = "solars";

    public $id;
    public $userid;
    public $connected;
    public $watthour;
    public $wattinverted;
    public $wattrequired;
    public $capacity;
    public $amper;
    public $solarp;
    public $panelcount;

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
          userid = :userid,
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
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->connected = htmlspecialchars(strip_tags($this->connected));
        $this->watthour = htmlspecialchars(strip_tags($this->watthour));
        $this->wattinverted = htmlspecialchars(strip_tags($this->wattinverted));
        $this->wattrequired = htmlspecialchars(strip_tags($this->wattrequired));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));
        $this->amper = htmlspecialchars(strip_tags($this->amper));
        $this->solarp = htmlspecialchars(strip_tags($this->solarp));
        $this->panelcount = htmlspecialchars(strip_tags($this->panelcount));

        // bind the values
        $stmt->bindParam(':userid', $this->userid, PDO::PARAM_INT);
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
    function selectuserid()
    {
        $query = "SELECT id FROM customers ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
?>
