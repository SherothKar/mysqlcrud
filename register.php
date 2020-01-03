<?php
ini_set('display_error',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
include_once("db_connect.php");
if((isset($_POST["email"]) && $_POST["email"] != "") && 
	(isset($_POST["password"]) && $_POST["password"] != "")) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$sql_query_for_duplication_checking = "SELECT * FROM users where (email = '$email')";
	$sql_query = "INSERT INTO users(email ,password) VALUES ('$email', '$password')";
	$connection = connectToDB();
	if(connectToDB()) {
		$duplicate_row = mysqli_query($connection, $sql_query_for_duplication_checking);
		if (mysqli_num_rows($duplicate_row) > 0) {
			$response = array("resultCode" => "Email Already Taken", "message" => "Try with different email!");
			echo json_encode($response);
		} else { 
			$insert_data = $connection -> query($sql_query);
			if ($insert_data === TRUE) {
				$inserted_id = $connection->insert_id;
				$response = array("resultCode" => "Success", "message" => "Successfully inserted into Database", "id" => $inserted_id, "email" => $email, "password" => $password);
				echo json_encode($response);
			} else {
				$response = array("resultCode" => "failure", "id" => nil);
				echo json_encode($response);
			}
		}
	}

} else {
	$response = array("resultCode" => "Invalid Input", "message" => "Either Email or Password is missing or both are missing!");
	echo json_encode($response);
}
?>