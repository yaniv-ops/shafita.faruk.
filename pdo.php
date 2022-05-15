<?php
$host = 'localhost';
$user = 'root';
$pass = 'shafita77';
$db = 'myDBPDO';

try {
	$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	   // set the PDO error to exeption
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
} catch (PDOException $e) {
	echo $conn . "<br>" . $e->getMessage();
}

