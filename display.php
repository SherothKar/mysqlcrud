<?php
ini_set('display_error',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include_once("db_connect.php");
	$get_all_users_sql_query = "SELECT * FROM users";
	$pdo = connect();
	if(connect()) {
		$query = $pdo->prepare($get_all_users_sql_query);
		$query->execute();
		$all_users = $query->fetchall();
		if (count($all_users) > 0) {
			$response = array("resultCode" => "Success", "records" => $all_users);
			echo json_encode($response);
		} else { 
			$response = array("resultCode" => "Records Unavailable", "message" => "No Records Found Currently");
			echo json_encode($response);
		}
	} else {
		$response = array("resultCode" => "Failure!", "message" => "Unable to connect to database");
		echo json_encode($response);
	}
?>