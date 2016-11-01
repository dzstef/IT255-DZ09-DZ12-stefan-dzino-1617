<?php
header('Access-Control-Allow-Methods: GET, POST');  
include("functions.php");

if(isset($_POST['nazivSobe']) && isset($_POST['tv']) && isset($_POST['kreveti'])){
	
$nazivSobe = $_POST['nazivSobe'];
$tv = intval($_POST['tv']);
$kreveti = intval($_POST['kreveti']);

dodajSobu($nazivSobe,$tv,$kreveti);
}
?>