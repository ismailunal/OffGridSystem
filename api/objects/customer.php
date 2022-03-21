<?php
// 'customer' object
class Customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "customers";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $phone;
    public $location;
    public $information;
    public $autonomyday;
    public $season;
    public $created;
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function checkExistPhone($phone){
        $query="SELECT * FROM customers where phone=?" . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$phone]);
        return $stmt->rowCount();
    }
    // read products
function read(){
  
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
 
// create new user record
function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                name = :name,
                email = :email,
                phone = :phone,
                location = :location,
                information = :information,
                autonomyday = :autonomyday,
                season = :season,
                created = :created";
    
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->location=htmlspecialchars(strip_tags($this->location));
    $this->information=htmlspecialchars(strip_tags($this->information));
    $this->autonomyday=htmlspecialchars(strip_tags($this->autonomyday));
    $this->season=htmlspecialchars(strip_tags($this->season));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind the values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':information', $this->information);
    $stmt->bindParam(':phone', $this->phone);
    $stmt->bindParam(':location', $this->location);
    $stmt->bindParam(':autonomyday', $this->autonomyday);
    $stmt->bindParam(':season', $this->season);
    $stmt->bindParam(':created', $this->created);
    // hash the password before saving to database
    //$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    //$stmt->bindParam(':password', $password_hash);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
 
function readbyID($id){
  
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE id=?" . "";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute([$id]);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $customerarr = array("records" => array());
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $customer_item = array(
                "name" => $name,
                "phone" => $phone,
                "email" => $email               
            );
            array_push($customerarr["records"], $customer_item);
        }
    }
    return $customerarr;
}
function updateStatus($id){
    $query = "UPDATE customers SET status=2" ." WHERE id=" . $id ."";
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
}
function readStatus($id){
    $query = "SELECT c.status FROM customers c WHERE id=" . $id ."";
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt->fetchColumn();
}

function delete_data($id){
    $query = "DELETE FROM 
    customers WHERE customers.id=?" . "";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute([$id]);
     
         return $stmt;
}

// emailExists() method will be here
}
?>