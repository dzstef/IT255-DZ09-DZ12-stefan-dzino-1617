<?php
include("config.php");

//Metoda za dodavanje soba  u bazu
function dodajSobu($nazivSobe, $tv, $krevet){
	global $conn;
	$rarray = array();
	$stmt = $conn->prepare("INSERT INTO sobe (naziv, tv, krevet) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $nazivSobe, $tv, $krevet);
	if($stmt->execute()){
		$rarray['sucess'] = "ok";
	}else{
		$rarray['error'] = "Database connection error";
	}
	return json_encode($rarray);
}

//Metoda koja pretrazuje sve sobe iz baze
function popisSoba(){
	global $conn;
	$rarray = array();
	
		$result = $conn->query("SELECT * FROM sobe");
		$num_rows = $result->num_rows;
		$sobe = array();
		if($num_rows > 0)
		{
			$result2 = $conn->query("SELECT * FROM sobe");
			while($row = $result2->fetch_assoc()) {
				$one_room = array();
				$one_room['id'] = $row['id'];
				$one_room['naziv'] = $row['naziv'];
				$one_room['tv'] = $row['tv'];
				$one_room['krevet'] = $row['krevet'];
				array_push($sobe,$one_room);
			}
		}
		$rarray['sobe'] = $sobe;
		return json_encode($rarray);	
}

//metoda proverava da li je korisnik vec ulogovan
function checkIfLoggedIn(){
	global $conn;
	if(isset($_SERVER['HTTP_TOKEN'])){
		$token = $_SERVER['HTTP_TOKEN'];
		$result = mysqli_query($conn, "SELECT * FROM registracija WHERE token='$token'");
		$num_rows = mysqli_num_rows($result);
		if($num_rows>0){
			return true;
		}
		else{
			return false;
		}	
	}
	else{
		return false;
	}
}

//metoda za logovanje
function login($username, $password){	
	global $conn;
	$rarray = array();
	if(checkLogin($username,$password)){
		$id = sha1(uniqid());
		$result2=mysqli_query($conn,"UPDATE registracija SET token='$id' WHERE username='$username'");
		$rarray['token']=$id;
	}
	else{
		$rarray['error']="Nevalidni podaci";
	}
	return json_encode($rarray);	
}

//metoda koja proverava da li su podaci validni
function checkLogin($username, $password){
	global $conn;
	$username = mysqli_real_escape_string($conn,$username);
	$password = md5(mysqli_real_escape_string($conn,$password));
	$result = mysqli_query($conn, "SELECT * FROM registracija WHERE username='$username' AND password='$password'");
	$num_rows = mysqli_num_rows($result);
	if($num_rows>0){
		return true;
	}
	else{
		return false;
	}
}

//metoda za registraciju
function registracija($username, $password, $ime, $prezime, $email, $telefon){
	global $conn;
	$rarray = array();
	$errors = "";
	if(checkIfUserExists($username)){
		$errors .= "Korisnicko ime vec postoji\r\n";
	}
	if(strlen($username) < 5){
		$errors .= "Korisnicko ime mora imati najmanje 5 karaktera\r\n";
	}
	if(strlen($password) < 5){
		$errors .= "Lozinka mora imati najmanje 5 karaktera\r\n";
	}
	if(strlen($ime) < 3){
		$errors .= "Ime mora imati najmanje 3 karaktera\r\n";
	}
	if(strlen($prezime) < 5){
		$errors .= "Prezime mora imati najmanje 5 karaktera\r\n";
	}
	if(strlen($email) < 7){
		$errors .= "Email mora imati najmanje 7 karaktera\r\n";
	}
	if(strlen($telefon) < 6){
		$errors .= "Telefon mora imati najmanje 6 karaktera\r\n";
	}
	if($errors == ""){
		$stmt = $conn->prepare("INSERT INTO registracija (username,password, ime, prezime, email, telefon) VALUES (?, ?, ?, ?, ?, ?)");
		$pass =md5($password);
		$stmt->bind_param("ssssss", $username, $password, $ime,$prezime,$email,$telefon);
		if($stmt->execute()){
			$id = sha1(uniqid());
			$result2 = $conn->prepare("UPDATE registracija SET token=? WHERE username=?");
			$result2->bind_param("ss",$id,$username);
			$result2->execute();
			$rarray['token'] = $id;
		}else{
			header('HTTP/1.1 400 Bad request');
			$rarray['error'] = "Database connection error";
		}
	} else{
		header('HTTP/1.1 400 Bad request');
		$rarray['error'] = json_encode($errors);
	}
	
	return json_encode($rarray);
}

//Metoda proverava da li korisnicko ime postoji u bazi
function checkIfUserExists($username){
	global $conn;
	$result = $conn->prepare("SELECT * FROM registracija WHERE username=?");
	$result->bind_param("s",$username);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{	
		return false;
	}
}


?>