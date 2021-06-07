<?php 
	class Conn{
		protected $servername= 'localhost';
		protected $username='root';
		protected $password = '';
		protected $db_name='minorproj';
		protected $conn;

		public function __construct(){
			$this->conn=new mysqli($this->servername,$this->username,$this->password,$this->db_name);

			if ($this->conn->connect_errno) {
				echo "Failed to connect to MYSQLI";
				exit();
			}
		}
		
	}
?>