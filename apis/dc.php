<?php
class Database{
    
    private $db_host = '10.100.31.36:3306';
    private $db_name = 'alb_cs_rabbit_integra';
    private $db_username = 'intmis';
    private $db_password = 'Intmis@123';
    
    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
        
        
    }
}
?>
