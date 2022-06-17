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

