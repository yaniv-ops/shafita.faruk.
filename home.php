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
       { $_SESSION['error'] = "You must provide a username and e-mail";
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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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

    ?>

    <h1>Slo-Rocking Horses</h1>
    <h1 id="scribble-top">A Job Helper</h1>
    <div class="wrapped-content">
        <img class="scroll" src="https://www.runescape.com/img/rsp777/scroll/backdrop_765_bottom.gif">
        <div class="contents-table">
            <?php

            if (isset($_SESSION['success'])) {
                echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
                if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
                    echo '<p style="color:white">' . $_SESSION['username'] . "</p>\n";
                }
                if ($_SESSION['success'] == "Welcome New Adventurer") {
                    
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    $msg = $_SESSION['success'];
                    session_destroy();
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
                    echo "<h3>Re-enter with the username and e-mail you have registered</h3>";
                    echo "<form method='POST' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    
                }
                if ($_SESSION['success'] === "Welcome Adventurer") {
                    if (isset($_POST['cars'])) {
                        updateJobs($conn);
                        header('Location: home.php');


                    }
                    
                    $row = showUserdata($_SESSION['username'], $conn);
                    if (count($row) == 0 ) {
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

                    $username = $_SESSION['username'];
                    $msg = $_SESSION['success'];
                    echo "<h1>Job offers</h1>";
                    echo "<table><th>Job name</th>
                    <th>Job Description</th><th>Company</th><th>Recruiter</th><th>Recruiter mail</th>
                    <th>Recruiter phone</th><th>Follow-up</th><th>Follow-up date</th>";    
                    foreach ($row as $value) {
                        
                        $job_id = prepareData($value['job_id'], $conn);
                        $recruiter = pullRec($value['recruiter_id'], $conn);
                        foreach ($job_id as $jid) {
                            $date_input = strtotime($value['follow_date']);
                            echo date('d/m/Y', $date_input);
                            $date = date('d/m/Y', $date_input);
                            $company = pullComp($jid['company_id'], $conn);                           
                            echo "<tr>
                            <td><p>".$jid['job_name']."</p></td>
                            <td><p>".$jid['job_description']."</p></td>
                            <td><p>".$company['company_name']."</p></td>
                            <td><p>".$recruiter['recruiter_name']."</p></td>
                            <td><p>".$recruiter['recruiter_email']."</p></td>
                            <td><p>".$recruiter['recruiter_phone']."</p></td>
                            <td><p>".$value['follow_status']."</p></td>
                            <td><p>".$date."</p></td>
                            <td><button class='update' name='update' type='submit' value='".$value['job_id']."'>Update</button></td>
                            <td><button class='send_button' value='".$value['job_id']."'>Send recruiter an update</button></td>
                            </tr>";
                            
                        }
        
                        

           
                    } 
                    echo "</table>";
                    echo ('<form id="first_form" method="POST" action="home.php">');
                    echo ('<p id="bacon">Add Job offer: <button id="addJob" >+</button></p>');
                    echo ('<div id="position_fields"></div>');
                    echo ('<input type="submit" id="first_form_submit" name="submit">Submit</button>');
                    echo ('</form>');
                    echo "<form method='POST' action='home.php'";
                    echo "<input type='hidden' id='quit' name='quit' value='true'>";
                    echo "<input type='submit' name='Quit'>";
                    echo "</form>";
                    echo "<div id='dialog-form' title='My jkhgjhkgjh dialog box'>
                    <form id='send-form' method='POST' action='home.php'>
                    <div id='body'><textarea name='testArea' id='mysend' required rows='10'></textarea><br></div>
                    <input type='hidden' id='input-hidden' name='input-hidden'><br>
                    </form>
                    </div>
                    <div id='dialog-formb' title='My second dialog box'>
                    <form id='update-form' method='POST' action='home.php'>
                    <select id='cars' name='cars'>
                    <option value='no'>No response</option>
                    <option value='cv'>Cv has been sent</option>
                    <option value='zoom'>Zoom interview</option>
                    <option value='mail'>Contact by mail</option>
                    <option value='phone'>phone is scheduled</option>
                    <option value='meet'>Personal interview</option>
                    <option value='onboard'>Onboard interview</option>
                    <option value='accepted'>Job accepted</option>
                    <option value='failed'>Job not accepted</option>
                    </select>
                    <input type='date' id='date' name='date'>
                    <input type='hidden' id='input-hiddenb' name='input-hiddenb'><br>
                    </form>
                    </div>";
                    }
                }
                
            } else if (isset($_SESSION['error'])) {
            session_destroy();            
            include('login.php');
            } else {
                include('login.php');
            }


            ?>




        </div>
    </div>

</body>

</html>