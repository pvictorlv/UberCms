<?php

session_start();
require_once("../global.php");

if(isset($_POST['motto'])){
    // Sanitize and validate input
    $motto = filter_input(INPUT_POST, 'motto', FILTER_SANITIZE_STRING);
    $motto = htmlspecialchars(substr($motto, 0, 32));
    
    // Use prepared statement
    Db::query("UPDATE users SET motto = ? WHERE username = ? LIMIT 1", $motto, USER_NAME);
    
    echo $motto;
} else {
    $getCoins = Db::query("SELECT motto FROM users WHERE username = ? LIMIT 1", USER_NAME);
    $myrow = $getCoins->fetch(PDO::FETCH_ASSOC);
    echo $myrow['motto'];
}
?>