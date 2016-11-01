<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');

$servername = "localhost";
$username = "root";
$password = "root";
$db = "domaci8";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $db);

if($conn->connect_error){
	die("Greska pri konekciji". $conn->connect_error);
}
?>