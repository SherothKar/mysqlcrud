<?php
//Function for connecting to Database:
function connectToDB() { 
	$hostname = "127.0.0.1";
	$username = "root";
	$password = "root";
	$database = "This";
	$connection = mysqli_connect($hostname, $username, $password, $database);
	if (mysqli_connect_errno()) {
		mysqli_connect_error();
		return $connection;
	} else {
		return $connection;
	}
}
function connect() {
	try {
	    $connection = new PDO('mysql:host=localhost;dbname=This', 'root', 'root', 
    	 array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    	 );
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $connection;
	} catch (PDOException $e) {
		echo $e->getMessage();
	    return false;
	}
}

?>