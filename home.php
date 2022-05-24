<?php
require_once('pdo.php');
require_once('util.php');
session_start();
if (!isset($_SESSION['success']) && !isset($_SESSION['error'])) {
    if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['email']) && !empty($_POST['email']))) {

        if (isset($_POST['new_user']) && $_POST['new_user'] === "true") {
            newUser($_POST['username'], $_POST['email'], $conn);
            header('Location: home.php');
            return;

        } elseif (isset($_POST['quit']) && $_post['quit']='true') {
            session_destroy();
            header('Location: home.php');
            return;
        } else {
            updateUser($_POST['username'], $_POST['email'], $conn);
            header('Location: home.php');
            return;
                } 
     header('Location: home.php');           
     return;           

    } 
    if (isset($_POST['username']) && !empty($_POST['username'])) {


        $_SESSION['error'] = "You must provide an email address";
        header('Location: home.php');
        return;
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {


        $_SESSION['error'] = "You must provide a username address";
        header('Location: home.php');
        return;
    }
    if (isset($_POST['username']) && empty($_POST['username']) && isset($_POST['email']) && empty($_POST['email'])) {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="index.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . '</p>\n';
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
    }
    if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
        echo '<p style="color:white">' . $_SESSION['username'] . "</p>\n";
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
                $row = showUserdata($_SESSION['username'], $conn);
                echo "<h1>$row</h1>";
                unset($_SESSION['success']);
            } elseif (isset($_SESSION['error'])) {

                if ($_SESSION['error'] == "Welcome New Adventurer") {

                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    session_destroy();
                    echo '<p style="color:purple">' . $_SESSION['error'] . "</p>\n";
                    echo '<p style="color:purple">' . $username . "</p>\n";
                    echo '<p style="color:purple">' . $email . "</p>\n";
                    echo '<h1>Would you Like to register as a new user?</h1>'; 
                    echo "<form method='post' action='home.php'>";
                    echo '<input type="hidden" id="username"  name="username" value=' . $username .'>';
                    echo '<input type="hidden" id="email" name="email" value=' . $email . '>';
                    echo "<input type='hidden' id='new_user' name='new_user' value='true'>";
                    echo "<input type='submit' name='submit'>";
                    echo "</form>";
                    echo "<form method='post' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    return;
                } elseif ($_SESSION['error'] == "Bad value for username") {
                        unset($_SESSION['error']);
                        $username = $_SESSION['username'];
                        $msg = $_SESSION['success'] = 'No offers yet';
                        echo "<h1>$msg</h1>";
                        echo ("<p>Add Job offer<input type='submit' id='addJob' value='+'><div id='position_fields'></div></p>");
                        echo ('<script type="text/javascript" src="add_job.js"></script>');
                        return;
                } else {
                    
                    unset($_SESSION['error']);
                    require_once('login.php');
                    return;
                }
                
                    
                } 
                require_once('login.php');
                    
            
            ?>

            
        </div>
    </div>
            
</body>

</html>