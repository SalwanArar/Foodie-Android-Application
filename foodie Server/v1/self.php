<?php

	require_once '../main/DbOperations.php';

	$response = array();
	$response['error'] = true;
	$db = new DbOperations();

	if($_SERVER['REQUEST_METHOD']=='GET'){
		if(isset($_GET['api_token'])){

			$token = $_GET['api_token'];
			if($query = $db->isTokenExist($token)) {
				$response['error'] = false;
				$response['message'] = $query;
			}else{
				$response['error'] = true;
				$response['message'] = "Sign In Faild";
			}
		}else{
			$response['error'] = true;
			$response['message'] = "you are not signed in";
		}
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	$db->closeConnection();
	if($response['error'])
		die();
?>