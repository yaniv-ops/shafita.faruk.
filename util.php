<?php

function updateUser($username, $email, $conn) {
    $sql = $conn->query("SELECT username, email FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ( $rows as $row ) {
        if ( $row['username'] === $username && $row['email'] === $email) {
            $_SESSION['success'] = $_POST['username'] . " " . "Logged in.";
            $_SESSION['username'] = $_POST['username'];
            header('Location: home.php');
            return $_SESSION['success'];
        } elseif ( $row['username'] = $username) {
            $_SESSION['error'] = "Username is used!";
            header('Location: home.php');
            return $_SESSION['error'];
        
        } elseif ( $row['email'] = $email ) {
            $_SESSION['error'] = "Email already registerd";
            header('Location: home.php');
            return $_SESSION['error'];
        } else {

            $_SESSION['error'] = "If You are Registered already, check your spelling\nIf you are new check the error flash:";
            header('Location: home.php');
            return $_SESSION['error'];
        }
    
         

        }


}