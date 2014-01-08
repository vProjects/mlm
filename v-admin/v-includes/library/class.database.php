<?php
	
	class dbConnection{
		protected $db_conn;
		public $db_name = "mlm" ;
		public $db_username = "root" ;
		public $db_password = "root" ;
		public $db_host = "localhost" ;
		
		function connect(){
			try{
				$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_username,$this->db_password);
				return $this->db_conn;
			}
			catch(PDOException $e){
				return $e->getMessage();
			}
		}		
	}
?>