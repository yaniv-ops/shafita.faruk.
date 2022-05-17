<?php

function updateUser($username, $email, $conn)
{
    unset($_SESSION['error']);
    $sql = $conn->query("SELECT username, email FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        if ($row['username'] == "1" && $row['email'] == "1@1") {
            $_SESSION['success'] = $username . " " . "Logged in.";
            $_SESSION['username'] = $username;
            echo "<h1 >" . $_SESSION['success'] . "</h1>";    
            break;
        } elseif ($row['username'] = $username) {
            $_SESSION['error'] = "Username is used!";
            break;
        } elseif ($row['email'] = $email) {
            $_SESSION['error'] = "Email already registerd";
            break;
        } 
        $_SESSION['error'] = "not Registered";
            
        
    }
    
    return;
    
    
    
}
