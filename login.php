<?php
echo '<form method="post">';
echo '<label for="username">name:  </label>';
echo '<input type="text" id="username" name="username"><br><br>';
echo '<label for="email">Email:  </label>';
echo '<input type="email" id="email" name="email"><br><br>';
echo '<input type="submit" value="Submit">';
$_SESSION["username"] = $_POST["username"];
echo "header('Location: home.php')";
echo 'return';
echo '<h1>OKKKKKKKK</h1>';
echo '</form>';
