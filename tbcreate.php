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
 $sql = "CREATE TABLE recruiters ( recruiter_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, recruiter_name VARCHAR(40) NOT NULL, recruiter_company VARCHAR(40), recruiter_email VARCHAR(60), recruiter_phone VARCHAR(20))";
 $conn->exec($sql);
 echo "Recruiters table created successfully";
 
 $sql = "CREATE TABLE companies ( company_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, company_name VARCHAR(40) NOT NULL, company_email VARCHAR(60), company_phone VARCHAR(20))";
 $conn->exec($sql);
 echo "companies table created successfully";

 $sql = "CREATE TABLE jobs ( job_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	job_name VARCHAR(40) NOT NULL, job_description VARCHAR(220) NOT NULL, company_id VARCHAR(40), CONSTRAINT is_jobs
	FOREIGN KEY(company_id) REFERENCES companies(company_id))";
 $conn->exec($sql);
 echo "jobs table created successfully";

 $sql = "CREATE TABLE job_offers ( job_id INT(11), recruiter_id INT(11), user_id INT(11), 
 	current_status VARCHAR(40), follow_status VARCHAR(60), date_recieved VARCHAR(80), follow_date VARCHAR(40),
	 CONSTRAINT for_jobs FOREIGN KEY(job_id) REFERENCES jobs(jobs_id),
	 CONSTRAINT for_recruiters FOREIGN KEY(recruiter_id) REFERENCES recruiters(recruiter_id),
	 CONSTRAINT for_users FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE)";
 $conn->exec($sql);
 echo "JOB OFFERS table created successfully";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>
      
