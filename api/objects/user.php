<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    public $name;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// check if given email exist in the database
function nameExists(){
 
    // query to check if email exists
    $query = "SELECT name FROM " . $this->table_name . "
";
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
     // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

function passExists(){
 
    // query to check if email exists
    $query = "SELECT password FROM " . $this->table_name . "
";
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->password = $row['password'];
     // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

function userExists($name,$pass){
 
    // query to check if email exists
    $query = "SELECT * FROM " . $this->table_name . " WHERE name='".$name."' AND password='".$pass."'";
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $num = $stmt->rowCount();
    if($num===1){
        return true;
    }
    return false;
}
}