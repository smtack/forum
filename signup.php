<?php
require_once 'src/init.php';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header('Location: ' . BASE_URL);
}

if(isset($_POST['signup'])) {
  if(!empty($_POST['user_username']) && !empty($_POST['user_email']) && !empty($_POST['user_password']) && !empty($_POST['confirm_password'])) {
    if($_POST['user_password'] === $_POST['confirm_password']) {
      $user = new User($db);

      if($user->signUp()) {
        $_SESSION['user_username'] = htmlentities($_POST['user_username']);
        $_SESSION['logged_in'] = true;

        header("Location: " . BASE_URL);
      } else {
        $error = "Unable to sign up";
      }
    } else {
      $error = "Passwords do not match";
    }
  } else {
    $error = "Please fill all fields";
  }
}

$page_title = "Sign Up";

require VIEW_ROOT . '/signup.php';