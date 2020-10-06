<?php

class DB{

    private $HOSTNAME = "";
	private $USERNAME = "";
	private $PASSWORD = "";
	private $DBNAME = "";

	private $db;

    public function __construct(){

        $this->HOSTNAME = "localhost"; 			
        $this->USERNAME = "root"; 			
        $this->PASSWORD = ""; 			
        $this->DBNAME = "gestao"; 	

		$this->conn = new \PDO(
			"mysql:dbname=".$this->DBNAME.";host=".$this->HOSTNAME, 
			$this->USERNAME,
			$this->PASSWORD,
			[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_PERSISTENT => true, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'"]
		);

    }


}

?>