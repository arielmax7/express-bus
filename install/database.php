<?php
//** FUNCIONES DE EJECUCION SQL PARA EL INSTALADOR *//
require ('BackupMysql.php');

class Installdb{

	public $DBUSER;
	public $DBPASS;
	public $DBHOST;
	public $DBNAME;
	private $DCONN;

	public function setConnection($DBuser,$DBpass,$DBhost,$DBname){

		$this->DBUSER = $DBuser;
		$this->DBPASS = $DBpass;
		$this->DBHOST = $DBhost;
		$this->DBNAME = $DBname;
		$this->DCONN = ['host'=> $DBhost, 'user'=> $DBuser, 'pass'=> $DBpass, 'dbname'=>$DBname];
	}

	public function connection(){

		$mysql = new mysqli($this->DBHOST, $this->DBUSER, $this->DBPASS); 
 		if (mysqli_connect_errno()) {
    		return "errorConnect";
   		}
    	
    	return $mysql;
	}


	public function dumpDB(){
		
		$conn = $this->connection();
		//create DataBase
		$sql = "CREATE DATABASE ".$this->DBNAME;

		if ($conn->query($sql) === TRUE) {

		   $bk = new BackupMysql('en', 'sql/');

		   $bk->setMysql($this->DCONN); 

		   $bk->restore('express_bus.zip'); //restore an dump database

		   return true;

		} else {

		    echo "Error creating database: " . $conn->error;		
		    return false;
		}
		
	}

}

?>