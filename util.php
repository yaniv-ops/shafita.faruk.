<?php

function updateUser($username, $email, $conn)
{

    $sql = $conn->query("SELECT * FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $nRows = $conn->query("select count(*) from users")->fetchColumn();
    if ($nRows === "1") {
        $_SESSION['error'] = "No Users at all";
        return;
    }
    

    foreach ($rows as $row) {
        if ($username === htmlentities($row['username']) && $email === htmlentities($row['email'])) {
            unset($_SESSION['error']); 
            $_SESSION['success'] = "Welcome Adventurer";
            $_SESSION['username'] = $username;
            return;
        }
        if ($username === htmlentities($row['username'])) { 
            unset($_SESSION['success']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            $_SESSION['error'] = "Username is already taken\nchoose another username";
            return;
        }
        if ($email === htmlentities($row['email'])) {
            unset($_SESSION['email']);
            $_SESSION['error'] = "Email is being used";
            return;
        }

        $_SESSION['success'] = "Welcome New Adventurer";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    }   return;     
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
    $stmt = $conn->prepare("SELECT * FROM job_offers where user= :xyz ");
    $stmt->execute(array(":xyz" => $username ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === false ) {
        unset($_SESSION['error']);
        $_SESSION['success'] = "Empty Offers list";
        $_SESSION['username'] = $username;
        unset($_SESSION['email']);
        header('Location: home.php');
        return;
    }
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
    $stmt = $conn->prepare('SELECT * FROM Profile
    WHERE profile_id = :prof AND user_id = :uid');
    $stmt->execute(array(':prof' => $_POST['username'],
        ':uid' => $_SESSION['email']));
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $profile === false) {
        $_SESSION['error'] = 'Could not load profile';
        header('Location: home.php');
        return;
    }

    for($i=1; $i<=9; $i++) {
        if (!isset($_POST['pos'.$i])) continue;
        if (!isset($_POST['desc'.$i])) continue;
        $position = $_POST['pos'.$i];
        $description = $_POST['desc'.$i];
        $stmt = $conn->prepare('INSERT INTO job_offers
            (user, job_name, "status", follow_up, follow_date)
            VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(array(
            ':pid' => $position,
            ':rank' => $description)
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