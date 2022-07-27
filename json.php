<?php
require_once('pdo.php');
header("Content-type: application/json; charset=utf-8");
$searchterm = $_GET['term'];
$stmt = $conn->prepare('SELECT company_name FROM companies
    WHERE company_name LIKE :prefix');
$stmt->execute(array(':prefix'=> "%".$searchterm."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    $retval[] = $row['company_name'];
}
echo(json_encode($retval, JSON_PRETTY_PRINT));