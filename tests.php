<?php
if (!isset($_SESSION['username']) && isset($_POST['username']) && isset($_POST['email'])) {
        updateUser($_POST['username'], $_POST['email'], $conn);
        header("Locate: home.php");
        return;
}
     elseif (!isset($_POST['username'])) {
            $_SESSION['error'] = "You must provide a username";
            header('Locate: home.php');
            return;
        } else {
        $_SESSION['error'] = "You must provide an email address";
        header('Locate: home.php');
        return;
        }
    }

?>