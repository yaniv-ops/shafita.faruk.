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
	 
 $sql = "CREATE TABLE users ( user_id INT NOT NULL AUTO_INCREMENT,
 			username VARCHAR(40) NOT NULL,
			email VARCHAR(60),
			PRIMARY KEY (user_id))
			ENGINE=INNODB;";
 	// use exec() because no results are returned
 $conn->exec($sql);
 echo "users table created successfully";
 $sql = "CREATE TABLE recruiters ( recruiter_id INT NOT NULL AUTO_INCREMENT,
  		recruiter_name VARCHAR(40) NOT NULL,
		recruiter_email VARCHAR(60),
		recruiter_phone VARCHAR(20),
		PRIMARY KEY (recruiter_id))
		ENGINE=INNODB;";
 $conn->exec($sql);
 echo "Recruiters table created successfully";
 
 $sql = "CREATE TABLE companies ( company_id INT NOT NULL AUTO_INCREMENT,
  company_name VARCHAR(60),
  PRIMARY KEY (company_id))
  ENGINE=INNODB;";
 $conn->exec($sql);
 echo "companies table created successfully";
 $sql = "CREATE TABLE jobs ( job_id INT NOT NULL AUTO_INCREMENT,
	job_name VARCHAR(40) NOT NULL,
	job_description VARCHAR(220) NOT NULL,
	company_id INT NOT NULL,
	PRIMARY KEY (job_id),
	INDEX fkCompany_id (company_id),
	FOREIGN KEY(company_id) 
	REFERENCES companies(company_id))
	ENGINE=INNODB;";
 $conn->exec($sql);
 echo "jobs table created successfully";

 $sql = "CREATE TABLE job_offers ( job_offer_id INT NOT NULL AUTO_INCREMENT, 
 	job_id INT NOT NULL,
	user_id INT NOT NULL, 
 	current_status VARCHAR(40),
	follow_status VARCHAR(60),
	date_recieved VARCHAR(80),
	follow_date VARCHAR(40),
	last_checked_date VARCHAR(40),
	recruiter_id INT NOT NULL,
	PRIMARY KEY (job_offer_id),
	INDEX fk_job_id (job_id),
	INDEX fk_user_id (user_id),
	INDEX fk_recruiter_id (recruiter_id),
	FOREIGN KEY (job_id)
	REFERENCES jobs (job_id),
	FOREIGN KEY (user_id)
	REFERENCES users (user_id),
	FOREIGN KEY (recruiter_id)
	REFERENCES recruiters (recruiter_id))
	ENGINE=INNODB;";
 $conn->exec($sql);
 echo "JOB OFFERS table created successfully";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
      
