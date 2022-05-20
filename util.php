<?php

function updateUser($username, $email, $conn)
{

    $sql = $conn->query("SELECT * FROM users");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        $_SESSION['error'] = "Empty Database";
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        return;    }

    foreach ($rows as $row) {
        if ($username === $row['username'] && $email === $row['email']) {
            $_SESSION['success'] = "Welcome Adventurer";
            return;
        }
        if ($username === $row['username']) {
            $_SESSION['error'] = "Username is already taken";
            return;
        }
        if ($email === $row['email']) {
            $_SESSION['error'] = "Email is being used";
            return;
        }


    }        

return;
}