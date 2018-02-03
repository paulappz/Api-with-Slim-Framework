<?php 
//Propertise

class db{
    


private $dbhost;
private $dbuser ;
private $dbpass ;
private $dbname ;

 
//Connect
public function connect(){

    $this->dbhost =  getenv("DB_HOSTNAME");
    $this->dbuser =  getenv("DB_USER");
    // $this->dbpass =  getenv("DB_PASS");
    $this->dbname =  getenv("DB_SCHEMA_CINEMA");




    $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
    $dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpass );
$dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $dbConnection;
}
}
?>