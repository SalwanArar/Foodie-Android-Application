<?php
    
    include_once 'Constraints.php';
    
    class DBConnect{
		private $con;
        
        public function __construct(){

        }
        function connect(){
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($this->con->connect_error){
				die("connection failed: " . $conn->connect_error);
				return $this->con;
			}
			else{
				if(function_exists('mysql_set_charset'))
					mysqli_set_charset($this->con, 'utf8mb4');
				else
					mysqli_query($this->con, "SET NAMES 'utf8mb4'");
			}
			return $this->con;
		}
    }
?>