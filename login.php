<?php
require_once 'src/init.php';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header('Location: ' . BASE_URL);
}

if(isset($_POST['login'])) {
  if(!empty($_POST['user_username']) && !empty($_POST['user_password'])) {
    $user = new User($db);
  
    if($user->logIn() && password_verify($_POST['user_password'], $user->user_password)) {
      $_SESSION['user_username'] = $user->user_username;
      $_SESSION['logged_in'] = true;
  
      header("Location: " . BASE_URL);
    } else {
      $error = "Username or Password Incorrect";
    }
  } else {
    $error = "Enter your Username and Password";
  }
}

$page_title = "Log In";

require VIEW_ROOT . '/login.php';