<?php
require_once('pdo.php');
require_once('util.php');
session_start();
if (!isset($_SESSION['success']) && !isset($_SESSION['error'])) {
    if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['email']) && !empty($_POST['email']))) {
        
        updateUser($_POST['username'], $_POST['email'], $conn);
        header('Location: home.php');
        return;
    
    } if (isset($_POST['username']) && !empty($_POST['username'])) {

           
            $_SESSION['error'] = "You must provide an email address";
            header('Location: home.php');
            return;
        } if (isset($_POST['email']) && !empty($_POST['email'])) {

        
        $_SESSION['error'] = "You must provide a username address";
        header('Location: home.php');
        return;

        } if (isset($_POST['username']) && empty($_POST['username']) && isset($_POST['email']) && empty($_POST['email'])) {
            $_SESSION['error'] = "You must provide an email and a username";
            header('Location: home.php');
            return;   
        }
  
    
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . '</p>\n';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
        unset($_SESSION['success']);
    }
    ?>

    <h1>Slo-Rocking Horses</h1>
    <h1 id="scribble-top">A Job Helper</h1>
    <div class="wrapped-content">
        <img class="scroll" src="https://www.runescape.com/img/rsp777/scroll/backdrop_765_bottom.gif">
        <div class="contents-table">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
                unset($_SESSION['success']);
            } else {

                
                require_once('login.php');
                
            }
            ?>
        </div>
    </div>
    <script src="index.js"></script>
</body>

</html>