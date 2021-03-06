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
        } else {
            checkUser($_POST['username'], $_POST['email'], $conn);
            header('Location: home.php');
            return;
            
        }
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
    if (isset($_POST['email']) && isset($_POST['username']))
       { $_SESSION['error'] = "You must";
        header('Location: home.php');
        return;
       }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Validation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
    }
    if (isset($_SESSION['success'])) {
        echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
        if (isset($_POST['Quit'])) {
            session_destroy();
            header('Location: home.php');
            return;
        }
        if ((isset($_POST['pos1']))) {
            validatePos($conn);
            $_SESSION['success'] = "Welcome Adventurer";
            header('Location: home.php');
            return;
        }
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
                if ($_SESSION['success'] == "Welcome New Adventurer") {
                    echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    $msg = $_SESSION['success'];
                    session_destroy();
                    echo '<p style="color:purple">' . $_SESSION['success'] . "</p>\n";
                    echo '<p style="color:purple">' . $username . "</p>\n";
                    echo '<p style="color:purple">' . $email . "</p>\n";
                    echo '<h1>Would you Like to register as a new user?</h1>';
                    echo "<form method='POST' action='home.php'>";
                    echo '<input type="hidden" id="username"  name="username" value=' . $username . '>';
                    echo '<input type="hidden" id="email" name="email" value=' . $email . '>';
                    echo "<input type='hidden' id='new_user' name='new_user' value='true'>";
                    echo "<input type='submit' name='submit'>";
                    echo "</form>";
                    echo "<form method='POST' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    
                }
                if ($_SESSION['success'] == "Adventurer has been added!") {
                    session_destroy();
                    echo "<form method='POST' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    
                }
                if ($_SESSION['success'] === "Welcome Adventurer") {
                    echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
                    $row = showUserdata($_SESSION['username'], $conn);
                    if ($row === false ) {
                        $username = $_SESSION['username'];
                        $msg = $_SESSION['success'];
                        echo "<h1>No job offers</h1>";
                        echo ('<form id="first_form" method="POST" action="home.php">');
                        echo ('<p id="bacon">Add Job offer: <button id="addJob" >+</button></p>');
                        echo ('<div id="position_fields"></div>');
                        echo '<h1>what</h1>';
                        echo ('<input type="submit" id="first_form_submit" name="submit">Submit</button>');
                        echo ('</form>');
                        echo "<form method='POST' action='home.php'";
                        echo "<input type='hidden' id='cancel' name='cancel' value='true'>";
                        echo "<input type='submit' name='Cancel'>";
                        echo "</form>";
                        echo "<form method='POST' action='home.php'";
                        echo "<input type='hidden' id='quit' name='quit' value='true'>";
                        echo "<input type='submit' name='Quit'>";
                        echo "</form>";
                        
                    } else {

                    foreach ($row as $value) {
                        echo "<h1>".$value['job_offer_id']."</h1>";
                    }
                    echo "<h1>Success</h1>";
                    $username = $_SESSION['username'];
                    $msg = $_SESSION['success'];
                    echo "<h1>Job offers</h1>";
                    echo ('<form id="first_form" method="POST" action="home.php">');
                    echo ('<p id="bacon">Add Job offer: <button id="addJob" >+</button></p>');
                    echo ('<div id="position_fields"></div>');
                    echo '<h1>what</h1>';
                    echo ('<input type="submit" id="first_form_submit" name="submit">Submit</button>');
                    echo ('</form>');
                    echo "<form method='POST' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    }
                }
                
            } else if (isset($_SESSION['error'])) {
            session_destroy();
            echo var_dump($_SESSION);            
            include('login.php');
            } else {
                echo var_dump($_SESSION);
                include('login.php');
            }


            ?>


        </div>
    </div>

</body>

</html>