<?php

	require_once '../main/DbOperations.php';

	$response = array();
	$response['error'] = true;
	$db = new DbOperations();

	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['username']) and isset($_POST['password'])){

			$username = $_POST['username'];
			$password = $_POST['password'];
			if($db->isUserExistAuth($username, $password)) {
				if($result = $db->userSignIn($username)){
					$response['error'] = false;
					$response['username'] = $username;
					$response['first_name'] = $result['f_name'];
					$response['last_name'] = $result['l_name'];
					$response['gender'] = $result['gender'];
					$response['email'] = $result['email'];
					$response['password'] = $result['password'];
					$response['api_token'] = $result['api_token'];
				}else{
					$response['error'] = true;
					$response['message'] = "Sign In Faild";
				}
			}else{
				$response['error'] = true;
				$response['message'] = "User already exist";
			}
		}else{
			$response['error'] = true; 
			$response['message'] = "Required fields are missing";
		}
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	$db->closeConnection();
	if($response['error'])
		die();
?>