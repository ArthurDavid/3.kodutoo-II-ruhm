<?php
	//k�ik AB'iga seonduv
	// �henduse loomiseks kasuta
	require_once("../configglobal.php");
	$database = "if15_areinlo_2";
	
	// paneme sessiooni k�ima, saame kasutada $_SESSION muutujaid
	session_start();
	
	// lisame kasutaja ab'i
	function createUser($create_email, $password_hash){
		// globals on muutuja k�igist php failidest mis on �hendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		$stmt->bind_param("ss", $create_email, $password_hash);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();		
	}
	
	//logime sisse
	function loginUser($email, $password_hash){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password_hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			echo "kasutaja id=".$id_from_db;
			
			$_SESSION["id_from_db"] = $id_from_db;
			$_SESSION["user_email"] = $email_from_db;
			
			//suunan kasutaja data.php lehele
			header("Location: data.php");
			
		}else{
			echo "Wrong password or email!";
		}
		$stmt->close();
		$mysqli->close();
	}
	function createCarData($year, $make, $model, $horsepower, $topspeed, $gearbox){
		// globals on muutuja k�igist php failidest mis on �hendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO car_data (year, make, model, horsepower, topspeed, transmission) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("iiiiis", $_SESSION["id_from_db"], $year, $make, $model, $horsepower, $topspeed, $transmission);
		$message = "";
		if($stmt->execute()){
			// see on t�ene siis kui sisestus ab'i �nnestus
			$message = "Succesfully inserted into database";
		}else{
			// execute on false, miski l�ks katki
			echo $stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return $message;
	}
?>