<?php
class Equipment
{
    private $conn;
    private $table_name = "equipments";

    public $id;
    public $name;
    public $type;
    public $brand;
    public $unit;
    public $unit_price;
    public $value;

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
        " . $this->table_name . " ORDER BY type";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $equipments_arr = array("records" => array());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $equipment_item = array(
                    "id" => $id,
                    "name" => $name,
                    "type" => $type,
                    "brand" => $brand,
                    "unit" => $unit,
                    "unit_price" => $unit_price,
                    "value" => $value
                );
                array_push($equipments_arr["records"], $equipment_item);
            }
            http_response_code(200);


            $recordedType="belirlenmedi.";
            foreach ($equipments_arr["records"] as $record) {
 
                if(strcmp($recordedType,$record['type'])!==0){
                     
                    if($record['type']==="" || $record['type']==="null"){                      
                        echo "<div> <button type=\"button\" class=\"btn btn-warning btn-block eqheader\" disabled>
                        Belirsiz Kategori
                  
                        <svg class=\"bi text-muted flex-shrink-0 me-3 addnewequipment\" width=\"1.75em\" height=\"1.75em\">
                        <use xlink:href=\"../svgs/plus.svg#Layer_1\"></use>
                    </svg>
                     
                    </button> </div>";
       
                    }
                    else{
                        //$typeCount= getCount($record['type']);
                       echo "<div><button type=\"button\" id=\"\" class=\"btn btn-warning btn-block eqheader\" disabled>
                       {$record['type']}
                       <svg class=\"bi text-muted flex-shrink-0 me-3 addnewequipment\" width=\"1.75em\" height=\"1.75em\">
                        <use xlink:href=\"../svgs/plus.svg#Layer_1\"></use>
                    </svg>
                   </button></div>";
 
                    }
                }                
                echo  "
                <button type=\"button\" style=\"height:100px;width:200px\" class=\"btn btn-info updateequipment mb-4 mt-2 ml-2\" id=\"{$record['id']}\" >
                {$record['name']} <br>";
                echo number_format($record['unit_price'],1); 
                echo "$</button>                         
                ";
                $recordedType=$record['type'];
     
            }
        } else if ($num == 0 || $num==null) {
            echo  "<div class=\"alert alert-warning\" role=\"alert\">
            Bir Sorun Oluştu Bulunamadı!
          </div>";
        }
     //TYPE I ÇEK VE READ İ TYPE A GÖRE SIRALA. GÖRSELLERDE KATEGORİ İSMİ DEĞİŞTİĞİ AN BAŞLIK OLARAK YAZ

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
            type = :type,
            brand = :brand,
            unit = :unit,
            unit_price = :unit_price,
            value = :value";

        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->unit = htmlspecialchars(strip_tags($this->unit));
        $this->unit_price = htmlspecialchars(strip_tags($this->unit_price));
        $this->value = htmlspecialchars(strip_tags($this->value));
        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':brand', $this->brand);
        $stmt->bindParam(':unit', $this->unit);
        $stmt->bindParam(':unit_price', $this->unit_price);
        $stmt->bindParam(':value', $this->value);       
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
    function update($id){
        $query = "UPDATE equipments " ."
        SET 
         name=:name,  
         type=:type,  
         brand=:brand,  
         unit=:unit, 
         unit_price=:unit_price, 
         value=:value WHERE id=". $id ."";

        $stmt = $this->conn->prepare($query); 
      
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->type=htmlspecialchars(strip_tags($this->type));
    $this->brand=htmlspecialchars(strip_tags($this->brand));
    $this->unit=htmlspecialchars(strip_tags($this->unit));
    $this->unit_price=htmlspecialchars(strip_tags($this->unit_price));
    $this->value=htmlspecialchars(strip_tags($this->value));

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':type', $this->type);
    $stmt->bindParam(':brand', $this->brand);
    $stmt->bindParam(':unit', $this->unit);
    $stmt->bindParam(':unit_price', $this->unit_price);
    $stmt->bindParam(':value', $this->value);
    
       if($stmt->execute()){
        return true;
       }else{return false;}
        
    }
    function delete($id){
        $query= "DELETE FROM equipments WHERE id=" .$id ."";    
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
