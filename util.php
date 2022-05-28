<?php

function updateUser($username, $email, $conn)
{

    $sql = $conn->query("SELECT * FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $nRows = $conn->query("select count(*) from users")->fetchColumn();
    if ($nRows === "1") {
        $_SESSION['error'] = "No Data at all";
        return;
    }
    

    foreach ($rows as $row) {
        if ($username === htmlentities($row['username']) && $email === htmlentities($row['email'])) {
            $_SESSION['success'] = "Welcome Adventurer";
            $_SESSION['username'] = $username;
            return;
        }
        if ($username === htmlentities($row['username'])) {
            $_SESSION['error'] = "Username is already taken";
            return;
        }
        if ($email === htmlentities($row['email'])) {
            $_SESSION['error'] = "Email is being used";
            return;
        }

        $_SESSION['error'] = "Welcome New Adventurer";
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
    $_SESSION['success'] = "Adventurer has been added!";
    return;
    
    
}


function showUserdata($username, $conn) {
    $stmt = $conn->prepare("SELECT * FROM job_offers where user= :xyz ");
    $stmt->execute(array(":xyz" => $username ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === false ) {
        $_SESSION['error'] = "Bad value for username";
        $_SESSION['username'] = $username;
        header('Location: home.php');
        return;
    }
    header('Locatin: home.php');
    return $row;
}


function flash_messages()