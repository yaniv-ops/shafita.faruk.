<?php

function checkUser($username, $email, $conn)
{

    $sql = $conn->query("SELECT * FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $nRows = $conn->query("select count(*) from users")->fetchColumn();
    if ($nRows === "0") {
        $_SESSION['success'] = "Welcome New Adventurer";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        return;
    }
    

    foreach ($rows as $row) {
        if ($username === htmlentities($row['username']) && $email === htmlentities($row['email'])) {
            $_SESSION['success'] = "Welcome Adventurer";
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            return;
        }
        if ($username === htmlentities($row['username'])) { 
            unset($_SESSION['success']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            $_SESSION['error'] = "Username is already taken choose another username";
            return;
        }
        if ($email === htmlentities($row['email'])) {
            unset($_SESSION['email']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            unset($_SESSION['success']);
            $_SESSION['error'] = "Email is being used";
            return;
        }


    } $_SESSION['success'] = "Welcome New Adventurer";
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email; 
      return;     
}


function newUser($username, $email, $conn) {
    $sql = "INSERT INTO users (username, email)
                VALUES (:username, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':username' => $username,
        ':email' => $email));
    unset($_SESSION['error']);    
    $_SESSION['success'] = "Adventurer has been added!";
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    return;

}


function showUserdata($username, $conn) {
    $stmt = $conn->prepare("SELECT * FROM job_offers where user_id= :xyz ");
    $stmt->execute(array(":xyz" => $username ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function insertData($username, $conn) {
    $stmt = $conn->prepare("SELECT * FROM users where username= :xyz ");
    $stmt->execute(array(":xyz" => $username ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === false ) {
        unset($_SESSION['error']);
        $_SESSION['success'] = "Empty Offers list";
        $_SESSION['username'] = $username;
        header('Location: home.php');
        return;
    }

    return $row;
}

// this function for inserting data for later on friday at most

function validatePos($conn) {
    $stmt = $conn->prepare('SELECT user_id FROM users                                         sers
    WHERE username = :user');
    $stmt->execute(array(':user' => $_SESSION['username']));
    $profile = $stmt->fetchColumn();
    if ( $profile === false) {
        $_SESSION['error'] = 'Could not load profile';
        header('Location: home.php');
        return;
    };

    $pointer_current_status = 'Job Offer initiated';
    $pointer_to_followstatus = "What's next?";
    $pointer_to_date = date("Y/m/d");

    for($i=1; $i<=9; $i++) {
        if (!isset($_POST['pos'.$i])) continue;
        if (!isset($_POST['desc'.$i])) continue;
        $position = $_POST['pos'.$i];
        $description = $_POST['desc'.$i];
        $company = $_POST['comp'.$i];
        $company_mail = $_POST['e-mail'.$i];
        $company_phone = $_POST['company_phone'.$i];
        $recruiter = $_POST['rec'.$i];
        $recruiter_mail = $_POST['rec-mail'.$i];
        $recruiter_phone = $_POST['rec-phone'.$i];
        $current_status = $pointer_current_status;
        $follow_status = $pointer_to_followstatus;
        $date_now = $pointer_to_date;
        $follow_date = $pointer_to_date;

        $stmt = $conn->prepare('INSERT INTO companies 
            (company_name, company_email, company_phone)
            VALUES ( :comp_name, :comp_mail, :comp_phone)');
        $stmt->execute(array(
            ':comp_name' => $company,
            ':comp_mail' => $company_mail,
            ':comp_phone' => $company_phone)
        );
        $stmt = $conn->prepare('INSERT INTO recruiters
            (recruiter_name, recruiter_email, recruiter_phone)
            VALUES ( :rec_name, :rec_mail, :rec_phone)');
        $stmt->execute(array(
            ':rec_name' => $recruiter,
            ':rec_mail' => $recruiter_mail,
            ':rec_phone' => $recruiter_phone)
        );
        $stmt = $conn->prepare('SELECT company_id FROM companies                                         sers
        WHERE company_name = :comp_name');
        $stmt->execute(array(':comp_name' => $company));
        $comp_profile = $stmt->fetchColumn();
        if ( $comp_profile === false) {
            $_SESSION['error'] = 'Could not load company profile';
            header('Location: home.php');
            return;
        };
        $stmt = $conn->prepare('SELECT recruiter_id FROM recruiters                                         sers
        WHERE recruiter_name = :rec_name');
        $stmt->execute(array(':rec_name' => $recruiter));
        $rec_profile = $stmt->fetchColumn();
        if ( $rec_profile === false) {
            $_SESSION['error'] = 'Could not load recruiter profile';
            header('Location: home.php');
            return;
        };
        
        $stmt = $conn->prepare('INSERT INTO jobs
            (job_name, job_description, company_id)
            VALUES ( :job, :job_des, :comp_id)');
        $stmt->execute(array(
            ':job' => $position,
            ':job_des' => $description,
            ':comp_id' => $comp_profile)
        );
        $stmt = $conn->prepare('SELECT job_id FROM jobs                                         sers
        WHERE job_description = :job_name');
        $stmt->execute(array(':job_name' => $description));
        $job_profile = $stmt->fetchColumn();
        if ( $job_profile === false) {
            $_SESSION['error'] = 'Could not load job profile';
            header('Location: home.php');
            return;
        };

        $stmt = $conn->prepare('INSERT INTO job_offers
            (user_id, job_id, current_status, follow_status, date_recieved, follow_date, 
            last_checked_date, recruiter_id)
            VALUES ( :user_id, :job_id, :current, :follow, :date_now, :follow_date, 
            :last_check, :rec_id)');
        $stmt->execute(array(
            ':user_id' => $profile,
            ':job_id' => $job_profile,
            ':current' => $current_status,
            ':follow' => $follow_status,
            ':date_now' => $date_now,
            ':follow_date' => $follow_date,
            ':last_check' => $date_now,
            ':rec_id' => $rec_profile)
        );    

    }
}

function updateJobs($conn) {
    $stmt = $conn->prepare('UPDATE Profile SET
        first_name=:fn, last_name=:ln,
        email=:em, headline=:he, summary=:su
        WHERE profile_id=:pid AND user_id=:uid');
    $stmt->execute(array(
        ':pid' => $_POST['username'],
        ':uid' => $_POST['email'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['user_id'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary']
    ));    
}

function loadEdu($conn, $profile_id) {
    $stmt = $conn->prepare('SELECT year,name FROM Education
    JOIN Institution
        ON Education.institution_id = Institution.institution_id
    WHERE profile_id = :prof ORDER BY rank');
    $stmt->execute(array(':prof' => $profile_id));
    $educations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $educations;
}