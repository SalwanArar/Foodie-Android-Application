<?php
	include_once 'DBConnection.php';

	class DBOperations{
		private $con;

		function __construct(){
			$db = new DBConnect();

			$this->con = $db->connect();
		}
		
		public function isUsernameExist($username) {
			$query = $this->con->prepare("SELECT
												username
											FROM
												USERS
											WHERE
												username = '$username'"
										);
			$query->execute();
			$query->store_result();
			return $query->num_rows > 0;
		}
		
		public function isEmailExist($email) {
			$query = $this->con->prepare("SELECT
												email
											FROM
												USERS
											WHERE
												email = '$email'"
										);
			$query->execute();
			$query->store_result();
			return $query->num_rows > 0;
		}
		
		public function createUser($username, $first_name, $last_name, $gender, $email, $password) {
			$query = $this->con->prepare("INSERT INTO
											USERS
												(
												username,
												f_name,
												l_name,
												gender,
												email,
												password
												)
											VALUES
												(
												'$username',
												'$first_name',
												'$last_name',
												'$gender',
												'$email',
												'$password'
												)"
										);
			if($query->execute())
				return true;
			else
				return false;
		}
		
		public function isUserExistAuth($username, $password) {
			$query = $this->con->prepare("SELECT
												username
											FROM
												USERS
											WHERE
												username = '$username' AND
												password = '$password'"
										);
			$query->execute();
			$query->store_result();
			return $query->num_rows > 0;
		}
		
		private function fetchUserInfo($username) {
			$query = $this->con->prepare("SELECT
												*
											FROM
												USERS
											WHERE
												username = '$username'"
										);
			$query->execute();
			return $query->get_result()->fetch_assoc();
		}
		
		public function userSignIn($username) {
			$response = array();
			$random_str = rand();
			$result = hash("md5", $random_str);
			$query = $this->con->prepare("UPDATE
												USERS
											SET
												api_token = '$result'
											WHERE
												username = '$username'"
										);
			
			$response = $this->fetchUserInfo($username);
			$response['api_token'] = $result;
			if($query->execute())
				return $response;
			else
				return false;
		}
		
		public function isTokenExist($token) {
			$query = $this->con->prepare("SELECT
												*
											FROM
												USERS
											WHERE
												api_token = '$token'"
										);
			$query->execute();;
			return $query->get_result()->fetch_assoc();
		}
		
		public function closeConnection() {
			mysqli_close($this->con);
		}
	}
?>