<?php
require_once 'src/init.php';

if(!isset($_SESSION['user'])) {
  header('Location: ' . BASE_URL);
} else {
  $user = new User($db);

  $user_data = $user->getUser($_SESSION['user']);
}

if(isset($_POST['update'])) {
  if(empty($_POST['user_email'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_email' => $_POST['user_email'])) && $_POST['user_email'] !== $user_data->user_email) {
    $error = "This email address is already in use";
  } else if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Enter a valid email address";
  } else {
    $update = ['user_email' => escape($_POST['user_email'])];

    if($user->updateUser($update, $user_data->user_id)) {
      header("Location: " . BASE_URL);
    } else {
      $error = "Unable to update profile";
    }
  }
}

if(isset($_POST['change_password'])) {
  if(empty($_POST['confirm_password']) || empty($_POST['new_password']) || empty($_POST['confirm_new_password'])) {
    $password_error = "Fill in all fields";
  } else if(!password_verify($_POST['confirm_password'], $user_data->user_password)) {
    $password_error = "Enter current password correctly";
  } else if($_POST['new_password'] !== $_POST['confirm_new_password']) {
    $password_error = "Passwords must match";
  } else {
    $password = ['user_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)];

    if($user->changePassword($password, $user_data->user_id)) {
      header("Location: " . BASE_URL);
    } else {
      $password_error = "Unable to change password";
    }
  }
}

if(isset($_POST['delete_profile'])) {
  if(empty($_POST['user_password'])) {
    $delete_error = "Enter your password";
  } else if(!password_verify($_POST['user_password'], $user_data->user_password)) {
    $delete_error = "Enter your password correctly";
  } else {
    if($user->deleteProfile($user_data->user_id)) {
      $user->logOut();
      
      header("Location: " . BASE_URL);
    } else {
      $delete_error = "Unable to delete profile";
    }
  }
}

$page_title = "Update Profile";

require VIEW_ROOT . '/update.php';