<?php
require_once 'src/init.php';

if(isset($_SESSION['user'])) {
  header('Location: ' . BASE_URL);
}

if(isset($_POST['signup'])) {
  if(empty($_POST['user_username']) || empty($_POST['user_email']) || empty($_POST['user_password']) || empty($_POST['confirm_password'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_username' => $_POST['user_username']))) {
    $error = "This username is taken";
  } else if($db->exists('users', array('user_email' => $_POST['user_email']))) {
    $error = "This email address is already in use";
  } else if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Enter a valid email address";
  } else if($_POST['user_password'] !== $_POST['confirm_password']) {
    $error = "Passwords must match";
  } else {
    $user = new User($db);

    $signup = [
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email']),
      'user_password' => password_hash($_POST['user_password'], PASSWORD_BCRYPT)
    ];

    if($user->createUser($signup)) {
      $_SESSION['user'] = escape($signup['user_username']);

      header("Location: " . BASE_URL);
    } else {
      $error = "Unable to sign up";
    }
  }
}

$page_title = "Sign Up";

require VIEW_ROOT . '/signup.php';