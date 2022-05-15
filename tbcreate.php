<?php
$host = 'localhost';
$user = 'root';
$pass = 'shafita77';
$db = 'myDBPDO';

try {
 $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	// set the PDO error to exeption
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	// sql to create users table
 $sql = "CREATE TABLE users ( user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(40) NOT NULL, email VARCHAR(60))";
 	// use exec() because no results are returned
 $conn->exec($sql);
 echo "users table created successfully";
 $sql = "CREATE TABLE recruiters ( user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(40) NOT NULL, company VARCHAR(40), email VARCHAR(60), phone VARCHAR(20))";
 $conn->exec($sql);
 echo "Recruiters table created successfully";
 
 $sql = "CREATE TABLE companies ( user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(40) NOT NULL, company VARCHAR(60), email VARCHAR(60), phone VARCHAR(20), recruiter INT REFERENCES recruiters(user_id))";
 $conn->exec($sql);
 echo "companies table created successfully";

 $sql = "CREATE TABLE jobs ( user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(40) NOT NULL, company INT REFERENCES companies(user_id), recruiter INT REFERENCES recruiters(user_id))";
 $conn->exec($sql);
 echo "jobs table created successfully";

 $sql = "CREATE TABLE job_offers ( user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, job_name INT NOT NULL REFERENCES jobs(user_id), user INT REFERENCES users(user_id), status VARCHAR(40), follow_up VARCHAR(60), follow_date VARCHAR(40))";
 $conn->exec($sql);
 echo "JOB OFFERS table created successfully";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
      
