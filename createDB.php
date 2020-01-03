<?php
$servername = "localhost";
$username = "root";
$password = "";
if(isset($_POST["DatabaseName"]))
$databaseName = $_POST["DatabaseName"];
else
$databaseName = "sampleDatabase";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE $databaseName";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>