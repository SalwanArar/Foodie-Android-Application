<?php

	require_once '../main/DbOperations.php';

	$response = array();
	$response['error'] = true;
	$db = new DbOperations();
			
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['username'])
			and isset($_POST['password'])
			and isset($_POST['email'])
			and isset($_POST['first_name'])
			and isset($_POST['last_name'])
		    and isset($_POST['gender'])){

			$username = $_POST['username'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$gender = $_POST['gender'];
			$password = $_POST['password'];
			if($db->isUsernameExist($username)) {
				$response['error'] = true;
				$response['message'] = "Username exist";
			}else{
				if($db->isEmailExist($email)) {
					$response['error'] = true;
					$response['message'] = "You can't have tow accounts with one email address";
				}else{
					if($db->createUser($username, $first_name, $last_name, $gender, $email, $password)){
						$response['error'] = false; 
						$response['message'] = "Operation Success"; 
					}else{
						$response['error'] = true; 
						$response['message'] = "Operation Faild";          
					}
				}
			}
		}else{
			$response['error'] = true; 
			$response['message'] = "Required fields are missing";
		}
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	$db->closeConnection();
	if($response['error'] == true)
		die();
?>