<?php
class General
{
    private $conn;
    private $table_name = "general";
    public $currency;
    public $tax;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readcurrency()
    {
        // select all query
        $query = "SELECT
        currency
    FROM
        " . $this->table_name . "";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    function readtax()
    {
        // select all query
        $query = "SELECT
        tax
    FROM
        " . $this->table_name . "";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    function update($value)
    {
        if(!isset($value) || empty($value)){
            $value=0;
        }
        $query = "UPDATE
        general
    SET 
    currency=" .$value ."";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    }?>