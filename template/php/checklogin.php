<?php
require_once('config.php');
session_start();
//Check Cookie, If Available Create Login Session  
if (isset($_COOKIE['username']) && isset($_COOKIE['password']))
    if ($_COOKIE['username'] == USERNAME && $_COOKIE['password'] == md5(PASSWORD)) {
        $_SESSION['logged'] = "Viraivil";
    }
//Compare Username and Password, If Matches Create Login Session and Cookie  
if (isset($_POST["username"]) && isset($_POST["password"]))
    if ($_POST['username'] == USERNAME && $_POST['password'] == PASSWORD) {
        $_SESSION['logged'] = "Viraivil";
        if (isset($_POST['rememberme'])) {
            setcookie('username', $_POST['username'], time() + 60 * 60 * 24 * 7, "/");
            setcookie('password', md5($_POST['password']), time() + 60 * 60 * 24 * 7, "/");
        }
    }
?>