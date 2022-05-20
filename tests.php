<?php
    foreach ($rows as $row) {
        if ($row['username'] == "1" && $row['email'] == "1@1") {
            unset($_SESSION['error']);
            $_SESSION['success'] = $username . " " . "Logged in.";
            $_SESSION['username'] = $username;
            echo "<h1 >" . $_SESSION['success'] . "</h1>";
            break;
        } elseif ($username == "yaniv") {
            $_SESSION['error'] = "Username is used!";
            break;
        } elseif ($row['email'] == $email) {
            $_SESSION['error'] = "Email already registerd";
            break;
        } else {
            $_SESSION['error'] = "not Registered";
        }
    }


    return;

?>